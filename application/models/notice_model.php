<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Notice_model extends CI_Model{
	function __construct(){
		parent::__construct();
	}

	public function gets(){
		return $this->db->get('notice')->result_array();
	}

	public function get($index){
		return $this->db->get_where('notice', array('index' => $index))->result_array();
	}

	public function put($data){
		$this->db->set('date', 'NOW()', false);

		$this->db->insert('notice', $data);
	}

	public function update($number, $data){
		$this->db->where('notice', $number)->update('test', array('title'=>$data));
	}

	public function delete($number){
		return $this->db->delete('notice', array('index'=>$number));
	}

	public function sort($name, $dir){
		if($dir == '오름차순') $direction = 'asc';
		else $direction = 'desc';
		return $this->db->order_by($name, $dir)->get('notice')->result_array();
	}

}

