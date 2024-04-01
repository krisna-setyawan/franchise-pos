<div class="container-fluid p-3">
	<table class="table table-bordered table-striped table-hover" id="table-produk">
		<thead>
			<tr>
				<th>Produk</th>
				<th>Stok</th>
				<th>Aksi</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($produk as $dt) : ?>
				<tr>
					<td><?= $dt->nama ?></td>
					<td><?= $dt->stok ?></td>
					<td>
						<button class="btn btn-success btn-sm py-0 px-2" onclick="pilih_produk(<?= $dt->id ?>, '<?= $dt->nama ?>')">Pilih</button>
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
