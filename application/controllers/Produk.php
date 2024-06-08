<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Produk extends CI_Controller
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
		$q_produk = "SELECT produk.*, produk_jenis.nama AS jenis, produk_label.nama AS label FROM produk 
					JOIN produk_jenis ON produk.id_jenis = produk_jenis.id 
					JOIN produk_label ON produk.id_label = produk_label.id 
					WHERE produk.id_cabang = $id_cabang";
		$data = [
			'produk' => $this->db->query($q_produk)->result()
		];

		$this->load->view('template/header');
		$this->load->view('template/topbar', $data_topbar);
		$this->load->view('template/sidebar', $data_sidebar);
		$this->load->view('produk/index', $data);
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
			'kode' => getKodeProduk(),
			'produk_jenis' => $this->db->get('produk_jenis')->result(),
			'produk_label' => $this->db->get('produk_label')->result()
		];

		$this->load->view('template/header');
		$this->load->view('template/topbar', $data_topbar);
		$this->load->view('template/sidebar', $data_sidebar);
		$this->load->view('produk/add', $data);
		$this->load->view('template/footer');
	}

	public function store()
	{
		$data = array(
			'id_cabang' => $this->session->userdata('id_cabang'),
			'id_jenis' => $this->input->post('id_jenis'),
			'id_label' => $this->input->post('id_label'),
			'kode' => $this->input->post('kode'),
			'nama' => $this->input->post('nama'),
			'hg_outlet' => str_replace(".", "", $this->input->post('hg_outlet')),
			'hg_shopee' => str_replace(".", "", $this->input->post('hg_shopee')),
			'hg_tokopedia' => str_replace(".", "", $this->input->post('hg_tokopedia')),
			'hg_lazada' => str_replace(".", "", $this->input->post('hg_lazada')),
			'hg_agen' => str_replace(".", "", $this->input->post('hg_agen')),
			'hg_reseller' => str_replace(".", "", $this->input->post('hg_reseller')),
			'hg_whatsapp' => str_replace(".", "", $this->input->post('hg_whatsapp')),
			'stok' => $this->input->post('stok'),
			'keterangan' => $this->input->post('keterangan'),
		);
		$this->db->insert('produk', $data);

		$datasession = array(
			'pesan-notif' => 'Berhasil menambah data produk.',
			'icon-notif' => 'success'
		);
		$this->session->set_flashdata($datasession);
		redirect('produk');
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

		$data = [
			'produk' => $this->db->get_where('produk', ['kode' => str_replace('%20', ' ', $kode)])->row_array(),
			'produk_jenis' => $this->db->get('produk_jenis')->result(),
			'produk_label' => $this->db->get('produk_label')->result()
		];

		$this->load->view('template/header');
		$this->load->view('template/topbar', $data_topbar);
		$this->load->view('template/sidebar', $data_sidebar);
		$this->load->view('produk/edit', $data);
		$this->load->view('template/footer');
	}

	public function update()
	{
		$kode =  $this->input->post('oldkode');

		$data = array(
			'kode' => $this->input->post('kode'),
			'id_jenis' => $this->input->post('id_jenis'),
			'id_label' => $this->input->post('id_label'),
			'nama' => $this->input->post('nama'),
			'hg_outlet' => str_replace(".", "", $this->input->post('hg_outlet')),
			'hg_shopee' => str_replace(".", "", $this->input->post('hg_shopee')),
			'hg_tokopedia' => str_replace(".", "", $this->input->post('hg_tokopedia')),
			'hg_lazada' => str_replace(".", "", $this->input->post('hg_lazada')),
			'hg_agen' => str_replace(".", "", $this->input->post('hg_agen')),
			'hg_reseller' => str_replace(".", "", $this->input->post('hg_reseller')),
			'hg_whatsapp' => str_replace(".", "", $this->input->post('hg_whatsapp')),
			'stok' => $this->input->post('stok'),
			'keterangan' => $this->input->post('keterangan'),
		);
		$this->db->where('kode', $kode);
		$this->db->update('produk', $data);

		$datasession = array(
			'pesan-notif' => 'Berhasil update data produk.',
			'icon-notif' => 'success'
		);
		$this->session->set_flashdata($datasession);
		redirect('produk');
	}



	public function delete($id)
	{
		$where = array('id' => $id);
		$this->db->where($where);
		$this->db->delete('produk');

		$datasession = array(
			'pesan-notif' => 'Berhasil menghapus data produk.',
			'icon-notif' => 'success'
		);
		$this->session->set_flashdata($datasession);
		redirect('produk');
	}
















	public function selectProdukForModal()
	{
		$row = $this->input->get('row');
		$marketplace = $this->input->get('marketplace') ? $this->input->get('marketplace') : 'outlet';

		$id_cabang = $this->session->userdata('id_cabang');
		$q_produk = "SELECT produk.*, produk_jenis.nama AS jenis, produk_label.nama AS label FROM produk 
					JOIN produk_jenis ON produk.id_jenis = produk_jenis.id 
					JOIN produk_label ON produk.id_label = produk_label.id 
					WHERE produk.id_cabang = $id_cabang";

		$data_view = [
			'produk' => $this->db->query($q_produk)->result(),
			'row' => $row,
			'marketplace' => $marketplace,
		];

		$data = [
			'table_produk' => $this->load->view('produk/table_modal', $data_view, TRUE),
		];

		echo json_encode($data);
	}
}
