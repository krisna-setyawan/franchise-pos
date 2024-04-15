<div class="page-wrapper">
	<div class="content">
		<div class="page-header">
			<div class="page-title">
				<h4>Buat Penjualan Outlet</h4>
			</div>
		</div>

		<div class="card">
			<div class="card-body">
				<form autocomplete="off" class="row needs-validation" novalidate action="<?= base_url() ?>penjualan_outlet/store" method="post" onsubmit="return validateForm()">
					<div class="row">
						<div class="col-sm-5 col-12">
							<div class="row">
								<div class="col-lg-12 col-12">
									<div class="form-group">
										<label>Customer</label>
										<input id="id_customer" name="id_customer" type="hidden">
										<input required readonly class="form-control bg-white" id="customer" name="customer" type="text" onclick="select_customer()">
									</div>
								</div>
								<div class="col-lg-6 col-12">
									<div class="form-group">
										<label>ID Customer</label>
										<input readonly class="form-control bg-white" id="kode_customer" type="text">
									</div>
								</div>
								<div class="col-lg-6 col-12">
									<div class="form-group">
										<label>Cabang Register</label>
										<input readonly class="form-control bg-white" id="cabang_register" type="text">
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-7 col-12">
							<div class="row">
								<div class="col-lg-6 col-12">
									<div class="form-group">
										<label>Nomor</label>
										<input readonly class="form-control bg-white" id="nomor" name="nomor" type="text" value="<?= $nomor ?>">
									</div>
								</div>
								<div class="col-lg-6 col-12">
									<div class="form-group">
										<label>Tanggal</label>
										<input class="form-control" required id="tanggal" name="tanggal" type="text" value="<?= date('Y-m-d') ?>" onchange="ganti_tanggal(this)">
									</div>
								</div>
								<div class="col-lg-12 col-12">
									<div class="form-group">
										<label>Catatan</label>
										<input class="form-control" id="catatan" name="catatan" type="text">
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="mb-5 mt-4">

						<button type="button" class="btn btn-sm btn-submit p-1 mb-3" onclick="BtnAdd()">Tambah Produk</button>
						<button type="button" class="btn btn-sm btn-submit p-1 mb-3" onclick="BtnAddJasa()">Tambah Treatment</button>

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
									<tr id="TRow_1" class="d-none">
										<td colspan="4">
											<input autocomplete="off" class="form-control" type="hidden" name="id_jasa[]" id="id_jasa_0">
											<input readonly autocomplete="off" style="background: #fff;" class="form-control" type="text" name="nama_jasa[]" id="nama_jasa_0" onclick="select_jasa(this)">
										</td>
										<td>
											<input autocomplete="off" class="form-control text-end bg-white" type="text" name="harga[]" id="harga_0" value="0" readonly="">
										</td>
										<td>
											<a class="delete-set" onclick="BtnDel(this)"><img src="<?= base_url() ?>assets/template/assets/img/icons/delete.svg" alt="svg"></a>
										</td>
									</tr>
								</tbody>
								<tbody>
									<tr>
										<td colspan="4" class="fs-5 text-dark text-end"><b>Total Produk</b></td>
										<td>
											<input autocomplete="off" class="form-control text-end bg-white" type="text" name="total_hg_produk" id="total_hg_produk" value="0" readonly="">
										</td>
										<td></td>
									</tr>
									<tr>
										<td colspan="4" class="fs-5 text-dark text-end"><b>Total Treatment</b></td>
										<td>
											<input autocomplete="off" class="form-control text-end bg-white" type="text" name="total_hg_jasa" id="total_hg_jasa" value="0" readonly="">
										</td>
										<td></td>
									</tr>
									<tr>
										<td colspan="4" class="fs-5 text-dark text-end"><b>Produk & Treatment</b></td>
										<td>
											<input autocomplete="off" class="form-control text-end bg-white" type="text" name="total_jasa_produk" id="total_jasa_produk" value="0" readonly="">
										</td>
										<td></td>
									</tr>
									<tr>
										<td colspan="4" class="fs-5 text-dark text-end"><b>Diskon</b></td>
										<td>
											<input autocomplete="off" class="form-control text-end bg-white" type="text" name="diskon" id="diskon" required value="0" onkeyup="GetTotal()">
										</td>
										<td></td>
									</tr>
									<tr>
										<td colspan="4" class="fs-5 text-dark text-end"><b>Grand Total</b></td>
										<td>
											<input autocomplete="off" class="form-control text-end bg-white" type="text" name="grand_total" id="grand_total" readonly>
										</td>
										<td></td>
									</tr>
									<tr>
										<td colspan="4" class="fs-5 text-dark text-end"><b>Jenis Bayar</b></td>
										<td>
											<select class="select form-control" required id="jenis_bayar" name="jenis_bayar" onchange="ganti_jenis_bayar(this)">
												<option value="Cash">Cash</option>
												<option value="Transfer">Transfer</option>
												<option value="Kartu Kredit">Kartu Kredit</option>
											</select>
										</td>
										<td></td>
									</tr>
									<tr id="tr-bayar">
										<td colspan="4" class="fs-5 text-dark text-end"><b>Bayar</b></td>
										<td>
											<input autocomplete="off" class="form-control text-end bg-white" type="text" name="bayar" id="bayar" required onkeyup="hitung_kembalian()" value="0">
										</td>
										<td></td>
									</tr>
									<tr id="tr-kembalian">
										<td colspan="4" class="fs-5 text-dark text-end"><b>Kembalian</b></td>
										<td>
											<input autocomplete="off" class="form-control text-end bg-white" type="text" name="kembalian" id="kembalian" readonly value="0">
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
				<h1 class="modal-title fs-6" id="modal-label"></h1>
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
		});
		$('#bayar').mask('000.000.000', {
			reverse: true
		});
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

	function ganti_jenis_bayar(jenis) {
		if (jenis.value == 'Cash') {
			$('#tr-bayar').attr('hidden', false);
			$('#tr-kembalian').attr('hidden', false);
		} else {
			$('#tr-bayar').attr('hidden', true);
			$('#tr-kembalian').attr('hidden', true);
		}
	}

	function hitung_kembalian() {
		var grand_total = $('#grand_total').val();
		var bayar = $('#bayar').val();

		$('#kembalian').val(formatToCurrency(formatToNumber(bayar) - formatToNumber(grand_total)))
	}


	var rowCounter = 1;

	function BtnAdd() {
		var v = $("#TRow_0").clone().appendTo("#TBody");
		$(v).find("input").val('');
		$(v).removeClass("d-none");

		// Update ID dan name masing-masing elemen input
		$(v).find("input[name='id_produk[]']").attr('id', 'id_produk_' + rowCounter);
		$(v).find("input[name='nama_produk[]']").attr('id', 'nama_produk_' + rowCounter);
		$(v).find("span").attr('id', 'info_produk_' + rowCounter);
		$(v).find("input[name='satuan[]']").attr('id', 'satuan_' + rowCounter);
		$(v).find("input[name='satuan[]']").val('0');
		$(v).find("input[name='diskon_item[]']").attr('id', 'diskon_item_' + rowCounter);
		$(v).find("input[name='diskon_item[]']").val('0');
		$(v).find("input[name='diskon_item[]']").mask('000.000.000', {
			reverse: true
		});
		$(v).find("input[name='total_list[]']").attr('id', 'total_list_' + rowCounter);
		$(v).find("input[name='total_list[]']").val('0');
		$(v).find("input[name='qty[]']").attr('id', 'qty_' + rowCounter);

		// Increment rowCounter untuk indeks unik pada baris berikutnya
		rowCounter++;
	}

	function BtnAddJasa() {
		var v = $("#TRow_1").clone().appendTo("#TBody");
		$(v).find("input").val('');
		$(v).removeClass("d-none");

		// Update ID dan name masing-masing elemen input
		$(v).find("input[name='id_jasa[]']").attr('id', 'id_jasa_' + rowCounter);
		$(v).find("input[name='nama_jasa[]']").attr('id', 'nama_jasa_' + rowCounter);
		$(v).find("input[name='harga[]']").attr('id', 'harga_' + rowCounter);
		$(v).find("input[name='harga[]']").val('0');

		// Increment rowCounter untuk indeks unik pada baris berikutnya
		rowCounter++;
	}


	function BtnDel(v) {
		$(v).closest('tr').remove();
		GetTotal();

		$("#TBody").find("tr").each(
			function(index) {
				$(this).find("th").first().html(index);
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
		var sum_produk = 0;
		var totals = document.getElementsByName("total_list[]");
		for (let index = 0; index < totals.length; index++) {
			var total = formatToNumber(totals[index].value);
			sum_produk = +(sum_produk) + +(total);
		}

		var sum_jasa = 0;
		var hargas = document.getElementsByName("harga[]");
		for (let index = 0; index < hargas.length; index++) {
			var harga = formatToNumber(hargas[index].value);
			sum_jasa = +(sum_jasa) + +(harga);
		}

		var sum_produk_jasa = sum_produk + sum_jasa;

		var diskon = document.getElementById("diskon").value;

		document.getElementById("total_hg_produk").value = formatToCurrency(sum_produk);
		document.getElementById("total_hg_jasa").value = formatToCurrency(sum_jasa);
		document.getElementById("total_jasa_produk").value = formatToCurrency(sum_produk_jasa);
		document.getElementById("grand_total").value = formatToCurrency(sum_produk_jasa - formatToNumber(diskon));
	}



	function validateForm() {
		var grandTotalValue = $('#grand_total').val();
		var customer = $('#customer').val();
		var kembalian = $('#kembalian').val();

		if (customer.trim() === '') {
			alert_toastr('error', 'Customer belum dipilih.');
			return false;
		}
		if (grandTotalValue.trim() === '') {
			alert_toastr('error', 'Belum ada list produk yang dijual.');
			return false;
		}
		if (kembalian.trim() < 0) {
			alert_toastr('error', 'Jumlah bayar tidak benar.');
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




	function select_jasa(element) {
		var id_input = element.id;
		var row = id_input.match(/\d+/)[0];

		$.ajax({
			type: "GET",
			url: "<?= base_url() ?>jasa/selectJasaForModal",
			data: 'row=' + row,
			dataType: 'JSON',
			success: function(response) {
				$('#modal-body').html(response.table_jasa);
				$('#mymodal').modal('show');
			}
		})
	}

	function pilih_jasa(id_jasa, nama_jasa, harga, row) {
		$('#id_jasa_' + row).val(id_jasa)
		$('#nama_jasa_' + row).val(nama_jasa)
		$('#harga_' + row).val(formatToCurrency(formatToNumber(harga)))
		$('#mymodal').modal('hide');
		GetTotal();
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
		$('#kode_customer').val(kode)
		$('#cabang_register').val(cabang_register)
		$('#mymodal').modal('hide');
	}
</script>
