<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		is_logged_in();
	}

	public function get_menus($id_menu)
	{
		$data_sidebar = [
			'user' => $this->session->userdata('nama_user'),
			'menus' => get_menus(),
		];
		$id_user = $this->session->userdata('id_user');

		$q = "SELECT user_office_access.*, user_office_menu.* FROM user_office_access 
		JOIN user_office_menu ON user_office_access.id_menu = user_office_menu.id 
		WHERE user_office_access.id_user = $id_user AND user_office_menu.parent = $id_menu ORDER BY user_office_menu.id";

		$data = [
			'menus' => $this->db->query($q)->result_array(),
			'title' => $this->db->get_where('user_office_menu', ['id' => $id_menu])->row_array(),
			'id_user' => $id_user
		];

		$this->load->view('template/header');
		$this->load->view('template/topbar');
		$this->load->view('template/sidebar', $data_sidebar);
		$this->load->view('sys/menu', $data);
		$this->load->view('template/footer');
	}
}
