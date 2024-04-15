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
			<div class="text-muted">Customer</div>
			<strong><?= $penjualan['marketplace'] ?></strong> <br>
			<strong><?= $penjualan['no_penjualan_mp'] ?></strong> <br>
			<strong><?= $penjualan['customer'] ?></strong>
		</div>
	</div>

	<div class="row mt-1">
		<div class="col-12">
			<table>
				<tr>
					<td class="text-muted fw-bold">Nomor&nbsp; &nbsp; &nbsp;</td>
					<td class="text-muted"><?= $penjualan['nomor'] ?></td>
				</tr>
				<tr>
					<td class="text-muted fw-bold">Tanggal&nbsp; &nbsp; &nbsp;</td>
					<td class="text-muted"><?= $penjualan['tanggal'] ?></td>
				</tr>
				<tr>
					<td class="text-muted fw-bold">Pengiriman&nbsp; &nbsp; &nbsp;</td>
					<td class="text-muted"><?= $penjualan['ekspedisi'] ?> - <?= $penjualan['tgl_kirim'] ?></td>
				</tr>
			</table>
		</div>
	</div>


	<table class="table table-sm mt-4" width="100%">
		<thead>
			<tr>
				<th width="66%">Produk</th>
				<th class="text-center" width="8%">Qty</th>
				<th class="text-end" width="13%">Satuan</th>
				<th class="text-end" width="13%">Diskon</th>
				<th class="text-end" width="13%">Total</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($penjualan_produk as $ls) { ?>
				<tr>
					<td><?= $ls->nama_produk ?></td>
					<td class="text-center"><?= $ls->qty ?></td>
					<td class="text-end">Rp. <?= number_format($ls->satuan, 0, ',', '.') ?></td>
					<td class="text-end">Rp. <?= number_format($ls->diskon, 0, ',', '.') ?></td>
					<td class="text-end">Rp. <?= number_format($ls->total, 0, ',', '.') ?></td>
				</tr>
			<?php } ?>
			<tr>
				<td colspan="4" class="text-end">Total</td>
				<td class="text-end">Rp. <?= number_format($penjualan['total_hg_produk'], 0, ',', '.') ?></td>
			</tr>
			<tr>
				<td colspan="4" class="text-end">Diskon</td>
				<td class="text-end">Rp. <?= number_format($penjualan['diskon'], 0, ',', '.') ?></td>
			</tr>
			<tr>
				<td colspan="4" class="text-end">Grand Total</td>
				<td class="text-end">Rp. <?= number_format($penjualan['grand_total'], 0, ',', '.') ?></td>
			</tr>
		</tbody>
	</table>
</div>
