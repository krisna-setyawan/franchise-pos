<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
	<meta name="description" content="POS - Franchise POS">
	<meta name="keywords" content="admin, estimates, bootstrap, business, corporate, creative, management, minimal, modern,  html5, responsive">
	<meta name="author" content="Dreamguys - Franchise POS">
	<meta name="robots" content="noindex, nofollow">
	<title>Penjualan <?= $penjualan['nomor'] ?></title>

	<link rel="icon" type="image/x-icon" href="<?= base_url() ?>assets/image/Logo2.png">
	<link rel="stylesheet" href="<?= base_url() ?>assets/template/assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?= base_url() ?>assets/template/assets/css/style.css">

</head>


<body>
	<div class="m-4 mb-3">

		<div class="row mt-4">
			<div class="col-6">
				<img src="<?= base_url() ?>assets/image/Logo2.png" alt="" style="width: 50%;">
				<br>
				<strong style="font-size: 20px; margin-bottom: 0px;"><?= $cabang['nama'] ?></strong>
				<p class="mb-2">
					<?= $cabang['alamat'] ?>
					<br> <?= $cabang['telp'] ?>
				</p>
			</div>

			<div class="col-6">
				<div class="text-end mb-4">
					<div class="text-muted">Customer</div>
					<strong><?= $penjualan['marketplace'] ?></strong> <br>
					<strong><?= $penjualan['customer'] ?></strong>
				</div>

				<table style="width: 100%;">
					<tr>
						<td style="width: 25%;">Nomor</td>
						<td class="text-end"><strong><?= $penjualan['nomor'] ?></strong></td>
					</tr>
					<tr>
						<td style="width: 25%;">Tanggal</td>
						<td class="text-end"><strong><?= $penjualan['tanggal'] ?></strong></td>
					</tr>
					<tr>
						<td style="width: 25%;">Pengiriman</td>
						<td class="text-end"><strong><?= $penjualan['ekspedisi'] ?> - <?= $penjualan['tgl_kirim'] ?></strong></td>
					</tr>
					<tr>
						<td style="width: 25%;">Alamat Kirim</td>
						<td class="text-end"><strong><?= $penjualan['alamat_kirim'] ?></strong></td>
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
				<?php if ($penjualan['marketplace'] == 'Whatsapp') { ?>
					<tr>
						<td colspan="4" class="text-end">Bank Transfer</td>
						<td class="text-end"><?= $penjualan['bank_transfer'] ?></td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>


	<script>
		window.print();
	</script>
	<script src="<?= base_url() ?>assets/template/assets/js/bootstrap.bundle.min.js"></script>
	<script src="<?= base_url() ?>assets/template/assets/js/script.js"></script>
</body>

</body>

</html>