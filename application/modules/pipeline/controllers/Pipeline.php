<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pipeline extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_general', 'mdl');
		$this->load->model('M_stage', 'stage');
		$this->load->model('M_customer', 'customer');
	}

	public function index($view = 'kanban')
	{
		$data = [
			'title' => 'Pipeline',
			'stages' => $this->mdl->getAll('stage_id as id, stage as name, order_num', 'order_num asc', 'm_stage')->result_array(),
			'customers' => $this->customer->getContact()->result_array(),
			'opportunities' => $this->stage->getOpportunities()->result_array(),
			'sales_team' => $this->mdl->getAll('sales_team_id as id, sales_team as name', null, 'm_sales_team')->result_array()
		];

		if ($view == 'list') {
			$this->load->view('v_pipeline_list', $data);
		} else {
			$this->load->view('v_pipeline_kanban', $data);
		}
	}

	public function saveStage()
	{
		if (!$this->input->is_ajax_request()) show_404();

		$stage_id = $this->input->post('id');
		$stage = $this->input->post('stage');
		$sales_team = $this->input->post('sales_team');
		$req = $this->input->post('req');

		$check = $this->mdl->getWhere('stage_id', ['stage_id' => $stage_id], 'm_stage');

		$rules = [
			[
				'field' => 'stage',
				'label' => 'Stage',
				'rules' => 'required'
			],
		];

		$this->form_validation->set_rules($rules);
		if ($this->form_validation->run() == FALSE) {
			$result = [
				'success' => false,
				'console_message' => validation_errors()
			];
		} else {
			$this->db->trans_begin();

			$order_num = $this->mdl->getMax('order_num', 'm_stage')->row_array();
			$data = [
				'stage' => $stage,
				'order_num' => $order_num['order_num'] + 1
			];

			if ($check->num_rows() > 0) {
				$data['sales_team_id'] = $sales_team;
				$data['requirements'] = $req;
				$this->db->update('m_stage', $data, ['stage_id' => $stage_id]);

				$result = [
					'success' => true,
					'console_message' => 'Success to save changes'
				];
			} else {
				$this->db->insert('m_stage', $data);

				$result = [
					'success' => true,
					'console_message' => 'Success to add new stage'
				];
			}
		}

		if ($this->db->trans_status() == FALSE) {
			$this->db->trans_rollback();
			$result['success'] = false;
			$result['console_message'] = "Error! There's an error when trying to save data [Rollback DB]";
		} else {
			$this->db->trans_commit();
		}

		return $this->output
			->set_content_type('application/json')
			->set_status_header(200)
			->set_output(json_encode($result));
	}

	public function updateStage()
	{
		if (!$this->input->is_ajax_request()) show_404();

		$stage_id = $this->input->post('id');
		$stage = $this->input->post('stage');
		$sales_team = $this->input->post('sales_team');
		$req = $this->input->post('req');

		$check = $this->mdl->getWhere('stage_id', ['stage_id' => $stage_id], 'm_stage');

		if ($check->num_rows() < 0) show_404();

		$rules = [
			[
				'field' => 'stage',
				'label' => 'Stage',
				'rules' => 'required'
			],
		];

		$this->form_validation->set_rules($rules);
		if ($this->form_validation->run() == FALSE) {
			$result = [
				'success' => false,
				'console_message' => validation_errors()
			];
		} else {
			$this->db->trans_begin();
			$data = [
				'stage' => $stage,
				'sales_team_id' => $sales_team,
				'requirements' => $req
			];

			$this->db->update('m_stage', $data, ['stage_id' => $stage_id]);

			$result = [
				'success' => true,
				'console_message' => 'Success to save changes'
			];
		}

		if ($this->db->trans_status() == FALSE) {
			$this->db->trans_rollback();
			$result['success'] = false;
			$result['console_message'] = "Error! There's an error when trying to save data [Rollback DB]";
		} else {
			$this->db->trans_commit();
		}

		return $this->output
			->set_content_type('application/json')
			->set_status_header(200)
			->set_output(json_encode($result));
	}

	public function saveOpportunity()
	{
		if (!$this->input->is_ajax_request()) show_404();

		$stage_id = $this->input->post('stage_id');
		$opportunity = $this->input->post('opportunity');
		$customer = $this->input->post('customer');
		$revenue = str_replace(',', '', $this->input->post('revenue'));
		$priority = $this->input->post('score');
		$closing = $this->input->post('closing');

		$rules = [
			[
				'field' => 'customer',
				'label' => 'Customer',
				'rules' => 'required'
			],
			[
				'field' => 'opportunity',
				'label' => 'Opportunity',
				'rules' => 'required'
			],
			[
				'field' => 'revenue',
				'label' => 'Expected Revenue',
				'rules' => 'required'
			],
			[
				'field' => 'score',
				'label' => 'Score',
				'rules' => 'numeric'
			],
			[
				'field' => 'closing',
				'label' => 'Closing',
				'rules' => 'required'
			]
		];

		$this->form_validation->set_rules($rules);
		if ($this->form_validation->run() == FALSE) {
			$result = [
				'success' => false,
				'console_message' => validation_errors()
			];
		} else {
			$this->db->trans_begin();
			$data = [
				'stage_id' => $stage_id,
				'contact_id' => $customer,
				'opportunity' => $opportunity,
				'revenue' => $revenue,
				'priority_id' => $priority,
				'expected_closing' => $closing
			];

			$this->db->insert('m_opportunity', $data);
			$result = [
				'success' => true,
				'console_message' => 'Success to add new record'
			];
		}

		if ($this->db->trans_status() == FALSE) {
			$this->db->trans_rollback();
			$result = [
				'success' => false,
				'console_message' => 'Success to add new record [Rollback DB]'
			];
		} else {
			$this->db->trans_commit();
		}

		return $this->output
			->set_content_type('application/json')
			->set_status_header(200)
			->set_output(json_encode($result));
	}

	public function edit($id)
	{
		$check = $this->mdl->getWhere('opportunity_id', ['opportunity_id' => $id], 'm_opportunity');
		if (!$check->num_rows()) show_404();

		$data = [
			'title' => 'Edit Opportunity',
			'opportunity' => $this->stage->getOpportunity($id)->row_array(),
			'customers' => $this->customer->getContact()->result_array(),
			'sales_team' => $this->mdl->getAll('sales_team_id as id, sales_team as name', null, 'm_sales_team')->result_array()
		];

		$this->load->view('f_opportunity', $data);
	}

	public function updateOpportunity()
	{
		if (!$this->input->is_ajax_request()) show_404();

		$id = $this->input->post('id');
		$opportunity = $this->input->post('opportunity');
		$revenue = $this->input->post('revenue');
		$contact_id = $this->input->post('customer');
		$expected_closing = $this->input->post('closing');
		$email = $this->input->post('email');
		$priority_id = $this->input->post('score');

		$check = $this->mdl->getWhere('opportunity_id', ['opportunity_id' => $id], 'm_opportunity');

		if ($check->num_rows() < 1) show_404();

		$rules = [
			[
				'field' => 'opportunity',
				'label' => 'Opportunity',
				'rules' => 'required'
			],
			[
				'field' => 'revenue',
				'label' => 'Revenue',
				'rules' => 'required'
			],
			[
				'field' => 'customer',
				'label' => 'Customer',
				'rules' => 'required'
			],
			[
				'field' => 'closing',
				'label' => 'Closing',
				'rules' => 'required'
			],
		];

		$this->form_validation->set_rules($rules);
		if ($this->form_validation->run() == FALSE) {
			$result = [
				'success' => false,
				'console_message' => validation_errors()
			];
		} else {
			$this->db->trans_begin();

			$data = [
				'opportunity' => $opportunity,
				'revenue' => str_replace(',', '', $revenue),
				'contact_id' => $contact_id,
				'expected_closing' => $expected_closing,
				'priority_id' => $priority_id
			];

			$this->db->update('m_opportunity', $data, ['opportunity_id' => $id]);
			$result = [
				'success' => true,
				'console_message' => 'Success to save changes'
			];
		}

		if ($this->db->trans_status() == FALSE) {
			$this->db->trans_rollback();
			$result['success'] = false;
			$result['console_message'] = 'There\'s an error when trying to save changes';
		} else {
			$this->db->trans_commit();
		}

		return $this->output
			->set_content_type('application/json')
			->set_status_header(200)
			->set_output(json_encode($result));
	}

	public function destroy()
	{
		if (!$this->input->is_ajax_request()) show_404();

		$id = $this->input->post('id');

		$this->db->trans_begin();
		if ($this->db->delete('m_stage', ['stage_id' => $id])) {
			$result = [
				'success' => true,
				'console_message' => 'Success'
			];
		} else {
			$result = [
				'success' => false,
				'console_message' => 'Error'
			];
		}

		if ($this->db->trans_status() == FALSE) {
			$this->db->trans_rollback();
			$result['success'] = false;
			$result['console_message'] = 'Error';
		} else {
			$this->db->trans_commit();
		}

		$this->output
			->set_content_type('application/json')
			->set_status_header(200)
			->set_output(json_encode($result));
	}

	public function destroyStageList()
	{
		if (!$this->input->is_ajax_request()) show_404();

		$id = $this->input->post('id');

		$this->db->trans_begin();
		if ($this->db->delete('m_opportunity', ['opportunity_id' => $id])) {
			$result = [
				'success' => true,
				'console_message' => 'Success to delete record'
			];
		} else {
			$result = [
				'success' => false,
				'console_message' => 'Failed! There\'s an error when trying to deleting record'
			];
		}

		if ($this->db->trans_status() == FALSE) {
			$this->db->trans_rollback();
			$result['success'] = false;
			$result['console_message'] = 'Error';
		} else {
			$this->db->trans_commit();
		}

		$this->output
			->set_content_type('application/json')
			->set_status_header(200)
			->set_output(json_encode($result));
	}

	public function getStage()
	{
		if (!$this->input->is_ajax_request()) show_404();

		$id = $this->input->get('id');

		$stage = $this->mdl->getWhere('*', ['stage_id' => $id], 'm_stage');
		if ($stage->num_rows() > 0) {
			$result = [
				'success' => true,
				'stage' => $stage->row_array()
			];
		} else {
			$result = [
				'success' => false,
				'console_message' => "There is no data with id $id"
			];
		}

		return $this->output
			->set_content_type('application/json')
			->set_status_header(200)
			->set_output(json_encode($result));
	}

	public function changePriority()
	{
		if (!$this->input->is_ajax_request()) show_404();

		$opportunity_id = $this->input->post('listID');
		$priority = $this->input->post('priority');

		$check = $this->mdl->getWhere('*', ['opportunity_id' => $opportunity_id], 'm_opportunity');
		$this->db->trans_begin();
		if ($check->num_rows() > 0) {
			$this->db->update('m_opportunity', ['priority_id' => $priority], ['opportunity_id' => $opportunity_id]);
			$result = [
				'success' => true,
				'console_message' => 'Success to save changes',
				'priority' => $priority
			];
		}

		if ($this->db->trans_status() == FALSE) {
			$this->db->trans_rollback();
			$result['success'] = false;
			$result['console_message'] = 'Error! failed to save changes';
		} else {
			$this->db->trans_commit();
		}

		return $this->output
			->set_content_type('application/json')
			->set_status_header(200)
			->set_output(json_encode($result));
	}

	public function reorder()
	{
		if (!$this->input->is_ajax_request()) show_404();

		$position = $this->input->post('position');

		$i = 1;

		$this->db->trans_begin();
		foreach ($position as $val) {
			$this->db->update('m_stage', ['order_num' => $i], ['stage_id' => $val]);
			$i++;
		}

		$result = [
			'success' => true,
			'console_message' => 'Success to reorder stage'
		];

		if ($this->db->trans_status() == FALSE) {
			$this->db->trans_rollback();
			$result['success'] = false;
			$result['console_message'] = 'Failed to reorder stage [Rollback DB]';
		} else {
			$this->db->trans_commit();
		}

		return $this->output
			->set_content_type('application/json')
			->set_status_header(200)
			->set_output(json_encode($result));
	}

	public function changeStage()
	{
		if (!$this->input->is_ajax_request()) show_404();

		$opportunity_id = $this->input->post('id');
		$stage_id = $this->input->post('stageId');

		$data = [
			'stage_id' => $stage_id
		];

		$this->db->trans_begin();
		$this->db->update('m_opportunity', $data, ['opportunity_id' => $opportunity_id]);

		$result = [
			'success' => true,
			'console_message' => 'Success to save changes',
		];

		if ($this->db->trans_status() == FALSE) {
			$this->db->trans_rollback();
		} else {
			$this->db->trans_commit();
		}

		return $this->output
			->set_content_type('application/json')
			->set_status_header(200)
			->set_output(json_encode($result));
	}
}
