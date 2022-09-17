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
                    'is_doing' => (int) $data_angket->is_doing,
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

    public function getQuestion_post(){
		date_default_timezone_set('Asia/Jakarta');
        $id = $this->post('angket_id');
        $date = date("d-M-Y");
        try{
            $angket = $this->Base_model->getDataBy("questionner", array('angket_id' => $id));

            $data = array();
            foreach($angket->result() as $data_angket){

                $object = array(
                    'questionner_id' => (int) $data_angket->questionner_id,
                    'questionner_title' => $data_angket->questionner_title,
                    'option_a' => $data_angket->option_a,
                    'option_b' => $data_angket->option_b,
                    'option_c' => $data_angket->option_c,
                    'option_d' => $data_angket->option_d,
                    'option_e' => $data_angket->option_e,
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

    public function doingAngket_post(){
		date_default_timezone_set('Asia/Jakarta');
		$angket_id = $this->post('angket_id');
		$siswa_id = $this->post('siswa_id');
		$is_doing = $this->post('is_doing');;


		$kondisi = array('angket_id' => $angket_id, 'siswa_id' => $siswa_id);

		$data = array(
			'is_doing' => $is_doing,
			'updated_by' => $siswa_id,
			'updated_date' => date("Y-m-d H:i:s")
		);

        try{
            $update = $this->Base_model->updateData('responden', $data, $kondisi);
            if($update){
                $this->set_response([
                    'isSuccess' => TRUE,
                    'message' => 'Successfully update data',
                    'data' => $data
                ], REST_Controller::HTTP_OK);
            }else{
                $this->set_response([
                    'isSuccess' => FALSE,
                    'message' => 'Failed update data',
                    'data' => null
                ], REST_Controller::HTTP_OK);
            }	
        }catch(Exception $e){
            $this->set_response([
                'isSuccess' => FALSE,
                'message' => $error,
                'data' => null
            ], REST_Controller::HTTP_OK);
        }
	}

    public function answerQuestion_post(){
		date_default_timezone_set('Asia/Jakarta');
		$angket_id = $this->post('angket_id');
		$question_id = $this->post('question_id');
		$siswa_id = $this->post('siswa_id');
        $answer_value = $this->post('answer_value');
        $check_score = $this->Base_model->getDataBy("questionner", array('angket_id' => $angket_id, 'questionner_id' => $question_id));
        $answer = "";
        $point = 0;
        if($answer_value == 0) {
            $answer = "A";
            $point = (int) $check_score->row()->score_a;
        } else if($answer_value == 1) {
            $answer = "B";
            $point = (int) $check_score->row()->score_b;
        } else if($answer_value == 2) {
            $answer = "C";
            $point = (int) $check_score->row()->score_c;
        } else if($answer_value == 3) {
            $answer = "D";
            $point = (int) $check_score->row()->score_d;
        } else if($answer_value == 4) {
            $answer = "E";
            $point = (int) $check_score->row()->score_e;
        } else {
            $answer = "";
            $point = 0;
        }

        $check = $this->Base_model->getDataBy("answer", array('angket_id' => $angket_id, 'questionner_id' => $question_id, 'siswa_id' => $siswa_id));
        if($check->num_rows() > 0) {
            $kondisi = array('angket_id' => $angket_id, 'siswa_id' => $siswa_id, 'questionner_id' => $question_id);

            $data = array(
                'answer_value' => $answer,
                'score' => $point,
                'updated_by' => $siswa_id,
                'updated_date' => date("Y-m-d H:i:s")
            );
    
            try{
                $update = $this->Base_model->updateData('answer', $data, $kondisi);
                if($update){
                    $this->set_response([
                        'isSuccess' => TRUE,
                        'message' => 'Successfully update data',
                        'data' => null
                    ], REST_Controller::HTTP_OK);
                }else{
                    $this->set_response([
                        'isSuccess' => FALSE,
                        'message' => 'Failed update data',
                        'data' => null
                    ], REST_Controller::HTTP_OK);
                }	
            }catch(Exception $e){
                $this->set_response([
                    'isSuccess' => FALSE,
                    'message' => $error,
                    'data' => null
                ], REST_Controller::HTTP_OK);
            }
        } else {
            $data = array(
                'angket_id'       => $angket_id,
                'questionner_id'  => $question_id,
                'siswa_id'    	  => $siswa_id,
                'answer_value'    => $answer,
                'score' => $point,
                'created_by'      => $siswa_id,
                'updated_by'      => $siswa_id
            );
            try{
                $insert = $this->Base_model->insertData("answer", $data);
                if($insert){
                    $this->set_response([
                        'isSuccess' => TRUE,
                        'message' => 'Successfully insert data',
                        'data' => null
                    ], REST_Controller::HTTP_OK);
                }else{
                    $this->set_response([
                        'isSuccess' => FALSE,
                        'message' => 'Failed insert data',
                        'data' => null
                    ], REST_Controller::HTTP_OK);
                }	
            }catch(Exception $e){
                $this->set_response([
                    'isSuccess' => FALSE,
                    'message' => $error,
                    'data' => null
                ], REST_Controller::HTTP_OK);
            }
        }
	}
}