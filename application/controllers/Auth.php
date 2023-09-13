<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller{
 
	function __construct(){
		parent::__construct();
		
		$this->load->helper('url');
		$this->load->model('Base_model');
 
	}
 
	function index(){
		if($this->session->userdata('auth_login') == true){
            redirect(base_url());
        }else{
			$this->load->view('login_view');
		}
	}
 
	function checklogin(){
		$nip = $this->input->post('nip');
		$password = $this->input->post('password');
		$where = array(
			'admin_nip' => $nip,
			'admin_password' => md5($password)
		);
		$cek = $this->Base_model->getDataBy("admin", $where);
		if($cek->num_rows() > 0){
			$admin_id = $cek->row()->admin_id;
			$admin_role = $cek->row()->admin_role;
			$data_session = array(
				'admin_id' => $admin_id,
				'admin_role' => $admin_role,
				'auth_login' => true
				);
 
			$this->session->set_userdata($data_session);
			
			$alert = array(
				'message' => 'Selamat datang di ruang administrator',
				'title' => 'Success',
				'type' => 'success'
			);
			$this->session->set_flashdata($alert);
			redirect(base_url()); 
		}else{
			$alert = array(
                'message' => 'NIP atau Password anda salah',
                'title' => 'Error',
                'type' => 'error'
            );
			$this->session->set_flashdata($alert);
			redirect('login');
		}
	}

	public function logout(){
        $this->session->unset_userdata('admin_id');
        $this->session->unset_userdata('admin_role');
        $this->session->unset_userdata('auth_login');
        redirect(base_url());
    }

	public function profile(){
		if($this->session->userdata('auth_login') == true){
            $admin_id = $this->session->userdata('admin_id');
			$admin = $this->Base_model->getDataBy('admin', array('admin_id' => $admin_id))->row_array();
			$data=array('admin' => $admin);
			
			$this->load->view("template/header", $data);
			$this->load->view("profile_view", $data);
			$this->load->view("template/footer");
		}else{
			$this->load->view('login_view');
		}
	}

	public function changePassword(){
		if($this->session->userdata('auth_login') == true){
            $admin_id = $this->session->userdata('admin_id');
			$admin = $this->Base_model->getDataBy('admin', array('admin_id' => $admin_id))->row_array();
			$data=array('admin' => $admin);
			
			$this->load->view("template/header", $data);
			$this->load->view("change_password_view", $data);
			$this->load->view("template/footer");
		}else{
			$this->load->view('login_view');
		}
	}

	function updateProfile(){
		date_default_timezone_set('Asia/Jakarta');
		$name = $this->input->post('name');
		$admin_id = $this->session->userdata('admin_id');

		$kondisi = array('admin_id' => $admin_id);

		$data = array(
			'admin_name'       		=> $name,
			'updated_date'			=> date('Y-m-d H:i:s'),
			'updated_by'			=> $admin_id
		);

		$update = $this->Base_model->updateData('admin', $data, $kondisi);
		if($update){
			$alert = array(
				'message' => 'Successfully update data',
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


	function updatePassword(){
		date_default_timezone_set('Asia/Jakarta');
		$old = $this->input->post('old_password');
		$new = $this->input->post('new_password');
		$confirm = $this->input->post('confirm_password');
		$admin_id = $this->session->userdata('admin_id');

		if($new == $confirm) {
			$check = $this->Base_model->getDataBy('admin', array('admin_id' => $admin_id, 'admin_password' => md5($old)));
			if($check->num_rows() > 0){
				$kondisi = array('admin_id' => $admin_id);

				$data = array(
					'admin_password'       	=> md5($new),
					'updated_date'			=> date('Y-m-d H:i:s'),
					'updated_by'			=> $admin_id
				);
		
				$update = $this->Base_model->updateData('admin', $data, $kondisi);
				if($update){
					$alert = array(
						'message' => 'Successfully update data',
						'title' => 'Success',
						'type' => 'success'
					);
					$this->session->set_flashdata($alert);
					redirect($_SERVER['HTTP_REFERER']);
				} else {
					$alert = array(
						'message' => 'Opps.. something went wrong',
						'title' => 'Error',
						'type' => 'error'
					);
					$this->session->set_flashdata($alert);
					redirect($_SERVER['HTTP_REFERER']);
				}	
			} else {
				$alert = array(
					'message' => 'User tidak ditemukan',
					'title' => 'Error',
					'type' => 'error'
				);
				$this->session->set_flashdata($alert);
				redirect($_SERVER['HTTP_REFERER']);
			}
		} else {
			$alert = array(
				'message' => 'Kata sandi baru dengan konfirmasi kata sandi tidak boleh beda',
				'title' => 'Error',
				'type' => 'error'
			);
			$this->session->set_flashdata($alert);
			redirect($_SERVER['HTTP_REFERER']);
		}
	}
}

?>