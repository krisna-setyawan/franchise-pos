<div class="page-wrapper">
	<div class="content">
		<div class="page-header">
			<div class="page-title">
				<h4>Edit Penjualan Outlet</h4>
			</div>
		</div>

		<div class="card">
			<div class="card-body">
				<form autocomplete="off" class="row needs-validation" novalidate action="<?= base_url() ?>penjualan_outlet/update" method="post" onsubmit="return validateForm()">
					<input type="hidden" name="id_penjualan" value="<?= $penjualan['id'] ?>">
					<div class="col-lg-4 col-sm-6 col-12">
						<div class="form-group">
							<label>Nomor</label>
							<input readonly class="form-control bg-white" id="nomor" name="nomor" type="text" value="<?= $penjualan['nomor'] ?>">
						</div>
					</div>
					<div class="col-lg-4 col-sm-6 col-12">
						<div class="form-group">
							<label>Tanggal</label>
							<input class="form-control" required id="tanggal" name="tanggal" type="text" value="<?= $penjualan['tanggal'] ?>" onchange="ganti_tanggal(this)">
						</div>
					</div>
					<div class="col-lg-4 col-sm-6 col-12">
						<div class="form-group">
							<label>Catatan</label>
							<input class="form-control" id="catatan" name="catatan" type="text" value="<?= $penjualan['catatan'] ?>">
						</div>
					</div>
					<div class="col-lg-4 col-sm-6 col-12">
						<div class="form-group">
							<label>Marketplace</label>
							<select class="select form-control" required id="marketplace" name="marketplace">
								<option <?= $penjualan['marketplace'] == 'Shopee' ? 'selected' : '' ?> value="Shopee">Shopee</option>
								<option <?= $penjualan['marketplace'] == 'Tokopedia' ? 'selected' : '' ?> value="Tokopedia">Tokopedia</option>
								<option <?= $penjualan['marketplace'] == 'Lazada' ? 'selected' : '' ?> value="Lazada">Lazada</option>
								<option <?= $penjualan['marketplace'] == 'Bukalapak' ? 'selected' : '' ?> value="Bukalapak">Bukalapak</option>
								<option <?= $penjualan['marketplace'] == 'Blibli' ? 'selected' : '' ?> value="Blibli">Blibli</option>
								<option <?= $penjualan['marketplace'] == 'Marketplace' ? 'selected' : '' ?> value="Marketplace Lain">Marketplace Lain</option>
							</select>
						</div>
					</div>
					<div class="col-lg-4 col-sm-6 col-12">
						<div class="form-group">
							<label>Invoice Marketplace</label>
							<input class="form-control" id="no_penjualan_mp" name="no_penjualan_mp" type="text" value="<?= $penjualan['no_penjualan_mp'] ?>">
						</div>
					</div>
					<div class="col-lg-4 col-sm-6 col-12">
						<div class="form-group">
							<label>Customer</label>
							<input required class="form-control" id="customer" name="customer" type="text" value="<?= $penjualan['customer'] ?>">
						</div>
					</div>

					<div class="mb-5 mt-4">

						<button type="button" class="btn btn-sm btn-submit p-1 mb-3" onclick="BtnAdd()">Tambah Produk</button>

						<div class="table-responsive">
							<table class="table" style="background-color: #FAFBFE;">
								<thead style="background-color: #EEEEEE;">
									<tr>
										<th width="60%">Produk</th>
										<th>Qty</th>
										<th>Satuan</th>
										<th>Diskon</th>
										<th width="12%">Total</th>
										<th width="3%"></th>
									</tr>
								</thead>
								<tbody id="TBody">
									<tr id="TRow_0" class="d-none">
										<td>
											<input autocomplete="off" class="form-control" type="hidden" name="id_produk[]" id="id_produk_0">
											<div class="input-group">
												<input readonly autocomplete="off" style="background: #fff;" class="form-control" type="text" name="nama_produk[]" id="nama_produk_0" onclick="select_produk(this)">
												<span class="input-group-text bg-light" style="color: grey;" id="info_produk_0"></span>
											</div>
										</td>
										<td>
											<input autocomplete="off" class="form-control" type="number" name="qty[]" id="qty_0" onkeyup="Calc(this);">
										</td>
										<td>
											<input autocomplete="off" class="form-control text-end bg-white" type="text" name="satuan[]" id="satuan_0" value="0" readonly="">
										</td>
										<td>
											<input autocomplete="off" class="form-control text-end bg-white" type="text" name="diskon[]" id="diskon_0" onkeyup="Calc(this);" value="0">
										</td>
										<td>
											<input autocomplete="off" class="form-control text-end bg-white" type="text" name="total_list[]" id="total_list_0" value="0" readonly="">
										</td>
										<td>
											<a class="delete-set" onclick="BtnDel(this)"><img src="<?= base_url() ?>assets/template/assets/img/icons/delete.svg" alt="svg"></a>
										</td>
									</tr>



									<?php
									$no = 1;
									foreach ($penjualan_produk as $list) { ?>
										<?php $no_baris = $no++ ?>
										<tr id="TRow_<?= $no_baris ?>">
											<td>
												<input autocomplete="off" class="form-control" type="hidden" name="id_produk[]" id="id_produk_<?= $no_baris ?>" value="<?= $list->id_produk ?>">
												<div class="input-group">
													<input readonly autocomplete="off" style="background: #fff;" class="form-control" type="text" name="nama_produk[]" id="nama_produk_<?= $no_baris ?>" value="<?= $list->nama_produk ?>" onclick="select_produk(this)">
													<span class="input-group-text bg-light" style="color: grey;" id="info_produk_<?= $no_baris ?>">Stok :<?= $list->stok ?></span>
												</div>
											</td>
											<td>
												<input autocomplete="off" class="form-control" type="number" name="qty[]" id="qty_<?= $no_baris ?>" value="<?= $list->qty ?>" onkeyup="Calc(this);">
											</td>
											<td>
												<input autocomplete="off" class="form-control text-end bg-white" type="text" name="satuan[]" id="satuan_<?= $no_baris ?>" value="<?= number_format($list->satuan, 0, ',', '.') ?>" readonly="">
											</td>
											<td>
												<input autocomplete="off" class="form-control text-end bg-white" type="text" name="diskon[]" id="diskon_<?= $no_baris ?>" onkeyup="Calc(this);" value="<?= number_format($list->diskon, 0, ',', '.') ?>">
											</td>
											<td>
												<input autocomplete="off" class="form-control text-end bg-white" type="text" name="total_list[]" id="total_list_<?= $no_baris ?>" value="<?= number_format($list->total, 0, ',', '.') ?>" readonly="">
											</td>
											<td>
												<a class="delete-set" onclick="BtnDel(this)"><img src="<?= base_url() ?>assets/template/assets/img/icons/delete.svg" alt="svg"></a>
											</td>
										</tr>
									<?php } ?>
								</tbody>
								<tbody>
									<tr>
										<td colspan="3" class="fs-5 text-dark text-end"><b>Total</b></td>
										<td colspan="1">
											<input autocomplete="off" class="form-control text-end bg-white" type="text" name="total" id="total" value="<?= number_format($penjualan['total_hg_produk'], 0, ',', '.') ?>" readonly="">
										</td>
										<td></td>
									</tr>
									<tr>
										<td colspan="3" class="fs-5 text-dark text-end"><b>Diskon</b></td>
										<td colspan="1">
											<input autocomplete="off" class="form-control text-end bg-white" type="text" name="diskon" id="diskon" required value="<?= number_format($penjualan['diskon'], 0, ',', '.') ?>" onkeyup="GetTotal()">
										</td>
										<td></td>
									</tr>
									<tr>
										<td colspan="3" class="fs-5 text-dark text-end"><b>Grand Total</b></td>
										<td colspan="1">
											<input autocomplete="off" class="form-control text-end bg-white" type="text" name="grand_total" id="grand_total" readonly value="<?= number_format($penjualan['grand_total'], 0, ',', '.') ?>">
										</td>
										<td></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>


					<div class="col-lg-12">
						<button href="javascript:void(0);" class="btn btn-submit me-2" type="submit">Simpan</button>
						<a href="<?= base_url() ?>penjualan_outlet" class="btn btn-cancel" type="button">Batal</a>
					</div>
				</form>
			</div>
		</div>

	</div>
</div>


</div>

<!-- Modal -->
<div class="modal fade" id="mymodal" tabindex="-1" aria-labelledby="modal-label" aria-hidden="true">
	<div class="modal-dialog modal-dialog-scrollable modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h1 class="modal-title fs-6" id="modal-label">Pilih Produk</h1>
				<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span></button>
			</div>
			<div class="modal-body m-0 p-0" id="modal-body">

			</div>
		</div>
	</div>
</div>



<script>
	$(document).ready(function() {
		$('#diskon').mask('000.000.000', {
			reverse: true
		});;

		$(document).keypress(function(event) {
			var keycode = (event.keyCode ? event.keyCode : event.which);
			if (keycode == '113') { // '113' adalah kode ASCII untuk tombol 'F2'
				BtnAdd();
			}
		})
	})

	function ganti_tanggal(tgl) {
		$.ajax({
			data: 'tanggal=' + tgl.value,
			url: '<?= base_url() ?>penjualan_outlet/change_date',
			method: 'get',
			dataType: 'json',
			success: function(res) {
				$('#nomor').val(res.nomor);
			}
		})
	}


	var rowCounter = $('#TBody tr').length;;

	function BtnAdd() {
		var v = $("#TRow_0").clone().appendTo("#TBody");
		$(v).find("input").val('');
		$(v).removeClass("d-none");
		$(v).find("th").first().html($('#TBody tr').length - 1);

		// Update ID dan name masing-masing elemen input
		$(v).find("input[name='id_produk[]']").attr('id', 'id_produk_' + rowCounter);
		$(v).find("input[name='nama_produk[]']").attr('id', 'nama_produk_' + rowCounter);
		$(v).find("span").attr('id', 'info_produk_' + rowCounter);
		$(v).find("input[name='satuan[]']").attr('id', 'satuan_' + rowCounter);
		$(v).find("input[name='total_list[]']").attr('id', 'total_list_' + rowCounter);
		$(v).find("input[name='qty[]']").attr('id', 'qty_' + rowCounter);

		// Increment rowCounter untuk indeks unik pada baris berikutnya
		rowCounter++;
	}


	function BtnDel(v) {
		$(v).closest('tr').remove(); // Menggunakan closest untuk mencari elemen terdekat dengan tag <tr>
		GetTotal();

		// Mengupdate nomor urut setelah menghapus baris
		$("#TBody").find("tr").each(
			function(index) {
				$(this).find("th").first().html(index); // Menambah 1 karena index dimulai dari 0
			}
		);
		rowCounter--;
	}


	function Calc(v) {
		var index = $(v).closest('tr').index(); // Menggunakan closest untuk mendapatkan elemen terdekat (tr) dan mengambil indexnya.

		var qty = $("input[name='qty[]']").eq(index).val();
		var satuan = $("input[name='satuan[]']").eq(index).val();

		var total = formatToNumber(qty) * formatToNumber(satuan);
		document.getElementsByName("total_list[]")[index].value = formatToCurrency(total); // Menambahkan kurung siku dan mengganti "totla" menjadi "total_list[]"

		GetTotal();
	}






	function GetTotal() {
		var sum = 0;
		var totals = document.getElementsByName("total_list[]");

		for (let index = 0; index < totals.length; index++) {
			var total = formatToNumber(totals[index].value);
			sum = +(sum) + +(total);
		}

		var diskon = document.getElementById("diskon").value;

		document.getElementById("total").value = formatToCurrency(sum);
		document.getElementById("grand_total").value = formatToCurrency(sum - formatToNumber(diskon));
	}



	function validateForm() {
		// Mendapatkan nilai grand_total
		var grandTotalValue = $('#grand_total').val();

		// Jika grand_total kosong
		if (grandTotalValue.trim() === '') {
			// Menampilkan alert
			alert_toastr('error', 'Belum ada list produk yang dijual.');
			// Mengembalikan false agar formulir tidak disubmit
			return false;
		}

		// Jika grand_total tidak kosong
		return true;
	}




	function formatToNumber(stringNumber) {
		// Menghapus pemisah ribuan dan mengembalikan sebagai angka
		return parseInt(stringNumber.replace(/\./g, ''), 10);
	}

	function formatToCurrency(number) {
		// Mengubah angka menjadi format mata uang dengan pemisah ribuan
		return number.toLocaleString('id-ID');
	}





	function select_produk(element) {
		var id_input = element.id;
		var row = id_input.match(/\d+/)[0];

		$.ajax({
			type: "GET",
			url: "<?= base_url() ?>produk/selectProdukForModal",
			data: 'row=' + row,
			dataType: 'JSON',
			success: function(response) {
				$('#modal-body').html(response.table_produk);
				$('#mymodal').modal('show');
			}
		})
	}

	function pilih_produk(id_produk, nama_produk, satuan, stok, row) {
		$('#id_produk_' + row).val(id_produk)
		$('#nama_produk_' + row).val(nama_produk)
		$('#satuan_' + row).val(formatToCurrency(formatToNumber(satuan)))
		$('#info_produk_' + row).html('Stok : <b>' + stok + '</b>');
		$('#mymodal').modal('hide');
		$('#qty_' + row).trigger("focus")
	}
</script>
