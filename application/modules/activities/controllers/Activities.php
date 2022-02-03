<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Activities extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_general', 'mdl');
		$this->load->model('M_stage', 'stage');
		$this->load->model('M_activity', 'act');
	}

	public function index()
	{
		$data = [
			'title' => 'Activities',
			'opportunities' => $this->stage->getOpportunities()->result_array(),
			'schedules' => $this->act->getOpportunities()->result_array(),
			'activities' => $this->mdl->getAll('activity_id as id, activity_type as name', null, 'm_activity')->result_array(),
		];

		$this->load->view('v_activities', $data);
	}

	public function my()
	{
		$data = [
			'title' => 'My Activities'
		];

		$this->load->view('v_my_activities', $data);
	}

	public function store()
	{
		if (!$this->input->is_ajax_request()) show_404();

		$opportunity_id = $this->input->post('opportunity_id');
		$activity_id = $this->input->post('activity_type');
		$expected_closing = $this->input->post('closing');
		$summary = $this->input->post('summary');
		$sales_person = $this->input->post('sales_person');
		$note = $this->input->post('note');

		$rules = [
			[
				'field' => 'activity_type',
				'label' => 'Activity',
				'rules' => 'required'
			],
			[
				'field' => 'closing',
				'label' => 'Expected Closing',
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
				'opportunity_id' => $opportunity_id,
				'activity_id' => $activity_id,
				'expected_closing' => $expected_closing,
				'summary' => $summary,
				'sales_person' => $sales_person,
				'note' => $note
			];

			$this->db->insert('activity_schedule', $data);

			$result = [
				'success' => true,
				'console_message' => 'Success to add new schedule'
			];
		}

		if ($this->db->trans_status() == FALSE) {
			$this->db->trans_rollback();
			$result['success'] = false;
			$result['console_message'] = 'There\'s an error when trying to save data';
		} else {
			$this->db->trans_commit();
		}

		return $this->output
			->set_content_type('application/json')
			->set_status_header(200)
			->set_output(json_encode($result));
	}

	public function markdone()
	{
		if (!$this->input->is_ajax_request()) show_404();

		$opportunity_id = $this->input->post('opportunity');
		$activity_id = $this->input->post('activity_id');
		$feedback = $this->input->post('feedback');

		$rules = [
			[
				'field' => 'feedback',
				'label' => 'Feedback',
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
				'feedback' => $feedback,
				'is_done' => 1,
				'completion_date' => date('Y-m-d H:i:s')
			];

			$this->db->update('activity_schedule', $data, [
				'opportunity_id' => $opportunity_id, 'activity_id' => $activity_id
			]);

			$result = [
				'success' => true,
				'console_message' => 'Success to save changes'
			];
		}

		if ($this->db->trans_status() == FALSE) {
			$this->db->trans_rollback();
			$result['success'] = false;
			$result['console_message'] = 'There\'s an error when trying to save data';
		} else {
			$this->db->trans_commit();
		}

		return $this->output
			->set_content_type('application/json')
			->set_status_header(200)
			->set_output(json_encode($result));
	}

	public function report()
	{
		$data = [
			'title' => 'Activities Report',
			'reports' => $this->act->getReports()->result_array()
		];

		$this->load->view('v_activities_report', $data);
	}
}
