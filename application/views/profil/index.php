<div class="page-wrapper">
	<div class="content">

		<div class="page-header">
			<div class="page-title">
				<h4>Profil</h4>
			</div>
			<div class="page-btn">
				<a href="<?= base_url() ?>karyawan/add" class="btn btn-added"><img src="<?= base_url() ?>assets/template/assets/img/icons/plus.svg" alt="img">Tambah Karyawan</a>
			</div>
		</div>

		<div class="card">
			<div class="card-body">

				<div class="row">
					<div class="col-md-3">
						<div class="d-flex flex-column align-items-center text-left p-3"><img class="rounded-circle mt-5" width="150px" src="<?= base_url() ?>assets/template/assets/img/profiles/profil.png">
							<span class="font-weight-bold mt-3 fs-4"><?= $user['nama'] ?></span>
							<span class="text-black-50 fs-5"><?= $user['jabatan'] ?></span>
							<span> </span>
						</div>
					</div>
					<div class="col-md-6">
						<form class="p-3" method="get" action="<?= base_url() ?>zprofil/updateProfil">
							<div class="row mt-3">
								<input type="hidden" name="id_kry" value="<?= $user['id'] ?>">
								<div class="col-md-12 mb-4">
									<label class="labels">Nama</label>
									<input readonly type="text" id="nama" name="nama" class="form-control form-control-lg" value="<?= $user['nama'] ?>">
								</div>
								<div class="col-md-12 mb-4">
									<label class="labels">Nomor Induk Karyawan</label>
									<input readonly type="text" class="form-control form-control-lg" value="<?= $user['nik'] ?>">
								</div>
								<div class="col-md-12 mb-4">
									<label class="labels">Jabatan</label>
									<input readonly type="text" class="form-control form-control-lg" value="<?= $user['jabatan'] ?>">
								</div>
								<div class="col-md-12 mb-4">
									<label class="labels">Alamat</label>
									<input readonly type="text" id="alamat" name="alamat" class="form-control form-control-lg" value="<?= $user['alamat'] ?>">
								</div>
								<div class="col-md-12 mb-4">
									<label class="labels">No Telepon</label>
									<input readonly type="text" id="telp" name="telp" class="form-control form-control-lg" value="<?= $user['telp'] ?>">
								</div>
								<div class="col-md-12 mb-4">
									<label class="labels">Kontak Darurat</label>
									<input readonly type="text" id="kontak_darurat" name="kontak_darurat" class="form-control form-control-lg" value="<?= $user['kontak_darurat'] ?>">
								</div>
							</div>

							<div class="mt-4 text-center edit-biodata-buttons">
								<button class="btn btn-secondary edit-biodata" type="button"><img src="<?= base_url() ?>assets/template/assets/img/icons/edit1.svg" style="width: 14px; margin-right: 10px;" alt="img">Edit Biodata</button>
							</div>
							<div hidden class="mt-4 text-center save-cancel-buttons">
								<button class="btn btn-danger cancel" type="button"><img src="<?= base_url() ?>assets/template/assets/img/icons/cross.svg" style="width: 13px; margin-right: 10px;" alt="img">Batal</button>
								<button class="btn btn-primary" type="submit"><img src="<?= base_url() ?>assets/template/assets/img/icons/save.svg" style="width: 14px; margin-right: 10px;" alt="img">Simpan</button>
							</div>
						</form>
					</div>
				</div>

			</div>
		</div>

	</div>
</div>
<script>
	$(document).ready(function() {
		// Ketika tombol edit biodata diklik
		$("button.edit-biodata").click(function() {
			// Aktifkan semua input
			$("input").prop('readonly', false);

			// Tampilkan div tombol simpan dan batal
			$(".save-cancel-buttons").removeAttr('hidden');

			// Sembunyikan div tombol edit biodata
			$(".edit-biodata-buttons").attr('hidden', true);
		});

		// Ketika tombol batal diklik
		$("button.cancel").click(function() {
			// Nonaktifkan kembali semua input
			$("input").prop('readonly', true);

			// Sembunyikan div tombol simpan dan batal
			$(".save-cancel-buttons").attr('hidden', true);

			// Tampilkan kembali div tombol edit biodata
			$(".edit-biodata-buttons").removeAttr('hidden');
		});
	});
</script>