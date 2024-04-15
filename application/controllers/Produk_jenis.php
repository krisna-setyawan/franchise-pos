<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Produk_jenis extends CI_Controller
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
			'produk_jenis' => $this->db->get_where('produk_jenis', ['id' => $this->session->userdata('id_produk_jenis')])->row_array(),
		];

		$data = [
			'produk_jenis' => $this->db->get('produk_jenis')->result()
		];

		$this->load->view('template/header');
		$this->load->view('template/topbar', $data_topbar);
		$this->load->view('template/sidebar', $data_sidebar);
		$this->load->view('produk_jenis/index', $data);
		$this->load->view('template/footer');
	}



	public function add()
	{
		$data_sidebar = [
			'menus' => get_menus()
		];
		$data_topbar = [
			'user' => $this->session->userdata('nama_user'),
			'produk_jenis' => $this->db->get_where('produk_jenis', ['id' => $this->session->userdata('id_produk_jenis')])->row_array(),
		];

		$this->load->view('template/header');
		$this->load->view('template/topbar', $data_topbar);
		$this->load->view('template/sidebar', $data_sidebar);
		$this->load->view('produk_jenis/add');
		$this->load->view('template/footer');
	}

	public function store()
	{
		$data = array(
			'nama' => $this->input->post('nama'),
		);
		$this->db->insert('produk_jenis', $data);

		$datasession = array(
			'pesan-notif' => 'Berhasil menambah data jenis produk.',
			'icon-notif' => 'success'
		);
		$this->session->set_flashdata($datasession);
		redirect('produk_jenis');
	}



	public function edit($id)
	{
		$data_sidebar = [
			'menus' => get_menus()
		];
		$data_topbar = [
			'user' => $this->session->userdata('nama_user'),
			'produk_jenis' => $this->db->get_where('produk_jenis', ['id' => $this->session->userdata('id_produk_jenis')])->row_array(),
		];

		$data = [
			'produk_jenis' => $this->db->get_where('produk_jenis', ['id' => $id])->row_array()
		];

		$this->load->view('template/header');
		$this->load->view('template/topbar', $data_topbar);
		$this->load->view('template/sidebar', $data_sidebar);
		$this->load->view('produk_jenis/edit', $data);
		$this->load->view('template/footer');
	}

	public function update()
	{
		$id =  $this->input->post('id');

		$data = array(
			'nama' => $this->input->post('nama'),
		);
		$this->db->where('id', $id);
		$this->db->update('produk_jenis', $data);

		$datasession = array(
			'pesan-notif' => 'Berhasil update data jenis produk.',
			'icon-notif' => 'success'
		);
		$this->session->set_flashdata($datasession);
		redirect('produk_jenis');
	}



	public function delete($id)
	{
		$where = array('id' => $id);
		$this->db->where($where);
		$this->db->delete('produk_jenis');

		$datasession = array(
			'pesan-notif' => 'Berhasil menghapus data jenis produk.',
			'icon-notif' => 'success'
		);
		$this->session->set_flashdata($datasession);
		redirect('produk_jenis');
	}
}
