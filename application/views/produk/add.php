<div class="page-wrapper">
	<div class="content">
		<div class="page-header">
			<div class="page-title">
				<h4>Tambah Produk</h4>
			</div>
		</div>

		<div class="card">
			<div class="card-body">
				<form class="row needs-validation" novalidate action="<?= base_url() ?>produk/store" method="post">
					<div class="row">
						<div class="col-md-6">
							<div class="col-lg-12 col-sm-12 col-12">
								<div class="form-group">
									<label>Kode</label>
									<input class="form-control" required id="kode" name="kode" type="text" value="<?= $kode ?>">
								</div>
							</div>
							<div class="col-lg-12 col-sm-12 col-12">
								<div class="form-group">
									<label>Nama</label>
									<input class="form-control" required id="nama" name="nama" type="text">
								</div>
							</div>
							<div class="col-lg-12 col-12">
								<div class="form-group">
									<label>Stok Awal</label>
									<input class="form-control" required id="stok" name="stok" type="text">
								</div>
							</div>
							<div class="col-lg-12 col-sm-12 col-12">
								<div class="form-group">
									<label>Jenis</label>
									<select class="select form-control" required id="id_jenis" name="id_jenis">
										<?php foreach ($produk_jenis as $dt) : ?>
											<option value="<?= $dt->id ?>"><?= $dt->nama ?></option>
										<?php endforeach; ?>
									</select>
								</div>
							</div>
							<div class="col-lg-12 col-sm-12 col-12">
								<div class="form-group">
									<label>Label</label>
									<select class="select form-control" required id="id_label" name="id_label">
										<?php foreach ($produk_label as $dt) : ?>
											<option value="<?= $dt->id ?>"><?= $dt->nama ?></option>
										<?php endforeach; ?>
									</select>
								</div>
							</div>
							<div class="col-lg-12 col-sm-12 col-12">
								<div class="form-group">
									<label>Keterangan</label>
									<textarea name="keterangan" name="keterangan" id="keterangan" style="height: 135px;"></textarea>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="col-lg-12 col-sm-12 col-12">
								<div class="form-group">
									<label>Harga di outlet</label>
									<div class="input-group">
										<span class="input-group-text" style="font-size: 14px;">Rp</span>
										<input class="form-control input-masked" required id="hg_outlet" name="hg_outlet" type="text">
									</div>
								</div>
							</div>
							<div class="col-lg-12 col-sm-12 col-12">
								<div class="form-group">
									<label>Harga di shopee</label>
									<div class="input-group">
										<span class="input-group-text" style="font-size: 14px;">Rp</span>
										<input class="form-control input-masked" required id="hg_shopee" name="hg_shopee" type="text">
									</div>
								</div>
							</div>
							<div class="col-lg-12 col-sm-12 col-12">
								<div class="form-group">
									<label>Harga di tokopedia</label>
									<div class="input-group">
										<span class="input-group-text" style="font-size: 14px;">Rp</span>
										<input class="form-control input-masked" required id="hg_tokopedia" name="hg_tokopedia" type="text">
									</div>
								</div>
							</div>
							<div class="col-lg-12 col-sm-12 col-12">
								<div class="form-group">
									<label>Harga di lazada</label>
									<div class="input-group">
										<span class="input-group-text" style="font-size: 14px;">Rp</span>
										<input class="form-control input-masked" required id="hg_lazada" name="hg_lazada" type="text">
									</div>
								</div>
							</div>
							<div class="col-lg-12 col-sm-12 col-12">
								<div class="form-group">
									<label>Harga di bukalapak</label>
									<div class="input-group">
										<span class="input-group-text" style="font-size: 14px;">Rp</span>
										<input class="form-control input-masked" required id="hg_bukalapak" name="hg_bukalapak" type="text">
									</div>
								</div>
							</div>
							<div class="col-lg-12 col-sm-12 col-12">
								<div class="form-group">
									<label>Harga di blibli</label>
									<div class="input-group">
										<span class="input-group-text" style="font-size: 14px;">Rp</span>
										<input class="form-control input-masked" required id="hg_blibli" name="hg_blibli" type="text">
									</div>
								</div>
							</div>
							<div class="col-lg-12 col-sm-12 col-12">
								<div class="form-group">
									<label>Harga di whatsapp</label>
									<div class="input-group">
										<span class="input-group-text" style="font-size: 14px;">Rp</span>
										<input class="form-control input-masked" required id="hg_whatsapp" name="hg_whatsapp" type="text">
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="col-lg-12">
						<button href="javascript:void(0);" class="btn btn-submit me-2" type="submit">Simpan</button>
						<a href="<?= base_url() ?>produk" class="btn btn-cancel" type="button">Batal</a>
					</div>
				</form>
			</div>
		</div>

	</div>
</div>
