<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Akun extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		is_logged_in();
	}

	public function index()
	{
		$data_sidebar = [
			'menus' => get_menus()
		];
		$data_topbar = [
			'user' => $this->session->userdata('nama_user'),
			'cabang' => $this->db->get_where('cabang', ['id' => $this->session->userdata('id_cabang')])->row_array(),
		];

		$data['akun'] = $this->db->get_where('user', ['deleted_at' => null])->result();

		$this->load->view('template/header');
		$this->load->view('template/topbar', $data_topbar);
		$this->load->view('template/sidebar', $data_sidebar);
		$this->load->view('akun/index', $data);
		$this->load->view('template/footer');
	}





	public function add()
	{
		$data_sidebar = [
			'menus' => get_menus()
		];
		$data_topbar = [
			'user' => $this->session->userdata('nama_user'),
			'cabang' => $this->db->get_where('cabang', ['id' => $this->session->userdata('id_cabang')])->row_array(),
		];

		$data = [
			'karyawan' => $this->db->get_where('karyawan', ['deleted_at' => null])->result()
		];

		$this->load->view('template/header');
		$this->load->view('template/topbar', $data_topbar);
		$this->load->view('template/sidebar', $data_sidebar);
		$this->load->view('karyawan/add', $data);
		$this->load->view('template/footer');
	}

	public function store()
	{
		$karyawan = $this->db->get_where('karyawan', ['id' => $this->input->post('id_karyawan')])->row_array();
		$data = array(
			'id_karyawan' => $this->input->post('id_karyawan'),
			'nama' => $karyawan['nama'],
			'username' => $this->input->post('username'),
			'password' => $this->input->post('password'),
		);
		$this->db->insert('user', $data);
		$last_id_user = $this->db->insert_id();

		$data_access = array(
			'id_user' => $last_id_user,
			'id_menu' => 1,
		);
		$this->db->insert('user_access', $data_access);

		$datasession = array(
			'pesan-notif' => 'Berhasil menambah akun karyawan.',
			'icon-notif' => 'success'
		);
		$this->session->set_flashdata($datasession);
		redirect('akun');
	}


	public function delete($id)
	{
		$where = array('id' => $id);
		$this->db->where($where);
		$this->db->delete('user');

		$datasession = array(
			'pesan-notif' => 'Berhasil menghapus akun karyawan.',
			'icon-notif' => 'success'
		);
		$this->session->set_flashdata($datasession);
		redirect('akun');
	}






	// MENU USER --------------------------------------------------------------------------------------- MENU USER
	public function get_hak_menu()
	{
		$id_user = $this->input->post('id_user');
		$user_menu = $this->db->get_where('user_menu', ['id !=' => 1])->result();

		foreach ($user_menu as $um) {
			if ($um->level == 2) {
				$class_td = 'class="ps-5"';
			} else {
				$class_td = 'class="ps-3"';
			}
			echo "
        <tr>
            <td " . $class_td . ">$um->menu</td>
            <td class='text-center'>
                <div class='custom-control custom-checkbox'>
                    <input onclick='beri_menu($um->id, $id_user)' type='checkbox' " . check_akses($um->id, $id_user) . ">
                </div>
            </td>
        </tr>
        ";
		}
	}

	public function beri_hak_menu()
	{
		$id_menu = $this->input->post('id_menu');
		$id_user = $this->input->post('id_user');

		$query = "SELECT * FROM user_access WHERE id_user = $id_user AND id_menu = $id_menu";

		$ada = $this->db->query($query);

		if ($ada->num_rows() < 1) {
			$dtinsert = [
				'id_menu' => $id_menu,
				'id_user' => $id_user,
			];
			$this->db->insert('user_access', $dtinsert);
		} else {
			$where = array(
				'id_user' => $id_user,
				'id_menu' => $id_menu,
			);
			$this->db->delete('user_access', $where);
		}
	}
	// MENU USER --------------------------------------------------------------------------------------- MENU USER
}