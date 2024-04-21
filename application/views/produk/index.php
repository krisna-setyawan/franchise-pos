<div class="page-wrapper">
	<div class="content">

		<div class="page-header">
			<div class="page-title">
				<h4>Data Produk</h4>
			</div>
			<div class="page-btn">
				<a href="<?= base_url() ?>produk/add" class="btn btn-added"><img src="<?= base_url() ?>assets/template/assets/img/icons/plus.svg" alt="img">Tambah Produk</a>
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
								<th>Kode</th>
								<th>Nama</th>
								<th>Stok</th>
								<th>Jenis</th>
								<th>Label</th>
								<th width="10%">Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($produk as $dt) : ?>
								<tr>
									<td><?= $dt->kode ?></td>
									<td>
										<a href="javascript:void(0);"><?= $dt->nama ?></a>
									</td>
									<td><?= $dt->stok ?></td>
									<td><?= $dt->jenis ?></td>
									<td><?= $dt->label ?></td>
									<td class="text-center">
										<a class="me-3" href="<?= base_url() ?>produk/edit/<?= $dt->kode ?>">
											<img src="<?= base_url() ?>assets/template/assets/img/icons/edit.svg" alt="img">
										</a>
										<a class="me-3" href="javascript:void(0);" onclick="confirm_delete('<?= base_url() ?>produk/delete/<?= $dt->id ?>')">
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
