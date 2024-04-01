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

		$data = [
			'produk' => $this->db->get('produk')->result()
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
			'kode' => $this->input->post('kode'),
			'nama' => $this->input->post('nama'),
			'harga' => str_replace(".", "", $this->input->post('harga')),
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
			'produk' => $this->db->get_where('produk', ['kode' => $kode])->row_array(),
		];

		$this->load->view('template/header');
		$this->load->view('template/topbar', $data_topbar);
		$this->load->view('template/sidebar', $data_sidebar);
		$this->load->view('produk/edit', $data);
		$this->load->view('template/footer');
	}

	public function update()
	{
		$kode =  $this->input->post('kode');

		$data = array(
			'nama' => $this->input->post('nama'),
			'harga' => str_replace(".", "", $this->input->post('harga')),
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
		$data_view = [
			'produk' => $this->db->get('produk')->result(),
			'row' => $row
		];

		$data = [
			'table_produk' => $this->load->view('produk/table_modal', $data_view, TRUE),
		];

		echo json_encode($data);
	}
}
