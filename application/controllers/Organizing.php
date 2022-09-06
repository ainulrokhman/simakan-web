<?php 

class Organizing extends CI_Controller{
	
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
			$angket = $this->Base_model->getData('angket')->result();
			$data = array('admin' => $admin, 'angket' => $angket);
			
			$this->load->view("template/header", $data);
			$this->load->view("organizing_view", $data);
			$this->load->view("template/footer");
		}else{
			$this->load->view('login_view');
		}
	}

	public function detailAngket($id){
		if($this->session->userdata('auth_login') == true){
            $admin_id = $this->session->userdata('admin_id');
			$admin = $this->Base_model->getDataBy('admin', array('admin_id' => $admin_id))->row_array();
			$angket = $this->Base_model->getDataBy('angket', array('angket_id' => $id))->row_array();
			$category = $this->Base_model->getData('category')->result();
			$siswa = $this->Base_model->getData('siswa')->result();
			$questionner = $this->Base_model->getDataBy('questionner', array('angket_id' => $id))->result();
			$responden = $this->Base_model->getDataBy('responden', array('angket_id' => $id))->num_rows();
			$data = array('admin' => $admin, 'angket' => $angket, 'category' => $category, 'siswa' => $siswa, 'questionner' => $questionner, 'responden' => $responden);
			
			$this->load->view("template/header", $data);
			$this->load->view("planing_detail_view", $data);
			$this->load->view("template/footer");
		}else{
			$this->load->view('login_view');
		}
	}

	public function addAngket(){
		if($this->session->userdata('auth_login') == true){
            $admin_id = $this->session->userdata('admin_id');
			$admin = $this->Base_model->getDataBy('admin', array('admin_id' => $admin_id))->row_array();
			$category = $this->Base_model->getData('category')->result();
			$data = array('admin' => $admin, 'category' => $category);
			
			$this->load->view("template/header", $data);
			$this->load->view("planing_add_view", $data);
			$this->load->view("template/footer");
		}else{
			$this->load->view('login_view');
		}
	}
	

	public function saveResponden(){
		$angket = $this->input->post('angket');
		$siswa = $this->input->post('siswa');
		$delete=$this->Base_model->deleteData('responden', array('angket_id' => $angket));
		foreach($siswa as $data_siswa) {
			$check = $this->Base_model->getDataBy('responden', array('angket_id' => $angket, 'siswa_id' => $data_siswa));
			if($check->num_rows() == 0){
				$data = array(
					'angket_id' => $angket,
					'siswa_id' => $data_siswa
				);
				$insert = $this->Base_model->insertData('responden', $data);
			}
		}
		$alert = array(
			'message' => 'OK',
			'title' => 'Success',
			'type' => 'success'
		);
		$this->session->set_flashdata($alert);
		redirect($_SERVER['HTTP_REFERER']);
	}

	public function saveQuestion(){
		$angket = $this->input->post('angket');
		$question = $this->input->post('question');
		$admin_id = $this->session->userdata('admin_id');
		$data = array(
			'angket_id' => $angket,
			'questionner_title' => $question,
			'questionner_type' => 'essay',
			'created_by' => $admin_id,
			'updated_by' => $admin_id
		);
		$insert = $this->Base_model->insertData('questionner', $data);
		if($insert){
			$alert = array(
				'message' => 'Successfully save data',
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

	public function saveAngket(){
		$title = $this->input->post('title');
		$desc = $this->input->post('desc');
		$category = $this->input->post('category');
		$start_date = $this->input->post('start_date');
		$end_date = $this->input->post('end_date');
		$admin_id = $this->session->userdata('admin_id');
		$data = array(
			'angket_title' => $title,
			'angket_description' => $desc,
			'category_id' => $category,
			'angket_start_date' => $start_date,
			'angket_end_date' => $end_date,
			'is_active' => 0,
			'created_by' => $admin_id,
			'updated_by' => $admin_id
		);
		$insert = $this->Base_model->insertData('angket', $data);
		$row = $this->db->select("*")->limit(1)->order_by('angket_id',"DESC")->get("angket")->row();
		if($insert){
			$alert = array(
				'message' => 'Successfully save data',
				'title' => 'Success',
				'type' => 'success'
			);
			$this->session->set_flashdata($alert);
			redirect('planing/detail/'.$row->angket_id);
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

	function updateAngket(){
		date_default_timezone_set('Asia/Jakarta');
		$id = $this->input->post('id');
		$title = $this->input->post('title');
		$desc = $this->input->post('desc');
		$category = $this->input->post('category');
		$start_date = $this->input->post('start_date');
		$end_date = $this->input->post('end_date');
		$status = $this->input->post('status');
		$admin_id = $this->session->userdata('admin_id');

		$kondisi = array('angket_id' => $id);

		$data = array(
			'angket_title' => $title,
			'angket_description' => $desc,
			'category_id' => $category,
			'angket_start_date' => $start_date,
			'angket_end_date' => $end_date,
			'is_active' => $status,
			'updated_by' => $admin_id,
			'updated_date' => date("Y-m-d H:i:s")
		);

		$update = $this->Base_model->updateData('angket', $data, $kondisi);
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

	public function deleteAngket($id){
		$delete=$this->Base_model->deleteData('angket', array('angket_id' => $id));
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

	public function deleteQuestion($id){
		$delete=$this->Base_model->deleteData('questionner', array('questionner_id' => $id));
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