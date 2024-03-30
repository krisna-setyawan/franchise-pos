<div class="page-wrapper">
	<div class="content">
		<div class="page-header">
			<div class="page-title">
				<h4>Edit Cabang</h4>
			</div>
		</div>

		<div class="card">
			<div class="card-body">
				<form class="row needs-validation" novalidate action="<?= base_url() ?>cabang/update" method="post">
					<input type="hidden" name="kode" value="<?= $cabang['kode'] ?>">
					<div class="col-lg-4 col-sm-6 col-12">
						<div class="form-group">
							<label>Nama</label>
							<input class="form-control" required id="nama" name="nama" type="text" value="<?= $cabang['nama'] ?>">
						</div>
					</div>
					<div class="col-lg-4 col-sm-6 col-12">
						<div class="form-group">
							<label>Telepon</label>
							<input class="form-control" required id="telp" name="telp" type="text" value="<?= $cabang['telp'] ?>">
						</div>
					</div>
					<div class="col-lg-4 col-sm-6 col-12">
						<div class="form-group">
							<label>Jenis</label>
							<select class="select form-control" required id="jenis" name="jenis">
								<option <?= $cabang['jenis'] == '2' ? 'selected' : '' ?> value="2">Cabang</option>
								<option <?= $cabang['jenis'] == '1' ? 'selected' : '' ?> value="1">Pusat</option>
							</select>
						</div>
					</div>
					<div class="col-lg-12 col-12">
						<div class="form-group">
							<label>Alamat</label>
							<input class="form-control" required id="alamat" name="alamat" type="text" value="<?= $cabang['alamat'] ?>">
						</div>
					</div>
					<div class="col-lg-12">
						<button href="javascript:void(0);" class="btn btn-submit me-2" type="submit">Simpan</button>
						<a href="<?= base_url() ?>cabang" class="btn btn-cancel" type="button">Batal</a>
					</div>
				</form>
			</div>
		</div>

	</div>
</div>
