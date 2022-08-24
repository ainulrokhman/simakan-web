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
			$this->load->view('login_view', $data);
		}
	}
 
	function checklogin(){
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		$where = array(
			'admin_email' => $email,
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
                'message' => 'Username atau Password anda salah',
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
}

?>