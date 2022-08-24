<?php 

class Location extends CI_Controller{
	
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
			$data=array('app' => $app, 'admin' => $admin);
			
			$this->load->view("template/header", $data);
			$this->load->view("index", $data);
			$this->load->view("template/footer");
		}else{
			$app = $this->Base_model->getData('app_settings')->row_array();
			$data=array('app' => $app);
			$this->load->view('login_view', $data);
		}
	}

	public function province(){
		if($this->session->userdata('bmf_admin_login') == true){
			$app = $this->Base_model->getData('app_settings')->row_array();
            $admin_id = $this->session->userdata('admin_id');
			$admin = $this->Base_model->getDataBy('admin', array('admin_id' => $admin_id))->row_array();
			$province = $this->Base_model->getData('province')->result();
			$data=array('app' => $app, 'admin' => $admin, 'province' => $province);
			
			$this->load->view("template/header", $data);
			$this->load->view("province_view", $data);
			$this->load->view("template/footer");
		}else{
			$app = $this->Base_model->getData('app_settings')->row_array();
			$data=array('app' => $app);
			$this->load->view('login_view', $data);
		}
	}

	public function saveProvince(){
		date_default_timezone_set('Asia/Jakarta');
		$name = $this->input->post('name');
		$admin_id = $this->session->userdata('admin_id');

		$data = array(
			'province_name'       	=> $name,
			// 'is_active'     		=> 1,
			// 'created_date'     		=> date('Y-m-d H:i:s'),
			// 'created_by'			=> $admin_id,
			// 'updated_date'			=> date('Y-m-d H:i:s'),
			// 'updated_by'			=> $admin_id
		);
		$insert = $this->Base_model->insertData('province', $data);
		if($insert){
			$alert = array(
				'message' => 'Successfully save data',
				'title' => 'Success',
				'type' => 'success'
			);
			$this->session->set_flashdata($alert);
			redirect('province');
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

	public function editProvince($id){
		if($this->session->userdata('bmf_admin_login') == true){
			$app = $this->Base_model->getData('app_settings')->row_array();
            $admin_id = $this->session->userdata('admin_id');
			$admin = $this->Base_model->getDataBy('admin', array('admin_id' => $admin_id))->row_array();
			$province = $this->Base_model->getDataBy('province', array('province_id' => $id))->row_array();
			$list_province = $this->Base_model->getData('province')->result();
			$data=array('app' => $app, 'admin' => $admin, 'province' => $province, 'list_province' => $list_province);
			
			$this->load->view("template/header", $data);
			$this->load->view("province_edit_view", $data);
			$this->load->view("template/footer");
		}else{
			$app = $this->Base_model->getData('app_settings')->row_array();
			$data=array('app' => $app);
			$this->load->view('login_view', $data);
		}
	}

	function updateProvince(){
		date_default_timezone_set('Asia/Jakarta');
		$id = $this->input->post('id');
		$name = $this->input->post('name');
		$admin_id = $this->session->userdata('admin_id');

		$kondisi = array('province_id' => $id);

		$data = array(
			'province_name'       		=> $name,
			// 'updated_date'			=> date('Y-m-d H:i:s'),
			// 'updated_by'			=> $admin_id
		);

		$update = $this->Base_model->updateData('province', $data, $kondisi);
		if($update){
			$alert = array(
				'message' => 'Successfully update data',
				'title' => 'Success',
				'type' => 'success'
			);
			$this->session->set_flashdata($alert);
			redirect('province');
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

	public function deleteProvince($id){
		$delete=$this->Base_model->deleteData('province', array('province_id' => $id));
		if($delete){
			$alert = array(
				'message' => 'Successfully delete data',
				'title' => 'Success',
				'type' => 'success'
			);
			$this->session->set_flashdata($alert);
			redirect('province');
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

	

	public function city(){
		if($this->session->userdata('bmf_admin_login') == true){
			$app = $this->Base_model->getData('app_settings')->row_array();
            $admin_id = $this->session->userdata('admin_id');
			$admin = $this->Base_model->getDataBy('admin', array('admin_id' => $admin_id))->row_array();
			$province = $this->Base_model->getData('province')->result();
			$city = $this->db->select('*')->from('city A')->join('province B', 'A.province_id = B.province_id', 'left')->get()->result();
			$data=array('app' => $app, 'admin' => $admin, 'province' => $province, 'city' => $city);
			
			$this->load->view("template/header", $data);
			$this->load->view("city_view", $data);
			$this->load->view("template/footer");
		}else{
			$app = $this->Base_model->getData('app_settings')->row_array();
			$data=array('app' => $app);
			$this->load->view('login_view', $data);
		}
	}

	public function savecity(){
		date_default_timezone_set('Asia/Jakarta');
		$province_id = $this->input->post('province_id');
		$name = $this->input->post('name');
		$postal_code = $this->input->post('postal_code');
		$admin_id = $this->session->userdata('admin_id');

		$data = array(
			'province_id'		=> $province_id,
			'city_name'       	=> $name,
			'postal_code'       	=> $postal_code,
			// 'is_active'     		=> 1,
			// 'created_date'     		=> date('Y-m-d H:i:s'),
			// 'created_by'			=> $admin_id,
			// 'updated_date'			=> date('Y-m-d H:i:s'),
			// 'updated_by'			=> $admin_id
		);
		$insert = $this->Base_model->insertData('city', $data);
		if($insert){
			$alert = array(
				'message' => 'Successfully save data',
				'title' => 'Success',
				'type' => 'success'
			);
			$this->session->set_flashdata($alert);
			redirect('city');
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

	public function editcity($id){
		if($this->session->userdata('bmf_admin_login') == true){
			$app = $this->Base_model->getData('app_settings')->row_array();
            $admin_id = $this->session->userdata('admin_id');
			$admin = $this->Base_model->getDataBy('admin', array('admin_id' => $admin_id))->row_array();
			$province = $this->Base_model->getData('province')->result();
			$city = $this->db->select('*')->from('city A')->join('province B', 'A.province_id = B.province_id', 'left')->where('A.city_id', $id)->get()->row_array();
			$list_city = $this->db->select('*')->from('city A')->join('province B', 'A.province_id = B.province_id', 'left')->get()->result();
			$data=array('app' => $app, 'admin' => $admin, 'city' => $city, 'list_city' => $list_city, 'province' =>$province);
			
			$this->load->view("template/header", $data);
			$this->load->view("city_edit_view", $data);
			$this->load->view("template/footer");
		}else{
			$app = $this->Base_model->getData('app_settings')->row_array();
			$data=array('app' => $app);
			$this->load->view('login_view', $data);
		}
	}

	function updatecity(){
		date_default_timezone_set('Asia/Jakarta');
		$id = $this->input->post('id');
		$province_id = $this->input->post('province_id');
		$name = $this->input->post('name');
		$postal_code = $this->input->post('postal_code');
		$admin_id = $this->session->userdata('admin_id');

		$kondisi = array('city_id' => $id);

		$data = array(
			'province_id'		=> $province_id,
			'city_name'       	=> $name,
			'postal_code'       => $postal_code,
			// 'updated_date'			=> date('Y-m-d H:i:s'),
			// 'updated_by'			=> $admin_id
		);

		$update = $this->Base_model->updateData('city', $data, $kondisi);
		if($update){
			$alert = array(
				'message' => 'Successfully update data',
				'title' => 'Success',
				'type' => 'success'
			);
			$this->session->set_flashdata($alert);
			redirect('city');
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

	public function deletecity($id){
		$delete=$this->Base_model->deleteData('city', array('city_id' => $id));
		if($delete){
			$alert = array(
				'message' => 'Successfully delete data',
				'title' => 'Success',
				'type' => 'success'
			);
			$this->session->set_flashdata($alert);
			redirect('city');
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