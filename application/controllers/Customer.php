<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Customer extends CI_Controller
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

		$q_customer = "SELECT customer.*, provinsi.nama as provinsi, kota.nama as kota, kecamatan.nama as kecamatan, kelurahan.nama as kelurahan, cabang.nama as cabang_asal FROM customer
					JOIN provinsi ON customer.id_provinsi = provinsi.id
					JOIN kota ON customer.id_kota = kota.id
					JOIN kecamatan ON customer.id_kecamatan = kecamatan.id
					JOIN kelurahan ON customer.id_kelurahan = kelurahan.id
					JOIN cabang ON customer.cabang_register = cabang.id";
		$data = [
			'customer' => $this->db->query($q_customer)->result()
		];

		$this->load->view('template/header');
		$this->load->view('template/topbar', $data_topbar);
		$this->load->view('template/sidebar', $data_sidebar);
		$this->load->view('customer/index', $data);
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

		$this->db->order_by('nama', 'asc');
		$provinsi = $this->db->get('provinsi')->result();

		$data = [
			'kode' => getKodeCustomer(),
			'provinsi' => $provinsi
		];

		$this->load->view('template/header');
		$this->load->view('template/topbar', $data_topbar);
		$this->load->view('template/sidebar', $data_sidebar);
		$this->load->view('customer/add', $data);
		$this->load->view('template/footer');
	}

	public function store()
	{
		$data = array(
			'kode' => $this->input->post('kode'),
			'nama' => $this->input->post('nama'),
			'id_provinsi' => $this->input->post('id_provinsi'),
			'id_kota' => $this->input->post('id_kota'),
			'id_kecamatan' => $this->input->post('id_kecamatan'),
			'id_kelurahan' => $this->input->post('id_kelurahan'),
			'alamat' => $this->input->post('alamat'),
			'telp' => $this->input->post('telp'),
			'cabang_register' => $this->session->userdata('id_cabang'),
		);
		$this->db->insert('customer', $data);

		$datasession = array(
			'pesan-notif' => 'Berhasil menambah data customer.',
			'icon-notif' => 'success'
		);
		$this->session->set_flashdata($datasession);
		redirect('customer');
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

		$customer = $this->db->get_where('customer', ['kode' => $kode])->row_array();
		$this->db->order_by('nama', 'asc');
		$provinsi = $this->db->get('provinsi')->result();
		$this->db->order_by('nama', 'asc');
		$kota = $this->db->get_where('kota', ['id_provinsi' => $customer['id_provinsi']])->result();
		$this->db->order_by('nama', 'asc');
		$kecamatan = $this->db->get_where('kecamatan', ['id_kota' => $customer['id_kota']])->result();
		$this->db->order_by('nama', 'asc');
		$kelurahan = $this->db->get_where('kelurahan', ['id_kecamatan' => $customer['id_kecamatan']])->result();

		$data = [
			'customer' => $this->db->get_where('customer', ['kode' => $kode])->row_array(),
			'provinsi' => $provinsi,
			'kota' => $kota,
			'kecamatan' => $kecamatan,
			'kelurahan' => $kelurahan,
		];

		$this->load->view('template/header');
		$this->load->view('template/topbar', $data_topbar);
		$this->load->view('template/sidebar', $data_sidebar);
		$this->load->view('customer/edit', $data);
		$this->load->view('template/footer');
	}

	public function update()
	{
		$kode =  $this->input->post('kode');

		$data = array(
			'nama' => $this->input->post('nama'),
			'id_provinsi' => $this->input->post('id_provinsi'),
			'id_kota' => $this->input->post('id_kota'),
			'id_kecamatan' => $this->input->post('id_kecamatan'),
			'id_kelurahan' => $this->input->post('id_kelurahan'),
			'alamat' => $this->input->post('alamat'),
			'telp' => $this->input->post('telp'),
		);
		$this->db->where('kode', $kode);
		$this->db->update('customer', $data);

		$datasession = array(
			'pesan-notif' => 'Berhasil update data customer.',
			'icon-notif' => 'success'
		);
		$this->session->set_flashdata($datasession);
		redirect('customer');
	}



	public function delete($id)
	{
		$where = array('id' => $id);
		$this->db->where($where);
		$this->db->delete('customer');

		$datasession = array(
			'pesan-notif' => 'Berhasil menghapus data customer.',
			'icon-notif' => 'success'
		);
		$this->session->set_flashdata($datasession);
		redirect('customer');
	}



	public function show($id)
	{
		$q_most_produk = "SELECT pop.id_produk, SUM(pop.qty) AS total_qty, p.nama FROM penjualan_outlet_produk pop
						INNER JOIN penjualan_outlet po ON pop.id_penjualan_outlet = po.id
						INNER JOIN produk p ON pop.id_produk = p.id
						INNER JOIN customer c ON po.id_customer = c.id
						WHERE c.id = '$id' GROUP BY pop.id_produk ORDER BY total_qty DESC;";
		$q_most_jasa = "SELECT pop.id_penjualan_outlet, pop.id_jasa, COUNT(pop.id_jasa) AS jumlah_jasa, p.nama FROM penjualan_outlet_jasa pop
						INNER JOIN penjualan_outlet po ON pop.id_penjualan_outlet = po.id
						INNER JOIN jasa p ON pop.id_jasa = p.id
						INNER JOIN customer c ON po.id_customer = c.id
						WHERE c.id = '$id' GROUP BY pop.id_jasa ORDER BY jumlah_jasa DESC;";
		$q_riwayat = "SELECT po.tanggal AS tanggal,COUNT(pop.id_produk) AS jumlah_produk, COUNT(poj.id) AS jumlah_jasa, po.grand_total, po.nomor, c.nama AS cabang FROM penjualan_outlet po
						LEFT JOIN penjualan_outlet_produk pop ON po.id = pop.id_penjualan_outlet
						LEFT JOIN penjualan_outlet_jasa poj ON po.id = poj.id_penjualan_outlet
						LEFT JOIN cabang c ON po.id_cabang = c.id
						WHERE po.id_customer = '$id' GROUP BY po.id ORDER BY po.tanggal DESC;";

		$data_view = [
			'most_produk' => $this->db->query($q_most_produk)->result(),
			'most_jasa' => $this->db->query($q_most_jasa)->result(),
			'riwayat' => $this->db->query($q_riwayat)->result(),
		];

		$data = [
			'detail' => $this->load->view('customer/show', $data_view, TRUE),
		];

		echo json_encode($data);
	}
















	public function selectCustomerForModal()
	{
		$q_customer = "SELECT customer.*, cabang.nama AS cabang FROM customer JOIN cabang ON customer.cabang_register = cabang.id";
		$data_view = [
			'customer' => $this->db->query($q_customer)->result(),
		];

		$data = [
			'table_customer' => $this->load->view('customer/table_modal', $data_view, TRUE),
		];

		echo json_encode($data);
	}
}
