<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penjualan_outlet extends CI_Controller
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
			'nomor' => nomor_penjualan_outlet_auto($tanggal, $this->session->userdata('id_cabang')),
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
		$q_penjualan = "SELECT penjualan_outlet.*, customer.nama AS customer, customer.kode AS kode_customer FROM penjualan_outlet 
					JOIN customer ON penjualan_outlet.id_customer = customer.id
					WHERE tanggal >= '$tanggalAwal' AND tanggal <= '$tanggalAkhir' AND id_cabang = $id_cabang ORDER BY id DESC";
		$penjualan_outlet = $this->db->query($q_penjualan)->result();

		$data = [
			'penjualan_outlet' => $penjualan_outlet,
			'tgl_awal' => $tanggalAwal,
			'tgl_akhir' => $tanggalAkhir
		];

		$this->load->view('template/header');
		$this->load->view('template/topbar', $data_topbar);
		$this->load->view('template/sidebar', $data_sidebar);
		$this->load->view('penjualan_outlet/index', $data);
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
			'nomor' => nomor_penjualan_outlet_auto(date('Y-m-d'), $this->session->userdata('id_cabang')),
		];

		$this->load->view('template/header');
		$this->load->view('template/topbar', $data_topbar);
		$this->load->view('template/sidebar', $data_sidebar);
		$this->load->view('penjualan_outlet/add', $data);
		$this->load->view('template/footer');
	}


	public function store()
	{
		$data = array(
			'id_cabang' => $this->session->userdata('id_cabang'),
			'id_user' => $this->input->post('id_user'),
			'nomor' => $this->input->post('nomor'),
			'id_customer' => $this->input->post('id_customer'),
			'tanggal' => $this->input->post('tanggal'),
			'jam' => $this->input->post('jam'),
			'total_hg_produk' => str_replace(".", "", $this->input->post('total_hg_produk')),
			'total_hg_jasa' => str_replace(".", "", $this->input->post('total_hg_jasa')),
			'diskon' => str_replace(".", "", $this->input->post('diskon')),
			'grand_total' => str_replace(".", "", $this->input->post('grand_total')),
			'bayar' => str_replace(".", "", $this->input->post('bayar')),
			'kembalian' => str_replace(".", "", $this->input->post('kembalian')),
			'jenis_bayar' => $this->input->post('jenis_bayar'),
			'bank' => $this->input->post('bank'),
			'catatan' => $this->input->post('catatan'),
		);
		$this->db->insert('penjualan_outlet', $data);
		$id_penjualan_outlet = $this->db->insert_id();

		// INSERT PENJUALAN OUTLET PRODUK
		$produk = $this->input->post('id_produk');
		$qty = $this->input->post('qty');
		$satuan = $this->input->post('satuan');
		$diskon_item = $this->input->post('diskon_item');
		$total_list = $this->input->post('total_list');

		if (!empty($produk) && is_array($produk) && !empty($qty) && is_array($qty)) {
			$batch_data_produk = [];

			foreach ($produk as $index => $value) {
				$list_produk = [
					'id_penjualan_outlet' => $id_penjualan_outlet,
					'id_produk' => $value,
					'qty' => $qty[$index],
					'satuan' => str_replace(".", "", $satuan[$index]),
					'diskon' => str_replace(".", "", $diskon_item[$index]),
					'total' => str_replace(".", "", $total_list[$index])
				];

				if ($index != 0) {
					$batch_data_produk[] = $list_produk;
				}
			}

			if (!empty($batch_data_produk)) {
				$this->db->insert_batch('penjualan_outlet_produk', $batch_data_produk);

				foreach ($batch_data_produk as $item) {
					$dt_produk = $this->db->get_where('produk', ['id' => $item['id_produk']])->row_array();
					if ($dt_produk) {
						$upd_produk = ['stok' => intval($dt_produk['stok']) - intval($item['qty'])];
						$this->db->update('produk', $upd_produk, ['id' => $item['id_produk']]);
					}
				}
			}
		}


		// INSERT PENJUALAN OUTLET JASA
		$jasa = $this->input->post('id_jasa');
		$harga = $this->input->post('harga');

		if (!empty($jasa) && is_array($jasa) && !empty($qty) && is_array($qty)) {
			$batch_data_jasa = [];

			foreach ($jasa as $index => $value) {
				$list_jasa = [
					'id_penjualan_outlet' => $id_penjualan_outlet,
					'id_jasa' => $value,
					'harga' => str_replace(".", "", $harga[$index]),
				];

				if ($index != 0) {
					$batch_data_jasa[] = $list_jasa;
				}
			}

			if (!empty($batch_data_jasa)) {
				$this->db->insert_batch('penjualan_outlet_jasa', $batch_data_jasa);
			}
		}


		$datasession = array(
			'pesan-notif' => 'Berhasil membuat penjualan outlet.',
			'icon-notif' => 'success',
			'penjualan_outlet' => $this->input->post('nomor')
		);
		$this->session->set_flashdata($datasession);
		redirect('penjualan_outlet');
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

		$penjualan_outlet = $this->db->get_where('penjualan_outlet', ['nomor' => $nomor])->row_array();
		$id_penjualan_outlet = $penjualan_outlet['id'];
		$q_penjualan_outlet_produk = "SELECT penjualan_outlet_produk.*, produk.nama AS nama_produk, produk.stok AS stok FROM penjualan_outlet_produk JOIN produk ON penjualan_outlet_produk.id_produk = produk.id WHERE penjualan_outlet_produk.id_penjualan_outlet = $id_penjualan_outlet";
		$penjualan_outlet_produk = $this->db->query($q_penjualan_outlet_produk)->result();
		$q_penjualan_outlet_jasa = "SELECT penjualan_outlet_jasa.*, jasa.nama AS nama_jasa FROM penjualan_outlet_jasa JOIN jasa ON penjualan_outlet_jasa.id_jasa = jasa.id WHERE penjualan_outlet_jasa.id_penjualan_outlet = $id_penjualan_outlet";
		$penjualan_outlet_jasa = $this->db->query($q_penjualan_outlet_jasa)->result();

		$data = [
			'penjualan' => $penjualan_outlet,
			'penjualan_produk' => $penjualan_outlet_produk,
			'penjualan_jasa' => $penjualan_outlet_jasa,
		];

		$this->load->view('template/header');
		$this->load->view('template/topbar', $data_topbar);
		$this->load->view('template/sidebar', $data_sidebar);
		$this->load->view('penjualan_outlet/edit', $data);
		$this->load->view('template/footer');
	}


	public function update()
	{
		$data = array(
			'id_cabang' => $this->session->userdata('id_cabang'),
			'id_user' => $this->session->userdata('id_user'),
			'nomor' => $this->input->post('nomor'),
			'id_customer' => $this->input->post('id_customer'),
			'tanggal' => $this->input->post('tanggal'),
			'jam' => $this->input->post('jam'),
			'total_hg_produk' => str_replace(".", "", $this->input->post('total_hg_produk')),
			'total_hg_jasa' => str_replace(".", "", $this->input->post('total_hg_jasa')),
			'diskon' => str_replace(".", "", $this->input->post('diskon')),
			'grand_total' => str_replace(".", "", $this->input->post('grand_total')),
			'bayar' => str_replace(".", "", $this->input->post('bayar')),
			'kembalian' => str_replace(".", "", $this->input->post('kembalian')),
			'jenis_bayar' => $this->input->post('jenis_bayar'),
			'bank' => $this->input->post('bank'),
			'catatan' => $this->input->post('catatan'),
		);
		$id_penjualan = $this->input->post('id_penjualan');
		$this->db->where('id', $id_penjualan);
		$this->db->update('penjualan_outlet', $data);


		// DELETE OLD PENJUALAN PRODUK
		$penjualan_outlet_produk = $this->db->get_where('penjualan_outlet_produk', ['id_penjualan_outlet' => $id_penjualan])->result();
		foreach ($penjualan_outlet_produk as $detail) {
			$dt_produk = $this->db->get_where('produk', ['id' => $detail->id_produk])->row_array();
			if ($dt_produk) {
				$upd_produk = ['stok' => intval($dt_produk['stok']) + intval($detail->qty)];
				$this->db->update('produk', $upd_produk, ['id' => $detail->id_produk]);
			}
		}
		$this->db->where('id_penjualan_outlet', $id_penjualan);
		$this->db->delete('penjualan_outlet_produk');


		// INSERT PENJUALAN OUTLET PRODUK
		$produk = $this->input->post('id_produk');
		$qty = $this->input->post('qty');
		$satuan = $this->input->post('satuan');
		$total_list = $this->input->post('total_list');

		if (!empty($produk) && is_array($produk) && !empty($qty) && is_array($qty)) {
			$batch_data_produk = [];

			foreach ($produk as $index => $value) {
				$list_produk = [
					'id_penjualan_outlet' => $id_penjualan,
					'id_produk' => $value,
					'qty' => $qty[$index],
					'satuan' => str_replace(".", "", $satuan[$index]),
					'total' => str_replace(".", "", $total_list[$index])
				];

				if ($index != 0) {
					$batch_data_produk[] = $list_produk;
				}
			}

			if (!empty($batch_data_produk)) {
				$this->db->insert_batch('penjualan_outlet_produk', $batch_data_produk);

				foreach ($batch_data_produk as $item) {
					$dt_produk = $this->db->get_where('produk', ['id' => $item['id_produk']])->row_array();
					if ($dt_produk) {
						$upd_produk = ['stok' => intval($dt_produk['stok']) - intval($item['qty'])];
						$this->db->update('produk', $upd_produk, ['id' => $item['id_produk']]);
					}
				}
			}
		}


		// DELETE OLD PENJUALAN OUTLET JASA
		$this->db->where('id_penjualan_outlet', $id_penjualan);
		$this->db->delete('penjualan_outlet_jasa');


		// INSERT PENJUALAN OUTLET JASA
		$jasa = $this->input->post('id_jasa');
		$harga = $this->input->post('harga');

		if (!empty($jasa) && is_array($jasa) && !empty($qty) && is_array($qty)) {
			$batch_data_jasa = [];

			foreach ($jasa as $index => $value) {
				$list_jasa = [
					'id_penjualan_outlet' => $id_penjualan,
					'id_jasa' => $value,
					'harga' => str_replace(".", "", $harga[$index]),
				];

				if ($index != 0) {
					$batch_data_jasa[] = $list_jasa;
				}
			}

			if (!empty($batch_data_jasa)) {
				$this->db->insert_batch('penjualan_outlet_jasa', $batch_data_jasa);
			}
		}

		$datasession = array(
			'pesan-notif' => 'Berhasil update penjualan outlet.',
			'icon-notif' => 'success'
		);
		$this->session->set_flashdata($datasession);
		redirect('penjualan_outlet');
	}



	public function delete($id)
	{
		$penjualan_outlet_produk = $this->db->get_where('penjualan_outlet_produk', ['id_penjualan_outlet' => $id])->result();

		foreach ($penjualan_outlet_produk as $detail) {
			$dt_produk = $this->db->get_where('produk', ['id' => $detail->id_produk])->row_array();
			if ($dt_produk) {
				$upd_produk = ['stok' => intval($dt_produk['stok']) + intval($detail->qty)];
				$this->db->update('produk', $upd_produk, ['id' => $detail->id_produk]);
			}
		}

		$where = array('id' => $id);
		$this->db->where($where);
		$this->db->delete('penjualan_outlet');

		$datasession = array(
			'pesan-notif' => 'Berhasil menghapus data penjualan outlet.',
			'icon-notif' => 'success'
		);
		$this->session->set_flashdata($datasession);
		redirect('penjualan_outlet');
	}



	public function show($nomor)
	{
		$q_penjualan_outlet = "SELECT 
									penjualan_outlet.*, 
									customer.nama, customer.kode, customer.alamat, customer.telp, 
									kelurahan.nama AS kelurahan, 
									kecamatan.nama AS kecamatan, 
									kota.nama AS kota, 
									provinsi.nama AS provinsi, 
									user.nama AS user 
								FROM penjualan_outlet
								JOIN customer ON penjualan_outlet.id_customer = customer.id 
								JOIN kelurahan ON customer.id_kelurahan = kelurahan.id 
								JOIN kecamatan ON customer.id_kecamatan = kecamatan.id 
								JOIN kota ON customer.id_kota = kota.id 
								JOIN provinsi ON customer.id_provinsi = provinsi.id 
								JOIN user ON penjualan_outlet.id_user = user.id 
								WHERE penjualan_outlet.nomor = '$nomor'";
		$penjualan_outlet = $this->db->query($q_penjualan_outlet)->row_array();
		$id_penjualan_outlet = $penjualan_outlet['id'];
		$q_penjualan_outlet_produk = "SELECT penjualan_outlet_produk.*, produk.nama AS nama_produk, produk.stok AS stok FROM penjualan_outlet_produk JOIN produk ON penjualan_outlet_produk.id_produk = produk.id WHERE penjualan_outlet_produk.id_penjualan_outlet = $id_penjualan_outlet";
		$penjualan_outlet_produk = $this->db->query($q_penjualan_outlet_produk)->result();
		$q_penjualan_outlet_jasa = "SELECT penjualan_outlet_jasa.*, jasa.nama AS nama_jasa FROM penjualan_outlet_jasa JOIN jasa ON penjualan_outlet_jasa.id_jasa = jasa.id WHERE penjualan_outlet_jasa.id_penjualan_outlet = $id_penjualan_outlet";
		$penjualan_outlet_jasa = $this->db->query($q_penjualan_outlet_jasa)->result();

		$id_cabang = $this->session->userdata('id_cabang');
		$cabang = $this->db->get_where('cabang', ['id' => $id_cabang])->row_array();

		$data_view = [
			'penjualan' => $penjualan_outlet,
			'penjualan_produk' => $penjualan_outlet_produk,
			'penjualan_jasa' => $penjualan_outlet_jasa,
			'cabang' => $cabang,
		];

		$data = [
			'detail' => $this->load->view('penjualan_outlet/show', $data_view, TRUE),
		];

		echo json_encode($data);
	}



	public function print($nomor)
	{
		$q_penjualan_outlet = "SELECT 
									penjualan_outlet.*, 
									customer.nama, customer.kode, customer.alamat, customer.telp, 
									kelurahan.nama AS kelurahan, 
									kecamatan.nama AS kecamatan, 
									kota.nama AS kota, 
									provinsi.nama AS provinsi, 
									user.nama AS user 
								FROM penjualan_outlet
								JOIN customer ON penjualan_outlet.id_customer = customer.id 
								JOIN kelurahan ON customer.id_kelurahan = kelurahan.id 
								JOIN kecamatan ON customer.id_kecamatan = kecamatan.id 
								JOIN kota ON customer.id_kota = kota.id 
								JOIN provinsi ON customer.id_provinsi = provinsi.id 
								JOIN user ON penjualan_outlet.id_user = user.id 
								WHERE penjualan_outlet.nomor = '$nomor'";
		$penjualan_outlet = $this->db->query($q_penjualan_outlet)->row_array();
		$id_penjualan_outlet = $penjualan_outlet['id'];
		$q_penjualan_outlet_produk = "SELECT penjualan_outlet_produk.*, produk.nama AS nama_produk, produk.stok AS stok FROM penjualan_outlet_produk JOIN produk ON penjualan_outlet_produk.id_produk = produk.id WHERE penjualan_outlet_produk.id_penjualan_outlet = $id_penjualan_outlet";
		$penjualan_outlet_produk = $this->db->query($q_penjualan_outlet_produk)->result();
		$q_penjualan_outlet_jasa = "SELECT penjualan_outlet_jasa.*, jasa.nama AS nama_jasa FROM penjualan_outlet_jasa JOIN jasa ON penjualan_outlet_jasa.id_jasa = jasa.id WHERE penjualan_outlet_jasa.id_penjualan_outlet = $id_penjualan_outlet";
		$penjualan_outlet_jasa = $this->db->query($q_penjualan_outlet_jasa)->result();

		$id_cabang = $this->session->userdata('id_cabang');
		$cabang = $this->db->get_where('cabang', ['id' => $id_cabang])->row_array();

		$data_view = [
			'penjualan' => $penjualan_outlet,
			'penjualan_produk' => $penjualan_outlet_produk,
			'penjualan_jasa' => $penjualan_outlet_jasa,
			'cabang' => $cabang,
		];

		$this->load->view('penjualan_outlet/print', $data_view);
	}
}
