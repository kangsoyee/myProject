<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Blog_model extends CI_Model {

	function __construct(){
		parent::__construct();
	}

	public function gets(){
		return $this->db->get('member')->result_array();
	}

	public function get($id){
		return $this->db->get_where('member', array('id' => $id))->result_array();
	}

	public function put($data){
		$this->db->set('date', 'NOW()', false);

		$this->db->insert('member', $data);
	}

	public function isID($data){
		if(null!=$this->db->get_where('member', array('id' => $data))->result()) {
			return false;
		} else {
			return true;
		}
	}

	public function check_sign_in($id, $pw){
		if($this->db
			->get_where('member', array('id' => $id, 'pw' => $pw))
			->num_rows() > 0
		) {
			return true;
		} else {
			return false;
		}
	}

//	public function update($number, $data){
//		$this->db->where('number', $number)->update('test', array('title'=>$data));
//	}
//
//	public function delete($number){
//		return $this->db->delete('test', array('number'=>$number));
//	}
//
//	public function sort($name, $dir){
//		if($dir == '오름차순') $direction = 'asc';
//		else $direction = 'desc';
//		return $this->db->order_by($name, $dir)->get('test')->result_array();
//	}
}
?>
