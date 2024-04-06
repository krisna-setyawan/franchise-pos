<div class="container-fluid p-3">
	<table class="table table-bordered table-hover" id="table-produk" style="width: 100%;">
		<thead>
			<tr>
				<th>Produk</th>
				<th>Stok</th>
				<th style="width: 10%;">Aksi</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($produk as $dt) : ?>
				<tr>
					<td><?= $dt->nama ?></td>
					<td><?= $dt->stok ?></td>
					<td>
						<button class="btn btn-success btn-sm py-0 px-2" onclick="pilih_produk(<?= $dt->id ?>, '<?= $dt->nama ?>', '<?= $dt->harga ?>', '<?= $dt->stok ?>', <?= $row ?>)">Pilih</button>
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
