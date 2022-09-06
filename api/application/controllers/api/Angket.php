<?php

defined('BASEPATH') OR exit('No direct script access allowed');
use \Firebase\JWT\JWT;

class Angket extends BD_Controller {

    function __construct(){
        parent::__construct();
        $this->load->model('Base_model');
    }
    
    public function getAngket_post(){
		date_default_timezone_set('Asia/Jakarta');
        $id = $this->post('siswa_id');
        $date = date("d-M-Y");
        try{
            $this->db->select('*');    
            $this->db->from('responden a');
            $this->db->join('angket b', 'a.angket_id = b.angket_id');
            $this->db->join('category c', 'b.category_id = c.category_id');
            $this->db->where("a.siswa_id", $id );
            $angket = $this->db->get();
            $error = $this->db->error();

            $data = array();
            foreach($angket->result() as $data_angket){
                $status = "";
                if($date > date("d-M-Y", strtotime($data_angket->angket_end_date))) {
                    $status = "Sudah Berakhir";
                } else if($date < date("d-M-Y", strtotime($data_angket->angket_start_date))) {
                    $status = "Belum Dimulai";
                } else {
                    $status = "OK";
                }

                $object = array(
                    'responden_id' => (int) $data_angket->responden_id,
                    'angket_id' => (int) $data_angket->angket_id,
                    'angket_title' => $data_angket->angket_title,
                    'angket_description' => $data_angket->angket_description,
                    'category_name' => $data_angket->category_name,
                    'angket_start_date' => date("d-M-Y", strtotime($data_angket->angket_start_date)),
                    'angket_end_date' => date("d-M-Y", strtotime($data_angket->angket_end_date)),
                    'status' => $status
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