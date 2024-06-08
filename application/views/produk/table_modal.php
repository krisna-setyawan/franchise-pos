<div class="container-fluid p-3">
	<table class="table table-bordered table-hover" id="table-produk" style="width: 100%;">
		<thead>
			<tr>
				<th>Produk</th>
				<th>Jenis</th>
				<th>Label</th>
				<th>Stok</th>
				<th>Harga</th>
				<th style="width: 10%;">Aksi</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($produk as $dt) : ?>
				<tr>
					<td><?= $dt->nama ?></td>
					<td><?= $dt->jenis ?></td>
					<td><?= $dt->label ?></td>
					<td><?= $dt->stok ?></td>
					<?php switch ($marketplace) {
						case 'outlet': ?>
							<td><?= number_format($dt->hg_outlet, 0, ',', '.') ?></td>
						<?php $harga = $dt->hg_outlet;
							break;
						case 'Shopee': ?>
							<td><?= number_format($dt->hg_shopee, 0, ',', '.') ?></td>
						<?php $harga = $dt->hg_shopee;
							break;
						case 'Tokopedia': ?>
							<td><?= number_format($dt->hg_tokopedia, 0, ',', '.') ?></td>
						<?php $harga = $dt->hg_tokopedia;
							break;
						case 'Lazada': ?>
							<td><?= number_format($dt->hg_lazada, 0, ',', '.') ?></td>
						<?php $harga = $dt->hg_lazada;
							break;
						case 'Agen': ?>
							<td><?= number_format($dt->hg_agen, 0, ',', '.') ?></td>
						<?php $harga = $dt->hg_agen;
							break;
						case 'Reseller': ?>
							<td><?= number_format($dt->hg_reseller, 0, ',', '.') ?></td>
						<?php $harga = $dt->hg_reseller;
							break;
						case 'Whatsapp': ?>
							<td><?= number_format($dt->hg_whatsapp, 0, ',', '.') ?></td>
							<?php $harga = $dt->hg_whatsapp;
							break; ?>
					<?php } ?>
					<td>
						<button class="btn btn-success btn-sm py-0 px-2" onclick="pilih_produk(<?= $dt->id ?>, '<?= $dt->nama ?>', '<?= $harga ?>', '<?= $dt->stok ?>', <?= $row ?>)">Pilih</button>
					</td>
				</tr>
			<?php endforeach ?>
		</tbody>
	</table>
</div>


<script>
	$('#table-produk').dataTable({
		info: false,
	});
</script>