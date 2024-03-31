<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data_karyawan extends CI_Controller
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

    $id_cabang = $this->session->userdata('id_cabang');
    $q_kry = "SELECT karyawan.*, cabang.nama AS cabang FROM karyawan JOIN cabang ON karyawan.id_cabang = cabang.id WHERE karyawan.id_cabang = $id_cabang";
    $karyawan = $this->db->query($q_kry)->result();
    $data = [
      'karyawan' => $karyawan,
    ];

    $this->load->view('template/header');
    $this->load->view('template/topbar', $data_topbar);
    $this->load->view('template/sidebar', $data_sidebar);
    $this->load->view('data_karyawan/index', $data);
    $this->load->view('template/footer');
  }
}
