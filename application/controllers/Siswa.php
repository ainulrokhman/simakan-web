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

	public function editPayment($id){
		if($this->session->userdata('bmf_admin_login') == true){
			$app = $this->Base_model->getData('app_settings')->row_array();
            $admin_id = $this->session->userdata('admin_id');
			$admin = $this->Base_model->getDataBy('admin', array('admin_id' => $admin_id))->row_array();
			$payment = $this->Base_model->getDataBy('payment', array('payment_id' => $id))->row_array();
			$data=array('app' => $app, 'admin' => $admin, 'payment' => $payment);
			
			$this->load->view("template/header", $data);
			$this->load->view("payment_edit_view", $data);
			$this->load->view("template/footer");
		}else{
			$app = $this->Base_model->getData('app_settings')->row_array();
			$data=array('app' => $app);
			$this->load->view('login_view', $data);
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

	function updatePayment(){
		date_default_timezone_set('Asia/Jakarta');
		$id = $this->input->post('id');
		$name = $this->input->post('name');
		$desc = $this->input->post('desc');
		if(!empty($_FILES['images']['tmp_name'])){
			$images = file_get_contents($_FILES['images']['tmp_name']); 
		}else{
			$images = null;
		}
		$admin_id = $this->session->userdata('admin_id');

		$kondisi = array('payment_id' => $id);

		if($images != null){
			$data = array(
				'payment_name'       		=> $name,
				'payment_instruction'   	=> $desc,
				'payment_logo'     		=> $images,
				'updated_date'			=> date('Y-m-d H:i:s'),
				'updated_by'			=> $admin_id
			);
		}else{
			$data = array(
				'payment_name'       		=> $name,
				'payment_instruction'   	=> $desc,
				'updated_date'			=> date('Y-m-d H:i:s'),
				'updated_by'			=> $admin_id
			);
		}

		$update = $this->Base_model->updateData('payment', $data, $kondisi);
		if($update){
			$alert = array(
				'message' => 'Successfully update data',
				'title' => 'Success',
				'type' => 'success'
			);
			$this->session->set_flashdata($alert);
			redirect('payment');
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

	public function deletePayment($id){
		$delete=$this->Base_model->deleteData('payment', array('payment_id' => $id));
		if($delete){
			$alert = array(
				'message' => 'Successfully delete data',
				'title' => 'Success',
				'type' => 'success'
			);
			$this->session->set_flashdata($alert);
			redirect('payment');
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

	public function paymentStatus($id){
		date_default_timezone_set('Asia/Jakarta');
		$admin_id = $this->session->userdata('admin_id');
		$payment = $this->Base_model->getDataBy('payment', array('payment_id' => $id));
		if($payment->num_rows() > 0){
			$status = $payment->row()->is_active;
			if($status == 1) {
				$active = 0;
			}else{
				$active = 1;
			}
			$update=$this->Base_model->updateData(
				'payment', 
				array(
					'is_active' => $active,
					'updated_by' => $admin_id,
					'updated_date' => date("Y-m-d H:i:s")
				), 
				array('payment_id' => $id));
			if($update){
				$alert = array(
					'message' => 'Successfully update data',
					'title' => 'Success',
					'type' => 'success'
				);
				$this->session->set_flashdata($alert);
				redirect('payment');
			}else{
				$alert = array(
					'message' => 'Opps.. something went wrong',
					'title' => 'Error',
					'type' => 'error'
				);
				$this->session->set_flashdata($alert);
				redirect($_SERVER['HTTP_REFERER']);
			}
		} else{
			$alert = array(
				'message' => 'Opps.. payment not found',
				'title' => 'Error',
				'type' => 'error'
			);
			$this->session->set_flashdata($alert);
			redirect($_SERVER['HTTP_REFERER']);
		}
	}
}
?>