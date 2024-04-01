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

<script>
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