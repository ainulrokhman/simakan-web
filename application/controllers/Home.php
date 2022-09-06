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
			$angket = $this->Base_model->getDataBy('angket', array('is_active' => 1));
			$siswa = $this->Base_model->getDataBy('siswa', array('is_active' => 1));
			$guru = $this->Base_model->getDataBy('admin', array('is_active' => 1));
			$category = $this->Base_model->getDataBy('category', array('is_active' => 1));
			$data = array('admin' => $admin, 'angket' => $angket, 'siswa' => $siswa, 'guru' => $guru, 'category' => $category);
			
			$this->load->view("template/header", $data);
			$this->load->view("home_view", $data);
			$this->load->view("template/footer");
		}else{
			$this->load->view('login_view');
		}
	}
	
}
?>