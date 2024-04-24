<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penjualan_online extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		is_logged_in();
	}

	public function change_date()
	{
		$tanggal = $this->input->get('tanggal');
		$data = [
			'nomor' => nomor_penjualan_online_auto($tanggal),
		];
		echo json_encode($data);
	}



	public function index()
	{
		date_default_timezone_set('Asia/Jakarta');

		$tgl_awal = $this->input->get('dari');
		$tgl_akhir = $this->input->get('sampai');

		if ($tgl_awal == null) {
			$tanggalAwal = date('Y-m-d');
		} else {
			$tanggalAwal = $tgl_awal;
		}
		if ($tgl_akhir == null) {
			$tanggalAkhir = date('Y-m-d');
		} else {
			$tanggalAkhir = $tgl_akhir;
		}

		$data_sidebar = [
			'menus' => get_menus()
		];
		$data_topbar = [
			'user' => $this->session->userdata('nama_user'),
			'cabang' => $this->db->get_where('cabang', ['id' => $this->session->userdata('id_cabang')])->row_array(),
		];

		$id_cabang = $this->session->userdata('id_cabang');
		$q_penjualan = "SELECT * FROM penjualan_online	WHERE tanggal >= '$tanggalAwal' AND tanggal <= '$tanggalAkhir' AND id_cabang = $id_cabang ORDER BY id DESC";
		$penjualan_online = $this->db->query($q_penjualan)->result();

		$data = [
			'penjualan_online' => $penjualan_online,
			'tgl_awal' => $tanggalAwal,
			'tgl_akhir' => $tanggalAkhir
		];

		$this->load->view('template/header');
		$this->load->view('template/topbar', $data_topbar);
		$this->load->view('template/sidebar', $data_sidebar);
		$this->load->view('penjualan_online/index', $data);
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
			'nomor' => nomor_penjualan_online_auto(date('Y-m-d')),
		];

		$this->load->view('template/header');
		$this->load->view('template/topbar', $data_topbar);
		$this->load->view('template/sidebar', $data_sidebar);
		$this->load->view('penjualan_online/add', $data);
		$this->load->view('template/footer');
	}


	public function store()
	{
		$data = array(
			'id_cabang' => $this->session->userdata('id_cabang'),
			'nomor' => $this->input->post('nomor'),
			'no_penjualan_mp' => $this->input->post('no_penjualan_mp'),
			'tanggal' => $this->input->post('tanggal'),
			'marketplace' => $this->input->post('marketplace'),
			'id_customer' => $this->input->post('id_customer'),
			'total_hg_produk' => str_replace(".", "", $this->input->post('total')),
			'diskon' => str_replace(".", "", $this->input->post('diskon')),
			'grand_total' => str_replace(".", "", $this->input->post('grand_total')),
			'pajak_platform' => str_replace(".", "", $this->input->post('pajak_platform')),
			'ekspedisi' => $this->input->post('ekspedisi'),
			'tgl_kirim' => $this->input->post('tgl_kirim'),
			'bank_transfer' => $this->input->post('bank_transfer'),
			'alamat_kirim' => $this->input->post('alamat_kirim'),
			'catatan' => $this->input->post('catatan'),
		);
		$this->db->insert('penjualan_online', $data);
		$id_penjualan_online = $this->db->insert_id();

		// INSERT PENJUALAN ONLINE DETAIL
		$produk = $this->input->post('id_produk');
		$qty = $this->input->post('qty');
		$satuan = $this->input->post('satuan');
		$diskon_item = $this->input->post('diskon_item');
		$total_list = $this->input->post('total_list');

		if (!empty($produk) && is_array($produk) && !empty($qty) && is_array($qty)) {
			$batch_data = [];

			foreach ($produk as $index => $value) {
				$list_produk = [
					'id_penjualan_online' => $id_penjualan_online,
					'id_produk' => $value,
					'qty' => $qty[$index],
					'satuan' => str_replace(".", "", $satuan[$index]),
					'diskon' => str_replace(".", "", $diskon_item[$index]),
					'total' => str_replace(".", "", $total_list[$index])
				];

				if ($index != 0) {
					$batch_data[] = $list_produk;
				}
			}

			if (!empty($batch_data)) {
				$this->db->insert_batch('penjualan_online_produk', $batch_data);

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
			'pesan-notif' => 'Berhasil membuat penjualan online.',
			'icon-notif' => 'success',
			'penjualan_online' => $this->input->post('nomor')
		);
		$this->session->set_flashdata($datasession);
		redirect('penjualan_online');
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

		$q_penjualan_online = "SELECT penjualan_online.*, customer.nama AS customer FROM penjualan_online
							JOIN customer ON penjualan_online.id_customer = customer.id
							WHERE penjualan_online.nomor = '$nomor'";
		$penjualan_online = $this->db->query($q_penjualan_online)->row_array();
		$id_penjualan_online = $penjualan_online['id'];
		$q_penjualan_online_produk = "SELECT penjualan_online_produk.*, produk.nama AS nama_produk, produk.stok AS stok FROM penjualan_online_produk JOIN produk ON penjualan_online_produk.id_produk = produk.id WHERE penjualan_online_produk.id_penjualan_online = $id_penjualan_online";
		$penjualan_online_produk = $this->db->query($q_penjualan_online_produk)->result();

		$data = [
			'penjualan' => $penjualan_online,
			'penjualan_produk' => $penjualan_online_produk,
		];

		$this->load->view('template/header');
		$this->load->view('template/topbar', $data_topbar);
		$this->load->view('template/sidebar', $data_sidebar);
		$this->load->view('penjualan_online/edit', $data);
		$this->load->view('template/footer');
	}


	public function update()
	{
		$data = array(
			'nomor' => $this->input->post('nomor'),
			'no_penjualan_mp' => $this->input->post('no_penjualan_mp'),
			'tanggal' => $this->input->post('tanggal'),
			'marketplace' => $this->input->post('marketplace'),
			'id_customer' => $this->input->post('id_customer'),
			'total_hg_produk' => str_replace(".", "", $this->input->post('total')),
			'diskon' => str_replace(".", "", $this->input->post('diskon')),
			'grand_total' => str_replace(".", "", $this->input->post('grand_total')),
			'pajak_platform' => str_replace(".", "", $this->input->post('pajak_platform')),
			'ekspedisi' => $this->input->post('ekspedisi'),
			'tgl_kirim' => $this->input->post('tgl_kirim'),
			'bank_transfer' => $this->input->post('bank_transfer'),
			'alamat_kirim' => $this->input->post('alamat_kirim'),
			'catatan' => $this->input->post('catatan'),
		);
		$id_penjualan = $this->input->post('id_penjualan');
		$this->db->where('id', $id_penjualan);
		$this->db->update('penjualan_online', $data);


		// DELETE OLD PENJUALAN PRODUK
		$penjualan_online_produk = $this->db->get_where('penjualan_online_produk', ['id_penjualan_online' => $id_penjualan])->result();
		foreach ($penjualan_online_produk as $detail) {
			$dt_produk = $this->db->get_where('produk', ['id' => $detail->id_produk])->row_array();
			if ($dt_produk) {
				$upd_produk = ['stok' => intval($dt_produk['stok']) + intval($detail->qty)];
				$this->db->update('produk', $upd_produk, ['id' => $detail->id_produk]);
			}
		}
		$this->db->where('id_penjualan_online', $id_penjualan);
		$this->db->delete('penjualan_online_produk');


		// INSERT PENJUALAN PRODUK
		$produk = $this->input->post('id_produk');
		$qty = $this->input->post('qty');
		$satuan = $this->input->post('satuan');
		$diskon_item = $this->input->post('diskon_item');
		$total_list = $this->input->post('total_list');

		if (!empty($produk) && is_array($produk) && !empty($qty) && is_array($qty)) {
			$batch_data = [];

			foreach ($produk as $index => $value) {
				$list_produk = [
					'id_penjualan_online' => $id_penjualan,
					'id_produk' => $value,
					'qty' => $qty[$index],
					'satuan' => str_replace(".", "", $satuan[$index]),
					'diskon' => str_replace(".", "", $diskon_item[$index]),
					'total' => str_replace(".", "", $total_list[$index])
				];

				if ($index != 0) {
					$batch_data[] = $list_produk;
				}
			}

			if (!empty($batch_data)) {
				$this->db->insert_batch('penjualan_online_produk', $batch_data);

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
			'pesan-notif' => 'Berhasil update penjualan online.',
			'icon-notif' => 'success'
		);
		$this->session->set_flashdata($datasession);
		redirect('penjualan_online');
	}



	public function delete($id)
	{
		$penjualan_online_produk = $this->db->get_where('penjualan_online_produk', ['id_penjualan_online' => $id])->result();

		foreach ($penjualan_online_produk as $detail) {
			$dt_produk = $this->db->get_where('produk', ['id' => $detail->id_produk])->row_array();
			if ($dt_produk) {
				$upd_produk = ['stok' => intval($dt_produk['stok']) + intval($detail->qty)];
				$this->db->update('produk', $upd_produk, ['id' => $detail->id_produk]);
			}
		}

		$where = array('id' => $id);
		$this->db->where($where);
		$this->db->delete('penjualan_online');

		$datasession = array(
			'pesan-notif' => 'Berhasil menghapus data penjualan online.',
			'icon-notif' => 'success'
		);
		$this->session->set_flashdata($datasession);
		redirect('penjualan_online');
	}



	public function show($nomor)
	{
		$q_penjualan_online = "SELECT penjualan_online.*, customer.nama AS customer FROM penjualan_online
							JOIN customer ON penjualan_online.id_customer = customer.id
							WHERE penjualan_online.nomor = '$nomor'";
		$penjualan_online = $this->db->query($q_penjualan_online)->row_array();
		$id_penjualan_online = $penjualan_online['id'];
		$q_penjualan_online_produk = "SELECT penjualan_online_produk.*, produk.nama AS nama_produk, produk.stok AS stok FROM penjualan_online_produk JOIN produk ON penjualan_online_produk.id_produk = produk.id WHERE penjualan_online_produk.id_penjualan_online = $id_penjualan_online";
		$penjualan_online_produk = $this->db->query($q_penjualan_online_produk)->result();

		$id_cabang = $this->session->userdata('id_cabang');
		$cabang = $this->db->get_where('cabang', ['id' => $id_cabang])->row_array();

		$data_view = [
			'penjualan' => $penjualan_online,
			'penjualan_produk' => $penjualan_online_produk,
			'cabang' => $cabang,
		];

		$data = [
			'detail' => $this->load->view('penjualan_online/show', $data_view, TRUE),
		];

		echo json_encode($data);
	}



	public function print($nomor)
	{
		$q_penjualan_online = "SELECT penjualan_online.*, customer.nama AS customer FROM penjualan_online
							JOIN customer ON penjualan_online.id_customer = customer.id
							WHERE penjualan_online.nomor = '$nomor'";
		$penjualan_online = $this->db->query($q_penjualan_online)->row_array();
		$id_penjualan_online = $penjualan_online['id'];
		$q_penjualan_online_produk = "SELECT penjualan_online_produk.*, produk.nama AS nama_produk, produk.stok AS stok FROM penjualan_online_produk JOIN produk ON penjualan_online_produk.id_produk = produk.id WHERE penjualan_online_produk.id_penjualan_online = $id_penjualan_online";
		$penjualan_online_produk = $this->db->query($q_penjualan_online_produk)->result();

		$id_cabang = $this->session->userdata('id_cabang');
		$cabang = $this->db->get_where('cabang', ['id' => $id_cabang])->row_array();

		$data_view = [
			'penjualan' => $penjualan_online,
			'penjualan_produk' => $penjualan_online_produk,
			'cabang' => $cabang,
		];

		$this->load->view('penjualan_online/print', $data_view);
	}
}
