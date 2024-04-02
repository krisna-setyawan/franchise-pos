<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Outbound extends CI_Controller
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
			'outbound' => $this->db->get('outbound')->result()
		];

		$this->load->view('template/header');
		$this->load->view('template/topbar', $data_topbar);
		$this->load->view('template/sidebar', $data_sidebar);
		$this->load->view('outbound/index', $data);
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
			'nomor' => getNomorOutbound(date('Y-m-d')),
		];

		$this->load->view('template/header');
		$this->load->view('template/topbar', $data_topbar);
		$this->load->view('template/sidebar', $data_sidebar);
		$this->load->view('outbound/add', $data);
		$this->load->view('template/footer');
	}

	public function store()
	{
		$data = array(
			'nomor' => $this->input->post('nomor'),
			'tanggal' => $this->input->post('tanggal'),
			'tujuan' => $this->input->post('tujuan'),
			'keterangan' => $this->input->post('keterangan'),
		);
		$this->db->insert('outbound', $data);
		$id_outbound = $this->db->insert_id();

		// INSERT OUTBOUND DETAIL
		$produk = $this->input->post('id_produk');
		$qty = $this->input->post('qty');

		if (!empty($produk) && is_array($produk) && !empty($qty) && is_array($qty)) {
			$batch_data = [];

			foreach ($produk as $index => $value) {
				$list_produk = [
					'id_outbound' => $id_outbound,
					'id_produk' => $value,
					'qty' => $qty[$index],
				];

				if ($index != 0) {
					$batch_data[] = $list_produk;
				}
			}

			if (!empty($batch_data)) {
				$this->db->insert_batch('outbound_detail', $batch_data);

				foreach ($batch_data as $item) {
					$dt_produk = $this->db->get_where('produk', ['id' => $item['id_produk']])->row_array();
					if ($dt_produk) {
						$upd_produk = ['stok' => intval($dt_produk['stok']) - intval($item['qty'])];
						$this->db->update('produk', $upd_produk, ['id' => $item['id_produk']]);
					}
				}
			}
		}


		$datasession = array(
			'pesan-notif' => 'Berhasil menambah data outbound.',
			'icon-notif' => 'success'
		);
		$this->session->set_flashdata($datasession);
		redirect('outbound');
	}



	public function edit($nomor)
	{
		$data_sidebar = [
			'menus' => get_menus()
		];
		$data_topbar = [
			'user' => $this->session->userdata('nama_user'),
			'cabang' => $this->db->get_where('cabang', ['id' => $this->session->userdata('id_cabang')])->row_array(),
		];

		$outbound = $this->db->get_where('outbound', ['nomor' => $nomor])->row_array();
		$id_outbound = $outbound['id'];
		$q_outbound_detail = "SELECT outbound_detail.*, produk.nama AS nama_produk FROM outbound_detail JOIN produk ON outbound_detail.id_produk = produk.id WHERE outbound_detail.id_outbound = $id_outbound";
		$outbound_detail = $this->db->query($q_outbound_detail)->result();

		$data = [
			'outbound' => $outbound,
			'outbound_detail' => $outbound_detail,
		];

		$this->load->view('template/header');
		$this->load->view('template/topbar', $data_topbar);
		$this->load->view('template/sidebar', $data_sidebar);
		$this->load->view('outbound/edit', $data);
		$this->load->view('template/footer');
	}

	public function update()
	{
		$data = array(
			'tanggal' => $this->input->post('tanggal'),
			'tujuan' => $this->input->post('tujuan'),
			'keterangan' => $this->input->post('keterangan'),
		);
		$id_outbound = $this->input->post('id_outbound');
		$this->db->where('id', $id_outbound);
		$this->db->update('outbound', $data);


		// DELETE OLD OUTBOUND DETAIL
		$outbound_detail = $this->db->get_where('outbound_detail', ['id_outbound' => $id_outbound])->result();
		foreach ($outbound_detail as $detail) {
			$dt_produk = $this->db->get_where('produk', ['id' => $detail->id_produk])->row_array();
			if ($dt_produk) {
				$upd_produk = ['stok' => intval($dt_produk['stok']) + intval($detail->qty)];
				$this->db->update('produk', $upd_produk, ['id' => $detail->id_produk]);
			}
		}
		$this->db->where('id_outbound', $id_outbound);
		$this->db->delete('outbound_detail');


		// INSERT OUTBOUND DETAIL
		$produk = $this->input->post('id_produk');
		$qty = $this->input->post('qty');

		if (!empty($produk) && is_array($produk) && !empty($qty) && is_array($qty)) {
			$batch_data = [];

			foreach ($produk as $index => $value) {
				$list_produk = [
					'id_outbound' => $id_outbound,
					'id_produk' => $value,
					'qty' => $qty[$index],
				];

				if ($index != 0) {
					$batch_data[] = $list_produk;
				}
			}

			if (!empty($batch_data)) {
				$this->db->insert_batch('outbound_detail', $batch_data);

				foreach ($batch_data as $item) {
					$dt_produk = $this->db->get_where('produk', ['id' => $item['id_produk']])->row_array();
					if ($dt_produk) {
						$upd_produk = ['stok' => intval($dt_produk['stok']) - intval($item['qty'])];
						$this->db->update('produk', $upd_produk, ['id' => $item['id_produk']]);
					}
				}
			}
		}

		$datasession = array(
			'pesan-notif' => 'Berhasil update data outbound.',
			'icon-notif' => 'success'
		);
		$this->session->set_flashdata($datasession);
		redirect('outbound');
	}



	public function delete($id)
	{
		$outbound_detail = $this->db->get_where('outbound_detail', ['id_outbound' => $id])->result();

		foreach ($outbound_detail as $detail) {
			$dt_produk = $this->db->get_where('produk', ['id' => $detail->id_produk])->row_array();
			if ($dt_produk) {
				$upd_produk = ['stok' => intval($dt_produk['stok']) + intval($detail->qty)];
				$this->db->update('produk', $upd_produk, ['id' => $detail->id_produk]);
			}
		}

		$where = array('id' => $id);
		$this->db->where($where);
		$this->db->delete('outbound');

		$datasession = array(
			'pesan-notif' => 'Berhasil menghapus data outbound.',
			'icon-notif' => 'success'
		);
		$this->session->set_flashdata($datasession);
		redirect('outbound');
	}



	public function show($nomor)
	{
		$outbound = $this->db->get_where('outbound', ['nomor' => $nomor])->row_array();
		$id_outbound = $outbound['id'];
		$q_outbound_detail = "SELECT outbound_detail.*, produk.nama AS nama_produk FROM outbound_detail JOIN produk ON outbound_detail.id_produk = produk.id WHERE outbound_detail.id_outbound = $id_outbound";
		$outbound_detail = $this->db->query($q_outbound_detail)->result();

		$data_view = [
			'outbound' => $outbound,
			'outbound_detail' => $outbound_detail,
		];

		$data = [
			'detail' => $this->load->view('outbound/show', $data_view, TRUE),
		];

		echo json_encode($data);
	}
}
