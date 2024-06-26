<div class="m-4 mb-5">

	<div class="row mt-4">
		<div class="col-6">
			<strong style="font-size: 20px; margin-bottom: 0px;"><?= $cabang['nama'] ?></strong>
			<p class="mb-2">
				<?= $cabang['alamat'] ?>
				<br> <?= $cabang['telp'] ?>
			</p>
		</div>
		<div class="col-6 text-end">
			<div class="text-muted">Nomor &nbsp; &nbsp;<strong><?= $inbound['nomor'] ?></strong> </div>
			<div class="text-muted">Tanggal &nbsp; &nbsp; &nbsp; <strong><?= $inbound['tanggal'] ?></strong> </div>
		</div>
	</div>


	<table class="table table-sm mt-4" width="100%">
		<thead>
			<tr>
				<th width="90%">Produk</th>
				<th class="text-center" width="10%">Qty</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($inbound_detail as $ls) { ?>
				<tr>
					<td><?= $ls->nama_produk ?></td>
					<td class="text-center"><?= $ls->qty ?></td>
				</tr>
			<?php } ?>
		</tbody>
	</table>
</div>
