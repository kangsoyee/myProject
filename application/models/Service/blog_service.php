<?php
class Blog_service extends CI_Model {
	function __construct(){
		parent::__construct();
		$this->load->model('blog_model');
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->library('form_validation');
	}

	function validation(){
		$this->form_validation->set_rules('');

	}
}
?>
