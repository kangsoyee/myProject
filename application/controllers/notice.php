<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Notice extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('blog_model');
		$this->load->model('notice_model');
		$this->load->helper('url');
	}

	function index(){
//		if ($this->session->userdata('is_login')) {
//			redirect('/blog/main');
//		}
		$this->load->view('notice_write_view');
	}

	function write(){
		$this->notice_model->put(array(
			'title' => $this->input->post('title'),
			'contents' => $this->input->post('contents'),
			'id' => $this->session->userdata('id')
		));
		redirect('/blog/main');
	}

	function detail($index){
		$model_data = $this->notice_model->get($index);
		$data['table'] = $model_data[0];
		if($this->session->userdata('id') == $model_data[0]['id']){
			$data['auth'] = true;
		}else $data['auth'] = false;
		$data['index'] = $index;

		$data['test'] = $this->session->userdata('id')."///".$model_data[0]['id'];

		$this->load->view('notice_detail_view', $data);
	}

	function edit($index){
		$this->notice_model->edit($index);
		redirect('/blog/main');
	}

	function delete($index){
		$this->notice_model->delete($index);
		redirect('/blog/main');
	}
}
