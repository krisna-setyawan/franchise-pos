</div>


<script src="<?= base_url() ?>assets/template/assets/js/jquery-3.6.0.min.js"></script>

<script src="<?= base_url() ?>assets/template/assets/js/feather.min.js"></script>

<script src="<?= base_url() ?>assets/template/assets/js/jquery.slimscroll.min.js"></script>

<script src="<?= base_url() ?>assets/template/assets/plugins/select2/js/select2.min.js"></script>
<script src="<?= base_url() ?>assets/template/assets/plugins/select2/js/custom-select.js"></script>

<script src="<?= base_url() ?>assets/template/assets/plugins/jquery-mask/jquery.mask.js" crossorigin="anonymous"></script>

<script src="<?= base_url() ?>assets/template/assets/js/moment.min.js"></script>
<script src="<?= base_url() ?>assets/template/assets/js/bootstrap-datetimepicker.min.js"></script>

<script src="<?= base_url() ?>assets/template/assets/plugins/sweetalert/sweetalert2.all.min.js"></script>
<script src="<?= base_url() ?>assets/template/assets/plugins/sweetalert/sweetalerts.min.js"></script>

<script src="<?= base_url() ?>assets/template/assets/plugins/apexchart/apexcharts.min.js"></script>
<script src="<?= base_url() ?>assets/template/assets/plugins/apexchart/chart-data.js"></script>

<script src="<?= base_url() ?>assets/template/assets/plugins/toastr/toastr.min.js"></script>
<script src="<?= base_url() ?>assets/template/assets/plugins/toastr/toastr.js"></script>

<script src="<?= base_url() ?>assets/template/assets/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>assets/template/assets/js/dataTables.bootstrap4.min.js"></script>

<script src="<?= base_url() ?>assets/template/assets/js/bootstrap.bundle.min.js"></script>

<script src="<?= base_url() ?>assets/template/assets/js/script.js"></script>

<script>
	var pesan = <?= (!empty($this->session->flashdata('pesan-notif')) ? json_encode($this->session->flashdata('pesan-notif')) : '""'); ?>;
	var icon = <?= (!empty($this->session->flashdata('icon-notif')) ? json_encode($this->session->flashdata('icon-notif')) : '""'); ?>;
	if (pesan != '') {
		pesan = pesan.replace(/"/g, '');
		icon = icon.replace(/"/g, '');
		toastr[icon](pesan)
	}


	// RANTAI WILAYAH
	$(document).ready(function() {
		$('#id_provinsi').change(function() {
			let id_provinsi = $(this).val();
			if (id_provinsi != '') {
				$.ajax({
					type: 'get',
					url: '<?= site_url('sys/wilayah/kota_by_provinsi') ?>',
					data: '&id_provinsi=' + id_provinsi,
					success: function(html) {
						$('#id_kota').html(html);
						$('#id_kecamatan').html('<option selected value=""></option>');
						$('#id_kelurahan').html('<option selected value=""></option>');
					}
				})
			} else {
				$('#id_kota').html('<option selected value=""></option>');
				$('#id_kecamatan').html('<option selected value=""></option>');
				$('#id_kelurahan').html('<option selected value=""></option>');
			}
		})

		$('#id_kota').change(function() {
			let id_kota = $(this).val();
			if (id_kota != '') {
				$.ajax({
					type: 'get',
					url: '<?= site_url('sys/wilayah/kecamatan_by_kota') ?>',
					data: '&id_kota=' + id_kota,
					success: function(html) {
						$('#id_kecamatan').html(html);
						$('#id_kelurahan').html('<option selected value=""></option>');
					}
				})
			} else {
				$('#id_kecamatan').html('<option selected value=""></option>');
				$('#id_kelurahan').html('<option selected value=""></option>');
			}
		})

		$('#id_kecamatan').change(function() {
			let id_kecamatan = $(this).val();
			if (id_kecamatan != '') {
				$.ajax({
					type: 'get',
					url: '<?= site_url('sys/wilayah/kelurahan_by_kecamatan') ?>',
					data: '&id_kecamatan=' + id_kecamatan,
					success: function(html) {
						$('#id_kelurahan').html(html);
					}
				})
			} else {
				$('#id_kelurahan').html('<option selected value=""></option>');
			}
		})
	})
</script>

</body>

</html>
