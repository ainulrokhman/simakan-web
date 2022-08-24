<?php 

class Promo extends CI_Controller{
	
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
			$promo = $this->Base_model->getData('promo')->result();
			$data=array('app' => $app, 'admin' => $admin, 'promo' => $promo);
			
			$this->load->view("template/header", $data);
			$this->load->view("promo_view", $data);
			$this->load->view("template/footer");
		}else{
			$app = $this->Base_model->getData('app_settings')->row_array();
			$data=array('app' => $app);
			$this->load->view('login_view', $data);
		}
	}

	public function editPromo($id){
		if($this->session->userdata('bmf_admin_login') == true){
			$app = $this->Base_model->getData('app_settings')->row_array();
            $admin_id = $this->session->userdata('admin_id');
			$admin = $this->Base_model->getDataBy('admin', array('admin_id' => $admin_id))->row_array();
			$promo = $this->Base_model->getDataBy('promo', array('promo_id' => $id))->row_array();
			$data=array('app' => $app, 'admin' => $admin, 'promo' => $promo);
			
			$this->load->view("template/header", $data);
			$this->load->view("promo_edit_view", $data);
			$this->load->view("template/footer");
		}else{
			$app = $this->Base_model->getData('app_settings')->row_array();
			$data=array('app' => $app);
			$this->load->view('login_view', $data);
		}
	}

	public function addPromo(){
		if($this->session->userdata('bmf_admin_login') == true){
			$app = $this->Base_model->getData('app_settings')->row_array();
            $admin_id = $this->session->userdata('admin_id');
			$admin = $this->Base_model->getDataBy('admin', array('admin_id' => $admin_id))->row_array();
			$data=array('app' => $app, 'admin' => $admin);
			
			$this->load->view("template/header", $data);
			$this->load->view("promo_add_view", $data);
			$this->load->view("template/footer");
		}else{
			$app = $this->Base_model->getData('app_settings')->row_array();
			$data=array('app' => $app);
			$this->load->view('login_view', $data);
		}
	}


	public function savePromo(){
		date_default_timezone_set('Asia/Jakarta');
		$title = $this->input->post('title');
		$desc = $this->input->post('desc');
		$images = file_get_contents($_FILES['images']['tmp_name']); 
		$admin_id = $this->session->userdata('admin_id');

		$data = array(
			'promo_title'       	 	=> $title,
			'promo_description'   	=> $desc,
			'promo_images'     		=> $images,
			'is_active'     		=> 1,
			'created_date'     		=> date('Y-m-d H:i:s'),
			'created_by'			=> $admin_id,
			'updated_date'			=> date('Y-m-d H:i:s'),
			'updated_by'			=> $admin_id
		);
		$insert = $this->Base_model->insertData('promo', $data);
		if($insert){
			$alert = array(
				'message' => 'Successfully save data',
				'title' => 'Success',
				'type' => 'success'
			);
			$this->session->set_flashdata($alert);
			redirect('promo');
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

	function updatePromo(){
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

		$kondisi = array('promo_id' => $id);

		if($images != null){
			$data = array(
				'promo_title'       		=> $name,
				'promo_description'   	=> $desc,
				'promo_images'     		=> $images,
				'updated_date'			=> date('Y-m-d H:i:s'),
				'updated_by'			=> $admin_id
			);
		}else{
			$data = array(
				'promo_title'       		=> $name,
				'promo_description'   	=> $desc,
				'updated_date'			=> date('Y-m-d H:i:s'),
				'updated_by'			=> $admin_id
			);
		}

		$update = $this->Base_model->updateData('promo', $data, $kondisi);
		if($update){
			$alert = array(
				'message' => 'Successfully update data',
				'title' => 'Success',
				'type' => 'success'
			);
			$this->session->set_flashdata($alert);
			redirect('promo');
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

	public function deletePromo($id){
		$delete=$this->Base_model->deleteData('promo', array('promo_id' => $id));
		if($delete){
			$alert = array(
				'message' => 'Successfully delete data',
				'title' => 'Success',
				'type' => 'success'
			);
			$this->session->set_flashdata($alert);
			redirect('promo');
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

	public function promoStatus($id){
		date_default_timezone_set('Asia/Jakarta');
		$admin_id = $this->session->userdata('admin_id');
		$promo = $this->Base_model->getDataBy('promo', array('promo_id' => $id));
		if($promo->num_rows() > 0){
			$status = $promo->row()->is_active;
			if($status == 1) {
				$active = 0;
			}else{
				$active = 1;
			}
			$update=$this->Base_model->updateData(
				'promo', 
				array(
					'is_active' => $active,
					'updated_by' => $admin_id,
					'updated_date' => date("Y-m-d H:i:s")
				), 
				array('promo_id' => $id));
			if($update){
				$alert = array(
					'message' => 'Successfully update data',
					'title' => 'Success',
					'type' => 'success'
				);
				$this->session->set_flashdata($alert);
				redirect('promo');
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
				'message' => 'Opps.. promo not found',
				'title' => 'Error',
				'type' => 'error'
			);
			$this->session->set_flashdata($alert);
			redirect($_SERVER['HTTP_REFERER']);
		}
	}
}
?>