<?php 

class User extends CI_Controller{
	
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
			$user = $this->Base_model->getData('user')->result();
			$data=array('app' => $app, 'user' => $user, 'admin' => $admin);
			
			$this->load->view("template/header", $data);
			$this->load->view("user_view", $data);
			$this->load->view("template/footer");
		}else{
			$app = $this->Base_model->getData('app_settings')->row_array();
			$data=array('app' => $app);
			$this->load->view('login_view', $data);
		}
	}

	public function deleteUser($id){
		$delete=$this->Base_model->deleteData('user', array('user_id' => $id));
		if($delete){
			$alert = array(
				'message' => 'Successfully delete data',
				'title' => 'Success',
				'type' => 'success'
			);
			$this->session->set_flashdata($alert);
			redirect('user');
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