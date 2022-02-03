<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_general extends CI_Model
{
	public function getAll($select, $order = NULL, $table)
	{
		$this->db->select($select);
		if ($order) {
			$this->db->order_by($order);
		}
		return $this->db->get($table);
	}

	public function getWhere($select, $where, $table)
	{
		$this->db->select($select);
		return $this->db->get_where($table, $where);
	}

	public function getMax($select, $table)
	{
		$this->db->select_max($select);
		$this->db->from($table);
		return $this->db->get();
	}
}
