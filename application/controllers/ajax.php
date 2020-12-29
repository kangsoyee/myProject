<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Ajax extends CI_Controller{
//view => ajax => test_model
	function __construct(){
		parent::__construct();
		$this->load->model('test_model');
		$this->load->helper('form');
		$this->load->helper('url');
		//$this->load->helper('json');
	}

	function index(){
		$data['list'] = $this->test_model->getString();
		$this->load->view('view', $data);
	}

	function save(){
		$timestamp = date("y-m-d h:i:s", time());
		$data = array(
			0,
			$this->input->post('title'),
			0,
			$timestamp
		);
		$this->test_model->putString($data, $this->input->post('number'));

		$json_data = $this->test_model->getString();
		echo json_encode($json_data);
	}

	function delete(){
		$number = $this->input->post('number');
		$this->test_model->deleteString($number);

		$json_data = $this->test_model->getString();
		echo json_encode($json_data);
	}

	function edit(){
		$this->test_model->editString($this->input->post('number'), $this->input->post('title'));

		$json_data = $this->test_model->getString();
		echo json_encode($json_data);
	}

	function search(){
		$data = $this->test_model->getString();
		$search = $this->input->post('search');
		if($search != null){
			$result = array();
			for($i=0; $i<count($data)-1; $i++){
				if($data[$i][1] == $search){
					array_push($result, $data[$i]);
				}
			}
			array_push($result, "");
			$data = $result;
		}
		echo json_encode($data);
	}

	function sort(){
		$this->test_model->sortString($this->input->post('select_dir'));

		$json_data = $this->test_model->getString();
		echo json_encode($json_data);
	}
}
