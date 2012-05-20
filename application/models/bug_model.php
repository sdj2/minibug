<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bug_Model extends CI_Model {

	function __construct() {
		$this->load->database('minibug');
	}

	function getStatusList() {
		$sql_get_bug_statuses = "select status from bug_status";
		$query_get_bug_statuses = $this->db->query($sql_get_bug_statuses);
		$status_list = array();
		foreach( $query_get_bug_statuses->result() as $row ) {
			$status_list[] = $row->status;
		}
		return $status_list;
	}

	function getList($order_by='created') {
		// validate order by param cheaply
		if ( array_search($order_by,array('created','name','status')) === FALSE) {
//			throw new UnusualBehaviorException("invalid sort order: $order_by");
//TODO: error handling
			return null;
		}

		// FIXME pagination optimization
		$sql_get_bugs = "select id,name,description,created,status from bugs ORDER BY $order_by";
		$query_get_bugs = $this->db->query($sql_get_bugs);
		return $query_get_bugs->result();
	}

	// FIXME test result
	function create($name,$description) {
		$sql_create_bug = "insert into bugs (name,description,status) VALUES (?,?,'NEW');";
		$query_create_bug = $this->db->query($sql_create_bug,array($name,$description));
		return true;
	}
}
