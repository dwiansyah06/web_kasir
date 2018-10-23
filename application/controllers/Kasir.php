<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kasir extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('id_user')) {
			redirect(base_url());
		}
		$this->load->model('M_pelayan');
	}

		public function detailPesanan()
	{
		$data['judul'] = "Erporate | Detail Pesanan";
		$data['pesanan'] = $this->M_pelayan->get_pesanan();
		$this->template->display('pelayan/detail_pesanan', $data);
	}

	public function list_detail_pesanan($kode)
	{
		$data['judul'] = "Erporate | List Detail Pesanan";
		$data['detail'] = $this->M_pelayan->get_detail($kode);
		$data['menu'] = $this->M_pelayan->get_menu();
		$this->template->display('pelayan/list_detail_pesanan',$data);
	}

	public function hapus_pesanan($id,$kode)
	{
		$this->M_pelayan->hapus($id);
		redirect(base_url().'pelayan/list_detail_pesanan/'.$kode);
	}

	public function update_data()
	{
		if ($_POST) {
			$menu = $this->input->post('menu_baru');
			$hrg = $this->input->post('harga_baru');

			$data = array(
				'nama_menu' => $menu,
				'harga' => $hrg,
				'qty' => $this->input->post('qty')
			);

			$where = array(
				'id_pesanan' => $this->input->post('id_pesanan')
			);

			$this->M_pelayan->update($where, $data, 'pesanan');
		} else {
			redirect(base_url().'pelayan/detailPesanan');
		}
	}

}

/* End of file Kasir.php */
/* Location: ./application/controllers/Kasir.php */