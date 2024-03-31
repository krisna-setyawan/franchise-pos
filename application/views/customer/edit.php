<div class="page-wrapper">
  <div class="content">
    <div class="page-header">
      <div class="page-title">
        <h4>Edit Customer</h4>
      </div>
    </div>

    <div class="card">
      <div class="card-body">
        <form class="row needs-validation" novalidate action="<?= base_url() ?>customer/update" method="post">

          <input required id="kode" name="kode" type="hidden" value="<?= $customer['kode'] ?>">

          <div class="col-lg-4 col-sm-6 col-12">
            <div class="form-group">
              <label>Nama</label>
              <input class="form-control" required id="nama" name="nama" type="text" value="<?= $customer['nama'] ?>">
            </div>
          </div>
          <div class="col-lg-4 col-sm-6 col-12">
            <div class="form-group">
              <label>Telepon</label>
              <input class="form-control" required id="telp" name="telp" type="text" value="<?= $customer['telp'] ?>">
            </div>
          </div>
          <div class="col-lg-4 col-sm-6 col-12">
            <div class="form-group">
              <label>Provinsi</label>
              <select class="select form-control" required id="id_provinsi" name="id_provinsi">
                <?php foreach ($provinsi as $dt) { ?>
                  <option <?= $dt->id == $customer['id_provinsi'] ? 'selected' : '' ?> value="<?= $dt->id ?>"><?= $dt->nama ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="col-lg-4 col-sm-6 col-12">
            <div class="form-group">
              <label>Kota</label>
              <select class="select form-control" required id="id_kota" name="id_kota">
                <?php foreach ($kota as $dt) { ?>
                  <option <?= $dt->id == $customer['id_kota'] ? 'selected' : '' ?> value="<?= $dt->id ?>"><?= $dt->nama ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="col-lg-4 col-sm-6 col-12">
            <div class="form-group">
              <label>Kecamatan</label>
              <select class="select form-control" required id="id_kecamatan" name="id_kecamatan">
                <?php foreach ($kecamatan as $dt) { ?>
                  <option <?= $dt->id == $customer['id_kecamatan'] ? 'selected' : '' ?> value="<?= $dt->id ?>"><?= $dt->nama ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="col-lg-4 col-sm-6 col-12">
            <div class="form-group">
              <label>Kelurahan</label>
              <select class="select form-control" required id="id_kelurahan" name="id_kelurahan">
                <?php foreach ($kelurahan as $dt) { ?>
                  <option <?= $dt->id == $customer['id_kelurahan'] ? 'selected' : '' ?> value="<?= $dt->id ?>"><?= $dt->nama ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="col-lg-8 col-12">
            <div class="form-group">
              <label>Alamat</label>
              <input class="form-control" required id="alamat" name="alamat" type="text" value="<?= $customer['alamat'] ?>">
            </div>
          </div>
          <div class="col-lg-12">
            <button href="javascript:void(0);" class="btn btn-submit me-2" type="submit">Simpan</button>
            <a href="<?= base_url() ?>customer" class="btn btn-cancel" type="button">Batal</a>
          </div>
        </form>
      </div>
    </div>

  </div>
</div>