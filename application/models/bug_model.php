<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bug_Model extends CI_Model {

	function __construct() {
		$this->load->database('minibug');
	}

	function get($id) {
		$sql_get_bug= "select id,name,description,created,status FROM bugs WHERE id = ?";
		$query_get_bug= $this->db->query($sql_get_bug, array($id));
		return $query_get_bug->row();
	}

	function getHistory($id) {
		$sql_get_history= "select bug_id,new_status,changed FROM bug_status_history WHERE bug_id = ? ORDER BY changed";
		$query_get_history= $this->db->query($sql_get_history, array($id));
		return $query_get_history->result();
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
		$sql_create_bug = "insert into bugs (name,description,status) VALUES (?,?,'NEW')";
		$query_create_bug = $this->db->query($sql_create_bug,array($name,$description));
		return true;
	}

	// FIXME test result
	function update($id,$name,$description,$status) {
		$sql_update_bug = "update bugs set name=?,description=?,status=? WHERE id=?;";
		$query_update_bug = $this->db->query($sql_update_bug,array($name,$description,$status,$id));
		return true;
	}
}
