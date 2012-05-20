<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

	public function index()
	{
		$this->load->model('Minibug_Model');

		$bug_list = $this->Minibug_Model->getBugList();
//		$bug_status_list = $this->Minibug_Model->getBugStatuses();

		$view_bug_list = array( 'name' => 'bug_list' );
		$view_bug_list['params']['bug_list'] = $bug_list;

		$view_new_bug = array( 'name' => 'create_bug' );
//		$view_new_bug['params']['bug_status_list'] = $bug_status_list;

		$this->render_views( array( $view_new_bug, $view_bug_list ));

	}

	private function render_views($views) {
		$this->load->view('header');
		foreach($views as $view) {
			$this->load->view($view['name'], isset($view['params']) ? $view['params'] : array());
		}
		$this->load->view('footer');
	}
}
