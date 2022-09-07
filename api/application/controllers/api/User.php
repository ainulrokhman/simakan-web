<?php

defined('BASEPATH') OR exit('No direct script access allowed');
use \Firebase\JWT\JWT;

class User extends BD_Controller {

    function __construct(){
        parent::__construct();
        $this->load->model('Base_model');
    }
    
    public function getUser_post(){
        // $this->auth();
        $id = $this->post('siswa_id');
        $user = $this->db->select('*')->from('siswa')->join('class', 'siswa.class_id = class.class_id', 'left')->where(array('siswa.siswa_id' => $id))->get();
        $data = array();
        if($user->num_rows() > 0){
            $data = array(
                'siswa_id' => (int) $user->row()->siswa_id,
                'siswa_nis' => $user->row()->siswa_nis,
                'siswa_name' => $user->row()->siswa_name,
                'class_name' => $user->row()->class_name,
                'siswa_email' => $user->row()->siswa_email,
                'siswa_phone_number' => $user->row()->siswa_phone_number,
                'siswa_images' => $user->row()->siswa_images == "" ? null : images_path.'siswa/'.$user->row()->siswa_images,
            );
            $this->set_response([
                'isSuccess' => TRUE,
                'message' => 'Successfully get data',
                'data' => $data
            ], REST_Controller::HTTP_OK);
        }else{
            $this->set_response([
                'isSuccess' => FALSE,
                'message' => 'User tidak ditemukan',
                'data' => null
            ], REST_Controller::HTTP_OK);
        }
    }

    public function changePhoto_post(){
		date_default_timezone_set('Asia/Jakarta');
        $user_id = $this->post('siswa_id');

		if(!empty($_FILES['images']['name'])){
			$config['upload_path'] = images_path.'siswa/';
			$config['allowed_types'] = 'jpg|png|jpeg';
			$config['max_size'] = '2048';  //2MB max
			$config['max_width'] = '4480'; // pixel
			$config['max_height'] = '4480'; // pixel
			$config['file_name'] = $_FILES['images']['name'];

			//Load upload library and initialize configuration
            $this->load->library('upload',$config);
            $this->upload->initialize($config);

			if ($this->upload->do_upload('images')) {
				$images = $this->upload->data();
	
				$dataUpdate = array(
					'siswa_images' 	        => $images['file_name'],
					'updated_date'			=> date('Y-m-d H:i:s'),
					'updated_by'			=> $user_id
				);
				
                $update = $this->Base_model->updateData("siswa", $dataUpdate, array('siswa_id' => $user_id));
                if($update == true){
                    $this->set_response([
                        'isSuccess' => TRUE,
                        'message' => 'Successfully update cart',
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
                    'message' => 'Opps.. failed to upload images. '.str_replace('</p>','', str_replace('<p>','', $this->upload->display_errors())),
                    'data' => null,
                    'path' => images_path.'siswa/',
                ], REST_Controller::HTTP_OK);
			}
		}        
    }

    public function updateProfile_post(){
		date_default_timezone_set('Asia/Jakarta');
		$name = $this->post('name');
		$email = $this->post('email');
		$phone = $this->post('phone');;
        $siswa_id = $this->post('siswa_id');


		$kondisi = array('siswa_id' => $siswa_id);

		$data = array(
			'siswa_name' => $name,
			'siswa_email' => $email,
			'siswa_phone_number' => $phone,
			'updated_by' => $siswa_id,
			'updated_date' => date("Y-m-d H:i:s")
		);

        try{
            $update = $this->Base_model->updateData('siswa', $data, $kondisi);
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
}