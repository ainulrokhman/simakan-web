<?php 

class News extends CI_Controller{
	
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
			$news = $this->Base_model->getData('news')->result();
			$data=array('app' => $app, 'admin' => $admin, 'news' => $news);
			
			$this->load->view("template/header", $data);
			$this->load->view("news_view", $data);
			$this->load->view("template/footer");
		}else{
			$app = $this->Base_model->getData('app_settings')->row_array();
			$data=array('app' => $app);
			$this->load->view('login_view', $data);
		}
	}

	public function editNews($id){
		if($this->session->userdata('bmf_admin_login') == true){
			$app = $this->Base_model->getData('app_settings')->row_array();
            $admin_id = $this->session->userdata('admin_id');
			$admin = $this->Base_model->getDataBy('admin', array('admin_id' => $admin_id))->row_array();
			$news = $this->Base_model->getDataBy('news', array('news_id' => $id))->row_array();
			$data=array('app' => $app, 'admin' => $admin, 'news' => $news);
			
			$this->load->view("template/header", $data);
			$this->load->view("news_edit_view", $data);
			$this->load->view("template/footer");
		}else{
			$app = $this->Base_model->getData('app_settings')->row_array();
			$data=array('app' => $app);
			$this->load->view('login_view', $data);
		}
	}

	public function addNews(){
		if($this->session->userdata('bmf_admin_login') == true){
			$app = $this->Base_model->getData('app_settings')->row_array();
            $admin_id = $this->session->userdata('admin_id');
			$admin = $this->Base_model->getDataBy('admin', array('admin_id' => $admin_id))->row_array();
			$data=array('app' => $app, 'admin' => $admin);
			
			$this->load->view("template/header", $data);
			$this->load->view("news_add_view", $data);
			$this->load->view("template/footer");
		}else{
			$app = $this->Base_model->getData('app_settings')->row_array();
			$data=array('app' => $app);
			$this->load->view('login_view', $data);
		}
	}


	public function saveNews(){
		date_default_timezone_set('Asia/Jakarta');
		$title = $this->input->post('title');
		$desc = $this->input->post('desc');
		$images = file_get_contents($_FILES['images']['tmp_name']); 
		$admin_id = $this->session->userdata('admin_id');

		$data = array(
			'news_title'       	 	=> $title,
			'news_description'   	=> $desc,
			'news_images'     		=> $images,
			'is_active'     		=> 1,
			'created_date'     		=> date('Y-m-d H:i:s'),
			'created_by'			=> $admin_id,
			'updated_date'			=> date('Y-m-d H:i:s'),
			'updated_by'			=> $admin_id
		);
		$insert = $this->Base_model->insertData('news', $data);
		if($insert){
			$alert = array(
				'message' => 'Successfully save data',
				'title' => 'Success',
				'type' => 'success'
			);
			$this->session->set_flashdata($alert);
			redirect('news');
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

	function updateNews(){
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

		$kondisi = array('news_id' => $id);

		if($images != null){
			$data = array(
				'news_title'       		=> $name,
				'news_description'   	=> $desc,
				'news_images'     		=> $images,
				'updated_date'			=> date('Y-m-d H:i:s'),
				'updated_by'			=> $admin_id
			);
		}else{
			$data = array(
				'news_title'       		=> $name,
				'news_description'   	=> $desc,
				'updated_date'			=> date('Y-m-d H:i:s'),
				'updated_by'			=> $admin_id
			);
		}

		$update = $this->Base_model->updateData('news', $data, $kondisi);
		if($update){
			$alert = array(
				'message' => 'Successfully update data',
				'title' => 'Success',
				'type' => 'success'
			);
			$this->session->set_flashdata($alert);
			redirect('news');
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

	public function deleteNews($id){
		$delete=$this->Base_model->deleteData('news', array('news_id' => $id));
		if($delete){
			$alert = array(
				'message' => 'Successfully delete data',
				'title' => 'Success',
				'type' => 'success'
			);
			$this->session->set_flashdata($alert);
			redirect('news');
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

	public function newsStatus($id){
		date_default_timezone_set('Asia/Jakarta');
		$admin_id = $this->session->userdata('admin_id');
		$news = $this->Base_model->getDataBy('news', array('news_id' => $id));
		if($news->num_rows() > 0){
			$status = $news->row()->is_active;
			if($status == 1) {
				$active = 0;
			}else{
				$active = 1;
			}
			$update=$this->Base_model->updateData(
				'news', 
				array(
					'is_active' => $active,
					'updated_by' => $admin_id,
					'updated_date' => date("Y-m-d H:i:s")
				), 
				array('news_id' => $id));
			if($update){
				$alert = array(
					'message' => 'Successfully update data',
					'title' => 'Success',
					'type' => 'success'
				);
				$this->session->set_flashdata($alert);
				redirect('news');
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
				'message' => 'Opps.. news not found',
				'title' => 'Error',
				'type' => 'error'
			);
			$this->session->set_flashdata($alert);
			redirect($_SERVER['HTTP_REFERER']);
		}
	}
}
?>