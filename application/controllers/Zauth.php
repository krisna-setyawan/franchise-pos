<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Zauth extends CI_Controller
{
	public function index()
	{
		$sesion = $this->session->userdata('franchise_pos_login');
		if ($sesion) {
			redirect('dashboard');
		} else {
			$this->form_validation->set_rules('username', 'username', 'required|trim', [
				'required' => 'Username Belum Diisi!',
			]);
			$this->form_validation->set_rules('password', 'Password', 'required|trim', [
				'required' => 'Password Belum Diisi!',
			]);

			if ($this->form_validation->run() == false) {
				$this->load->view('auth/login');
			} else {
				$this->_login();
			}
		}
	}

	private function _login()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		$user = $this->db->get_where('user', ['username' => $username, 'deleted_at' => null])->row_array();

		//jika username ada
		if ($user) {
			//cek password
			if ($password == $user['password']) {
				$karyawan = $this->db->get_where('karyawan', ['id' => $user['id_karyawan']])->row_array();
				$data = [
					'id_user' => $user['id'],
					'nama_user' => $user['nama'],
					'id_cabang' => $karyawan['id_cabang'],
					'franchise_pos_login' => 'logged_in',
				];
				$this->session->set_userdata($data);
				redirect('dashboard');
			} else {
				$data = array(
					'pesan-notif' => 'Password salah.',
					'icon-notif' => 'error'
				);
				$this->session->set_flashdata($data);
				redirect('zauth');
			}
		} else {
			$data = array(
				'pesan-notif' => 'Username salah.',
				'icon-notif' => 'error'
			);
			$this->session->set_flashdata($data);
			redirect('zauth');
		}
	}

	public function logout()
	{
		$this->session->unset_userdata('franchise_pos_login');

		redirect('zauth');
	}


	public function blocked()
	{
		$this->load->view('auth/blocked');
	}
}
