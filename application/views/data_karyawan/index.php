<div class="page-wrapper">
	<div class="content">

		<div class="page-header">
			<div class="page-title">
				<h4>Data Karyawan</h4>
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
								<th>NIK</th>
								<th>Nama</th>
								<th>KTP</th>
								<th>Telp</th>
								<th>Alamat</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($karyawan as $dt) : ?>
								<tr>
									<td><?= $dt->nik ?></td>
									<td>
										<a href="javascript:void(0);"><?= $dt->nama ?></a>
									</td>
									<td><?= $dt->ktp ?></td>
									<td><?= $dt->telp ?></td>
									<td><?= $dt->alamat ?></td>
								</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>

			</div>
		</div>

	</div>
</div>