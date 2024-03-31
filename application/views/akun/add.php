<div class="page-wrapper">
	<div class="content">
		<div class="page-header">
			<div class="page-title">
				<h4>Tambah Akun Karyawan</h4>
			</div>
		</div>

		<div class="card">
			<div class="card-body">
				<form class="row needs-validation" novalidate action="<?= base_url() ?>akun/store" method="post">
					<div class="col-lg-4 col-sm-6 col-12">
						<div class="form-group">
							<label>Karyawan</label>
							<select class="select form-control" required id="id_karyawan" name="id_karyawan">
								<?php foreach ($karyawan as $dt) : ?>
									<option value="<?= $dt->id ?>"><?= $dt->nama ?></option>
								<?php endforeach; ?>
							</select>
						</div>
					</div>
					<div class="col-lg-4 col-sm-6 col-12">
						<div class="form-group">
							<label>Username</label>
							<input class="form-control" required id="username" name="username" type="text">
						</div>
					</div>
					<div class="col-lg-4 col-sm-6 col-12">
						<div class="form-group">
							<label>Password</label>
							<input class="form-control" required id="password" name="password" type="text">
						</div>
					</div>
					<div class="col-lg-12 mt-3">
						<button href="javascript:void(0);" class="btn btn-submit me-2" type="submit">Simpan</button>
						<a href="<?= base_url() ?>akun" class="btn btn-cancel" type="button">Batal</a>
					</div>
				</form>
			</div>
		</div>

	</div>
</div>