<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelayan extends CI_Controller {

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

	public function menu()
	{
		$data['judul'] = "Erporate | Daftar Menu";
		$data['menu'] = $this->M_pelayan->get_menu();
		$this->template->display('pelayan/menu',$data);
	}

	public function tambah_menu()
	{
		if($_POST){
			// $config['upload_path'] = "./assets/images/";
			// $config['allowed_types'] = 'gif|jpg|png';
			// $this->load->library('upload',$config);
			
			// if ($this->upload->do_upload('gambar')){
			// 	$gambar = array('upload_data' => $this->upload->data());
				$data = array(
					'nama_menu' => $this->input->post('nm_menu'),
					'kategori' => $this->input->post('kategori'),
					'harga' => $this->input->post('harga'),
					'stok' => $this->input->post('stok'),
					'gambar' => 'default.png'
				);

				$this->M_pelayan->tambahMenu($data,'menu');
			// }
		} else {
			redirect(base_url().'pelayan/menu');
		}
	}

	public function update_menu()
	{
		if ($_POST) {
			$data = array(
				'nama_menu' => $this->input->post('nm_menu'),
				'harga' => $this->input->post('hrg_menu'),
				'stok' => $this->input->post('stok')
			);

			$where = array(
				'id_menu' => $this->input->post('id_menu')
			);
			$this->M_pelayan->updateMenu($where, $data, 'menu');
		} else {
			redirect(base_url().'pelayan/menu');
		}
	}

	public function hapus_menu($id)
	{
		$this->M_pelayan->hapusMenu($id);
		redirect(base_url().'pelayan/menu');
	}

	public function laporan()
	{
		$data['judul'] = "Erporate | Laporan";
		$data['laporan'] = $this->M_pelayan->get_laporan();
		$this->template->display('pelayan/laporan',$data);
	}

}

/* End of file Pelayan.php */
/* Location: ./application/controllers/Pelayan.php */