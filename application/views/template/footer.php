</div>



<!-- Modal -->
<div class="modal fade" id="modal-detail" tabindex="-1" aria-labelledby="modal-label" aria-hidden="true">
	<div class="modal-dialog modal-dialog-scrollable modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h1 class="modal-title fs-6" id="modal-label-detail">Pilih Produk</h1>
				<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span></button>
			</div>
			<div class="modal-body m-0 p-0" id="modal-body-detail">

			</div>
		</div>
	</div>
</div>


<script src="<?= base_url() ?>assets/template/assets/js/feather.min.js"></script>

<script src="<?= base_url() ?>assets/template/assets/js/jquery.slimscroll.min.js"></script>

<script src="<?= base_url() ?>assets/template/assets/plugins/select2/js/select2.min.js"></script>
<script src="<?= base_url() ?>assets/template/assets/plugins/select2/js/custom-select.js"></script>

<script src="<?= base_url() ?>assets/template/assets/plugins/jquery-mask/jquery.mask.js" crossorigin="anonymous"></script>

<script src="<?= base_url() ?>assets/template/assets/js/moment.min.js"></script>
<script src="<?= base_url() ?>assets/template/assets/js/bootstrap-datetimepicker.min.js"></script>

<script src="<?= base_url() ?>assets/template/assets/plugins/sweetalert/sweetalert2.all.min.js"></script>
<script src="<?= base_url() ?>assets/template/assets/plugins/sweetalert/sweetalerts.min.js"></script>

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

	var penjualan_online = <?= (!empty($this->session->flashdata('penjualan_online')) ? json_encode($this->session->flashdata('penjualan_online')) : '""'); ?>;
	if (pesan != '') {
		detail('<?= base_url() ?>penjualan_online/show/' + penjualan_online, 'Detail Penjualan')
	}

	var penjualan_outlet = <?= (!empty($this->session->flashdata('penjualan_outlet')) ? json_encode($this->session->flashdata('penjualan_outlet')) : '""'); ?>;
	if (pesan != '') {
		detail('<?= base_url() ?>penjualan_outlet/show/' + penjualan_outlet, 'Detail Penjualan')
	}

	function alert_toastr(icon, pesan) {
		toastr[icon](pesan)
	}
</script>

</body>

</html>