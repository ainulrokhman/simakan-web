<?php 

class Product extends CI_Controller{
	
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
			$product = $this->Base_model->getData('product')->result();
			$data=array('app' => $app, 'admin' => $admin, 'product' => $product);
			
			$this->load->view("template/header", $data);
			$this->load->view("product_view", $data);
			$this->load->view("template/footer");
		}else{
			$app = $this->Base_model->getData('app_settings')->row_array();
			$data=array('app' => $app);
			$this->load->view('login_view', $data);
		}
	}

	public function editProduct($id){
		if($this->session->userdata('bmf_admin_login') == true){
			$app = $this->Base_model->getData('app_settings')->row_array();
            $admin_id = $this->session->userdata('admin_id');
			$admin = $this->Base_model->getDataBy('admin', array('admin_id' => $admin_id))->row_array();
			$product = $this->Base_model->getDataBy('product', array('product_id' => $id))->row_array();
			$data=array('app' => $app, 'admin' => $admin, 'product' => $product);
			
			$this->load->view("template/header", $data);
			$this->load->view("product_edit_view", $data);
			$this->load->view("template/footer");
		}else{
			$app = $this->Base_model->getData('app_settings')->row_array();
			$data=array('app' => $app);
			$this->load->view('login_view', $data);
		}
	}

	public function addProduct(){
		if($this->session->userdata('bmf_admin_login') == true){
			$app = $this->Base_model->getData('app_settings')->row_array();
            $admin_id = $this->session->userdata('admin_id');
			$admin = $this->Base_model->getDataBy('admin', array('admin_id' => $admin_id))->row_array();
			$data=array('app' => $app, 'admin' => $admin);
			
			$this->load->view("template/header", $data);
			$this->load->view("product_add_view", $data);
			$this->load->view("template/footer");
		}else{
			$app = $this->Base_model->getData('app_settings')->row_array();
			$data=array('app' => $app);
			$this->load->view('login_view', $data);
		}
	}


	public function saveProduct(){
		date_default_timezone_set('Asia/Jakarta');
		$name = $this->input->post('name');
		$desc = $this->input->post('desc');
		$thumbnails = file_get_contents($_FILES['thumbnails']['tmp_name']); 
		$banner = file_get_contents($_FILES['banner']['tmp_name']); 
		$admin_id = $this->session->userdata('admin_id');

		$data = array(
			'product_name'       	=> $name,
			'product_description'   => $desc,
			'product_thumbnail'     => $thumbnails,
			'product_banner'     	=> $banner,
			'is_active'     		=> 1,
			'created_date'     		=> date('Y-m-d H:i:s'),
			'created_by'			=> $admin_id,
			'updated_date'			=> date('Y-m-d H:i:s'),
			'updated_by'			=> $admin_id
		);
		$insert = $this->Base_model->insertData('product', $data);
		if($insert){
			$alert = array(
				'message' => 'Successfully save data',
				'title' => 'Success',
				'type' => 'success'
			);
			$this->session->set_flashdata($alert);
			redirect('product');
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

	function updateProduct(){
		date_default_timezone_set('Asia/Jakarta');
		$id = $this->input->post('id');
		$name = $this->input->post('name');
		$desc = $this->input->post('desc');
		if(!empty($_FILES['thumbnails']['tmp_name'])){
			$thumbnails = file_get_contents($_FILES['thumbnails']['tmp_name']); 
		}else{
			$thumbnails = null;
		}
		if(!empty($_FILES['banner']['tmp_name'])){
			$banner = file_get_contents($_FILES['banner']['tmp_name']); 
		}else{
			$banner = null;
		}
		$admin_id = $this->session->userdata('admin_id');

		$kondisi = array('product_id' => $id);

		if($thumbnails != null){ //jika thumbnail ada
			if($banner !=null){ //jika banner ada
				$data = array(//update keduanya
					'product_name'       	=> $name,
					'product_description'   => $desc,
					'product_thumbnail'     => $thumbnails,
					'product_banner'     	=> $banner,
					'updated_date'			=> date('Y-m-d H:i:s'),
					'updated_by'			=> $admin_id
				);
			} else { //jika banner tidak ada 
				$data = array(//update thumbnail aja
					'product_name'       	=> $name,
					'product_description'   => $desc,
					'product_thumbnail'     => $thumbnails,
					'updated_date'			=> date('Y-m-d H:i:s'),
					'updated_by'			=> $admin_id
				);
			}
		}else{ //jika thumbnail tidak ada
			if($banner !=null){ //jika banner ada
				$data = array( //update banner aja
					'product_name'       	=> $name,
					'product_description'   => $desc,
					'product_banner'     	=> $banner,
					'updated_date'			=> date('Y-m-d H:i:s'),
					'updated_by'			=> $admin_id
				);
			} else { //banner tidak ada juga? update tanpa keduanya
				$data = array( //update banner aja
					'product_name'       	=> $name,
					'product_description'   => $desc,
					'updated_date'			=> date('Y-m-d H:i:s'),
					'updated_by'			=> $admin_id
				);
			}
		}

		$update = $this->Base_model->updateData('product', $data, $kondisi);
		if($update){
			$alert = array(
				'message' => 'Successfully update data',
				'title' => 'Success',
				'type' => 'success'
			);
			$this->session->set_flashdata($alert);
			redirect('product');
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

	public function deleteProduct($id){
		$delete=$this->Base_model->deleteData('product', array('product_id' => $id));
		if($delete){
			$alert = array(
				'message' => 'Successfully delete data',
				'title' => 'Success',
				'type' => 'success'
			);
			$this->session->set_flashdata($alert);
			redirect('product');
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

	public function productStatus($id){
		date_default_timezone_set('Asia/Jakarta');
		$admin_id = $this->session->userdata('admin_id');
		$product = $this->Base_model->getDataBy('product', array('product_id' => $id));
		if($product->num_rows() > 0){
			$status = $product->row()->is_active;
			if($status == 1) {
				$active = 0;
			}else{
				$active = 1;
			}
			$update=$this->Base_model->updateData(
				'product', 
				array(
					'is_active' => $active,
					'updated_by' => $admin_id,
					'updated_date' => date("Y-m-d H:i:s")
				), 
				array('product_id' => $id));
			if($update){
				$alert = array(
					'message' => 'Successfully update data',
					'title' => 'Success',
					'type' => 'success'
				);
				$this->session->set_flashdata($alert);
				redirect('product');
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
				'message' => 'Opps.. product not found',
				'title' => 'Error',
				'type' => 'error'
			);
			$this->session->set_flashdata($alert);
			redirect($_SERVER['HTTP_REFERER']);
		}
	}
}
?>