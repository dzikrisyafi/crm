<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		show_404();
	}

	public function login()
	{
		$data = [
			'title' => 'Login'
		];

		$this->load->view('f_login', $data);
	}

	public function register()
	{
		$data = [
			'title' => 'Register'
		];

		$this->load->view('f_register', $data);
	}
}
