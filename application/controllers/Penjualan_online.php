<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penjualan_online extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		is_logged_in();
	}

	public function index()
	{
		date_default_timezone_set('Asia/Jakarta');

		$tgl_awal = $this->input->get('dari');
		$tgl_akhir = $this->input->get('sampai');

		if ($tgl_awal == null) {
			$tanggalAwal = date('Y-m-d');
		} else {
			$tanggalAwal = $tgl_awal;
		}
		if ($tgl_akhir == null) {
			$tanggalAkhir = date('Y-m-d');
		} else {
			$tanggalAkhir = $tgl_akhir;
		}

		$data_sidebar = [
			'menus' => get_menus()
		];
		$data_topbar = [
			'user' => $this->session->userdata('nama_user'),
			'cabang' => $this->db->get_where('cabang', ['id' => $this->session->userdata('id_cabang')])->row_array(),
		];

		$q_penjualan = "SELECT * FROM penjualan_online	WHERE tanggal >= '$tanggalAwal' AND tanggal <= '$tanggalAkhir' ORDER BY id DESC";
		$penjualan_online = $this->db->query($q_penjualan)->result();

		$data = [
			'penjualan_online' => $penjualan_online,
			'tgl_awal' => $tanggalAwal,
			'tgl_akhir' => $tanggalAkhir
		];

		$this->load->view('template/header');
		$this->load->view('template/topbar', $data_topbar);
		$this->load->view('template/sidebar', $data_sidebar);
		$this->load->view('penjualan_online/index', $data);
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

		$data = [
			'nomor' => getNomorOutbound(date('Y-m-d')),
		];

		$this->load->view('template/header');
		$this->load->view('template/topbar', $data_topbar);
		$this->load->view('template/sidebar', $data_sidebar);
		$this->load->view('outbound/add', $data);
		$this->load->view('template/footer');
	}
}
