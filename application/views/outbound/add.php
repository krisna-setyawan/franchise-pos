<div class="page-wrapper">
	<div class="content">
		<div class="page-header">
			<div class="page-title">
				<h4>Tambah Outbound</h4>
			</div>
		</div>

		<div class="card">
			<div class="card-body">
				<form autocomplete="off" class="row needs-validation" novalidate action="<?= base_url() ?>outbound/store" method="post">
					<div class="col-lg-6 col-sm-6 col-12">
						<div class="form-group">
							<label>Nomor</label>
							<input class="form-control" required id="nomor" name="nomor" type="text" value="<?= $nomor ?>">
						</div>
					</div>
					<div class="col-lg-6 col-sm-6 col-12">
						<div class="form-group">
							<label>Tanggal</label>
							<input class="form-control" required id="tanggal" name="tanggal" type="text">
						</div>
					</div>
					<div class="col-lg-6 col-sm-6 col-12">
						<div class="form-group">
							<label>Tujuan</label>
							<input class="form-control" required id="tujuan" name="tujuan" type="text">
						</div>
					</div>
					<div class="col-lg-6 col-sm-6 col-12">
						<div class="form-group">
							<label>Keterangan</label>
							<input class="form-control" required id="keterangan" name="keterangan" type="text">
						</div>
					</div>

					<div class="mb-5 mt-4">

						<button type="button" class="btn btn-sm btn-submit p-1 mb-3" onclick="BtnAdd()">Tambah Produk</button>

						<div class="row">
							<div class="table-responsive">
								<table class="table" style="background-color: #FAFBFE;">
									<thead style="background-color: #EEEEEE;">
										<tr>
											<th width="80%">Produk</th>
											<th>QTY</th>
											<th></th>
										</tr>
									</thead>
									<tbody id="TBody">
										<tr id="TRow_0" class="d-none">
											<td>
												<input autocomplete="off" class="form-control" type="hidden" name="id_produk[]" id="id_produk_0">
												<input readonly autocomplete="off" style="background: #fff;" class="form-control" type="text" name="nama_produk[]" id="nama_produk_0" onclick="select_produk(this)">
											</td>
											<td>
												<input autocomplete="off" class="form-control" type="number" name="qty[]" id="qty_0" onchange="Calc(this);">
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
						<a href="<?= base_url() ?>outbound" class="btn btn-cancel" type="button">Batal</a>
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
	var rowCounter = 1;

	function BtnAdd() {
		/*Add Button*/
		var v = $("#TRow_0").clone().appendTo("#TBody");
		$(v).find("input").val('');
		$(v).removeClass("d-none");
		$(v).find("th").first().html($('#TBody tr').length - 1);

		// Update ID dan name masing-masing elemen input
		$(v).find("input[name='id_produk[]']").attr('id', 'id_produk_' + rowCounter);
		$(v).find("input[name='nama_produk[]']").attr('id', 'nama_produk_' + rowCounter);
		$(v).find("input[name='qty[]']").attr('id', 'qty_' + rowCounter);

		// Increment rowCounter untuk indeks unik pada baris berikutnya
		rowCounter++;
	}


	function BtnDel(v) {
		/*Delete Button*/
		$(v).closest('tr').remove(); // Menggunakan closest untuk mencari elemen terdekat dengan tag <tr>

		// Mengupdate nomor urut setelah menghapus baris
		$("#TBody").find("tr").each(
			function(index) {
				$(this).find("th").first().html(index); // Menambah 1 karena index dimulai dari 0
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
		$('#mymodal').modal('hide');
	}
</script>
