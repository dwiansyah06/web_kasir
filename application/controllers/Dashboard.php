<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('id_user')) {
			redirect(base_url());
		}
	}

	public function index()
	{
		$this->load->model('M_data');
		$data['judul'] = 'Erporate | Dashboard';
		$data['meja'] = $this->M_data->get_meja();
		$data['menu'] = $this->M_data->get_menu();
		$this->template->display('dashboard',$data);
	}

	function logout()
	{
		$this->session->sess_destroy();
		redirect(base_url());
	}

}
