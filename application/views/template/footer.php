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
</script>

</body>

</html>