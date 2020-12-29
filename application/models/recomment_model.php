<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Recomment_model extends CI_Model{
	function __construct(){
		parent::__construct();
	}

	public function gets($post){
		return $this->db->get_where('recomment', array('post' => $post))->result_array();
	}

	public function put($data){
		$this->db->set('date', 'NOW()', false);

		$this->db->insert('recomment', $data);
	}

	public function update($number, $data){
		$this->db->where('index', $number)->update('recomment', array('title'=>$data));
	}

	public function delete($number){
		$this->db->delete('recomment', array('index'=>$number));
	}

}

