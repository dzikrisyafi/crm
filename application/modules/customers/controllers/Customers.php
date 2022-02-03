<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Customers extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_general', 'mdl');
		$this->load->model('M_customer', 'customer');
	}

	public function index()
	{
		$data = [
			'title' => 'Customers',
			'customers' => $this->customer->getCustomers()->result_array(),
		];

		$this->load->view('v_customers', $data);
	}

	public function create()
	{
		$data = [
			'title' => 'Create Customer',
			'companies' => $this->mdl->getAll('company_id as id, company_name as name', null, 'm_company')->result_array()
		];

		$this->load->view('f_customers', $data);
	}

	public function detail($id)
	{
		$data = [
			'title' => 'Customer Detail',
			'customer' => $this->mdl->getWhere('*', ['company_id' => $id], 'm_company')
		];

		$this->load->view('', $data);
	}

	public function save()
	{
		if (!$this->input->is_ajax_request()) show_404();

		$category = $this->input->post('category');
		$contact_name = $this->input->post('contact_name');
		$company_name = $this->input->post('company_name');
		$street = $this->input->post('street');
		$street2 = $this->input->post('street2');
		$city = $this->input->post('city');
		$state = $this->input->post('state');
		$zip = $this->input->post('zip');
		$country = $this->input->post('country');
		$tax_id = $this->input->post('tax_id');
		$job_position = $this->input->post('job_position');
		$phone = $this->input->post('phone');
		$mobile = $this->input->post('mobile');
		$email = $this->input->post('email');
		$website = $this->input->post('website');
		$title = $this->input->post('title');
		$tag = $this->input->post('tag');

		$rules = [
			[
				'field' => 'contact_name',
				'label' => 'Contact Name',
				'rules' => 'required'
			]
		];

		if ($category == 1) {
			array_push(
				$rules,
				[
					'field' => 'company_name',
					'label' => 'Company Name',
					'rules' => 'required'
				]
			);
		}

		$this->form_validation->set_rules($rules);
		if ($this->form_validation->run() == FALSE) {
			$result = [
				'success' => false,
				'console_message' => validation_errors()
			];
		} else {
			$this->db->trans_begin();

			$data = [
				'company_name' => $contact_name,
				'street' => $street,
				'street2' => $street2,
				'city' => $city,
				'state_id' => $state,
				'zip_code' => $zip,
				'country_id' => $country,
				'tax_id' => $tax_id,
				'phone' => $phone,
				'mobile' => $mobile,
				'email' => $email,
				'website' => $website,
				'tag_id' => $tag,
			];

			if ($category == 1) {
				unset($data['company_name']);
				$data['contact_name'] = $contact_name;
				$data['job_position'] = $job_position;
				$data['title_id'] = $title;

				$table = 'm_individual';
			} else {
				$table = 'm_company';
			}

			$this->db->insert($table, $data);

			if ($table == 'm_company') {
				$data = [
					'company_id' => $this->db->insert_id(),
					'contact_id' => null
				];
				$this->db->insert('customer_contact', $data);
			} else {
				$this->db->insert('customer_contact', ['company_id' => $company_name, 'contact_id' => $this->db->insert_id()]);
			}

			$result = [
				'success' => true,
				'message' => 'Success to add new customer contact',
			];
		}

		if ($this->db->trans_status() == FALSE) {
			$this->db->trans_rollback();
			$result['success'] = false;
			$result['message'] = 'Failed to add new customer contact';
			$result['console_message'] = 'Failed to add new customer contact [Rollback DB]';
		} else {
			$result['console_message'] = 'Success to add new customer contact [Rollback DB]';
			$this->db->trans_commit();
		}

		return $this->output
			->set_content_type('application/json')
			->set_status_header(200)
			->set_output(json_encode($result));
	}
}
