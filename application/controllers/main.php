<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

	public function index()
	{
		$this->load->model('Minibug_Model');
		$view_params = array();
		$view_params['bug_list'] = $this->Minibug_Model->getBugList();
		$this->load->view('main',$view_params);
	}
}
