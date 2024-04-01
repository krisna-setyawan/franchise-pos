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

					<input id="kode" name="kode" type="hidden" value="<?= $produk['kode'] ?>">

					<div class="col-lg-6 col-sm-6 col-12">
						<div class="form-group">
							<label>Nama</label>
							<input class="form-control" required id="nama" name="nama" type="text" value="<?= $produk['nama'] ?>">
						</div>
					</div>
					<div class="col-lg-6 col-sm-6 col-12">
						<div class="form-group">
							<label>Harga</label>
							<div class="input-group">
								<span class="input-group-text" style="font-size: 14px;">Rp</span>
								<input class="form-control input-masked" required id="harga" name="harga" type="text" value="<?= number_format($produk['harga'], 0, ',', '.') ?>">
							</div>
						</div>
					</div>
					<div class="col-lg-6 col-12">
						<div class="form-group">
							<label>Stok Awal</label>
							<input class="form-control" required id="stok" name="stok" type="text" value="<?= $produk['stok'] ?>">
						</div>
					</div>
					<div class="col-lg-6 col-sm-6 col-12">
						<div class="form-group">
							<label>Keterangan</label>
							<input class="form-control" required id="keterangan" name="keterangan" type="text" value="<?= $produk['keterangan'] ?>">
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
