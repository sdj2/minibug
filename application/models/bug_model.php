<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//FIXME: For a scalable system, we would want to implement a lot of caching in this model
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

	function getList($order_by='id',$limit=10,$offset=0,$desc=FALSE) {
		// validate order by param cheaply
		if ( array_search($order_by,array('id','created','name','status')) === FALSE) {
			return array('error' => "Invalid sort parameter");
		}
		if (preg_match("/[^0-9]/",$limit) || preg_match("/[^0-9]/",$offset)) {
			return array('error' => "Invalid pagination");
		}

		$bugs = array();

		// get count for pagination
		$sql_num_bugs = "select count(*) as count FROM bugs";
		$query_num_bugs = $this->db->query($sql_num_bugs);
		$bugs['count'] = $query_num_bugs->row()->count;

		// get result page
		$order_dir = $desc ? "DESC" : "";
		$sql_get_bugs = "select id,name,description,created,status from bugs ORDER BY $order_by $order_dir LIMIT $limit OFFSET $offset";
		$query_get_bugs = $this->db->query($sql_get_bugs);
		$bugs['list'] = $query_get_bugs->result();
		return $bugs;
	}

	function create($name,$description) {
		$sql_create_bug = "insert into bugs (name,description,status) VALUES (?,?,'NEW')";
		$query_create_bug = $this->db->query($sql_create_bug,array($name,$description));
		if($query_create_bug) {
			return true;
		} else {
			return array('error' => 'Database error');
		}
	}

	function update($id,$name,$description,$status) {
		$sql_update_bug = "update bugs set name=?,description=?,status=? WHERE id=?;";
		$query_update_bug = $this->db->query($sql_update_bug,array($name,$description,$status,$id));
		if($query_update_bug) {
			return true;
		} else {
			return array('error' => 'Database error');
		}
	}
}
