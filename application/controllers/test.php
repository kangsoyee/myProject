<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Test extends CI_Controller {
//test => test => test_model
	function __construct(){
		parent::__construct();
		$this->load->model('test_model');
		$this->load->helper('form');
		$this->load->helper('url');
	}

	function index(){
		$data['list'] = $this->test_model->getString();
		$this->load->view('test', $data);
	}

	function save(){
		$timestamp = date("y-m-d h:i:s", time());
		$number = $this->input->post('number');
		$data = array(
			0,
			$this->input->post('title'),
			0,
			$timestamp
		);
		$this->test_model->putString($data, $this->input->post('number'));
		$data['list'] = $this->test_model->getString();

		$this->load->view('test', $data);
	}

	function delete(){
		$number = $this->input->post('number');
		$this->test_model->deleteString($number);

		$data['list'] = $this->test_model->getString();
		$this->load->view('test', $data);
	}

	function search(){
		$data['list'] = $this->test_model->getString();
		$search = $this->input->post('search');
		if($search != null){
			$result = array();
			for($i=0; $i<count($data['list'])-1; $i++){
				if($data['list'][$i][1] == $search){
					array_push($result, $data['list'][$i]);
				}
			}
			array_push($result, "");
			$data['list'] = $result;
		}
		$this->load->view('test', $data);
	}

	function edit(){
		$this->test_model->editString($this->input->post('number'), $this->input->post('title'));

		$data['list'] = $this->test_model->getString();
		$this->load->view('test', $data);
	}

	function sort(){
		$this->test_model->sortString($this->input->post('select'));

		$data['list'] = $this->test_model->getString();
		$this->load->view('test', $data);
	}

	function test(){
		$data['list'] = $this->test_model->getString();
		print_r($data);
	}
}
?>
