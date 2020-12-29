<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Table extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('blog_model');
		$this->load->model('table_model');
		$this->load->model('comment_model');
		$this->load->model('recomment_model');
		$this->load->helper('url', 'form');
		$this->load->library('upload');
	}
	function index(){
//		if ($this->session->userdata('is_login')) {
//			redirect('/blog/main');
//		}
		$this->load->view('table_write_view');
	}

	function write(){
		$target_file = 'D:/workspace/myProject/image/'.basename($_FILES["img"]["name"]);

		if (move_uploaded_file($_FILES["img"]["tmp_name"], $target_file)){
			$this->table_model->put(array(
				'title' => $this->input->post('title'),
				'contents' => $this->input->post('contents'),
				'id' => $this->session->userdata('id'),
				//'file' => $this->upload->file_name
				//'file' => $upload_data['file_name']
				'file' => basename($_FILES["img"]["name"])
			));
			redirect('http://www.kangse2942.com/blog/main');
		} else {
			$this->load->view('table_write_view', array('error'=>'file not found'));
		}
	}
	function notice(){
		$this->load->view('notice_write_view');
	}

	//
	function detail($index){
//		$index = $this->input->get('no');
		$model_data = $this->table_model->get($index);
		$data['table'] = $model_data[0];
		$data['comment'] = $this->comment_model->gets($index);
		$data['recomment'] = $this->recomment_model->gets($index);
		$data['user_data'] = $this->blog_model->get($this->session->userdata('id'));
//		if($this->session->userdata('id') == $model_data[0]['id']){
//			$data['auth'] = true;
//		}else $data['auth'] = false;
		$data['index'] = $index;

		$this->load->view('table_detail_view', $data);
	}
	function edit_page($index){
		$data['index'] = $index;
		$this->load->view('table_update_view', $data);
	}

	function edit($index){
		$data = array(
			'title' => $this->input->post('title'),
			'contents' => $this->input->post('contents')
		);
		$this->table_model->update($index, $data);
		redirect('http://www.kangse2942.com/blog/main');
	}

	function delete($index){
		$this->table_model->delete($index);
		redirect('http://www.kangse2942.com/blog/main');
	}

	function comment($index){
		$data = array(
			'post' => $index,
			'comment' => $this->input->post('comment'),
			'id' => $this->session->userdata('id')
		);
		$this->comment_model->put($data);
		//redirect('/table/detail/'.$index);

		$json_data[1] = $this->recomment_model->gets($index);
		$json_data[0] = $this->comment_model->gets($index);
		echo json_encode($json_data);
	}

	function recomment(){
		$data = array(
			'parents' => $this->input->post('parents'),
			'comment' => $this->input->post('comment'),
			'id' => $this->session->userdata('id'),
			'post' => $this->input->post('post')
		);

		$this->recomment_model->put($data);

		$json_data[1] = $this->recomment_model->gets($this->input->post('post'));
		$json_data[0] = $this->comment_model->gets($this->input->post('post'));

		echo json_encode($json_data);
		//redirect('/table/detail/'.$index);
	}

	function comment_delete(){
		$this->comment_model->delete($this->input->post('index'));
		$json_data[1] = $this->recomment_model->gets($this->input->post('post'));
		$json_data[0] = $this->comment_model->gets($this->input->post('post'));
		echo json_encode($json_data);
	}

	function recomment_delete(){
		$this->recomment_model->delete($this->input->post('index'));
		$json_data[1] = $this->recomment_model->gets($this->input->post('post'));
		$json_data[0] = $this->comment_model->gets($this->input->post('post'));
		echo json_encode($json_data);
	}
}
