<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Produk_label extends CI_Controller
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
			'produk_label' => $this->db->get_where('produk_label', ['id' => $this->session->userdata('id_produk_label')])->row_array(),
		];

		$data = [
			'produk_label' => $this->db->get('produk_label')->result()
		];

		$this->load->view('template/header');
		$this->load->view('template/topbar', $data_topbar);
		$this->load->view('template/sidebar', $data_sidebar);
		$this->load->view('produk_label/index', $data);
		$this->load->view('template/footer');
	}



	public function add()
	{
		$data_sidebar = [
			'menus' => get_menus()
		];
		$data_topbar = [
			'user' => $this->session->userdata('nama_user'),
			'produk_label' => $this->db->get_where('produk_label', ['id' => $this->session->userdata('id_produk_label')])->row_array(),
		];

		$this->load->view('template/header');
		$this->load->view('template/topbar', $data_topbar);
		$this->load->view('template/sidebar', $data_sidebar);
		$this->load->view('produk_label/add');
		$this->load->view('template/footer');
	}

	public function store()
	{
		$data = array(
			'nama' => $this->input->post('nama'),
		);
		$this->db->insert('produk_label', $data);

		$datasession = array(
			'pesan-notif' => 'Berhasil menambah data label produk.',
			'icon-notif' => 'success'
		);
		$this->session->set_flashdata($datasession);
		redirect('produk_label');
	}



	public function edit($id)
	{
		$data_sidebar = [
			'menus' => get_menus()
		];
		$data_topbar = [
			'user' => $this->session->userdata('nama_user'),
			'produk_label' => $this->db->get_where('produk_label', ['id' => $this->session->userdata('id_produk_label')])->row_array(),
		];

		$data = [
			'produk_label' => $this->db->get_where('produk_label', ['id' => $id])->row_array()
		];

		$this->load->view('template/header');
		$this->load->view('template/topbar', $data_topbar);
		$this->load->view('template/sidebar', $data_sidebar);
		$this->load->view('produk_label/edit', $data);
		$this->load->view('template/footer');
	}

	public function update()
	{
		$id =  $this->input->post('id');

		$data = array(
			'nama' => $this->input->post('nama'),
		);
		$this->db->where('id', $id);
		$this->db->update('produk_label', $data);

		$datasession = array(
			'pesan-notif' => 'Berhasil update data label produk.',
			'icon-notif' => 'success'
		);
		$this->session->set_flashdata($datasession);
		redirect('produk_label');
	}



	public function delete($id)
	{
		$where = array('id' => $id);
		$this->db->where($where);
		$this->db->delete('produk_label');

		$datasession = array(
			'pesan-notif' => 'Berhasil menghapus data label produk.',
			'icon-notif' => 'success'
		);
		$this->session->set_flashdata($datasession);
		redirect('produk_label');
	}
}
