<?php 

class Home extends CI_Controller{
	
	function __construct(){
		parent::__construct();	
		$this->load->helper('url');     
		$this->load->model('Base_model');
	}

	public function index(){
		if($this->session->userdata('auth_login') == true){
            $admin_id = $this->session->userdata('admin_id');
			$admin = $this->Base_model->getDataBy('admin', array('admin_id' => $admin_id))->row_array();
			$sosmed = $this->Base_model->getDataBy('social_media', array('is_active' => 1))->result();
			$data = array('admin' => $admin, 'sosmed' => $sosmed);
			
			$this->load->view("template/header", $data);
			$this->load->view("home_view", $data);
			$this->load->view("template/footer");
		}else{
			$this->load->view('login_view');
		}
	}
	
}
?>