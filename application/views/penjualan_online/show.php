<div class="m-4 mb-3">

	<div class="row mt-4">
		<div class="col-6">
			<strong style="font-size: 20px; margin-bottom: 0px;"><?= $cabang['nama'] ?></strong>
			<p class="mb-2">
				<?= $cabang['alamat'] ?>
				<br> <?= $cabang['telp'] ?>
			</p>
			<div class="row mt-1">
				<div class="col-12">
					<div class="text-muted">Nomor &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<strong><?= $penjualan['nomor'] ?></strong> </div>
					<div class="text-muted">Tanggal &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<strong><?= $penjualan['tanggal'] ?></strong> </div>
					<div class="text-muted">Pengiriman &nbsp; &nbsp; &nbsp;<strong><?= $penjualan['ekspedisi'] ?> - <?= $penjualan['tgl_kirim'] ?></strong> </div>
					<div class="text-muted">Alamat Kirim &nbsp; &nbsp;<strong><?= $penjualan['alamat_kirim'] ?></strong> </div>
				</div>
			</div>

		</div>
		<div class="col-6 text-end">
			<div class="text-muted">Customer</div>
			<strong><?= $penjualan['marketplace'] ?></strong> <br>
			<strong><?= $penjualan['customer'] ?></strong>
			<br>
			<br>
			<strong><?= $penjualan['no_penjualan_mp'] ?></strong>
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
			<?php if ($penjualan['marketplace'] == 'Whatsapp') { ?>
				<tr>
					<td colspan="4" class="text-end">Bank Transfer</td>
					<td class="text-end"><?= $penjualan['bank_transfer'] ?></td>
				</tr>
			<?php } ?>
		</tbody>
	</table>

	<div class="text-center mt-5">
		<button class="btn btn-success" onclick="print_nota('<?= $penjualan['nomor'] ?>')">Print <i class="fa-solid fa-print"></i></button>
	</div>
</div>


<script>
	function print_nota(nomor) {
		var s5_taf_parent = window.location;
		window.open('<?= base_url() ?>penjualan_online/print/' + nomor, 'page', 'toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=0,width=900,height=750,left=50,top=50,titlebar=yes')
	}
</script>