<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_activity extends CI_Model
{
	public function getOpportunities()
	{
		$this->db->select('
			ac.opportunity_id,
			opportunity,
			revenue
		');
		$this->db->from('activity_schedule ac');
		$this->db->join('m_opportunity mo', 'mo.opportunity_id=ac.opportunity_id', 'inner');
		$this->db->join('m_activity ma', 'ma.activity_id=ac.activity_id', 'inner');
		$this->db->group_by('ac.opportunity_id');
		$this->db->where('is_done', 0);
		return $this->db->get();
	}

	public function getReports()
	{
		$this->db->select('
			completion_date,
			activity_type,
			feedback
		');
		$this->db->from('activity_schedule ac');
		$this->db->join('m_activity ma', 'ma.activity_id=ac.activity_id', 'inner');
		$this->db->where('is_done', true);
		return $this->db->get();
	}
}
