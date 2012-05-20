<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bug extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Bug_Model');
	}


	public function index()
	{
		$bug_list = $this->Bug_Model->getList();
//		$bug_status_list = $this->Minibug_Model->getBugStatuses();

		$view_bug_list = array( 'name' => 'bug_list' );
		$view_bug_list['params']['bug_list'] = $bug_list;

		$view_new_bug = array( 'name' => 'create_bug' );
//		$view_new_bug['params']['bug_status_list'] = $bug_status_list;

		$this->render_views( array( $view_new_bug, $view_bug_list ));

	}

	public function create() {
		$title = $_POST['bug_title'];
		$description = $_POST['bug_description'];
		$create_success = $this->Bug_Model->create($title,$description);
		$this->index();
	}

	public function edit($bug_id) {
		if ( $_POST ) {
			return $this->do_edit($bug_id);
		} else {
			return $this->show_edit_form($bug_id);
		}
	}

	private function do_edit($bug_id) {
		$title = $_POST['bug_title'];
		$description = $_POST['bug_description'];
		$status = $_POST['bug_status'];
		$create_success = $this->Bug_Model->update($bug_id,$title,$description,$status);
	//	$this->index();
		redirect("index");
	}

	private function show_edit_form($bug_id) {
		$bug = $this->Bug_Model->get($bug_id);
		$bug_status_list = $this->Bug_Model->getStatusList();
		$params = array();
		$params['bug'] = $bug;
		$params['bug_status_list'] = $bug_status_list;
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
