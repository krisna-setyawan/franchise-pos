<div class="page-wrapper">
	<div class="content">

		<div class="page-header">
			<div class="page-title">
				<h4>Data Penjualan Online</h4>
			</div>
			<div class="page-btn">
				<a href="<?= base_url() ?>penjualan_online/add" class="btn btn-added"><img src="<?= base_url() ?>assets/template/assets/img/icons/plus.svg" alt="img">Tambah Penjualan</a>
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
						<form class="input-group" action="<?= base_url() ?>online" method="GET">
							<span class="input-group-text bg-light" style="font-size: small; color: grey;">Dari</span>
							<input type="text" class="form-control" id="tgl_awal" name="dari" style="font-size: small; color: grey;" value="<?= $tgl_awal ?>">
							<span class="input-group-text bg-light" style="font-size: small; color: grey;">Sampai</span>
							<input type="text" class="form-control" id="tgl_akhir" name="sampai" style="font-size: small; color: grey;" value="<?= $tgl_akhir ?>">
							<button type="submit" class="btn btn-sm btn-success">Cari</button>
						</form>
					</div>
				</div>


				<div class="table-responsive">
					<table class="table datanew">
						<thead>
							<tr class="text-center">
								<th>Tanggal</th>
								<th>Nomor</th>
								<th>No MP</th>
								<th>Marketplace</th>
								<th>Total</th>
								<th>Catatan</th>
								<th width="10%">Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($penjualan_online as $dt) : ?>
								<tr>
									<td><?= $dt->tanggal ?></td>
									<td>
										<a onclick="detail('<?= base_url() ?>penjualan_online/show/<?= $dt->nomor ?>', 'Detail Penjualan')" href="javascript:void(0);"><?= $dt->nomor ?></a>
									</td>
									<td><?= $dt->no_penjualan_mp ?></td>
									<td><?= $dt->marketplace ?></td>
									<td><?= $dt->total ?></td>
									<td><?= $dt->catatan ?></td>
									<td class="text-center">
										<a class="me-3" href="<?= base_url() ?>penjualan_online/edit/<?= $dt->nomor ?>">
											<img src="<?= base_url() ?>assets/template/assets/img/icons/edit.svg" alt="img">
										</a>
										<a class="me-3" href="javascript:void(0);" onclick="confirm_delete('<?= base_url() ?>penjualan_online/delete/<?= $dt->id ?>')">
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