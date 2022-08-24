<?php 

class Sallary extends CI_Controller{
	
	function __construct(){
		parent::__construct();
	
		$this->load->helper('url');     
		$this->load->model('Base_model');
		$this->load->library('upload');		
	}

	public function index(){
		if($this->session->userdata('bmf_admin_login') == true){
			$app = $this->Base_model->getData('app_settings')->row_array();
            $admin_id = $this->session->userdata('admin_id');
			$admin = $this->Base_model->getDataBy('admin', array('admin_id' => $admin_id))->row_array();
			$sallary = $this->Base_model->getData('sallary')->result();
			$data=array('app' => $app, 'admin' => $admin, 'sallary' => $sallary);
			
			$this->load->view("template/header", $data);
			$this->load->view("sallary_view", $data);
			$this->load->view("template/footer");
		}else{
			$app = $this->Base_model->getData('app_settings')->row_array();
			$data=array('app' => $app);
			$this->load->view('login_view', $data);
		}
	}

	public function editSallary($id){
		if($this->session->userdata('bmf_admin_login') == true){
			$app = $this->Base_model->getData('app_settings')->row_array();
            $admin_id = $this->session->userdata('admin_id');
			$admin = $this->Base_model->getDataBy('admin', array('admin_id' => $admin_id))->row_array();
			$sallary = $this->Base_model->getDataBy('sallary', array('sallary_id' => $id))->row_array();
			$list_sallary = $this->Base_model->getData('sallary')->result();
			$data=array('app' => $app, 'admin' => $admin, 'sallary' => $sallary, 'list_sallary' => $list_sallary);
			
			$this->load->view("template/header", $data);
			$this->load->view("sallary_edit_view", $data);
			$this->load->view("template/footer");
		}else{
			$app = $this->Base_model->getData('app_settings')->row_array();
			$data=array('app' => $app);
			$this->load->view('login_view', $data);
		}
	}

	public function addSallary(){
		if($this->session->userdata('bmf_admin_login') == true){
			$app = $this->Base_model->getData('app_settings')->row_array();
            $admin_id = $this->session->userdata('admin_id');
			$admin = $this->Base_model->getDataBy('admin', array('admin_id' => $admin_id))->row_array();
			$data=array('app' => $app, 'admin' => $admin);
			
			$this->load->view("template/header", $data);
			$this->load->view("sallary_add_view", $data);
			$this->load->view("template/footer");
		}else{
			$app = $this->Base_model->getData('app_settings')->row_array();
			$data=array('app' => $app);
			$this->load->view('login_view', $data);
		}
	}


	public function saveSallary(){
		date_default_timezone_set('Asia/Jakarta');
		$name = $this->input->post('name');
		$desc = $this->input->post('desc');
		$admin_id = $this->session->userdata('admin_id');

		$data = array(
			'sallary_title'       	 	=> $name,
			'sallary_description'   	=> $desc,
			'is_active'     		=> 1,
			'created_date'     		=> date('Y-m-d H:i:s'),
			'created_by'			=> $admin_id,
			'updated_date'			=> date('Y-m-d H:i:s'),
			'updated_by'			=> $admin_id
		);
		$insert = $this->Base_model->insertData('sallary', $data);
		if($insert){
			$alert = array(
				'message' => 'Successfully save data',
				'title' => 'Success',
				'type' => 'success'
			);
			$this->session->set_flashdata($alert);
			redirect('sallary');
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

	function updateSallary(){
		date_default_timezone_set('Asia/Jakarta');
		$id = $this->input->post('id');
		$name = $this->input->post('name');
		$desc = $this->input->post('desc');
		$admin_id = $this->session->userdata('admin_id');

		$kondisi = array('sallary_id' => $id);

		$data = array(
			'sallary_title'       		=> $name,
			'sallary_description'   	=> $desc,
			'updated_date'			=> date('Y-m-d H:i:s'),
			'updated_by'			=> $admin_id
		);

		$update = $this->Base_model->updateData('sallary', $data, $kondisi);
		if($update){
			$alert = array(
				'message' => 'Successfully update data',
				'title' => 'Success',
				'type' => 'success'
			);
			$this->session->set_flashdata($alert);
			redirect('sallary');
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

	public function deleteSallary($id){
		$delete=$this->Base_model->deleteData('sallary', array('sallary_id' => $id));
		if($delete){
			$alert = array(
				'message' => 'Successfully delete data',
				'title' => 'Success',
				'type' => 'success'
			);
			$this->session->set_flashdata($alert);
			redirect('sallary');
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

	public function sallaryStatus($id){
		date_default_timezone_set('Asia/Jakarta');
		$admin_id = $this->session->userdata('admin_id');
		$sallary = $this->Base_model->getDataBy('sallary', array('sallary_id' => $id));
		if($sallary->num_rows() > 0){
			$status = $sallary->row()->is_active;
			if($status == 1) {
				$active = 0;
			}else{
				$active = 1;
			}
			$update=$this->Base_model->updateData(
				'sallary', 
				array(
					'is_active' => $active,
					'updated_by' => $admin_id,
					'updated_date' => date("Y-m-d H:i:s")
				), 
				array('sallary_id' => $id));
			if($update){
				$alert = array(
					'message' => 'Successfully update data',
					'title' => 'Success',
					'type' => 'success'
				);
				$this->session->set_flashdata($alert);
				redirect('sallary');
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
				'message' => 'Opps.. sallary not found',
				'title' => 'Error',
				'type' => 'error'
			);
			$this->session->set_flashdata($alert);
			redirect($_SERVER['HTTP_REFERER']);
		}
	}
}
?>