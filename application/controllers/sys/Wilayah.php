<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Wilayah extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    is_logged_in();
  }

  public function kota_by_provinsi()
  {
    $id_provinsi = $this->input->get('id_provinsi');

    $this->db->order_by('nama', 'asc');
    $list_kota = $this->db->get_where('kota', ['id_provinsi' => $id_provinsi])->result();

    $echo = "<option selected value=''></option>";

    if ($list_kota) {
      foreach ($list_kota as $kt) {
        $echo .= " <option value='$kt->id'> $kt->nama </option> ";
      }
    } else {
      $echo .= " <option selected value=''>Kota Tidak Ditemukan</option> ";
    }

    echo $echo;
  }

  public function kecamatan_by_kota()
  {
    $id_kota = $this->input->get('id_kota');

    $this->db->order_by('nama', 'asc');
    $list_kecamatan = $this->db->get_where('kecamatan', ['id_kota' => $id_kota])->result();

    $echo = "<option selected value=''></option>";

    if ($list_kecamatan) {
      foreach ($list_kecamatan as $kt) {
        $echo .= " <option value='$kt->id'> $kt->nama </option> ";
      }
    } else {
      $echo .= " <option selected value=''>Kecamatan Tidak Ditemukan</option> ";
    }

    echo $echo;
  }

  public function kelurahan_by_kecamatan()
  {
    $id_kecamatan = $this->input->get('id_kecamatan');

    $this->db->order_by('nama', 'asc');
    $list_kelurahan = $this->db->get_where('kelurahan', ['id_kecamatan' => $id_kecamatan])->result();

    $echo = "<option selected value=''></option>";

    if ($list_kelurahan) {
      foreach ($list_kelurahan as $kt) {
        $echo .= " <option value='$kt->id'> $kt->nama </option> ";
      }
    } else {
      $echo .= " <option selected value=''>Kelurahan Tidak Ditemukan</option> ";
    }

    echo $echo;
  }
}
