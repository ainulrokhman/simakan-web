<?php 

class Actuating extends CI_Controller{
	
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
			$angket = $this->db->select('c.angket_id, c.angket_title, c.angket_description, b.siswa_name, b.siswa_id, a.is_doing')->from('responden a')->join('siswa b', 'a.siswa_id = b.siswa_id', 'left')->join('angket c', 'a.angket_id = c.angket_id')->where(array('a.is_doing' => 2))->get()->result();
			$data = array('admin' => $admin, 'angket' => $angket);
			
			$this->load->view("template/header", $data);
			$this->load->view("actuating_view", $data);
			$this->load->view("template/footer");
		}else{
			$this->load->view('login_view');
		}
	}

	public function detail($id){
		if($this->session->userdata('auth_login') == true){
            $admin_id = $this->session->userdata('admin_id');
			$admin = $this->Base_model->getDataBy('admin', array('admin_id' => $admin_id))->row_array();
			$angket = $this->Base_model->getDataBy('angket', array('angket_id' => $id))->row_array();
			$responden = $this->db->select('*')->from('responden a')->join('siswa b', 'a.siswa_id = b.siswa_id', 'left')->where(array('a.angket_id' => $id))->get()->result();
			$data = array('admin' => $admin, 'angket' => $angket,'responden' => $responden);
			
			$this->load->view("template/header", $data);
			$this->load->view("organizing_detail_view", $data);
			$this->load->view("template/footer");
		}else{
			$this->load->view('login_view');
		}
	}

	public function result($id){
		$array = explode('-', $id);
		$angket_id = $array[0];
		$siswa_id = $array[1];
		if($this->session->userdata('auth_login') == true){
            $admin_id = $this->session->userdata('admin_id');
			$admin = $this->Base_model->getDataBy('admin', array('admin_id' => $admin_id))->row_array();
			$angket = $this->Base_model->getDataBy('angket', array('angket_id' => $id))->row_array();
			$answer = $this->db->select('*')->from('answer a')->join('questionner b', 'a.questionner_id = b.questionner_id', 'left')->where(array('a.angket_id' => $angket_id, 'a.siswa_id' => $siswa_id))->get()->result();
			$total = $this->db->select('*')->from('answer a')->join('questionner b', 'a.questionner_id = b.questionner_id', 'left')->where(array('a.angket_id' => $angket_id, 'a.siswa_id' => $siswa_id))->get();
			$data = array('admin' => $admin, 'angket' => $angket, 'answer' => $answer, 'total_soal' => $total->num_rows());
			
			$this->load->view("template/header", $data);
			$this->load->view("result_detail_view", $data);
			$this->load->view("template/footer");
		}else{
			$this->load->view('login_view');
		}
	}
}
?>