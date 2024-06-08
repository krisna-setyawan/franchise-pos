<div class="page-wrapper">
	<div class="content">
		<div class="page-header">
			<div class="page-title">
				<h4>Edit Penjualan Online</h4>
			</div>
		</div>

		<div class="card">
			<div class="card-body">
				<form autocomplete="off" class="row needs-validation" novalidate action="<?= base_url() ?>penjualan_online/update" method="post" onsubmit="return validateForm()">
					<input type="hidden" name="id_penjualan" value="<?= $penjualan['id'] ?>">
					<div class="col-lg-3 col-sm-6 col-12">
						<div class="form-group">
							<label>Nomor</label>
							<input readonly class="form-control bg-white" id="nomor" name="nomor" type="text" value="<?= $penjualan['nomor'] ?>">
						</div>
					</div>
					<div class="col-lg-3 col-sm-6 col-12">
						<div class="form-group">
							<label>Tanggal</label>
							<input class="form-control" required id="tanggal" name="tanggal" type="text" value="<?= $penjualan['tanggal'] ?>" onchange="ganti_tanggal(this)">
						</div>
					</div>
					<div class="col-lg-3 col-sm-6 col-12">
						<div class="form-group">
							<label>Marketplace</label>
							<select class="select form-control" required id="marketplace" name="marketplace">
								<option <?= $penjualan['marketplace'] == 'Shopee' ? 'selected' : '' ?> value="Shopee">Shopee</option>
								<option <?= $penjualan['marketplace'] == 'Tokopedia' ? 'selected' : '' ?> value="Tokopedia">Tokopedia</option>
								<option <?= $penjualan['marketplace'] == 'Lazada' ? 'selected' : '' ?> value="Lazada">Lazada</option>
								<option <?= $penjualan['marketplace'] == 'Agen' ? 'selected' : '' ?> value="Agen">Agen</option>
								<option <?= $penjualan['marketplace'] == 'Reseller' ? 'selected' : '' ?> value="Reseller">Reseller</option>
								<option <?= $penjualan['marketplace'] == 'Whatsapp' ? 'selected' : '' ?> value="Whatsapp">Whatsapp</option>
							</select>
						</div>
					</div>
					<div class="col-lg-3 col-sm-6 col-12" id="div-bank-transfer" <?= $penjualan['marketplace'] !== 'Whatsapp' ? 'hidden' : '' ?>>
						<div class="form-group">
							<label>Bank Transfer</label>
							<select class="select form-control" id="bank_transfer" name="bank_transfer">
								<option value=""></option>
								<option <?= $penjualan['bank_transfer'] == 'Bank BCA' ? 'selected' : '' ?> value="Bank BCA">Bank BCA</option>
								<option <?= $penjualan['bank_transfer'] == 'Bank BRI' ? 'selected' : '' ?> value="Bank BRI">Bank BRI</option>
								<option <?= $penjualan['bank_transfer'] == 'Bank Mandiri' ? 'selected' : '' ?> value="Bank Mandiri">Bank Mandiri</option>
							</select>
						</div>
					</div>
					<div class="col-lg-3 col-sm-6 col-12" id="div-invoice-marketplace" <?= $penjualan['marketplace'] == 'Whatsapp' ? 'hidden' : '' ?>>
						<div class="form-group">
							<label>Invoice Marketplace</label>
							<input class="form-control" id="no_penjualan_mp" name="no_penjualan_mp" type="text" value="<?= $penjualan['no_penjualan_mp'] ?>">
						</div>
					</div>
					<div class="col-lg-3 col-sm-6 col-12">
						<div class="form-group">
							<label>Customer</label>
							<input id="id_customer" name="id_customer" type="hidden" value="<?= $penjualan['id_customer'] ?>">
							<input required readonly class="form-control bg-white" id="customer" name="customer" type="text" value="<?= $penjualan['customer'] ?>" onclick="select_customer()">
						</div>
					</div>
					<div class="col-lg-3 col-sm-6 col-12">
						<div class="form-group">
							<label>Platform Charge</label>
							<input class="form-control" id="pajak_platform" name="pajak_platform" type="number" required value="<?= $penjualan['pajak_platform'] ?>">
						</div>
					</div>
					<div class="col-lg-3 col-sm-6 col-12">
						<div class="form-group">
							<label>Ekspedisi</label>
							<input class="form-control" id="ekspedisi" name="ekspedisi" type="text" required value="<?= $penjualan['ekspedisi'] ?>">
						</div>
					</div>
					<div class="col-lg-3 col-sm-6 col-12">
						<div class="form-group">
							<label>Tanggal Pengiriman</label>
							<input class="form-control" id="tgl_kirim" name="tgl_kirim" type="text" required value="<?= $penjualan['tgl_kirim'] ?>">
						</div>
					</div>
					<div class="col-lg-6 col-sm-6 col-12">
						<div class="form-group">
							<label>Alamat Kirim</label>
							<input class="form-control" id="alamat_kirim" name="alamat_kirim" type="text" value="<?= $penjualan['alamat_kirim'] ?>">
						</div>
					</div>
					<div class="col-lg-6 col-sm-6 col-12">
						<div class="form-group">
							<label>Catatan</label>
							<input class="form-control" id="catatan" name="catatan" type="text" value="<?= $penjualan['catatan'] ?>">
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
											<input autocomplete="off" class="form-control text-end bg-white" type="text" name="diskon_item[]" id="diskon_item_0" onkeyup="Calc(this);" value="0">
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
												<input autocomplete="off" class="form-control text-end bg-white" type="text" name="diskon_item[]" id="diskon_item_<?= $no_baris ?>" onkeyup="Calc(this);" value="<?= number_format($list->diskon, 0, ',', '.') ?>">
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
										<td colspan="4" class="fs-5 text-dark text-end"><b>Total</b></td>
										<td colspan="1">
											<input autocomplete="off" class="form-control text-end bg-white" type="text" name="total" id="total" value="<?= number_format($penjualan['total_hg_produk'], 0, ',', '.') ?>" readonly="">
										</td>
										<td></td>
									</tr>
									<tr>
										<td colspan="4" class="fs-5 text-dark text-end"><b>Diskon</b></td>
										<td colspan="1">
											<input autocomplete="off" class="form-control text-end bg-white" type="text" name="diskon" id="diskon" required value="<?= number_format($penjualan['diskon'], 0, ',', '.') ?>" onkeyup="GetTotal()">
										</td>
										<td></td>
									</tr>
									<tr>
										<td colspan="4" class="fs-5 text-dark text-end"><b>Grand Total</b></td>
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
						<a href="<?= base_url() ?>penjualan_online" class="btn btn-cancel" type="button">Batal</a>
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
		$('#pajak_platform').mask('000.000.000', {
			reverse: true
		});;
		$("input[name='diskon_item[]']").mask('000.000.000', {
			reverse: true
		});
		$('#marketplace').change(function() {
			if ($(this).val() == 'Whatsapp') {
				$('#div-bank-transfer').attr('hidden', false);
				$('#div-invoice-marketplace').attr('hidden', true);
			} else {
				$('#div-bank-transfer').attr('hidden', true);
				$('#div-invoice-marketplace').attr('hidden', false);
			}
		})

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
			url: '<?= base_url() ?>penjualan_online/change_date',
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
		$(v).find("input[name='diskon_item[]']").attr('id', 'diskon_item_' + rowCounter);
		$(v).find("input[name='diskon_item[]']").val('0');
		$(v).find("input[name='diskon_item[]']").mask('000.000.000', {
			reverse: true
		});
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
		var id_input = v.id;
		var index = id_input.match(/\d+/)[0];

		var qty = $("#qty_" + index).val();
		var satuan = $("#satuan_" + index).val();
		var diskon = $("#diskon_item_" + index).val();

		var total = (formatToNumber(satuan) - formatToNumber(diskon)) * formatToNumber(qty);

		$("#total_list_" + index).val(formatToCurrency(total));

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
		var grandTotalValue = $('#grand_total').val();
		var id_customer = $('#id_customer').val();

		if (id_customer.trim() === '') {
			alert_toastr('error', 'Customer belum dipilih.');
			return false;
		}
		if (grandTotalValue.trim() === '') {
			alert_toastr('error', 'Belum ada list produk yang dijual.');
			return false;
		}

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




	function select_customer() {
		$.ajax({
			type: "GET",
			url: "<?= base_url() ?>customer/selectCustomerForModal",
			dataType: 'JSON',
			success: function(response) {
				$('#modal-body').html(response.table_customer);
				$('#mymodal').modal('show');
			}
		})
	}

	function pilih_customer(id_customer, kode, nama_customer, cabang_register) {
		$('#id_customer').val(id_customer)
		$('#customer').val(nama_customer)
		$('#mymodal').modal('hide');
	}
</script>