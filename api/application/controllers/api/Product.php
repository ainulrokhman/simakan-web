<?php

defined('BASEPATH') OR exit('No direct script access allowed');
use \Firebase\JWT\JWT;

class Product extends BD_Controller {

    function __construct(){
        parent::__construct();
        $this->load->model('Base_model');
    }
    
    public function getProduct_get(){
        try{
            $product = $this->Base_model->getData('product');
            $error = $this->db->error();

            $data = array();
            foreach($product->result() as $data_product){
                $object = array(
                    'product_code' => $data_product->product_code,
                    'product_name' => $data_product->product_name,
                    'price' => (int) $data_product->price,
                    'currency' => $data_product->currency,
                    'discount' => (int) $data_product->discount,
                    'dimension' => $data_product->dimension,
                    'unit' => $data_product->unit,
                    'images' => $data_product->images,
                );
                array_push($data,$object);
            }

            $this->set_response([
                'isSuccess' => TRUE,
                'message' => 'Successfully get data',
                'data' => $data
            ], REST_Controller::HTTP_OK);
        }catch(Exception $e){
            $this->set_response([
                'isSuccess' => FALSE,
                'message' => $error,
                'data' => null
            ], REST_Controller::HTTP_OK);
        }
    }
}