<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Zprofil extends CI_Controller
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

		$id_user = $this->session->userdata('id_user');
		$q_user = "SELECT karyawan.* FROM karyawan JOIN user ON karyawan.id = user.id_karyawan WHERE user.id = $id_user";
		$data = [
			'user' => $this->db->query($q_user)->row_array(),
		];

		$this->load->view('template/header');
		$this->load->view('template/topbar', $data_topbar);
		$this->load->view('template/sidebar', $data_sidebar);
		$this->load->view('profil/index', $data);
		$this->load->view('template/footer');
	}

	public function updateProfil()
	{
		$id_kry =  $this->input->get('id_kry');

		$data = array(
			'nama' => $this->input->get('nama'),
			'alamat' => $this->input->get('alamat'),
			'telp' => $this->input->get('telp'),
			'kontak_darurat' => $this->input->get('kontak_darurat'),
		);
		$this->db->where('id', $id_kry);
		$this->db->update('karyawan', $data);

		$datasession = array(
			'pesan-notif' => 'Berhasil update data biodata.',
			'icon-notif' => 'success'
		);
		$this->session->set_flashdata($datasession);
		redirect('profil');
	}
}
