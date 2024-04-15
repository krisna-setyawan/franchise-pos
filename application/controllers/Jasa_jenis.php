<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jasa_jenis extends CI_Controller
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
			'jasa_jenis' => $this->db->get_where('jasa_jenis', ['id' => $this->session->userdata('id_jasa_jenis')])->row_array(),
		];

		$data = [
			'jasa_jenis' => $this->db->get('jasa_jenis')->result()
		];

		$this->load->view('template/header');
		$this->load->view('template/topbar', $data_topbar);
		$this->load->view('template/sidebar', $data_sidebar);
		$this->load->view('jasa_jenis/index', $data);
		$this->load->view('template/footer');
	}



	public function add()
	{
		$data_sidebar = [
			'menus' => get_menus()
		];
		$data_topbar = [
			'user' => $this->session->userdata('nama_user'),
			'jasa_jenis' => $this->db->get_where('jasa_jenis', ['id' => $this->session->userdata('id_jasa_jenis')])->row_array(),
		];

		$this->load->view('template/header');
		$this->load->view('template/topbar', $data_topbar);
		$this->load->view('template/sidebar', $data_sidebar);
		$this->load->view('jasa_jenis/add');
		$this->load->view('template/footer');
	}

	public function store()
	{
		$data = array(
			'nama' => $this->input->post('nama'),
		);
		$this->db->insert('jasa_jenis', $data);

		$datasession = array(
			'pesan-notif' => 'Berhasil menambah data jenis Treatment.',
			'icon-notif' => 'success'
		);
		$this->session->set_flashdata($datasession);
		redirect('jasa_jenis');
	}



	public function edit($id)
	{
		$data_sidebar = [
			'menus' => get_menus()
		];
		$data_topbar = [
			'user' => $this->session->userdata('nama_user'),
			'jasa_jenis' => $this->db->get_where('jasa_jenis', ['id' => $this->session->userdata('id_jasa_jenis')])->row_array(),
		];

		$data = [
			'jasa_jenis' => $this->db->get_where('jasa_jenis', ['id' => $id])->row_array()
		];

		$this->load->view('template/header');
		$this->load->view('template/topbar', $data_topbar);
		$this->load->view('template/sidebar', $data_sidebar);
		$this->load->view('jasa_jenis/edit', $data);
		$this->load->view('template/footer');
	}

	public function update()
	{
		$id =  $this->input->post('id');

		$data = array(
			'nama' => $this->input->post('nama'),
		);
		$this->db->where('id', $id);
		$this->db->update('jasa_jenis', $data);

		$datasession = array(
			'pesan-notif' => 'Berhasil update data jenis Treatment.',
			'icon-notif' => 'success'
		);
		$this->session->set_flashdata($datasession);
		redirect('jasa_jenis');
	}



	public function delete($id)
	{
		$where = array('id' => $id);
		$this->db->where($where);
		$this->db->delete('jasa_jenis');

		$datasession = array(
			'pesan-notif' => 'Berhasil menghapus data jenis Treatment.',
			'icon-notif' => 'success'
		);
		$this->session->set_flashdata($datasession);
		redirect('jasa_jenis');
	}
}
