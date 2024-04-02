<div class="page-wrapper">
	<div class="content">

		<div class="page-header">
			<div class="page-title">
				<h4>Data Outbound</h4>
			</div>
			<div class="page-btn">
				<a href="<?= base_url() ?>outbound/add" class="btn btn-added"><img src="<?= base_url() ?>assets/template/assets/img/icons/plus.svg" alt="img">Tambah Outbound</a>
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
				</div>


				<div class="table-responsive">
					<table class="table datanew">
						<thead>
							<tr class="text-center">
								<th>Tanggal</th>
								<th>Nomor</th>
								<th>Tujuan</th>
								<th>Keterangan</th>
								<th width="10%">Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($outbound as $dt) : ?>
								<tr>
									<td><?= $dt->tanggal ?></td>
									<td>
										<a onclick="detail('<?= base_url() ?>outbound/show/<?= $dt->nomor ?>', 'Detail Outbound')" href="javascript:void(0);"><?= $dt->nomor ?></a>
									</td>
									<td><?= $dt->tujuan ?></td>
									<td><?= $dt->keterangan ?></td>
									<td class="text-center">
										<a class="me-3" href="<?= base_url() ?>outbound/edit/<?= $dt->nomor ?>">
											<img src="<?= base_url() ?>assets/template/assets/img/icons/edit.svg" alt="img">
										</a>
										<a class="me-3" href="javascript:void(0);" onclick="confirm_delete('<?= base_url() ?>outbound/delete/<?= $dt->id ?>')">
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
