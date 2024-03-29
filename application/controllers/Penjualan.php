<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Customer extends CI_Controller
{

  // public function __construct()
  // {
  // 	parent::__construct();
  // 	is_logged_in();
  // }

  public function index()
  {
    $this->load->view('template/header');
    $this->load->view('template/topbar');
    $this->load->view('template/sidebar');
    $this->load->view('customer/index');
    $this->load->view('template/footer');
  }
}
