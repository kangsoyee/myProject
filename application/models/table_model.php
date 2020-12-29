<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Table_model extends CI_Model{
	function __construct(){
		parent::__construct();
	}

	public function gets($limit, $offset, $is_notice){
//	public function gets(){
//		if($search != null) {
//			$this->db->where('content like %$search%');
//		}
		if($limit != null) {
			$this->db->limit($limit, $offset);
		}
		$this->db->where('is_notice', $is_notice);
		return $this->db->get('table')->result_array();
	}

	public function get($index){
		return $this->db->get_where('table', array('index' => $index))->result_array();
	}

	public function put($data){
		$this->db->set('date', 'NOW()', false);

		$this->db->insert('table', $data);
	}

	public function update($number, $data){
		$this->db->where('index', $number)->update('table', $data);
	}

	public function delete($number){
		return $this->db->delete('table', array('index'=>$number));
	}

	public function sort($name, $dir){
		if($dir == '오름차순') $direction = 'asc';
		else $direction = 'desc';
		return $this->db->order_by($name, $dir)->get('table')->result_array();
	}

}

