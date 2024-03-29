<div class="page-wrapper">
  <div class="content">
    <div class="page-header">
      <div class="page-title">
        <h4>Edit Customer</h4>
      </div>
    </div>

    <div class="card">
      <div class="card-body">
        <form class="row needs-validation" novalidate action="<?= base_url() ?>customer/update" method="get">
          <div class="col-lg-3 col-sm-6 col-12">
            <div class="form-group">
              <label>ID</label>
              <input class="form-control" required id="code" name="code" type="text">
            </div>
          </div>
          <div class="col-lg-3 col-sm-6 col-12">
            <div class="form-group">
              <label>Nama</label>
              <input class="form-control" required id="nama" name="nama" type="text">
            </div>
          </div>
          <div class="col-lg-3 col-sm-6 col-12">
            <div class="form-group">
              <label>Telepon</label>
              <input class="form-control" required id="telp" name="telp" type="text">
            </div>
          </div>
          <div class="col-lg-9 col-12">
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