<?php 

class Admin extends CI_Controller{
	
	function __construct(){
		parent::__construct();
	
		$this->load->helper('url');   
		$this->load->model('Base_model');		
	}

	public function index(){
		if($this->session->userdata('bmf_admin_login') == true){
			$app = $this->Base_model->getData('app_settings')->row_array();
            $admin_id = $this->session->userdata('admin_id');
			$admin = $this->Base_model->getDataBy('admin', array('admin_id' => $admin_id))->row_array();
			$list_admin = $this->Base_model->getData('admin')->result();
			$data=array('app' => $app, 'admin' => $admin, 'list_admin' => $list_admin);
			
			$this->load->view("template/header", $data);
			$this->load->view("admin_view", $data);
			$this->load->view("template/footer");
		}else{
			$app = $this->Base_model->getData('app_settings')->row_array();
			$data=array('app' => $app);
			$this->load->view('login_view', $data);
		}
	}

	public function saveAdmin(){
		date_default_timezone_set('Asia/Jakarta');
		$name = $this->input->post('name');
		$email = $this->input->post('email');
		$phone = $this->input->post('phone');
		$admin_id = $this->session->userdata('admin_id');

		$data = array(
			'admin_fullname'       	=> $name,
			'admin_email'     		=> $email,
			'admin_phone_number'    => $phone,
			'admin_password'     	=> md5('password123'),
			'admin_role'     		=> 'Admin',
			'is_active'     		=> 1,
			'created_date'     		=> date('Y-m-d H:i:s'),
			'created_by'			=> $admin_id,
			'updated_date'			=> date('Y-m-d H:i:s'),
			'updated_by'			=> $admin_id
		);
		$insert = $this->Base_model->insertData('admin', $data);
		if($insert){
			$alert = array(
				'message' => 'Successfully save data',
				'title' => 'Success',
				'type' => 'success'
			);
			$this->session->set_flashdata($alert);
			redirect('admin');
		}else{
			$alert = array(
				'message' => 'Opps.. something went wrong',
				'title' => 'Error',
				'type' => 'error'
			);
			$this->session->set_flashdata($alert);
			redirect($_SERVER['HTTP_REFERER']);
		}
	}

	public function deleteAdmin($id){
		$delete=$this->Base_model->deleteData('admin', array('admin_id' => $id));
		if($delete){
			$alert = array(
				'message' => 'Successfully delete data',
				'title' => 'Success',
				'type' => 'success'
			);
			$this->session->set_flashdata($alert);
			redirect('admin');
		}else{
			$alert = array(
				'message' => 'Opps.. something went wrong',
				'title' => 'Error',
				'type' => 'error'
			);
			$this->session->set_flashdata($alert);
			redirect($_SERVER['HTTP_REFERER']);
		}
	}

	// function profile(){
	// 	if($this->session->userdata('bmf_admin_login') == true){
	// 		$app = $this->Base_model->getData('app_settings')->row_array();
    //         $admin_id = $this->session->userdata('admin_id');
	// 		$admin = $this->Base_model->getDataBy('admin', array('admin_id' => $admin_id))->row_array();
	// 		$data = array('admin' => $admin, 'app' => $app);
			
	// 		$this->load->view("template/header", $data);
	// 		$this->load->view('profile_view');
	// 		$this->load->view("template/footer");
    //     }else{
    //         $app = $this->Base_model->getData('app_settings')->row_array();
	// 		$data=array('app' => $app);
	// 		$this->load->view('login_view', $data);
	// 	}
	// }

	// function changePassword(){
	// 	if($this->session->userdata('bmf_admin_login') == true){
	// 		$app=$this->App_model->get_app();
    //         $user_id = $this->session->userdata('user_id');
	// 		$user = $this->Auth_model->getUser($user_id);
	// 		$data = array('user' => $user, 'app' => $app);
			
	// 		$this->load->view("template/header", $data);
	// 		$this->load->view('change_password_view');
	// 		$this->load->view("template/footer");
    //     }else{
    //         redirect(base_url());
	// 	}
	// }

	// public function updateprofile(){
	// 	date_default_timezone_set('Asia/Jakarta');
	// 	$name = $this->input->post('name');
	// 	$email = $this->input->post('email');
	// 	$phone = $this->input->post('phone');
	// 	$user_id = $this->session->userdata('user_id');
		
	// 	$kondisi = array('user_id' => $user_id );

	// 	$data = array(
	// 		'user_fullname'       		=> $name,
	// 		'user_phone_number'     	=> $phone,
	// 		'updated_date'				=> date('Y-m-d H:i:s'),
	// 		'updated_by'				=> $user_id
	// 	);
	// 	$update = $this->User_model->updateuser($data,$kondisi);
	// 	if($update){
	// 		$alert = array(
	// 			'message' => 'Successfully update data',
	// 			'title' => 'Success',
	// 			'type' => 'success'
	// 		);
	// 		$this->session->set_flashdata($alert);
	// 		redirect($_SERVER['HTTP_REFERER']);
	// 	}else{
	// 		$alert = array(
	// 			'message' => 'Opps.. something went wrong',
	// 			'title' => 'Error',
	// 			'type' => 'error'
	// 		);
	// 		$this->session->set_flashdata($alert);
	// 		redirect($_SERVER['HTTP_REFERER']);
	// 	}
	// }

	// public function updatepassword(){
	// 	date_default_timezone_set('Asia/Jakarta');
	// 	$old = $this->input->post('old');
	// 	$new = $this->input->post('new');
	// 	$confirm = $this->input->post('confirm');
	// 	$user_id = $this->session->userdata('user_id');

	// 	if($new != $confirm){
	// 		$alert = array(
	// 			'message' => 'Opps.. new password must same with confirm password',
	// 			'title' => 'Error',
	// 			'type' => 'error'
	// 		);
	// 		$this->session->set_flashdata($alert);
	// 		redirect($_SERVER['HTTP_REFERER']);
	// 	}else{
	// 		$kondisi = array('user_id' => $user_id );

	// 		//cek password lama
	// 		$where = array(
	// 			'user_password' => md5($old)
	// 		);
	// 		$check = $this->User_model->checkPassword('user', $where);
	// 		if($check->num_rows() > 0){
	// 			$data = array(
	// 				'user_password'       		=> md5($new),
	// 				'updated_date'				=> date('Y-m-d H:i:s'),
	// 				'updated_by'				=> $user_id
	// 			);
	// 			$update = $this->User_model->updateuser($data,$kondisi);
	// 			if($update){
	// 				$alert = array(
	// 					'message' => 'Successfully update data',
	// 					'title' => 'Success',
	// 					'type' => 'success'
	// 				);
	// 				$this->session->set_flashdata($alert);
	// 				redirect($_SERVER['HTTP_REFERER']);
	// 			}else{
	// 				$alert = array(
	// 					'message' => 'Opps.. something went wrong',
	// 					'title' => 'Error',
	// 					'type' => 'error'
	// 				);
	// 				$this->session->set_flashdata($alert);
	// 				redirect($_SERVER['HTTP_REFERER']);
	// 			}
	// 		}else{
	// 			$alert = array(
	// 				'message' => 'Opps.. old password is wrong',
	// 				'title' => 'Error',
	// 				'type' => 'error'
	// 			);
	// 			$this->session->set_flashdata($alert);
	// 			redirect($_SERVER['HTTP_REFERER']);
	// 		}
	// 	}
	// }

	public function resetpassword($id){
		date_default_timezone_set('Asia/Jakarta');
		$admin_id = $this->session->userdata('admin_id');
		
		$kondisi = array('admin_id' => $id);

		$data = array(
			'admin_password'       		=> md5('password123'),
			'updated_date'				=> date('Y-m-d H:i:s'),
			'updated_by'				=> $admin_id
		);
		$update = $this->Base_model->updateData('admin', $data, $kondisi);
		if($update){
			$alert = array(
				'message' => 'Successfully reset data',
				'title' => 'Success',
				'type' => 'success'
			);
			$this->session->set_flashdata($alert);
			redirect($_SERVER['HTTP_REFERER']);
		}else{
			$alert = array(
				'message' => 'Opps.. something went wrong',
				'title' => 'Error',
				'type' => 'error'
			);
			$this->session->set_flashdata($alert);
			redirect($_SERVER['HTTP_REFERER']);
		}
	}
}
?>