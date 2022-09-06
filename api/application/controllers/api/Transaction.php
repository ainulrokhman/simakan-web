<?php

defined('BASEPATH') OR exit('No direct script access allowed');
use \Firebase\JWT\JWT;

class Transaction extends BD_Controller {

    function __construct(){
        parent::__construct();
        $this->load->model('Base_model');
    }

    public function checkout_post(){
        $document_code = "TRX-".date("YmdHis");
        $document_number = "TRX-".date("YmdHis");
        $user = $this->post('user');

        //get cart
        $this->db->select('*');    
        $this->db->from('cart');
        $this->db->join('product', 'cart.product_code = product.product_code');
        $this->db->where("cart.user", $user );
        $cart = $this->db->get();
        $total = 0;

        if($cart->num_rows() > 0) {
            for($i = 0; $i < $cart->num_rows(); $i++) {
                $insert = $this->Base_model->insertData("transaction_detail", array(
                    "document_code" => $document_code,
                    "document_number" => $document_number,
                    "product_code" => $cart->row($i)->product_code,
                    "price" => $cart->row($i)->price,
                    "quantity" => $cart->row($i)->quantity,
                    "unit" => $cart->row($i)->unit,
                    "sub_total" => $cart->row($i)->price * $cart->row($i)->quantity,
                    "currency" => $cart->row($i)->currency
                ));
                $total = $total + ( $cart->row($i)->price * $cart->row($i)->quantity);
            }
        }

        $data = array(
            'document_code'       	=> $document_code,
            'document_number'  => $document_number,
            'user'    	=> $user,
            'total' => $total,
            'date' => date("Y-m-d")
        );
        $insert = $this->Base_model->insertData("transaction_header", $data);

		if($insert){
            $delete = $this->Base_model->deleteData("cart", array('user' => $user));
            $this->set_response([
                'isSuccess' => TRUE,
                'message' => 'Successfully submit data',
                'data' => null
            ], REST_Controller::HTTP_OK);
        } else {
            $this->set_response([
                'isSuccess' => FALSE,
                'message' => 'Failed submit data',
                'data' => null
            ], REST_Controller::HTTP_OK);
        }
    }

    public function getReport_get(){
        $this->db->select('*');    
        $this->db->from('transaction_header as a');
        $this->db->join('login as b', 'a.user = b.user');
        $report = $this->db->get();


        $data = array();
        foreach($report->result() as $data_report){
            $this->db->select('*');    
            $this->db->from('transaction_detail as a');
            $this->db->join('product as b', 'a.product_code = b.product_code');
            $this->db->where('document_code',$data_report->document_code);
            $detail = $this->db->get();

            $item = array();
            foreach($detail->result() as $data_detail){
                $object_item = array(
                    'product_code' => $data_detail->product_code,
                    'product_name' => $data_detail->product_name,
                    'quantity' => $data_detail->quantity,
                );
                array_push($item,$object_item);
            }
            
            $object = array(
                'transaction' => $data_report->document_code,
                'user' => $data_report->user,
                'total' => (int) $data_report->total,
                'date' => $data_report->date,
                'item' => $item
            );
            array_push($data,$object);
        }

        $this->set_response([
            'isSuccess' => TRUE,
            'message' => 'Successfully get data',
            'data' => $data
        ], REST_Controller::HTTP_OK);
        
    }
}