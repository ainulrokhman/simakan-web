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


    public function getAddress_post(){
        try{
            $user_id = $this->post('user_id');
            $address = $this->db->select('*')
                ->from('address as A')
                ->join('province as B', 'A.province_id = B.province_id')
                ->join('city as C', 'A.city_id = C.city_id')
                ->join('district as D', 'A.district_id = D.district_id')
                ->get();
            $data = array();
            $error = $this->db->error();

            foreach($address->result() as $data_address){
                $object = array(
                    'address_id' => (int) $data_address->address_id,
                    'address_name' => $data_address->address_name,
                    'address_detail' => $data_address->address_detail,
                    'address_contact_person' => $data_address->address_contact_person,
                    'address_phone_number' => $data_address->address_phone_number,
                    'province_id' => (int) $data_address->province_id,
                    'province_name' => $data_address->province_name,
                    'city_id' => (int) $data_address->city_id,
                    'city_name' => $data_address->city_name,
                    'district_id' => (int) $data_address->district_id,
                    'district_name' => $data_address->district_name,
                    'latitude' => (double) $data_address->address_latitude,
                    'longitude' => (double) $data_address->address_longitude,
                    'address_full' => $data_address->address_detail.", ".$data_address->district_name.", ".$data_address->city_name.", ".$data_address->province_name
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

    public function getProvince_post(){
        try{
            $province = $this->Base_model->getDataBy("province", array());
            $error = $this->db->error();

            $data = array();
            foreach($province->result() as $data_province){
                $object = array(
                    'province_id' => (int) $data_province->province_id,
                    'province_name' => $data_province->province_name
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

    public function getCity_post(){
        $province_id = $this->post('province_id');
        try{
            $city = $this->Base_model->getDataBy("city", array('province_id' => $province_id));
            $error = $this->db->error();

            $data = array();
            foreach($city->result() as $data_city){
                $object = array(
                    'city_id' => (int) $data_city->city_id,
                    'city_name' => $data_city->city_name
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

    public function getDistrict_post(){
        $city_id = $this->post('city_id');
        try{
            $district = $this->Base_model->getDataBy("district", array('city_id' => $city_id));
            $error = $this->db->error();

            $data = array();
            foreach($district->result() as $data_district){
                $object = array(
                    'district_id' => (int) $data_district->district_id,
                    'district_name' => $data_district->district_name
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

    public function addAddress_post(){
        date_default_timezone_set('Asia/Jakarta');
        $user_id = $this->post('user_id');
        $address_name = $this->post('address_name');
        $address_detail = $this->post('address_detail');
        $address_contact_person = $this->post('address_contact_person');
        $address_phone_number = $this->post('address_phone_number');
        $province_id = $this->post('province_id');
        $city_id = $this->post('city_id');
        $district_id = $this->post('district_id');

        $data = array(
            'user_id' => $user_id,
            'address_name' => $address_name,
            'address_detail' => $address_detail,
            'address_contact_person' => $address_contact_person,
            'address_phone_number' => $address_phone_number,
            'province_id' => $province_id,
            'city_id' => $city_id,
            'district_id' => $district_id,
            'is_active' => 1,
            'created_by' => $user_id,
            'created_date' => date('Y-m-d H:i:s')
        );
        $insert = $this->Base_model->insertData('address', $data);
        if($insert == true){
            $this->set_response([
                'isSuccess' => TRUE,
                'message' => 'Successfully add address',
                'data' => null
            ], REST_Controller::HTTP_OK);
        }else{
            $this->set_response([
                'isSuccess' => TRUE,
                'message' => 'Opps... something went wrong',
                'data' => null
            ], REST_Controller::HTTP_OK);
        }
    }

    public function updateAddress_post(){
        date_default_timezone_set('Asia/Jakarta');
        $user_id = $this->post('user_id');
        $address_id = $this->post('address_id');
        $address_name = $this->post('address_name');
        $address_detail = $this->post('address_detail');
        $address_contact_person = $this->post('address_contact_person');
        $address_phone_number = $this->post('address_phone_number');
        $province_id = $this->post('province_id');
        $city_id = $this->post('city_id');
        $district_id = $this->post('district_id');

        $data = array(
            'address_name' => $address_name,
            'address_detail' => $address_detail,
            'address_contact_person' => $address_contact_person,
            'address_phone_number' => $address_phone_number,
            'province_id' => $province_id,
            'city_id' => $city_id,
            'district_id' => $district_id,
            'updated_by' => $user_id,
            'updated_date' => date('Y-m-d H:i:s')
        );
        $update = $this->Base_model->updateData("address", $data, array('address_id' => $address_id));
        if($update == true){
            $this->set_response([
                'isSuccess' => TRUE,
                'message' => 'Successfully add address',
                'data' => null
            ], REST_Controller::HTTP_OK);
        }else{
            $this->set_response([
                'isSuccess' => TRUE,
                'message' => 'Opps... something went wrong',
                'data' => null
            ], REST_Controller::HTTP_OK);
        }
    }

    public function deleteAddress_post(){
        $user_id = $this->post('user_id');
        $address_id = $this->post('address_id');

        $delete = $this->Base_model->deleteData("address", array('address_id' => $address_id, 'user_id' => $user_id));
        if($delete == true){
            $this->set_response([
                'isSuccess' => TRUE,
                'message' => 'Successfully delete address',
                'data' => null
            ], REST_Controller::HTTP_OK);
        }else{
            $this->set_response([
                'isSuccess' => FALSE,
                'message' => 'Opps...something went wrong',
                'data' => null
            ], REST_Controller::HTTP_OK);
        }
    }

    public function deletePhoto_post(){
        $user_id = $this->post('user_id');

        $delete = $this->Base_model->updateData("user", array('user_picture' => null), array('user_id' => $user_id));
        if($delete == true){
            $this->set_response([
                'isSuccess' => TRUE,
                'message' => 'Successfully delete photo',
                'data' => null
            ], REST_Controller::HTTP_OK);
        }else{
            $this->set_response([
                'isSuccess' => FALSE,
                'message' => 'Opps...something went wrong',
                'data' => null
            ], REST_Controller::HTTP_OK);
        }
    }

    public function changePhoto_post(){
		date_default_timezone_set('Asia/Jakarta');
        $user_id = $this->post('user_id');

        //images 1
		if(!empty($_FILES['images']['name'])){
			$config['upload_path'] = images_path.'user/';
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
					'user_picture' 	=> $images['file_name'],
					'updated_date'			=> date('Y-m-d H:i:s'),
					'updated_by'			=> $user_id
				);
				
                $update = $this->Base_model->updateData("user", $dataUpdate, array('user_id' => $user_id));
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
                    'path' => images_path.'user/'
                ], REST_Controller::HTTP_OK);
			}
		}        
    }
}