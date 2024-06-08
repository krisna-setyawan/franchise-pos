<div class="page-wrapper">
	<div class="content">
		<div class="page-header">
			<div class="page-title">
				<h4>Edit Produk</h4>
			</div>
		</div>

		<div class="card">
			<div class="card-body">
				<form autocomplete="off" class="row needs-validation" novalidate action="<?= base_url() ?>produk/update" method="post">

					<div class="row">
						<div class="col-md-6">
							<input id="oldkode" name="oldkode" type="hidden" value="<?= $produk['kode'] ?>">
							<div class="col-lg-12 col-sm-12 col-12">
								<div class="form-group">
									<label>Kode</label>
									<input class="form-control" required id="kode" name="kode" type="text" value="<?= $produk['kode'] ?>">
								</div>
							</div>
							<div class="col-lg-12 col-sm-12 col-12">
								<div class="form-group">
									<label>Nama</label>
									<input class="form-control" required id="nama" name="nama" type="text" value="<?= $produk['nama'] ?>">
								</div>
							</div>
							<div class="col-lg-12 col-sm-12 col-12">
								<div class="form-group">
									<label>Jenis</label>
									<select class="select form-control" required id="id_jenis" name="id_jenis">
										<?php foreach ($produk_jenis as $dt) : ?>
											<option <?= $produk['id_jenis'] == $dt->id ? 'selected' : '' ?> value="<?= $dt->id ?>"><?= $dt->nama ?></option>
										<?php endforeach; ?>
									</select>
								</div>
							</div>
							<div class="col-lg-12 col-sm-12 col-12">
								<div class="form-group">
									<label>Label</label>
									<select class="select form-control" required id="id_label" name="id_label">
										<?php foreach ($produk_label as $dt) : ?>
											<option <?= $produk['id_label'] == $dt->id ? 'selected' : '' ?> value="<?= $dt->id ?>"><?= $dt->nama ?></option>
										<?php endforeach; ?>
									</select>
								</div>
							</div>
							<div class="col-lg-12 col-12">
								<div class="form-group">
									<label>Stok Awal</label>
									<input class="form-control" required id="stok" name="stok" type="text" value="<?= $produk['stok'] ?>">
								</div>
							</div>
							<div class="col-lg-12 col-sm-12 col-12">
								<div class="form-group">
									<label>Keterangan</label>
									<textarea name="keterangan" name="keterangan" id="keterangan" style="height: 135px;"><?= $produk['keterangan'] ?></textarea>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="col-lg-12 col-sm-12 col-12">
								<div class="form-group">
									<label>Harga di outlet</label>
									<div class="input-group">
										<span class="input-group-text" style="font-size: 14px;">Rp</span>
										<input class="form-control input-masked" required id="hg_outlet" name="hg_outlet" type="text" value="<?= $produk['hg_outlet'] ?>">
									</div>
								</div>
							</div>
							<div class="col-lg-12 col-sm-12 col-12">
								<div class="form-group">
									<label>Harga di shopee</label>
									<div class="input-group">
										<span class="input-group-text" style="font-size: 14px;">Rp</span>
										<input class="form-control input-masked" required id="hg_shopee" name="hg_shopee" type="text" value="<?= $produk['hg_shopee'] ?>">
									</div>
								</div>
							</div>
							<div class="col-lg-12 col-sm-12 col-12">
								<div class="form-group">
									<label>Harga di tokopedia</label>
									<div class="input-group">
										<span class="input-group-text" style="font-size: 14px;">Rp</span>
										<input class="form-control input-masked" required id="hg_tokopedia" name="hg_tokopedia" type="text" value="<?= $produk['hg_tokopedia'] ?>">
									</div>
								</div>
							</div>
							<div class="col-lg-12 col-sm-12 col-12">
								<div class="form-group">
									<label>Harga di lazada</label>
									<div class="input-group">
										<span class="input-group-text" style="font-size: 14px;">Rp</span>
										<input class="form-control input-masked" required id="hg_lazada" name="hg_lazada" type="text" value="<?= $produk['hg_lazada'] ?>">
									</div>
								</div>
							</div>
							<div class="col-lg-12 col-sm-12 col-12">
								<div class="form-group">
									<label>Harga Agen</label>
									<div class="input-group">
										<span class="input-group-text" style="font-size: 14px;">Rp</span>
										<input class="form-control input-masked" required id="hg_agen" name="hg_agen" type="text" value="<?= $produk['hg_agen'] ?>">
									</div>
								</div>
							</div>
							<div class="col-lg-12 col-sm-12 col-12">
								<div class="form-group">
									<label>Harga Reseller</label>
									<div class="input-group">
										<span class="input-group-text" style="font-size: 14px;">Rp</span>
										<input class="form-control input-masked" required id="hg_reseller" name="hg_reseller" type="text" value="<?= $produk['hg_reseller'] ?>">
									</div>
								</div>
							</div>
							<div class="col-lg-12 col-sm-12 col-12">
								<div class="form-group">
									<label>Harga di whatsapp</label>
									<div class="input-group">
										<span class="input-group-text" style="font-size: 14px;">Rp</span>
										<input class="form-control input-masked" required id="hg_whatsapp" name="hg_whatsapp" type="text" value="<?= $produk['hg_whatsapp'] ?>">
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