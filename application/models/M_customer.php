<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_customer extends CI_Model
{
	public function getCustomers()
	{
		$this->db->select('
			mc.company_id,
			company_name,
			contact_name,
			mc.email as company_email,
			mi.email as individu_email
		');
		$this->db->from('customer_contact cc');
		$this->db->join('m_company mc', 'mc.company_id=cc.company_id', 'left');
		$this->db->join('m_individual mi', 'mi.contact_id=cc.contact_id', 'left');
		$this->db->order_by('company_name', 'asc');
		$this->db->order_by('contact_name', 'asc');
		return $this->db->get();
	}

	public function getContact()
	{
		$this->db->select('
			id,
			company_name,
			contact_name
		');
		$this->db->from('customer_contact cc');
		$this->db->join('m_company mc', 'mc.company_id=cc.company_id', 'left');
		$this->db->join('m_individual mi', 'mi.contact_id=cc.contact_id', 'left');
		$this->db->order_by('company_name', 'asc');
		$this->db->order_by('contact_name', 'asc');
		return $this->db->get();
	}
}
