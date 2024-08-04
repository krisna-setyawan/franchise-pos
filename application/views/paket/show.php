<div class="card bg-white">
	<div class="card-body">
		<ul class="list-group mb-4">
			<li class="list-group-item"><b>Nama Paket :</b> <?= $paket['nama'] ?></li>
			<li class="list-group-item"><b>Harga :</b> Rp. <?= number_format($paket['harga'], 0, ',', '.') ?></li>
			<li class="list-group-item"><b>Keterangan :</b> <?= $paket['keterangan'] ?></li>
		</ul>

		<div class="table-responsive mb-4">
			<table class="table table-hover mb-0">
				<thead>
					<tr>
						<th>Produk</th>
						<th width="10%">Qty</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($produk as $dt) { ?>
						<tr>
							<td><?= $dt->nama ?></td>
							<td><?= $dt->qty ?></td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>

		<div class="table-responsive mb-4">
			<table class="table table-hover mb-0">
				<thead>
					<tr>
						<th>Treatment</th>
						<th width="10%">Qty</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($jasa as $dt) { ?>
						<tr>
							<td><?= $dt->nama ?></td>
							<td><?= $dt->qty ?></td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
