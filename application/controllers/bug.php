<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bug extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Bug_Model');
	}


	public function index() {
		return $this->get_all();
	}

	public function get_all($order='',$errors=array()) {
		if ($order) {
			$bug_list = $this->Bug_Model->getList($order);
		} else {
			$bug_list = $this->Bug_Model->getList();
		}

		$view_bug_list = array( 'name' => 'bug_list' );
		$view_bug_list['params']['bug_list'] = $bug_list;

		if(isset($bug_list['error'])) {
			$view_bug_list['params']['errors'] = array($bug_list['error']);
		}

		$view_new_bug = array( 'name' => 'create_bug' );
		$view_new_bug['params']['errors'] = $errors;

		$this->render_views( array( $view_new_bug, $view_bug_list ));
	}

	public function create() {
		$title = $_POST['bug_title'];
		$description = $_POST['bug_description'];

		$this->load->library('form_validation');
		$this->form_validation->set_rules('bug_title',"Title",'trim|required');
		if($this->form_validation->run()) {
			$create_success = $this->Bug_Model->create($title,$description);
			if($create_success !== TRUE) {
				return $this->get_all('',$create_success);
			}
		}
		return $this->index();
	}

	public function view($bug_id) {
		$bug = $this->Bug_Model->get($bug_id);
		$bug_hist = $this->Bug_Model->getHistory($bug_id);
		$bug->history = $bug_hist;
		$params = array();
		$params['bug'] = $bug;
		$this->render_view( 'view_bug' , $params );
	}

	public function edit($bug_id) {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('bug_title',"Title",'trim|required');
		if($this->form_validation->run()) {
			return $this->do_edit($bug_id);
		} else {
			return $this->show_edit_form($bug_id);
		}
	}

	private function do_edit($bug_id) {
		$title = $_POST['bug_title'];
		$description = $_POST['bug_description'];
		$status = $_POST['bug_status'];
		$update_result = $this->Bug_Model->update($bug_id,$title,$description,$status);
		if($update_result === TRUE) {
			return $this->index();
		} else {
			return $this->show_edit_form($bug_id,$update_result);
		}
	}

	private function show_edit_form($bug_id,$errors=array()) {
		$bug = $this->Bug_Model->get($bug_id);
		$bug_status_list = $this->Bug_Model->getStatusList();
		$params = array();
		$params['bug'] = $bug;
		$params['bug_status_list'] = $bug_status_list;
		$params['errors'] = $errors;
		$this->render_view( 'edit_bug' , $params );
	}

	private function render_view($name, $params=array()) {
		$this->load->view('header');
		$this->load->view($name, $params);
		$this->load->view('footer');
	}

	private function render_views($views) {
		$this->load->view('header');
		foreach($views as $view) {
			$this->load->view($view['name'], isset($view['params']) ? $view['params'] : array());
		}
		$this->load->view('footer');
	}
}
