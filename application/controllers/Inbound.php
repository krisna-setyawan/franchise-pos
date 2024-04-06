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
			'inbound' => $this->db->get_where('inbound', ['id_cabang' => $this->session->userdata('id_cabang')])->result()
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
			'id_cabang' => $this->session->userdata('id_cabang'),
			'nomor' => $this->input->post('nomor'),
			'tanggal' => $this->input->post('tanggal'),
			'asal' => $this->input->post('asal'),
			'keterangan' => $this->input->post('keterangan'),
		);
		$this->db->insert('inbound', $data);
		$id_inbound = $this->db->insert_id();

		// INSERT INBOUND DETAIL
		$produk = $this->input->post('id_produk');
		$qty = $this->input->post('qty');

		if (!empty($produk) && is_array($produk) && !empty($qty) && is_array($qty)) {
			$batch_data = [];

			foreach ($produk as $index => $value) {
				$list_produk = [
					'id_inbound' => $id_inbound,
					'id_produk' => $value,
					'qty' => $qty[$index],
				];

				if ($index != 0) {
					$batch_data[] = $list_produk;
				}
			}

			if (!empty($batch_data)) {
				$this->db->insert_batch('inbound_detail', $batch_data);

				foreach ($batch_data as $item) {
					$dt_produk = $this->db->get_where('produk', ['id' => $item['id_produk']])->row_array();
					if ($dt_produk) {
						$upd_produk = ['stok' => intval($dt_produk['stok']) + intval($item['qty'])];
						$this->db->update('produk', $upd_produk, ['id' => $item['id_produk']]);
					}
				}
			}
		}


		$datasession = array(
			'pesan-notif' => 'Berhasil menambah data inbound.',
			'icon-notif' => 'success'
		);
		$this->session->set_flashdata($datasession);
		redirect('inbound');
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

		$inbound = $this->db->get_where('inbound', ['nomor' => $nomor])->row_array();
		$id_inbound = $inbound['id'];
		$q_inbound_detail = "SELECT inbound_detail.*, produk.nama AS nama_produk FROM inbound_detail JOIN produk ON inbound_detail.id_produk = produk.id WHERE inbound_detail.id_inbound = $id_inbound";
		$inbound_detail = $this->db->query($q_inbound_detail)->result();

		$data = [
			'inbound' => $inbound,
			'inbound_detail' => $inbound_detail,
		];

		$this->load->view('template/header');
		$this->load->view('template/topbar', $data_topbar);
		$this->load->view('template/sidebar', $data_sidebar);
		$this->load->view('inbound/edit', $data);
		$this->load->view('template/footer');
	}

	public function update()
	{
		$data = array(
			'tanggal' => $this->input->post('tanggal'),
			'asal' => $this->input->post('asal'),
			'keterangan' => $this->input->post('keterangan'),
		);
		$id_inbound = $this->input->post('id_inbound');
		$this->db->where('id', $id_inbound);
		$this->db->update('inbound', $data);


		// DELETE OLD INBOUND DETAIL
		$inbound_detail = $this->db->get_where('inbound_detail', ['id_inbound' => $id_inbound])->result();
		foreach ($inbound_detail as $detail) {
			$dt_produk = $this->db->get_where('produk', ['id' => $detail->id_produk])->row_array();
			if ($dt_produk) {
				$upd_produk = ['stok' => intval($dt_produk['stok']) - intval($detail->qty)];
				$this->db->update('produk', $upd_produk, ['id' => $detail->id_produk]);
			}
		}
		$this->db->where('id_inbound', $id_inbound);
		$this->db->delete('inbound_detail');


		// INSERT INBOUND DETAIL
		$produk = $this->input->post('id_produk');
		$qty = $this->input->post('qty');

		if (!empty($produk) && is_array($produk) && !empty($qty) && is_array($qty)) {
			$batch_data = [];

			foreach ($produk as $index => $value) {
				$list_produk = [
					'id_inbound' => $id_inbound,
					'id_produk' => $value,
					'qty' => $qty[$index],
				];

				if ($index != 0) {
					$batch_data[] = $list_produk;
				}
			}

			if (!empty($batch_data)) {
				$this->db->insert_batch('inbound_detail', $batch_data);

				foreach ($batch_data as $item) {
					$dt_produk = $this->db->get_where('produk', ['id' => $item['id_produk']])->row_array();
					if ($dt_produk) {
						$upd_produk = ['stok' => intval($dt_produk['stok']) + intval($item['qty'])];
						$this->db->update('produk', $upd_produk, ['id' => $item['id_produk']]);
					}
				}
			}
		}

		$datasession = array(
			'pesan-notif' => 'Berhasil update data inbound.',
			'icon-notif' => 'success'
		);
		$this->session->set_flashdata($datasession);
		redirect('inbound');
	}



	public function delete($id)
	{
		$inbound_detail = $this->db->get_where('inbound_detail', ['id_inbound' => $id])->result();

		foreach ($inbound_detail as $detail) {
			$dt_produk = $this->db->get_where('produk', ['id' => $detail->id_produk])->row_array();
			if ($dt_produk) {
				$upd_produk = ['stok' => intval($dt_produk['stok']) - intval($detail->qty)];
				$this->db->update('produk', $upd_produk, ['id' => $detail->id_produk]);
			}
		}

		$where = array('id' => $id);
		$this->db->where($where);
		$this->db->delete('inbound');

		$datasession = array(
			'pesan-notif' => 'Berhasil menghapus data inbound.',
			'icon-notif' => 'success'
		);
		$this->session->set_flashdata($datasession);
		redirect('inbound');
	}



	public function show($nomor)
	{
		$inbound = $this->db->get_where('inbound', ['nomor' => $nomor])->row_array();
		$id_inbound = $inbound['id'];
		$q_inbound_detail = "SELECT inbound_detail.*, produk.nama AS nama_produk FROM inbound_detail JOIN produk ON inbound_detail.id_produk = produk.id WHERE inbound_detail.id_inbound = $id_inbound";
		$inbound_detail = $this->db->query($q_inbound_detail)->result();

		$id_cabang = $this->session->userdata('id_cabang');
		$cabang = $this->db->get_where('cabang', ['id' => $id_cabang])->row_array();

		$data_view = [
			'inbound' => $inbound,
			'inbound_detail' => $inbound_detail,
			'cabang' => $cabang,
		];

		$data = [
			'detail' => $this->load->view('inbound/show', $data_view, TRUE),
		];

		echo json_encode($data);
	}
}
