<div class="page-wrapper">
	<div class="content">
		<div class="page-header">
			<div class="page-title">
				<h4>Tambah Karyawan</h4>
			</div>
		</div>

		<div class="card">
			<div class="card-body">
				<form class="row needs-validation" novalidate action="<?= base_url() ?>karyawan/store" method="post">
					<div class="col-lg-6 col-sm-6 col-12">
						<div class="form-group">
							<label>NIK</label>
							<input class="form-control" required id="nik" name="nik" type="text" value="<?= $nik ?>">
						</div>
					</div>
					<div class="col-lg-6 col-sm-6 col-12">
						<div class="form-group">
							<label>Cabang</label>
							<select class="select form-control" required id="id_cabang" name="id_cabang">
								<?php foreach ($cabang as $dt) : ?>
									<option value="<?= $dt->id ?>"><?= $dt->nama ?></option>
								<?php endforeach; ?>
							</select>
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
							<label>Jabatan</label>
							<input class="form-control" required id="jabatan" name="jabatan" type="text">
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
							<label>Kontak Darurat</label>
							<input class="form-control" required id="kontak_darurat" name="kontak_darurat" type="text">
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
						<a href="<?= base_url() ?>karyawan" class="btn btn-cancel" type="button">Batal</a>
					</div>
				</form>
			</div>
		</div>

	</div>
</div>
