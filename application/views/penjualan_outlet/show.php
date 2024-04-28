<div class="m-4 mb-5">

	<div class="row mt-4">
		<div class="col-6">
			<strong style="font-size: 20px; margin-bottom: 0px;"><?= $cabang['nama'] ?></strong>
			<p class="mb-2">
				<?= $cabang['alamat'] ?>
				<br> <?= $cabang['telp'] ?>
			</p>
			<div class="row mt-1">
				<div class="col-12">
					<div class="text-muted">Nomor &nbsp; &nbsp; &nbsp; <strong><?= $penjualan['nomor'] ?></strong> </div>
					<div class="text-muted">Tanggal &nbsp; &nbsp; <strong><?= $penjualan['tanggal'] ?> <?= $penjualan['jam'] ?></strong> </div>
					<div class="text-muted">Admin &nbsp; &nbsp; &nbsp; &nbsp;<strong><?= $penjualan['user'] ?></strong> </div>
				</div>
			</div>

		</div>
		<div class="col-6 text-end">
			<div class="text-muted">Customer</div>
			<strong><?= $penjualan['nama'] ?></strong> <br>
			<strong><?= $penjualan['alamat'] ?>, <?= $penjualan['kelurahan'] ?>, <?= $penjualan['kecamatan'] ?>, <?= $penjualan['kota'] ?></strong> <br>
			<strong><?= $penjualan['telp'] ?></strong> <br>
			<strong>ID Customer : <?= $penjualan['kode'] ?></strong>
		</div>
	</div>



	<table class="table table-sm mt-4" width="100%">
		<thead>
			<tr>
				<th width="3%">No</th>
				<th width="55%">Produk</th>
				<th class="text-center" width="3%">Qty</th>
				<th class="text-end" width="12%">Harga</th>
				<th class="text-end" width="12%">Diskon</th>
				<th class="text-end" width="15%">Total</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$no = 1;
			foreach ($penjualan_produk as $ls) { ?>
				<tr>
					<td><?= $no++ ?></td>
					<td><?= $ls->nama_produk ?></td>
					<td class="text-center"><?= $ls->qty ?></td>
					<td class="text-end">Rp. <?= number_format($ls->satuan, 0, ',', '.') ?></td>
					<td class="text-end">Rp. <?= number_format($ls->diskon, 0, ',', '.') ?></td>
					<td class="text-end">Rp. <?= number_format($ls->total, 0, ',', '.') ?></td>
				</tr>
			<?php } ?>
			<?php foreach ($penjualan_jasa as $ls) { ?>
				<tr>
					<td><?= $no++ ?></td>
					<td colspan="4"><?= $ls->nama_jasa ?></td>
					<td class="text-end">Rp. <?= number_format($ls->harga, 0, ',', '.') ?></td>
				</tr>
			<?php } ?>
			<tr>
				<td colspan="5" class="text-end">Total</td>
				<td class="text-end">Rp. <?= number_format($penjualan['total_hg_produk'] + $penjualan['total_hg_jasa'], 0, ',', '.') ?></td>
			</tr>
			<tr>
				<td colspan="5" class="text-end">Diskon</td>
				<td class="text-end">Rp. <?= number_format($penjualan['diskon'], 0, ',', '.') ?></td>
			</tr>
			<tr>
				<td colspan="5" class="text-end">Grand Total</td>
				<td class="text-end">Rp. <?= number_format($penjualan['grand_total'], 0, ',', '.') ?></td>
			</tr>
			<tr>
				<td colspan="5" class="text-end">Jenis Bayar</td>
				<td class="text-end"><?= $penjualan['jenis_bayar'] ?></td>
			</tr>
			<?php if ($penjualan['jenis_bayar'] == 'Cash') { ?>
				<tr>
					<td colspan="5" class="text-end">Bayar</td>
					<td class="text-end">Rp. <?= number_format($penjualan['bayar'], 0, ',', '.') ?></td>
				</tr>
				<tr>
					<td colspan="5" class="text-end">Kembalian</td>
					<td class="text-end">Rp. <?= number_format($penjualan['kembalian'], 0, ',', '.') ?></td>
				</tr>
			<?php } else { ?>
				<tr>
					<td colspan="5" class="text-end">Bank</td>
					<td class="text-end"><?= $penjualan['bank'] ?></td>
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
		window.open('<?= base_url() ?>penjualan_outlet/print/' + nomor, 'page', 'toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=0,width=900,height=750,left=50,top=50,titlebar=yes')
	}
</script>