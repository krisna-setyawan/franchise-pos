<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jasa extends CI_Controller
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
		$q_jasa = "SELECT jasa.*, jasa_jenis.nama AS jenis FROM jasa 
					JOIN jasa_jenis ON jasa.id_jenis = jasa_jenis.id 
					WHERE jasa.id_cabang = $id_cabang";
		$data = [
			'jasa' => $this->db->query($q_jasa)->result()
		];

		$this->load->view('template/header');
		$this->load->view('template/topbar', $data_topbar);
		$this->load->view('template/sidebar', $data_sidebar);
		$this->load->view('jasa/index', $data);
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
			'kode' => getKodeJasa(),
			'jasa_jenis' => $this->db->get('jasa_jenis')->result()
		];

		$this->load->view('template/header');
		$this->load->view('template/topbar', $data_topbar);
		$this->load->view('template/sidebar', $data_sidebar);
		$this->load->view('jasa/add', $data);
		$this->load->view('template/footer');
	}

	public function store()
	{
		$data = array(
			'id_cabang' => $this->session->userdata('id_cabang'),
			'id_jenis' => $this->input->post('id_jenis'),
			'kode' => $this->input->post('kode'),
			'nama' => $this->input->post('nama'),
			'harga' => str_replace(".", "", $this->input->post('harga')),
			'keterangan' => $this->input->post('keterangan'),
		);
		$this->db->insert('jasa', $data);

		$datasession = array(
			'pesan-notif' => 'Berhasil menambah data jasa.',
			'icon-notif' => 'success'
		);
		$this->session->set_flashdata($datasession);
		redirect('jasa');
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
			'jasa' => $this->db->get_where('jasa', ['kode' => $kode])->row_array(),
			'jasa_jenis' => $this->db->get('jasa_jenis')->result()
		];

		$this->load->view('template/header');
		$this->load->view('template/topbar', $data_topbar);
		$this->load->view('template/sidebar', $data_sidebar);
		$this->load->view('jasa/edit', $data);
		$this->load->view('template/footer');
	}

	public function update()
	{
		$kode =  $this->input->post('kode');

		$data = array(
			'id_jenis' => $this->input->post('id_jenis'),
			'nama' => $this->input->post('nama'),
			'harga' => str_replace(".", "", $this->input->post('harga')),
			'keterangan' => $this->input->post('keterangan'),
		);
		$this->db->where('kode', $kode);
		$this->db->update('jasa', $data);

		$datasession = array(
			'pesan-notif' => 'Berhasil update data jasa.',
			'icon-notif' => 'success'
		);
		$this->session->set_flashdata($datasession);
		redirect('jasa');
	}



	public function delete($id)
	{
		$where = array('id' => $id);
		$this->db->where($where);
		$this->db->delete('jasa');

		$datasession = array(
			'pesan-notif' => 'Berhasil menghapus data jasa.',
			'icon-notif' => 'success'
		);
		$this->session->set_flashdata($datasession);
		redirect('jasa');
	}
















	public function selectJasaForModal()
	{
		$row = $this->input->get('row');

		$id_cabang = $this->session->userdata('id_cabang');
		$q_jasa = "SELECT jasa.*, jasa_jenis.nama AS jenis FROM jasa 
					JOIN jasa_jenis ON jasa.id_jenis = jasa_jenis.id 
					WHERE jasa.id_cabang = $id_cabang";

		$data_view = [
			'jasa' => $this->db->query($q_jasa)->result(),
			'row' => $row
		];

		$data = [
			'table_jasa' => $this->load->view('jasa/table_modal', $data_view, TRUE),
		];

		echo json_encode($data);
	}
}
