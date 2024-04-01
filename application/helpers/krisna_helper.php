<?php

date_default_timezone_set('Asia/Jakarta');

function is_logged_in()
{
	$ci = get_instance();

	if (!$ci->session->userdata('franchise_pos_login')) {
		redirect('zauth');
	}
}

function get_menus()
{
	$ci = get_instance();

	$id_user = $ci->session->userdata('id_user');
	$ci->db->select('user_menu.*');
	$ci->db->from('user_access');
	$ci->db->join('user_menu', 'user_access.id_menu = user_menu.id');
	$ci->db->where('user_access.id_user', $id_user);
	$ci->db->order_by('user_menu.id', 'asc');
	$menus = $ci->db->get()->result_array();

	return $menus;
}



function check_akses($id_menu, $id_user)
{
	$ci = get_instance();

	$ada = $ci->db->get_where('user_access', ['id_user' => $id_user, 'id_menu' => $id_menu]);
	if ($ada->num_rows() > 0) {
		return "checked='checked'";
	}
}







function getKodeCabang($length = 3)
{
	$code = '';

	// Loop hingga kode yang dihasilkan unik
	do {
		$code = generateRandomCodeCabang($length);
	} while (codeExistsInDatabaseCabang($code));

	return 'ASR' . $code;
}

function generateRandomCodeCabang($length)
{
	$code = '';
	for ($i = 0; $i < $length; $i++) {
		$code .= mt_rand(1, 9);
	}
	return $code;
}

function codeExistsInDatabaseCabang($code)
{
	$ci = get_instance();
	$query = $ci->db->get_where('cabang', array('kode' => $code));
	return $query->num_rows() > 0;
}



function getKodeCustomer($length = 5)
{
	$code = '';

	// Loop hingga kode yang dihasilkan unik
	do {
		$code = generateRandomCodeCustomer($length);
	} while (codeExistsInDatabaseCustomer($code));

	return $code;
}

function generateRandomCodeCustomer($length)
{
	$code = '';
	for ($i = 0; $i < $length; $i++) {
		$code .= mt_rand(1, 9);
	}
	return $code;
}

function codeExistsInDatabaseCustomer($code)
{
	$ci = get_instance();
	$query = $ci->db->get_where('customer', array('kode' => $code));
	return $query->num_rows() > 0;
}



function getKodeProduk($length = 6)
{
	$code = '';

	// Loop hingga kode yang dihasilkan unik
	do {
		$code = generateRandomCodeProduk($length);
	} while (codeExistsInDatabaseProduk($code));

	return $code;
}

function generateRandomCodeProduk($length)
{
	$code = '';
	for ($i = 0; $i < $length; $i++) {
		$code .= mt_rand(1, 9);
	}
	return $code;
}

function codeExistsInDatabaseProduk($code)
{
	$ci = get_instance();
	$query = $ci->db->get_where('produk', array('kode' => $code));
	return $query->num_rows() > 0;
}



function getKodeJasa($length = 4)
{
	$code = '';

	// Loop hingga kode yang dihasilkan unik
	do {
		$code = generateRandomCodeJasa($length);
	} while (codeExistsInDatabaseJasa($code));

	return $code;
}

function generateRandomCodeJasa($length)
{
	$code = '';
	for ($i = 0; $i < $length; $i++) {
		$code .= mt_rand(1, 9);
	}
	return $code;
}

function codeExistsInDatabaseJasa($code)
{
	$ci = get_instance();
	$query = $ci->db->get_where('jasa', array('kode' => $code));
	return $query->num_rows() > 0;
}





function get_new_nik()
{
	$ci = get_instance();

	$quer = "SELECT MAX(RIGHT(nik, 3)) AS kode FROM karyawan";
	$query = $ci->db->query($quer)->row_array();

	if ($query && $query['kode'] !== null) {
		$no = (int)$query['kode'] + 1;
		$kd = sprintf("%03s", $no);
	} else {
		$kd = "001";
	}

	$nomor_auto = $kd;

	return $nomor_auto;
}





function getNomorInbound($tgl)
{
	date_default_timezone_set('Asia/Jakarta');

	$ci = get_instance();

	// Ambil bagian tahun dari tanggal
	$tahun = date('Y', strtotime($tgl));

	// Query untuk mendapatkan nomor urut terakhir
	$quer = "SELECT MAX(RIGHT(nomor, 3)) AS kode FROM inbound WHERE YEAR(tanggal) = '$tahun'";
	$query = $ci->db->query($quer)->row_array();

	if ($query && $query['kode'] !== null) {
		// Jika sudah ada nomor urut, tambahkan 1
		$no = (int)$query['kode'] + 1;
		$kd = sprintf("%03s", $no);
	} else {
		// Jika belum ada nomor urut, gunakan nomor urut pertama
		$kd = "001";
	}

	// Format nomor transaksi sesuai dengan keinginan
	$nomor_auto = 'INB-' . $tahun . '-' . $kd;

	return $nomor_auto;
}





function getNomorOutbound($tgl)
{
	date_default_timezone_set('Asia/Jakarta');

	$ci = get_instance();

	// Ambil bagian tahun dari tanggal
	$tahun = date('Y', strtotime($tgl));

	// Query untuk mendapatkan nomor urut terakhir
	$quer = "SELECT MAX(RIGHT(nomor, 3)) AS kode FROM outbound WHERE YEAR(tanggal) = '$tahun'";
	$query = $ci->db->query($quer)->row_array();

	if ($query && $query['kode'] !== null) {
		// Jika sudah ada nomor urut, tambahkan 1
		$no = (int)$query['kode'] + 1;
		$kd = sprintf("%03s", $no);
	} else {
		// Jika belum ada nomor urut, gunakan nomor urut pertama
		$kd = "001";
	}

	// Format nomor transaksi sesuai dengan keinginan
	$nomor_auto = 'OTB-' . $tahun . '-' . $kd;

	return $nomor_auto;
}


// function get_new_id_freelance()
// {
// 	$ci = get_instance();

// 	$quer = "SELECT MAX(RIGHT(id_freelance, 3)) AS kode FROM freelance";
// 	$query = $ci->db->query($quer)->row_array();

// 	if ($query && $query['kode'] !== null) {
// 		$no = (int)$query['kode'] + 1;
// 		$kd = sprintf("%03s", $no);
// 	} else {
// 		$kd = "001";
// 	}

// 	$nomor_auto = 'FR-' . $kd;

// 	return $nomor_auto;
// }


// function get_new_sku()
// {
// 	$ci = get_instance();

// 	$quer = "SELECT MAX(RIGHT(sku, 5)) AS kode FROM barang";
// 	$query = $ci->db->query($quer)->row_array();

// 	if ($query && $query['kode'] !== null) {
// 		$no = (int)$query['kode'] + 1;
// 		$kd = sprintf("%05s", $no);
// 	} else {
// 		$kd = "00001";
// 	}

// 	$nomor_auto = 'BRG-' . $kd;

// 	return $nomor_auto;
// }


// function get_new_id_supplier()
// {
// 	$ci = get_instance();

// 	$quer = "SELECT MAX(RIGHT(id_supplier, 3)) AS kode FROM supplier";
// 	$query = $ci->db->query($quer)->row_array();

// 	if ($query && $query['kode'] !== null) {
// 		$no = (int)$query['kode'] + 1;
// 		$kd = sprintf("%03s", $no);
// 	} else {
// 		$kd = "001";
// 	}

// 	$nomor_auto = 'SUP-' . $kd;

// 	return $nomor_auto;
// }


// function get_new_id_cabang()
// {
// 	$ci = get_instance();

// 	$quer = "SELECT MAX(RIGHT(id_cabang, 3)) AS kode FROM cust_cabang";
// 	$query = $ci->db->query($quer)->row_array();

// 	if ($query && $query['kode'] !== null) {
// 		$no = (int)$query['kode'] + 1;
// 		$kd = sprintf("%03s", $no);
// 	} else {
// 		$kd = "001";
// 	}

// 	$nomor_auto = 'CBG-' . $kd;

// 	return $nomor_auto;
// }


// function get_new_id_reseller()
// {
// 	$ci = get_instance();

// 	$quer = "SELECT MAX(RIGHT(id_reseller, 3)) AS kode FROM cust_reseller";
// 	$query = $ci->db->query($quer)->row_array();

// 	if ($query && $query['kode'] !== null) {
// 		$no = (int)$query['kode'] + 1;
// 		$kd = sprintf("%03s", $no);
// 	} else {
// 		$kd = "001";
// 	}

// 	$nomor_auto = 'RSL-' . $kd;

// 	return $nomor_auto;
// }


// function get_new_id_toko()
// {
// 	$ci = get_instance();

// 	$quer = "SELECT MAX(RIGHT(id_toko, 3)) AS kode FROM cust_toko";
// 	$query = $ci->db->query($quer)->row_array();

// 	if ($query && $query['kode'] !== null) {
// 		$no = (int)$query['kode'] + 1;
// 		$kd = sprintf("%03s", $no);
// 	} else {
// 		$kd = "001";
// 	}

// 	$nomor_auto = 'TKO-' . $kd;

// 	return $nomor_auto;
// }


// function get_new_id_cust_off()
// {
// 	$ci = get_instance();

// 	$quer = "SELECT MAX(RIGHT(kode_cust, 3)) AS kode FROM cust_off";
// 	$query = $ci->db->query($quer)->row_array();

// 	if ($query && $query['kode'] !== null) {
// 		$no = (int)$query['kode'] + 1;
// 		$kd = sprintf("%03s", $no);
// 	} else {
// 		$kd = "001";
// 	}

// 	$nomor_auto = 'COF-' . $kd;

// 	return $nomor_auto;
// }


// function get_new_id_cust_mp()
// {
// 	$ci = get_instance();

// 	$quer = "SELECT MAX(RIGHT(kode_cust, 3)) AS kode FROM cust_mp";
// 	$query = $ci->db->query($quer)->row_array();

// 	if ($query && $query['kode'] !== null) {
// 		$no = (int)$query['kode'] + 1;
// 		$kd = sprintf("%03s", $no);
// 	} else {
// 		$kd = "001";
// 	}

// 	$nomor_auto = 'CMP-' . $kd;

// 	return $nomor_auto;
// }





// function nomor_penjualan_auto($tgl)
// {
// 	date_default_timezone_set('Asia/Jakarta');

// 	$ci = get_instance();

// 	// Ambil bagian tahun dari tanggal
// 	$tahun = date('Y', strtotime($tgl));
// 	$bulan = date('m', strtotime($tgl));
// 	$hari = date('d', strtotime($tgl));


// 	// Query untuk mendapatkan nomor urut terakhir
// 	$quer = "SELECT MAX(RIGHT(nomor, 3)) AS kode FROM penjualan WHERE tanggal = '$tgl'";
// 	$query = $ci->db->query($quer)->row_array();

// 	if ($query && $query['kode'] !== null) {
// 		// Jika sudah ada nomor urut, tambahkan 1
// 		$no = (int)$query['kode'] + 1;
// 		$kd = sprintf("%03s", $no);
// 	} else {
// 		// Jika belum ada nomor urut, gunakan nomor urut pertama
// 		$kd = "001";
// 	}

// 	// Format nomor transaksi sesuai dengan keinginan
// 	$nomor_auto = $tahun . '' . $bulan . '' . $hari . '' . $kd;

// 	return $nomor_auto;
// }



// function nomor_penawaran_auto($tgl)
// {
// 	date_default_timezone_set('Asia/Jakarta');

// 	$ci = get_instance();

// 	// Ambil bagian tahun dari tanggal
// 	$tahun = date('Y', strtotime($tgl));

// 	// Query untuk mendapatkan nomor urut terakhir
// 	$quer = "SELECT MAX(RIGHT(nomor, 4)) AS kode FROM penawaran WHERE YEAR(tanggal) = '$tahun'";
// 	$query = $ci->db->query($quer)->row_array();

// 	if ($query && $query['kode'] !== null) {
// 		// Jika sudah ada nomor urut, tambahkan 1
// 		$no = (int)$query['kode'] + 1;
// 		$kd = sprintf("%04s", $no);
// 	} else {
// 		// Jika belum ada nomor urut, gunakan nomor urut pertama
// 		$kd = "0001";
// 	}

// 	// Format nomor transaksi sesuai dengan keinginan
// 	$nomor_auto = 'OFFER-' . $tahun . '-' . $kd;

// 	return $nomor_auto;
// }


// function nomor_pembelian_auto($tgl)
// {
// 	date_default_timezone_set('Asia/Jakarta');

// 	$ci = get_instance();

// 	// Ambil bagian tahun dari tanggal
// 	$tahun = date('Y', strtotime($tgl));

// 	// Query untuk mendapatkan nomor urut terakhir
// 	$quer = "SELECT MAX(RIGHT(nomor, 4)) AS kode FROM pembelian WHERE YEAR(tanggal) = '$tahun'";
// 	$query = $ci->db->query($quer)->row_array();

// 	if ($query && $query['kode'] !== null) {
// 		// Jika sudah ada nomor urut, tambahkan 1
// 		$no = (int)$query['kode'] + 1;
// 		$kd = sprintf("%04s", $no);
// 	} else {
// 		// Jika belum ada nomor urut, gunakan nomor urut pertama
// 		$kd = "0001";
// 	}

// 	// Format nomor transaksi sesuai dengan keinginan
// 	$nomor_auto = 'PURC-' . $tahun . '-' . $kd;

// 	return $nomor_auto;
// }


// function nomor_produksi_auto($tgl)
// {
// 	date_default_timezone_set('Asia/Jakarta');

// 	$ci = get_instance();

// 	// Ambil bagian tahun dari tanggal
// 	$tahun = date('Y', strtotime($tgl));

// 	// Query untuk mendapatkan nomor urut terakhir
// 	$quer = "SELECT MAX(RIGHT(nomor, 4)) AS kode FROM produksi WHERE YEAR(tanggal) = '$tahun'";
// 	$query = $ci->db->query($quer)->row_array();

// 	if ($query && $query['kode'] !== null) {
// 		// Jika sudah ada nomor urut, tambahkan 1
// 		$no = (int)$query['kode'] + 1;
// 		$kd = sprintf("%04s", $no);
// 	} else {
// 		// Jika belum ada nomor urut, gunakan nomor urut pertama
// 		$kd = "0001";
// 	}

// 	// Format nomor transaksi sesuai dengan keinginan
// 	$nomor_auto = 'MNF-' . $tahun . '-' . $kd;

// 	return $nomor_auto;
// }


// function nomor_stok_opname_auto($tgl)
// {
// 	date_default_timezone_set('Asia/Jakarta');

// 	$ci = get_instance();

// 	// Ambil bagian tahun dari tanggal
// 	$tahun = date('Y', strtotime($tgl));

// 	// Query untuk mendapatkan nomor urut terakhir
// 	$quer = "SELECT MAX(RIGHT(nomor, 4)) AS kode FROM stok_opname WHERE YEAR(tanggal) = '$tahun'";
// 	$query = $ci->db->query($quer)->row_array();

// 	if ($query && $query['kode'] !== null) {
// 		// Jika sudah ada nomor urut, tambahkan 1
// 		$no = (int)$query['kode'] + 1;
// 		$kd = sprintf("%04s", $no);
// 	} else {
// 		// Jika belum ada nomor urut, gunakan nomor urut pertama
// 		$kd = "0001";
// 	}

// 	// Format nomor transaksi sesuai dengan keinginan
// 	$nomor_auto = 'OPM-' . $tahun . '-' . $kd;

// 	return $nomor_auto;
// }
