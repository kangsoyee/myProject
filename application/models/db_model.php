<?php
class Db_model extends CI_Model {
	private $table_list;

	function __construct(){
		parent::__construct();
		$this->table_list = array();
	}

	public function get(){
		return $this->db->get('test')->result_array();
	}

	public function put($number, $title){
		if ($number != null) {

			$this->db->insert('test');
		} else {
			$this->db->set('title', $title);
			$this->db->set('view', 0);
			$this->db->set('date', 'NOW()', false);

			$this->db->insert('test');
		}
	}

	public function search($data){
		return $this->db->like('title', $data)->get('test')->result_array();
	}

	public function edit($number, $data){
		$this->db->where('number', $number)->update('test', array('title'=>$data));
	}

	public function delete($number){
		return $this->db->delete('test', array('number'=>$number));
	}

	public function sort($name, $dir){
		if($dir == '오름차순') $direction = 'asc';
		else $direction = 'desc';
		return $this->db->order_by($name, $dir)->get('test')->result_array();
	}
}
?>
