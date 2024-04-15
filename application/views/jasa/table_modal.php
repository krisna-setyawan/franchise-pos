<div class="container-fluid p-3">
	<table class="table table-bordered table-hover" id="table-jasa" style="width: 100%;">
		<thead>
			<tr>
				<th>Treatment</th>
				<th>Jenis</th>
				<th>Harga</th>
				<th style="width: 10%;">Aksi</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($jasa as $dt) : ?>
				<tr>
					<td><?= $dt->nama ?></td>
					<td><?= $dt->jenis ?></td>
					<td><?= number_format($dt->harga, 0, ',', '.') ?></td>
					<td>
						<button class="btn btn-success btn-sm py-0 px-2" onclick="pilih_jasa(<?= $dt->id ?>, '<?= $dt->nama ?>', '<?= $dt->harga ?>', <?= $row ?>)">Pilih</button>
					</td>
				</tr>
			<?php endforeach ?>
		</tbody>
	</table>
</div>


<script>
	$('#table-jasa').dataTable({
		info: false,
	});
</script>
