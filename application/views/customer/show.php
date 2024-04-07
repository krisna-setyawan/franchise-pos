<style>
	/* Warna tab saat tidak aktif */
	.nav-tabs-solid .nav-item .nav-link {
		color: #333;
		/* Warna teks */
		background-color: #fff;
		/* Warna latar belakang */
		border-color: #dee2e6;
		/* Warna border */
	}

	/* Warna tab saat aktif */
	.nav-tabs-solid .nav-item .nav-link.active {
		color: #fff;
		/* Warna teks saat aktif */
		background-color: #28a745;
		/* Warna latar belakang saat aktif */
		/* border-color: #28a745; */
		/* Warna border saat aktif */
	}
</style>
<div class="card bg-white">
	<div class="card-body">
		<ul class="nav nav-tabs nav-tabs-solid nav-justified">
			<li class="nav-item"><a class="nav-link fs-6 active" href="#solid-justified-tab1" data-bs-toggle="tab">Riwayat Pembelian</a></li>
			<li class="nav-item"><a class="nav-link fs-6" href="#solid-justified-tab2" data-bs-toggle="tab">Produk & Jasa</a></li>
		</ul>
		<div class="tab-content">
			<div class="tab-pane show active" id="solid-justified-tab1">
				<div class="table-responsive my-4">
					<table class="table table-hover mb-0">
						<thead>
							<tr>
								<th>Tanggal</th>
								<th>Cabang</th>
								<th>Nomor</th>
								<th>Jml Produk</th>
								<th>Jml Jasa</th>
								<th class="text-end">Grand Total</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($riwayat as $dt) { ?>
								<tr>
									<td><?= $dt->tanggal ?></td>
									<td><?= $dt->cabang ?></td>
									<td><?= $dt->nomor ?></td>
									<td><?= $dt->jumlah_produk ?> Item Produk</td>
									<td><?= $dt->jumlah_jasa ?> Jasa</td>
									<td class="text-end">Rp. <?= number_format($dt->grand_total, 0, ',', '.') ?></td>
								</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
			<div class="tab-pane" id="solid-justified-tab2">
				<div class="row my-4">
					<div class="col-6">
						<h5>Produk sering dibeli</h5>
						<div class="table-responsive my-3">
							<table class="table table-hover mb-0">
								<thead>
									<tr>
										<th width="80%">Produk</th>
										<th class="text-center">Grand Total</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($most_produk as $dt) { ?>
										<tr>
											<td><?= $dt->nama ?></td>
											<td class="text-center"><?= $dt->total_qty ?></td>
										</tr>
									<?php } ?>
								</tbody>
							</table>
						</div>
					</div>
					<div class="col-6">
						<h5>Jasa sering digunakan</h5>
						<div class="table-responsive my-3">
							<table class="table table-hover mb-0">
								<thead>
									<tr>
										<th width="80%">Jasa</th>
										<th class="text-center">Grand Total</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($most_jasa as $dt) { ?>
										<tr>
											<td><?= $dt->nama ?></td>
											<td class="text-center"><?= $dt->jumlah_jasa ?></td>
										</tr>
									<?php } ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>