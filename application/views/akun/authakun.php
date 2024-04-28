<div class="container p-3">
	<div class="form-group">
		<label>Admin</label>
		<select required class="select form-control" id="id_akun" name="id_akun">
			<option value=""></option>
			<?php foreach ($akun as $dt) : ?>
				<option value="<?= $dt->id ?>"><?= $dt->nama ?></option>
			<?php endforeach; ?>
		</select>
	</div>
	<div class="form-group">
		<label>Password</label>
		<input required class="form-control" id="password" name="password" type="password">
	</div>

	<div class="col-lg-12 text-center">
		<button href="javascript:void(0);" class="btn btn-submit me-2 p-2" type="submit" onclick="authUser()">OK</button>
	</div>
</div>