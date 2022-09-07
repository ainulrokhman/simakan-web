<?php 

class Controlling extends CI_Controller{
	
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
			$evaluasi = $this->db->select('*')->from('evaluasi a')->join('angket b', 'a.angket_id = b.angket_id', 'left')->join('admin c', 'a.created_by = c.admin_id', 'left')->get()->result();
			$data=array('evaluasi' => $evaluasi, 'admin' => $admin);
			
			$this->load->view("template/header", $data);
			$this->load->view("evaluasi_view", $data);
			$this->load->view("template/footer");
		}else{
			$this->load->view('login_view');
		}
	}

	public function addEvaluasi(){
		if($this->session->userdata('auth_login') == true){
            $admin_id = $this->session->userdata('admin_id');
			$admin = $this->Base_model->getDataBy('admin', array('admin_id' => $admin_id))->row_array();
			$angket = $this->Base_model->getData('angket')->result();
			$data=array('admin' => $admin, 'angket' => $angket);
			
			$this->load->view("template/header", $data);
			$this->load->view("evaluasi_add_view", $data);
			$this->load->view("template/footer");
		}else{
			$this->load->view('login_view');
		}
	}

	public function saveEvaluasi(){
		$title = $this->input->post('title');
		$desc = $this->input->post('desc');
		$angket = $this->input->post('angket');
		$admin_id = $this->session->userdata('admin_id');
		$data = array(
			'evaluasi_title' => $title,
			'evaluasi_description' => $desc,
			'angket_id' => $angket,
			'created_by' => $admin_id,
			'updated_by' => $admin_id
		);
		$insert = $this->Base_model->insertData('evaluasi', $data);
		if($insert){
			$alert = array(
				'message' => 'Successfully save data',
				'title' => 'Success',
				'type' => 'success'
			);
			$this->session->set_flashdata($alert);
			redirect('controlling/index');
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

	public function deleteEvaluasi($id){
		$delete=$this->Base_model->deleteData('evaluasi', array('evaluasi_id' => $id));
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