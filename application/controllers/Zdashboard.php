<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Zdashboard extends CI_Controller
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

		// Kondisi Where
		$where = [
			'month(tanggal)' => date('m'),
			'year(tanggal)' => date('Y'),
			'id_cabang' => $this->session->userdata('id_cabang')
		];

		$data = [
			'count_pjl_online' => $this->db->where($where)->count_all_results('penjualan_online'),
			'count_pjl_outlet' => $this->db->where($where)->count_all_results('penjualan_outlet'),
			'count_inbound' => $this->db->where($where)->count_all_results('inbound'),
			'count_outbound' => $this->db->where($where)->count_all_results('outbound'),
			'sum_grand_total_pjl_online' => $this->db->where($where)->select_sum('grand_total')->get('penjualan_online')->row_array(),
			'sum_grand_total_pjl_outlet' => $this->db->where($where)->select_sum('grand_total')->get('penjualan_outlet')->row_array(),
			'count_karyawan' => $this->db->where(['id_cabang' => $this->session->userdata('id_cabang')])->count_all_results('karyawan'),
			'count_customer' => $this->db->where(['cabang_register' => $this->session->userdata('id_cabang')])->count_all_results('customer'),
			'count_produk' => $this->db->where(['id_cabang' => $this->session->userdata('id_cabang')])->count_all_results('produk'),
			'count_jasa' => $this->db->where(['id_cabang' => $this->session->userdata('id_cabang')])->count_all_results('jasa'),
		];
		// Mengecek dan mengganti nilai null dengan 0
		$data['count_pjl_online'] = $data['count_pjl_online'] ?? 0;
		$data['count_pjl_outlet'] = $data['count_pjl_outlet'] ?? 0;
		$data['count_inbound'] = $data['count_inbound'] ?? 0;
		$data['count_outbound'] = $data['count_outbound'] ?? 0;
		$data['sum_grand_total_pjl_online']['grand_total'] = $data['sum_grand_total_pjl_online']['grand_total'] ?? 0;
		$data['sum_grand_total_pjl_outlet']['grand_total'] = $data['sum_grand_total_pjl_outlet']['grand_total'] ?? 0;
		$data['count_karyawan'] = $data['count_karyawan'] ?? 0;
		$data['count_customer'] = $data['count_customer'] ?? 0;
		$data['count_produk'] = $data['count_produk'] ?? 0;
		$data['count_jasa'] = $data['count_jasa'] ?? 0;

		// Penjualan dalam setahun
		for ($i = 1; $i < 13; $i++) {
			$where_i = [
				'month(tanggal)' => $i,
				'year(tanggal)' => date('Y'),
				'id_cabang' => $this->session->userdata('id_cabang')
			];
			$online_perbulan = $this->db->where($where_i)->count_all_results('penjualan_online');
			$outlet_perbulan = $this->db->where($where_i)->count_all_results('penjualan_outlet');
			$total_penjualan_perbulan = $online_perbulan + $outlet_perbulan;
			$penjualan_setahun[$i] = $total_penjualan_perbulan;
		}
		$data['penjualan_setahun'] = $penjualan_setahun;

		// penjualan outlet dg jasa atau tidak
		$id_cabang = $this->session->userdata('id_cabang');
		$q_penjualan_outlet_dg_jasa = "SELECT
											COALESCE(SUM(CASE WHEN poj.id_penjualan_outlet IS NOT NULL THEN 1 ELSE 0 END), 0) AS jumlah_dengan_jasa,
											COALESCE(SUM(CASE WHEN poj.id_penjualan_outlet IS NULL THEN 1 ELSE 0 END), 0) AS jumlah_tanpa_jasa
										FROM
											penjualan_outlet po
										LEFT JOIN
											penjualan_outlet_jasa poj ON po.id = poj.id_penjualan_outlet
										WHERE
											YEAR(po.tanggal) = YEAR(CURRENT_DATE()) AND
											MONTH(po.tanggal) = MONTH(CURRENT_DATE()) AND
											po.id_cabang = $id_cabang";
		$data['penjualan_outlet_dg_jasa'] = $this->db->query($q_penjualan_outlet_dg_jasa)->row_array();

		$this->load->view('template/header');
		$this->load->view('template/topbar', $data_topbar);
		$this->load->view('template/sidebar', $data_sidebar);
		$this->load->view('dashboard/index', $data);
		$this->load->view('template/footer');
	}
}
