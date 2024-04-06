<div class="container-fluid p-3">
	<table class="table table-bordered table-hover" id="table-customer" style="width: 100%;">
		<thead>
			<tr>
				<th>ID Customer</th>
				<th>Nama Customer</th>
				<th>Cabang Register</th>
				<th style="width: 10%;">Aksi</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($customer as $dt) : ?>
				<tr>
					<td><?= $dt->kode ?></td>
					<td><?= $dt->nama ?></td>
					<td><?= $dt->cabang ?></td>
					<td>
						<button class="btn btn-success btn-sm py-0 px-2" onclick="pilih_customer(<?= $dt->id ?>, '<?= $dt->kode ?>', '<?= $dt->nama ?>', '<?= $dt->cabang ?>')">Pilih</button>
					</td>
				</tr>
			<?php endforeach ?>
		</tbody>
	</table>
</div>


<script>
	$('#table-customer').dataTable({
		info: false,
	});
</script>
