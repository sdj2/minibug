<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bug extends CI_Controller {

	private $notices = array();
	private $errors = array();

	public function __construct() {
		parent::__construct();
		$this->load->model('Bug_Model');
	}


	public function index() {
		return $this->get_all();
	}

	public function get_all($order='id',$start_index=0) {
		$results_per_page = 10;

		$bugs = $this->Bug_Model->getList($order,$results_per_page,$start_index);

		if(isset($bugs['error'])) {
			return $this->show_error($bugs['error']);
		}

		$this->load->library('pagination');
		$pagination_config['base_url'] = site_url("get_all/$order");
		$pagination_config['per_page'] = $results_per_page; 
		$pagination_config['total_rows'] = $bugs['count'];
		$this->pagination->initialize($pagination_config); 

		$params = array();
		$params['bug_list'] = $bugs['list'];

		$params['pagination'] = $this->pagination->create_links();

		$this->render_view( 'bug_list', $params );
	}

	public function view($bug_id) {
		$view_params = array();
		$bug = $this->Bug_Model->get($bug_id);
		if( ! $bug ) {
			return $this->show_error( 'Bug Not Found' );
		}
		$bug_hist = $this->Bug_Model->getHistory($bug_id);
		$bug->history = $bug_hist;
		$view_params['bug'] = $bug;
		$this->render_view( 'view_bug' , $view_params );
	}

	public function create() {

		// validate form submit
		$this->load->library('form_validation');
		$this->form_validation->set_rules('bug_title',"Title",'trim|required');
		if( ! $this->form_validation->run() ) {
			return $this->render_view('create_bug');
		}

		// create bug
		$title = $_POST['bug_title'];
		$description = $_POST['bug_description'];
		$create_success = $this->Bug_Model->create($title,$description);
		if($create_success === TRUE) {
			$this->notices[] = "Bug Created";
			return $this->get_all();
		} else {
			$view_new_bug = array( 'name' => 'create_bug' );
			$view_new_bug['params']['errors'] = $create_success;
			return $this->render_view($view_new_bug);
		}
	}

	public function edit($bug_id) {
		// validate form submit
		$this->load->library('form_validation');
		$this->form_validation->set_rules('bug_title',"Title",'trim|required');
		if( ! $this->form_validation->run()) {
			return $this->show_edit_form($bug_id);
		}

		$title = $_POST['bug_title'];
		$description = $_POST['bug_description'];
		$status = $_POST['bug_status'];
		$update_result = $this->Bug_Model->update($bug_id,$title,$description,$status);
		if($update_result !== TRUE) {
			$this->errors[] = $update_result['error'];
			return $this->show_edit_form($bug_id);
		}
		$this->notices[] = "Bug Updated";
		return $this->index();
	}

	private function show_edit_form($bug_id) {
		$bug = $this->Bug_Model->get($bug_id);
		if ( ! $bug ) {
			return $this->show_error("Bug not found");
		}
		$bug_status_list = $this->Bug_Model->getStatusList();
		$params = array();
		$params['bug'] = $bug;
		$params['bug_status_list'] = $bug_status_list;
		$this->render_view( 'edit_bug' , $params );
	}

	private function render_view($name, $params=array()) {
		$params['errors'] = isset($params['errors']) ? array_merge($params['errors'],$this->errors) : $this->errors;
		$params['notices'] = isset($params['notices']) ? array_merge($params['notices'],$this->notices) : $this->notices;
		$this->load->view('header',$params);
		$this->load->view($name, $params);
		$this->load->view('footer',$params);
	}
	private function show_error($msg) {
		$params = array( 'errors' => array($msg) );
		$this->load->view('header',$params);
		$this->load->view('footer',$params);
		
	}
}
