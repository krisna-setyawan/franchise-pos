<div class="page-wrapper">
	<div class="content">
		<div class="page-header">
			<div class="page-title">
				<h4>Edit Treatment</h4>
			</div>
		</div>

		<div class="card">
			<div class="card-body">
				<form autocomplete="off" class="row needs-validation" novalidate action="<?= base_url() ?>jasa/update" method="post">

					<input id="kode" name="kode" type="hidden" value="<?= $jasa['kode'] ?>">

					<div class="col-lg-6 col-sm-6 col-12">
						<div class="form-group">
							<label>Nama</label>
							<input class="form-control" required id="nama" name="nama" type="text" value="<?= $jasa['nama'] ?>">
						</div>
					</div>
					<div class="col-lg-6 col-sm-6 col-12">
						<div class="form-group">
							<label>Harga</label>
							<div class="input-group">
								<span class="input-group-text" style="font-size: 14px;">Rp</span>
								<input class="form-control input-masked" required id="harga" name="harga" type="text" value="<?= number_format($jasa['harga'], 0, ',', '.') ?>">
							</div>
						</div>
					</div>
					<div class="col-lg-6 col-sm-6 col-12">
						<div class="form-group">
							<label>Jenis</label>
							<select class="select form-control" required id="id_jenis" name="id_jenis">
								<?php foreach ($jasa_jenis as $dt) : ?>
									<option <?= $jasa['id_jenis'] == $dt->id ? 'selected' : '' ?> value="<?= $dt->id ?>"><?= $dt->nama ?></option>
								<?php endforeach; ?>
							</select>
						</div>
					</div>
					<div class="col-lg-6 col-sm-6 col-12">
						<div class="form-group">
							<label>Keterangan</label>
							<input class="form-control" required id="keterangan" name="keterangan" type="text" value="<?= $jasa['keterangan'] ?>">
						</div>
					</div>
					<div class="col-lg-12">
						<button href="javascript:void(0);" class="btn btn-submit me-2" type="submit">Simpan</button>
						<a href="<?= base_url() ?>jasa" class="btn btn-cancel" type="button">Batal</a>
					</div>
				</form>
			</div>
		</div>

	</div>
</div>
