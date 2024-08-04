<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Paket extends CI_Controller
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
		$q_paket = "SELECT produk_paket.* FROM produk_paket WHERE produk_paket.id_cabang = $id_cabang";
		$data = [
			'paket' => $this->db->query($q_paket)->result()
		];

		$this->load->view('template/header');
		$this->load->view('template/topbar', $data_topbar);
		$this->load->view('template/sidebar', $data_sidebar);
		$this->load->view('paket/index', $data);
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
			'kode' => getKodePaket(),
		];

		$this->load->view('template/header');
		$this->load->view('template/topbar', $data_topbar);
		$this->load->view('template/sidebar', $data_sidebar);
		$this->load->view('paket/add', $data);
		$this->load->view('template/footer');
	}


	public function store()
	{
		$data = array(
			'id_cabang' => $this->session->userdata('id_cabang'),
			'kode' => $this->input->post('kode'),
			'nama' => $this->input->post('nama'),
			'harga' => str_replace(".", "", $this->input->post('harga')),
			'keterangan' => $this->input->post('keterangan'),
		);
		$this->db->insert('produk_paket', $data);
		$id_paket = $this->db->insert_id();

		// INSERT ITEM PRODUK
		$produk = $this->input->post('id_produk');
		$qty_produk = $this->input->post('qty_produk');

		if (!empty($produk) && is_array($produk) && !empty($qty_produk) && is_array($qty_produk)) {
			$batch_data_produk = [];

			foreach ($produk as $index => $value) {
				$list_produk = [
					'id_paket' => $id_paket,
					'id_produk' => $value,
					'qty' => $qty_produk[$index],
				];

				if ($index != 0) {
					$batch_data_produk[] = $list_produk;
				}
			}

			if (!empty($batch_data_produk)) {
				$this->db->insert_batch('produk_paket_pr', $batch_data_produk);
			}
		}

		// INSERT ITEM JASA
		$jasa = $this->input->post('id_jasa');
		$qty_jasa = $this->input->post('qty_jasa');

		if (!empty($jasa) && is_array($jasa) && !empty($qty_jasa) && is_array($qty_jasa)) {
			$batch_data_jasa = [];

			foreach ($jasa as $index => $value) {
				$list_jasa = [
					'id_paket' => $id_paket,
					'id_jasa' => $value,
					'qty' => $qty_jasa[$index],
				];

				if ($index != 0) {
					$batch_data_jasa[] = $list_jasa;
				}
			}

			if (!empty($batch_data_jasa)) {
				$this->db->insert_batch('produk_paket_js', $batch_data_jasa);
			}
		}

		$datasession = array(
			'pesan-notif' => 'Berhasil menambah data paket.',
			'icon-notif' => 'success'
		);
		$this->session->set_flashdata($datasession);
		redirect('paket');
	}


	public function delete($id)
	{
		$where = array('id' => $id);
		$this->db->where($where);
		$this->db->delete('produk_paket');

		$datasession = array(
			'pesan-notif' => 'Berhasil menghapus data paket.',
			'icon-notif' => 'success'
		);
		$this->session->set_flashdata($datasession);
		redirect('paket');
	}


	public function show($id)
	{
		$q_jasa = "SELECT produk_paket_js.*, jasa.nama FROM produk_paket_js
						LEFT JOIN jasa ON jasa.id = produk_paket_js.id_jasa
						WHERE produk_paket_js.id_paket = $id ORDER BY jasa.nama ASC;";
		$q_produk = "SELECT produk_paket_pr.*, produk.nama FROM produk_paket_pr
						LEFT JOIN produk ON produk.id = produk_paket_pr.id_produk
						WHERE produk_paket_pr.id_paket = $id ORDER BY produk.nama ASC;";

		$data_view = [
			'paket' => $this->db->get_where('produk_paket', ['id' => $id])->row_array(),
			'jasa' => $this->db->query($q_jasa)->result(),
			'produk' => $this->db->query($q_produk)->result(),
		];

		$data = [
			'detail' => $this->load->view('paket/show', $data_view, TRUE),
		];

		echo json_encode($data);
	}
}
