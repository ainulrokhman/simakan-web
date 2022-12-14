<?php 

class Siswa extends CI_Controller{
	
	function __construct(){
		parent::__construct();
	
		$this->load->helper('url');     
		$this->load->model('Base_model');
		$this->load->library('upload');		
	}

	public function index(){
		if($this->session->userdata('auth_login') == true){
            $admin_id = $this->session->userdata('admin_id');
			$admin = $this->Base_model->getDataBy('admin', array('admin_id' => $admin_id))->row_array();
			$siswa = $this->db->select('*')->from('siswa')->join('class', 'siswa.class_id = class.class_id', 'left')->get()->result();
			$data=array('admin' => $admin, 'siswa' => $siswa);
			
			$this->load->view("template/header", $data);
			$this->load->view("siswa_view", $data);
			$this->load->view("template/footer");
		}else{
			$this->load->view('login_view');
		}
	}

	public function detailSiswa($id){
		if($this->session->userdata('auth_login') == true){
            $admin_id = $this->session->userdata('admin_id');
			$admin = $this->Base_model->getDataBy('admin', array('admin_id' => $admin_id))->row_array();
			$siswa = $this->db->select('*')->from('siswa')->join('class', 'siswa.class_id = class.class_id', 'left')->where(array('siswa.siswa_id' => $id))->get()->row_array();
			$data=array('admin' => $admin, 'siswa' => $siswa);
			
			$this->load->view("template/header", $data);
			$this->load->view("siswa_detail_view", $data);
			$this->load->view("template/footer");
		}else{
			$this->load->view('login_view');
		}
	}

	public function addSiswa(){
		if($this->session->userdata('auth_login') == true){
            $admin_id = $this->session->userdata('admin_id');
			$admin = $this->Base_model->getDataBy('admin', array('admin_id' => $admin_id))->row_array();
			$class = $this->Base_model->getDataBy('class', array('is_active' => 1))->result();
			$data=array('admin' => $admin, 'class' => $class);
			
			$this->load->view("template/header", $data);
			$this->load->view("siswa_add_view", $data);
			$this->load->view("template/footer");
		}else{
			$this->load->view('login_view');
		}
	}

	public function saveSiswa(){
		date_default_timezone_set('Asia/Jakarta');
		$name = $this->input->post('name');
		$email = $this->input->post('email');
		$phone = $this->input->post('phone');
		$nis = $this->input->post('nis');
		$class = $this->input->post('class');
		$admin_id = $this->session->userdata('admin_id');

		$data = array(
			'siswa_name'       	 	=> $name,
			'siswa_email'   		=> $email,
			'siswa_phone_number'    => $phone,
			'siswa_nis'    => $nis,
			'class_id'    => $class,
			'siswa_password' => md5('password123'),
			'siswa_images' => 'default.png',
			'is_active'     		=> 1,
			'created_date'     		=> date('Y-m-d H:i:s'),
			'created_by'			=> $admin_id,
			'updated_date'			=> date('Y-m-d H:i:s'),
			'updated_by'			=> $admin_id
		);
		$insert = $this->Base_model->insertData('siswa', $data);
		if($insert){
			$alert = array(
				'message' => 'Successfully save data',
				'title' => 'Success',
				'type' => 'success'
			);
			$this->session->set_flashdata($alert);
			redirect('siswa');
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

	public function deleteSiswa($id){
		$delete=$this->Base_model->deleteData('siswa', array('siswa_id' => $id));
		if($delete){
			$alert = array(
				'message' => 'Successfully delete data',
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