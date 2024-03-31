<div class="page-wrapper">
  <div class="content">
    <div class="page-header">
      <div class="page-title">
        <h4>Tambah Customer</h4>
      </div>
    </div>

    <div class="card">
      <div class="card-body">
        <form class="row needs-validation" novalidate action="<?= base_url() ?>customer/store" method="post">
          <div class="col-lg-4 col-sm-6 col-12">
            <div class="form-group">
              <label>ID</label>
              <input class="form-control" required id="kode" name="kode" type="text" value="<?= $kode ?>">
            </div>
          </div>
          <div class="col-lg-4 col-sm-6 col-12">
            <div class="form-group">
              <label>Nama</label>
              <input class="form-control" required id="nama" name="nama" type="text">
            </div>
          </div>
          <div class="col-lg-4 col-sm-6 col-12">
            <div class="form-group">
              <label>Telepon</label>
              <input class="form-control" required id="telp" name="telp" type="text">
            </div>
          </div>
          <div class="col-lg-4 col-sm-6 col-12">
            <div class="form-group">
              <label>Provinsi</label>
              <select class="select form-control" required id="id_provinsi" name="id_provinsi">
                <option selected value=""></option>
                <?php foreach ($provinsi as $prov) { ?>
                  <option value="<?= $prov->id ?>"><?= $prov->nama ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="col-lg-4 col-sm-6 col-12">
            <div class="form-group">
              <label>Kota</label>
              <select class="select form-control" required id="id_kota" name="id_kota">
                <option selected value=""></option>
              </select>
            </div>
          </div>
          <div class="col-lg-4 col-sm-6 col-12">
            <div class="form-group">
              <label>Kecamatan</label>
              <select class="select form-control" required id="id_kecamatan" name="id_kecamatan">
                <option selected value=""></option>
              </select>
            </div>
          </div>
          <div class="col-lg-4 col-sm-6 col-12">
            <div class="form-group">
              <label>Kelurahan</label>
              <select class="select form-control" required id="id_kelurahan" name="id_kelurahan">
                <option selected value=""></option>
              </select>
            </div>
          </div>
          <div class="col-lg-8 col-12">
            <div class="form-group">
              <label>Alamat</label>
              <input class="form-control" required id="alamat" name="alamat" type="text">
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