<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
	<title>Login</title>

	<link rel="icon" type="image/x-icon" href="<?= base_url() ?>assets/image/Logo2.png">

	<link rel="stylesheet" href="<?= base_url() ?>assets/template/assets/css/bootstrap.min.css">

	<link rel="stylesheet" href="<?= base_url() ?>assets/template/assets/plugins/toastr/toatr.css">

	<link rel="stylesheet" href="<?= base_url() ?>assets/template/assets/plugins/fontawesome/css/fontawesome.min.css">
	<link rel="stylesheet" href="<?= base_url() ?>assets/template/assets/plugins/fontawesome/css/all.min.css">

	<link rel="stylesheet" href="<?= base_url() ?>assets/template/assets/css/style.css">
</head>

<body class="account-page">

	<div id="pesan-notif" style="display: none;"><?= json_encode($this->session->flashdata('pesan-notif')) ?></div>
	<div id="icon-notif" style="display: none;"><?= json_encode($this->session->flashdata('icon-notif')) ?></div>

	<div class="main-wrapper">
		<div class="account-content">
			<div class="login-wrapper">
				<div class="login-content">

					<form method="POST" action="<?= base_url() ?>zauth" class="login-userset needs-validation" novalidate>

						<div class="login-userheading mt-4">
							<h3>Login</h3>
						</div>
						<div class="form-login">
							<label class="text-secondary">Username</label>
							<div class="form-addons">
								<input style="color: grey;" name="username" type="text" class="form-control" required>
								<img class="mx-3" style="margin-top: -3px;" src="<?= base_url() ?>assets/template/assets/img/icons/users1.svg" alt="img">
							</div>
						</div>
						<div class="form-login">
							<label class="text-secondary">Password</label>
							<div class="pass-group">
								<input style="color: grey;" name="password" type="password" class="pass-input form-control" required>
								<span class="mx-3 fas toggle-password fa-eye-slash"></span>
							</div>
						</div>
						<div class="form-login">
							<button class="btn btn-login" href="<?= base_url() ?>dashboard" type="submit">Login</button>
						</div>
					</form>

				</div>
				<div class="login-img">
					<img src="<?= base_url() ?>assets/image/login-bg.png" alt="img">
				</div>
			</div>
		</div>
	</div>


	<script src="<?= base_url() ?>assets/template/assets/js/jquery-3.6.0.min.js"></script>

	<script src="<?= base_url() ?>assets/template/assets/js/feather.min.js"></script>

	<script src="<?= base_url() ?>assets/template/assets/js/bootstrap.bundle.min.js"></script>

	<script src="<?= base_url() ?>assets/template/assets/plugins/toastr/toastr.min.js"></script>
	<script src="<?= base_url() ?>assets/template/assets/plugins/toastr/toastr.js"></script>

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