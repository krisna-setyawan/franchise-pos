<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Karyawan extends CI_Controller
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

		$q_kry = "SELECT karyawan.*, cabang.nama AS cabang FROM karyawan JOIN cabang ON karyawan.id_cabang = cabang.id";
		$karyawan = $this->db->query($q_kry)->result();
		$data = [
			'karyawan' => $karyawan,
		];

		$this->load->view('template/header');
		$this->load->view('template/topbar', $data_topbar);
		$this->load->view('template/sidebar', $data_sidebar);
		$this->load->view('karyawan/index', $data);
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
			'nik' => get_new_nik(),
			'cabang' => $this->db->get('cabang')->result()
		];

		$this->load->view('template/header');
		$this->load->view('template/topbar', $data_topbar);
		$this->load->view('template/sidebar', $data_sidebar);
		$this->load->view('karyawan/add', $data);
		$this->load->view('template/footer');
	}

	public function store()
	{
		$data = array(
			'id_cabang' => $this->input->post('id_cabang'),
			'nik' => $this->input->post('nik'),
			'nama' => $this->input->post('nama'),
			'alamat' => $this->input->post('alamat'),
			'telp' => $this->input->post('telp'),
			'kontak_darurat' => $this->input->post('kontak_darurat'),
			'jabatan' => $this->input->post('jabatan'),
		);
		$this->db->insert('karyawan', $data);

		$datasession = array(
			'pesan-notif' => 'Berhasil menambah data karyawan.',
			'icon-notif' => 'success'
		);
		$this->session->set_flashdata($datasession);
		redirect('karyawan');
	}



	public function edit($nik)
	{
		$data_sidebar = [
			'menus' => get_menus()
		];
		$data_topbar = [
			'user' => $this->session->userdata('nama_user'),
			'cabang' => $this->db->get_where('cabang', ['id' => $this->session->userdata('id_cabang')])->row_array(),
		];

		$data = [
			'karyawan' => $this->db->get_where('karyawan', ['nik' => $nik])->row_array(),
			'cabang' => $this->db->get('cabang')->result()
		];

		$this->load->view('template/header');
		$this->load->view('template/topbar', $data_topbar);
		$this->load->view('template/sidebar', $data_sidebar);
		$this->load->view('karyawan/edit', $data);
		$this->load->view('template/footer');
	}

	public function update()
	{
		$nik =  $this->input->post('nik');

		$data = array(
			'id_cabang' => $this->input->post('id_cabang'),
			'nama' => $this->input->post('nama'),
			'alamat' => $this->input->post('alamat'),
			'telp' => $this->input->post('telp'),
			'kontak_darurat' => $this->input->post('kontak_darurat'),
			'kontak_darurat' => $this->input->post('kontak_darurat'),
			'jabatan' => $this->input->post('jabatan'),
		);
		$this->db->where('nik', $nik);
		$this->db->update('karyawan', $data);

		$datasession = array(
			'pesan-notif' => 'Berhasil update data karyawan.',
			'icon-notif' => 'success'
		);
		$this->session->set_flashdata($datasession);
		redirect('karyawan');
	}



	public function delete($id)
	{
		$where = array('id' => $id);
		$this->db->where($where);
		$this->db->delete('karyawan');

		$datasession = array(
			'pesan-notif' => 'Berhasil menghapus data karyawan.',
			'icon-notif' => 'success'
		);
		$this->session->set_flashdata($datasession);
		redirect('karyawan');
	}
}
