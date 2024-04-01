<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Inbound extends CI_Controller
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
			'inbound' => $this->db->get('inbound')->result()
		];

		$this->load->view('template/header');
		$this->load->view('template/topbar', $data_topbar);
		$this->load->view('template/sidebar', $data_sidebar);
		$this->load->view('inbound/index', $data);
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
			'nomor' => getNomorInbound(date('Y-m-d')),
		];

		$this->load->view('template/header');
		$this->load->view('template/topbar', $data_topbar);
		$this->load->view('template/sidebar', $data_sidebar);
		$this->load->view('inbound/add', $data);
		$this->load->view('template/footer');
	}

	public function store()
	{
		$data = array(
			'nomor' => $this->input->post('nomor'),
			'tanggal' => $this->input->post('tanggal'),
			'asal' => $this->input->post('asal'),
			'keterangan' => $this->input->post('keterangan'),
		);
		$this->db->insert('inbound', $data);
		$id_inbound = $this->db->insert_id();

		$produk = $this->input->post('id_produk');
		foreach ($produk as $index => $value) {
			$list_produk = [
				'id_inbound' => $id_inbound,
				'id_produk' => $value,
				'qty' => $this->input->post('qty')[$index],
			];
			if ($index != 0) {
				$this->db->insert('inbound_detail', $list_produk);
			}
		}

		$datasession = array(
			'pesan-notif' => 'Berhasil menambah data inbound.',
			'icon-notif' => 'success'
		);
		$this->session->set_flashdata($datasession);
		redirect('inbound');
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
			'inbound' => $this->db->get_where('inbound', ['kode' => $kode])->row_array(),
		];

		$this->load->view('template/header');
		$this->load->view('template/topbar', $data_topbar);
		$this->load->view('template/sidebar', $data_sidebar);
		$this->load->view('inbound/edit', $data);
		$this->load->view('template/footer');
	}

	public function update()
	{
		$kode =  $this->input->post('kode');

		$data = array(
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
}
