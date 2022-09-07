<?php

defined('BASEPATH') OR exit('No direct script access allowed');
use \Firebase\JWT\JWT;

class Auth extends BD_Controller {

    function __construct(){
        parent::__construct();
        $this->methods['users_get']['limit'] = 500;
        $this->methods['users_post']['limit'] = 100;
        $this->methods['users_delete']['limit'] = 50;
        $this->load->model('Base_model');
    }


    public function login_post(){
        $nis = $this->post('nis');
        $password = $this->post('password');
        $check = $this->Base_model->getDataBy("siswa", array('siswa_nis' => $nis, 'siswa_password' => md5($password)));

		if($check->num_rows() > 0){
            $data = array(
                'siswa_id' => (int) $check->row()->siswa_id,
            );

            $this->set_response([
                'isSuccess' => TRUE,
                'message' => 'Successfully login',
                'data' => $data
            ], REST_Controller::HTTP_OK);
        } else {
            $this->set_response([
                'isSuccess' => FALSE,
                'message' => 'NIS atau password salah',
                'data' => null
            ], REST_Controller::HTTP_OK);
        }
    }

    public function changePassword_post(){
        $user_id = $this->post('siswa_id');
        $oldPassword = md5($this->post('old_password'));
        $newPassword = md5($this->post('new_password'));
        $check = $this->Base_model->getDataBy("siswa", array('siswa_id' => $user_id, 'siswa_password' => $oldPassword));
        if($check->num_rows() > 0){
            $update = $this->Base_model->updateData("siswa", array('siswa_password' => $newPassword), array('siswa_id' => $user_id));
            if($update == true){
                $this->set_response([
                    'isSuccess' => TRUE,
                    'message' => 'Successfully change password',
                    'data' => null
                ], REST_Controller::HTTP_OK);
            }else{
                $this->set_response([
                    'isSuccess' => FALSE,
                    'message' => 'Opps...something went wrong',
                    'data' => null
                ], REST_Controller::HTTP_OK);
            }
        }else{
            $this->set_response([
                'isSuccess' => FALSE,
                'message' => 'Kata sandi lama anda tidak sesuai',
                'data' => null
            ], REST_Controller::HTTP_OK);
        }
        
    }
}
