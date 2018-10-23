<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_pelayan extends CI_Model {

	function get_menu()
	{
		return $this->db->get('menu')->result();
	}

	function get_pesanan()
	{
		$this->db->distinct();
		$this->db->select('*');
		$this->db->where('status_byr', 0); 
		$this->db->group_by('kd_pesanan','nmr_meja');
		$query = $this->db->get('pesanan');
		return $query->result();
	}

	public function get_detail($kode){
		return $this->db->where('kd_pesanan',$kode)->get('pesanan')->result();
	}

	public function hapus($id)
	{
		$this->db->where('id_pesanan', $id);
		$this->db->delete('pesanan');
	}

	public function update($where, $data, $tabel){
		$this->db->where($where);
		$this->db->update($tabel,$data);
	}

	public function tambahMenu($data,$tabel){
		$this->db->set($data);
		$this->db->insert($tabel);
	}

	public function updateMenu($where, $data, $tabel){
		$this->db->where($where);
		$this->db->update($tabel,$data);
	}

	public function hapusMenu($id)
	{
		$this->db->where('id_menu', $id);
		$this->db->delete('menu');
	}

	public function get_laporan(){
		$username = $this->session->userdata('username');
		return $this->db->where('nm_pelayan',$username)->get('pesanan')->result();
	}

}

/* End of file M_pelayan.php */
/* Location: ./application/models/M_pelayan.php */