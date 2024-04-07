<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Zmy404 extends CI_Controller
{
	// public function __construct()
	// {
	//   parent::__construct();
	//   is_logged_in();
	// }

	public function index()
	{
		$this->output->set_status_header('404');
		$this->load->view('errors/err404');
	}
}
