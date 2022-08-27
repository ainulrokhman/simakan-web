<?php if(!defined('BASEPATH')) exit('No direct script allowed');

class Base_model extends CI_Model{

	function getData($table) {
		$query = $this->db->get($table);
		return $query;
	}

	function getDataBy($table, $condition) {
		$query = $this->db->get_where($table, $condition);
		return $query;
	}

	public function updateData($table, $data, $condition){
		$update = $this->db->update($table, $data, $condition);
		if($update){
			return true;
		}else{
		return false;
		}
	}

	public function insertData($table, $data){
		$insert = $this->db->insert($table, $data);
		if($insert){
		  return true;
		}else{
		  return false;
		}
	}

	public function deleteData($table, $condition){
		$delete = $this->db->delete($table, $condition);
		if($delete){
			return true;
		}else{
		return false;
		}
	}
}