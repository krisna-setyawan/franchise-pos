<div class="page-wrapper">
	<div class="content">

		<div id="pesan-notif" style="display: none;"><?= json_encode($this->session->flashdata('pesan-notif')) ?></div>
		<div id="icon-notif" style="display: none;"><?= json_encode($this->session->flashdata('icon-notif')) ?></div>

		<div class="page-header">
			<div class="page-title">
				<h4>Akun Karyawan</h4>
			</div>
			<div class="page-btn">
				<a href="<?= base_url() ?>akun/add" class="btn btn-added"><img src="<?= base_url() ?>assets/template/assets/img/icons/plus.svg" alt="img">Tambah Akun</a>
			</div>
		</div>

		<div class="card">
			<div class="card-body">

				<div class="table-top">
					<div class="search-set">
						<div class="search-input">
							<a class="btn btn-searchset"><img src="<?= base_url() ?>assets/template/assets/img/icons/search-white.svg" alt="img"></a>
						</div>
					</div>
					<!-- <div class="wordset">
						<ul>
							<li>
								<a data-bs-toggle="tooltip" data-bs-placement="top" title="pdf"><img src="<?= base_url() ?>assets/template/assets/img/icons/pdf.svg" alt="img"></a>
							</li>
							<li>
								<a data-bs-toggle="tooltip" data-bs-placement="top" title="excel"><img src="<?= base_url() ?>assets/template/assets/img/icons/excel.svg" alt="img"></a>
							</li>
							<li>
								<a data-bs-toggle="tooltip" data-bs-placement="top" title="print"><img src="<?= base_url() ?>assets/template/assets/img/icons/printer.svg" alt="img"></a>
							</li>
						</ul>
					</div> -->
				</div>


				<div class="table-responsive">
					<table class="table datanew">
						<thead>
							<tr class="text-center">
								<th>Karyawan</th>
								<th>Username</th>
								<th width="10%">Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($akun as $dt) : ?>
								<tr>
									<td>
										<a href="javascript:void(0);"><?= $dt->nama ?></a>
									</td>
									<td><?= $dt->username ?></td>
									<td class="text-center">
										<a class="me-3" onclick="hak_menu(<?= $dt->id ?>)">
											<img src="<?= base_url() ?>assets/template/assets/img/icons/edit.svg" alt="img">
										</a>
										<a class="me-3" href="javascript:void(0);" onclick="confirm_delete('<?= base_url() ?>akun/delete/<?= $dt->id ?>')">
											<img src="<?= base_url() ?>assets/template/assets/img/icons/delete.svg" alt="img">
										</a>
									</td>
								</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>

			</div>
		</div>

	</div>
</div>


<!-- Modal menu user -->
<div class="modal fade" id="modal-menu-user" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-scrollable modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Menu User</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<div class="table-responsive">
					<table class="table table-sm table-bordered table-hover" width="100%">
						<thead>
							<tr class="text-center bg-dark">
								<th class="text-light bg-dark" width="75%">Menu</th>
								<th class="text-light bg-dark" width="25%" style="text-align: center">Akses</th>
							</tr>
						</thead>
						<tbody id="isi_tabel">
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>


<script>
	// MENU DATA ----------------------------------------------------------------------------------- MENU DATA
	function hak_menu(id) {
		$.ajax({
			url: '<?= base_url() ?>akun/get_hak_menu',
			type: 'post',
			data: '&id_user=' + id,
			success: function(html) {
				$('#isi_tabel').html(html);
				$('#modal-menu-user').modal('toggle');
			}
		});
	}

	function beri_menu(id_menu, id_user) {
		$.ajax({
			url: '<?= base_url('akun/beri_hak_menu') ?>',
			type: 'post',
			data: "&id_menu=" + id_menu +
				"&id_user=" + id_user,
			success: function() {
				Toast.fire({
					icon: 'success',
					title: 'Berhasil edit hak akses menu!'
				})
			}
		});
	}
	// MENU DATA ----------------------------------------------------------------------------------- MENU DATA
</script>
