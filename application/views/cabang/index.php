<div class="page-wrapper">
	<div class="content">

		<div id="pesan-notif" style="display: none;"><?= json_encode($this->session->flashdata('pesan-notif')) ?></div>
		<div id="icon-notif" style="display: none;"><?= json_encode($this->session->flashdata('icon-notif')) ?></div>

		<div class="page-header">
			<div class="page-title">
				<h4>Data Cabang</h4>
			</div>
			<div class="page-btn">
				<a href="<?= base_url() ?>cabang/add" class="btn btn-added"><img src="<?= base_url() ?>assets/template/assets/img/icons/plus.svg" alt="img">Tambah Cabang</a>
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
					<!-- <div class="wordset">
						<ul>
							<li>
								<a data-bs-toggle="tooltip" data-bs-placement="top" title="pdf"><img src="<?= base_url() ?>assets/template/assets/img/icons/pdf.svg" alt="img"></a>
							</li>
							<li>
								<a data-bs-toggle="tooltip" data-bs-placement="top" title="excel"><img src="<?= base_url() ?>assets/template/assets/img/icons/excel.svg" alt="img"></a>
							</li>
							<li>
								<a data-bs-toggle="tooltip" data-bs-placement="top" title="print"><img src="<?= base_url() ?>assets/template/assets/img/icons/printer.svg" alt="img"></a>
							</li>
						</ul>
					</div> -->
				</div>


				<div class="table-responsive">
					<table class="table datanew">
						<thead>
							<tr class="text-center">
								<th>ID</th>
								<th>Nama</th>
								<th>Telp</th>
								<th>Alamat</th>
								<th>Jenis</th>
								<th width="10%">Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($cabang as $dt) : ?>
								<tr>
									<td><?= $dt->kode ?></td>
									<td>
										<a href="javascript:void(0);"><?= $dt->nama ?></a>
									</td>
									<td><?= $dt->telp ?></td>
									<td><?= $dt->alamat ?></td>
									<td><?= $dt->jenis == '1' ? 'Pusat' : 'Cabang' ?></td>
									<td class="text-center">
										<a class="me-3" href="<?= base_url() ?>cabang/edit/<?= $dt->kode ?>">
											<img src="<?= base_url() ?>assets/template/assets/img/icons/edit.svg" alt="img">
										</a>
										<a class="me-3" href="javascript:void(0);" onclick="confirm_delete('<?= base_url() ?>cabang/delete/<?= $dt->id ?>')">
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
