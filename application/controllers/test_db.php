<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Test_db extends CI_Controller {
//test_db_view => test_db => db_model
	function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->model('db_model');
	}

	function index(){
		$data['list'] = $this->db_model->get();
		$this->load->view('test_db_view', $data);
	}

	function save(){
		$this->db_model->put($this->input->post('number'), $this->input->post('title'));

		$data['list'] = $this->db_model->get();
		$this->load->view('test_db_view', $data);
	}

	function delete(){
		$this->db_model->delete($this->input->post('number'));

		$data['list'] = $this->db_model->get();
		$this->load->view('test_db_view', $data);
	}

	function edit(){
		$this->db_model->edit($this->input->post('number'), $this->input->post('title'));

		$data['list'] = $this->db_model->get();
		$this->load->view('test_db_view', $data);
	}

	function search(){
		$data['list'] = $this->db_model->search($this->input->post('search'));
		$this->load->view('test_db_view', $data);
	}

	function sort(){
		$this->db_model->sort($this->input->post('select_name'), $this->input->post('select_dir'));

		$data['list'] = $this->db_model->get();
		$this->load->view('test_db_view', $data);
	}
}
?>
