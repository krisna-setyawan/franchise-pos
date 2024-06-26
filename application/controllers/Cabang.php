<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cabang extends CI_Controller
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
			'cabang' => $this->db->get('cabang')->result()
		];

		$this->load->view('template/header');
		$this->load->view('template/topbar', $data_topbar);
		$this->load->view('template/sidebar', $data_sidebar);
		$this->load->view('cabang/index', $data);
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
			'kode' => getKodeCabang()
		];

		$this->load->view('template/header');
		$this->load->view('template/topbar', $data_topbar);
		$this->load->view('template/sidebar', $data_sidebar);
		$this->load->view('cabang/add', $data);
		$this->load->view('template/footer');
	}

	public function store()
	{
		$data = array(
			'kode' => $this->input->post('kode'),
			'nama' => $this->input->post('nama'),
			'alamat' => $this->input->post('alamat'),
			'telp' => $this->input->post('telp'),
			'jenis' => $this->input->post('jenis'),
		);
		$this->db->insert('cabang', $data);

		$datasession = array(
			'pesan-notif' => 'Berhasil menambah data cabang.',
			'icon-notif' => 'success'
		);
		$this->session->set_flashdata($datasession);
		redirect('cabang');
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
			'cabang' => $this->db->get_where('cabang', ['kode' => $kode])->row_array()
		];

		$this->load->view('template/header');
		$this->load->view('template/topbar', $data_topbar);
		$this->load->view('template/sidebar', $data_sidebar);
		$this->load->view('cabang/edit', $data);
		$this->load->view('template/footer');
	}

	public function update()
	{
		$kode =  $this->input->post('kode');

		$data = array(
			'nama' => $this->input->post('nama'),
			'alamat' => $this->input->post('alamat'),
			'telp' => $this->input->post('telp'),
			'jenis' => $this->input->post('jenis'),
		);
		$this->db->where('kode', $kode);
		$this->db->update('cabang', $data);

		$datasession = array(
			'pesan-notif' => 'Berhasil update data cabang.',
			'icon-notif' => 'success'
		);
		$this->session->set_flashdata($datasession);
		redirect('cabang');
	}



	public function delete($id)
	{
		$where = array('id' => $id);
		$this->db->where($where);
		$this->db->delete('cabang');

		$datasession = array(
			'pesan-notif' => 'Berhasil menghapus data cabang.',
			'icon-notif' => 'success'
		);
		$this->session->set_flashdata($datasession);
		redirect('cabang');
	}
}
