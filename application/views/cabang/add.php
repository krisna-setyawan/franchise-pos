<div class="page-wrapper">
	<div class="content">
		<div class="page-header">
			<div class="page-title">
				<h4>Tambah Cabang</h4>
			</div>
		</div>

		<div class="card">
			<div class="card-body">
				<form class="row needs-validation" novalidate action="<?= base_url() ?>cabang/store" method="post">
					<div class="col-lg-6 col-sm-6 col-12">
						<div class="form-group">
							<label>ID</label>
							<input class="form-control" required id="kode" name="kode" type="text" value="<?= $kode ?>">
						</div>
					</div>
					<div class="col-lg-6 col-sm-6 col-12">
						<div class="form-group">
							<label>Nama</label>
							<input class="form-control" required id="nama" name="nama" type="text">
						</div>
					</div>
					<div class="col-lg-6 col-sm-6 col-12">
						<div class="form-group">
							<label>Telepon</label>
							<input class="form-control" required id="telp" name="telp" type="text">
						</div>
					</div>
					<div class="col-lg-6 col-sm-6 col-12">
						<div class="form-group">
							<label>Jenis</label>
							<select class="select form-control" required id="jenis" name="jenis">
								<option value="2">Cabang</option>
								<option value="1">Pusat</option>
							</select>
						</div>
					</div>
					<div class="col-lg-12 col-12">
						<div class="form-group">
							<label>Alamat</label>
							<input class="form-control" required id="alamat" name="alamat" type="text">
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
