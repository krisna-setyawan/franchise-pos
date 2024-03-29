<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Customer extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    is_logged_in();
  }

  public function index()
  {
    $data_sidebar = [
      'menus' => get_menus()
    ];
    $data_topbar = [
      'user' => $this->session->userdata('nama_user'),
      'cabang' => $this->db->get_where('cabang', ['id' => $this->session->userdata('id_cabang')])->row_array(),
    ];

    $this->load->view('template/header');
    $this->load->view('template/topbar', $data_topbar);
    $this->load->view('template/sidebar', $data_sidebar);
    $this->load->view('customer/index');
    $this->load->view('template/footer');
  }

  public function add()
  {
    $data_sidebar = [
      'menus' => get_menus()
    ];
    $data_topbar = [
      'user' => $this->session->userdata('nama_user'),
      'cabang' => $this->db->get_where('cabang', ['id' => $this->session->userdata('id_cabang')])->row_array(),
    ];

    $this->load->view('template/header');
    $this->load->view('template/topbar', $data_topbar);
    $this->load->view('template/sidebar', $data_sidebar);
    $this->load->view('customer/add');
    $this->load->view('template/footer');
  }

  public function edit($kode)
  {
    $data_sidebar = [
      'menus' => get_menus()
    ];
    $data_topbar = [
      'user' => $this->session->userdata('nama_user'),
      'cabang' => $this->db->get_where('cabang', ['id' => $this->session->userdata('id_cabang')])->row_array(),
    ];

    $this->load->view('template/header');
    $this->load->view('template/topbar', $data_topbar);
    $this->load->view('template/sidebar', $data_sidebar);
    $this->load->view('customer/edit');
    $this->load->view('template/footer');
  }
}
