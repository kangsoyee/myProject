<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Blog extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('blog_model');
		$this->load->model('table_model');
		$this->load->model('notice_model');
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->library('form_validation');
	}

	function index(){
		if($this->session->userdata('is_login')){
			redirect('http://www.kangse2942.com/blog/main');
		}
		$this->load->view('sign_in_view', array('error'=>""));
	}

	function signin(){
		if($this->blog_model->isID($this->input->post('id'))==false){
			if($this->blog_model->check_sign_in(
				$this->input->post('id'),
				$this->input->post('pw')
			)){
				$data = $this->blog_model->get($this->input->post('id'));
				$data = $data[0];
				$this->session->set_userdata($data);
				$this->session->set_userdata('is_login', true);

				redirect('http://www.kangse2942.com/blog/main');
			}else $this->load->view('sign_in_view', array('error'=>"pw error"));
		}else $this->load->view('sign_in_view', array('error'=>"id error"));
	}

	function signup(){
		$this->form_validation->set_rules('name', 'Username', 'required|callback_isID');
		$this->form_validation->set_rules('id', 'User ID', 'required');
		$this->form_validation->set_rules('pw', 'Password', 'required|callback_isPW');
		$this->form_validation->set_rules('pwconf', 'Password Confirm', 'required|matches[pw]');
		$this->form_validation->set_rules('email', 'Email Address', 'required|valid_email');
		$this->form_validation->set_rules('', 'required');


		if($this->form_validation->run() == FALSE){
			$this->load->view('sign_up_view');

		}else {
			$data = array(
				'name' => $this->input->post('name'),
				'id' => $this->input->post('id'),
				'pw' => $this->input->post('pw'),
				'email' => $this->input->post('email'),
				'phone' => $this->input->post('phone')
			);
			$this->blog_model->put($data);
			$this->load->view('sign_in_view');
		}
	}
	function isID(){
		if(!$this->blog_model->isID($this->input->post('id'))) return false;
		else return true;
	}
	function isPW(){
		if(!preg_match('/^[0-9A-Za-a~!@#$%^&*]{5,20}$/', $this->input->post('pw'))) return false;
		else return true;
	}

	function logout(){
		$this->session->sess_destroy();
		redirect('http://www.kangse2942.com/blog');
	}

	function main(){
		$data = $this->blog_model->get($this->session->userdata('id'));
		$data['list'] = $data[0];
		$data['table'] = $this->table_model->gets(null, null, 'N');
		$data['notice'] = $this->table_model->gets(null, null, 'Y');

		if($data[0]['auth'] == 1){
			$data['auth'] = true;
		}else $data['auth'] = false;

		$this->load->view('blog_view', $data);
	}

	function pagination(){
		$offset = $this->input->post('offset');
		$json_data = $this->table_model->gets(5, $offset, 'N');
		echo json_encode($json_data);
	}
}
