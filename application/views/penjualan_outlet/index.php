<div class="page-wrapper">
	<div class="content">

		<div class="page-header">
			<div class="page-title">
				<h4>Data Penjualan Outlet</h4>
			</div>
			<div class="page-btn">
				<a <?= checkAccess(53) == '0' ? 'hidden' : '' ?> href="<?= base_url() ?>outlet/add" class="btn btn-added"><img src="<?= base_url() ?>assets/template/assets/img/icons/plus.svg" alt="img">Tambah Penjualan</a>
			</div>
		</div>

		<div class="card">
			<div class="card-body">

				<div class="table-top">
					<div class="search-set">
						<div class="search-input">
							<a class="btn btn-searchset"><img src="<?= base_url() ?>assets/template/assets/img/icons/search-white.svg" alt="img"></a>
						</div>
					</div>
					<div class="wordset">
						<form class="input-group" action="<?= base_url() ?>outlet" method="GET">
							<span class="input-group-text bg-light" style="font-size: small; color: grey;">Dari</span>
							<input type="text" class="form-control" id="tgl_awal" name="dari" style="font-size: small; color: grey;" value="<?= $tgl_awal ?>">
							<span class="input-group-text bg-light" style="font-size: small; color: grey;">Sampai</span>
							<input type="text" class="form-control" id="tgl_akhir" name="sampai" style="font-size: small; color: grey;" value="<?= $tgl_akhir ?>">
							<button type="submit" class="btn btn-sm btn-success">Cari</button>
						</form>
					</div>
				</div>

				<div class="row">
					<div class="table-responsive">
						<table class="table datanew" width="100%">
							<thead>
								<tr class="text-center">
									<th width="8%">Tanggal</th>
									<th width="12%">Nomor</th>
									<th width="12%">Customer</th>
									<th width="12%">Total Produk</th>
									<th width="12%">Total Treatment</th>
									<th width="12%">Diskon</th>
									<th width="12%">Grand Total</th>
									<th width="6%">Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($penjualan_outlet as $dt) : ?>
									<tr>
										<td><?= $dt->tanggal ?></td>
										<td>
											<a onclick="detail('<?= base_url() ?>penjualan_outlet/show/<?= $dt->nomor ?>', 'Detail Penjualan')" href="javascript:void(0);"><?= $dt->nomor ?></a>
										</td>
										<td><?= $dt->customer ?> (<?= $dt->kode_customer ?>)</td>
										<td class="text-end px-3"><?= number_format($dt->total_hg_jasa, 0, ',', '.') ?></td>
										<td class="text-end px-3"><?= number_format($dt->total_hg_produk, 0, ',', '.') ?></td>
										<td class="text-end px-3"><?= number_format($dt->diskon, 0, ',', '.') ?></td>
										<td class="text-end px-3"><?= number_format($dt->grand_total, 0, ',', '.') ?></td>
										<td class="text-center">
											<!-- <a <?= checkAccess(54) == '0' ? 'hidden' : '' ?> class="me-3" href="<?= base_url() ?>outlet/edit/<?= $dt->nomor ?>">
												<img src="<?= base_url() ?>assets/template/assets/img/icons/edit.svg" alt="img">
											</a> -->
											<a <?= checkAccess(55) == '0' ? 'hidden' : '' ?> class="me-3" href="javascript:void(0);" onclick="confirm_delete('<?= base_url() ?>penjualan_outlet/delete/<?= $dt->id ?>')">
												<img src="<?= base_url() ?>assets/template/assets/img/icons/delete.svg" alt="img">
											</a>
										</td>
									</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					</div>
				</div>

			</div>
		</div>

	</div>
</div>
