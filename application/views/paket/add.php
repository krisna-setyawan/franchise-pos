<div class="page-wrapper">
	<div class="content">
		<div class="page-header">
			<div class="page-title">
				<h4>Tambah Paket</h4>
			</div>
		</div>

		<div class="card">
			<div class="card-body">
				<form class="row needs-validation" novalidate action="<?= base_url() ?>paket/store" method="post">
					<div class="row">
						<div class="col-md-5">
							<div class="col-lg-12 col-sm-12 col-12">
								<div class="form-group">
									<label>Kode</label>
									<input class="form-control" required id="kode" name="kode" type="text" value="<?= $kode ?>">
								</div>
							</div>
							<div class="col-lg-12 col-sm-12 col-12">
								<div class="form-group">
									<label>Nama Paket</label>
									<input class="form-control" required id="nama" name="nama" type="text">
								</div>
							</div>
							<div class="col-lg-12 col-sm-12 col-12">
								<div class="form-group">
									<label>Harga</label>
									<div class="input-group">
										<span class="input-group-text" style="font-size: 14px;">Rp</span>
										<input class="form-control input-masked" required id="harga" name="harga" type="text">
									</div>
								</div>
							</div>
							<div class="col-lg-12 col-sm-12 col-12">
								<div class="form-group">
									<label>Keterangan</label>
									<textarea name="keterangan" name="keterangan" id="keterangan" style="height: 135px;"></textarea>
								</div>
							</div>
						</div>

						<div class="col-md-7">
							<button type="button" class="btn btn-sm btn-submit p-1 mb-3" onclick="BtnAdd()">Tambah Produk</button>
							<button type="button" class="btn btn-sm btn-submit p-1 mb-3" onclick="BtnAddJasa()">Tambah Treatment</button>


							<div class="table-responsive">
								<table class="table" style="background-color: #FAFBFE;">
									<thead style="background-color: #EEEEEE;">
										<tr>
											<th width="60%">Produk / Jasa</th>
											<th>Qty</th>
											<th>Harga @</th>
											<th width="8%"></th>
										</tr>
									</thead>
									<tbody id="TBody">
										<tr id="TRow_0" class="d-none">
											<td>
												<input autocomplete="off" class="form-control" type="hidden" name="id_produk[]" id="id_produk_0">
												<input readonly autocomplete="off" style="background: #fff;" class="form-control" type="text" name="nama_produk[]" id="nama_produk_0" onclick="select_produk(this)">
											</td>
											<td>
												<input autocomplete="off" class="form-control" type="number" name="qty_produk[]" id="qty_produk_0">
											</td>
											<td>
												<input autocomplete="off" class="form-control text-end bg-white" type="text" name="harga_produk[]" id="harga_produk_0" value="0" readonly="">
											</td>
											<td>
												<a class="delete-set" onclick="BtnDel(this)"><img src="<?= base_url() ?>assets/template/assets/img/icons/delete.svg" alt="svg"></a>
											</td>
										</tr>
										<tr id="TRow_1" class="d-none">
											<td>
												<input autocomplete="off" class="form-control" type="hidden" name="id_jasa[]" id="id_jasa_0">
												<input readonly autocomplete="off" style="background: #fff;" class="form-control" type="text" name="nama_jasa[]" id="nama_jasa_0" onclick="select_jasa(this)">
											</td>
											<td>
												<input autocomplete="off" class="form-control" type="number" name="qty_jasa[]" id="qty_jasa_0">
											</td>
											<td>
												<input autocomplete="off" class="form-control text-end bg-white" type="text" name="harga_jasa[]" id="harga_jasa_0" value="0" readonly="">
											</td>
											<td>
												<a class="delete-set" onclick="BtnDel(this)"><img src="<?= base_url() ?>assets/template/assets/img/icons/delete.svg" alt="svg"></a>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>

					</div>

					<div class="col-lg-12">
						<button href="javascript:void(0);" class="btn btn-submit me-2" type="submit">Simpan</button>
						<a href="<?= base_url() ?>paket" class="btn btn-cancel" type="button">Batal</a>
					</div>
				</form>
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
	var rowCounter = 1;

	function BtnAdd() {
		var v = $("#TRow_0").clone().appendTo("#TBody");
		$(v).find("input").val('');
		$(v).removeClass("d-none");

		// Update ID dan name masing-masing elemen input
		$(v).find("input[name='id_produk[]']").attr('id', 'id_produk_' + rowCounter);
		$(v).find("input[name='nama_produk[]']").attr('id', 'nama_produk_' + rowCounter);
		$(v).find("input[name='harga_produk[]']").attr('id', 'harga_produk_' + rowCounter);
		$(v).find("input[name='harga_produk[]']").val('0');
		$(v).find("input[name='qty_produk[]']").attr('id', 'qty_produk_' + rowCounter);

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
		$(v).find("input[name='harga_jasa[]']").attr('id', 'harga_jasa_' + rowCounter);
		$(v).find("input[name='harga_jasa[]']").val('0');
		$(v).find("input[name='qty_jasa[]']").attr('id', 'qty_jasa_' + rowCounter);

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
		$('#harga_produk_' + row).val(formatToCurrency(formatToNumber(satuan)))
		$('#mymodal').modal('hide');
		$('#qty_produk_' + row).trigger("focus")
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
		$('#harga_jasa_' + row).val(formatToCurrency(formatToNumber(harga)))
		$('#mymodal').modal('hide');
		$('#qty_jasa_' + row).trigger("focus")
	}


	function formatToNumber(stringNumber) {
		// Menghapus pemisah ribuan dan mengembalikan sebagai angka
		return parseInt(stringNumber.replace(/\./g, ''), 10);
	}

	function formatToCurrency(number) {
		// Mengubah angka menjadi format mata uang dengan pemisah ribuan
		return number.toLocaleString('id-ID');
	}
</script>
