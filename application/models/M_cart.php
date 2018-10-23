<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_cart extends CI_Model {

	public function send_db($data,$tabel){
		$this->db->set($data);
		$this->db->insert($tabel);
	}

	public function update_meja($data, $where, $tabel){
		$this->db->where($where);
		$this->db->update($tabel,$data);
	}

	public function update_bayar($data, $where, $tabel){
		$this->db->where($where);
		$this->db->update($tabel,$data);
	}

	public function update_stts_byr($data, $where, $tabel){
		$this->db->where($where);
		$this->db->update($tabel,$data);
	}

	public function get_kode()
	{
		$q = $this->db->query("SELECT MAX(RIGHT(kd_pesanan,3)) AS kd_max FROM pesanan ");
        $kd = "";
        if($q->num_rows()>0){
            foreach($q->result() as $k){
                $tmp = ((int)$k->kd_max)+1;
                $kd = sprintf("%03s", $tmp);
            }
        }else{
            $kd = "001";
        }

        $tanggal = date('dmY');
        $kode = "ERP$tanggal-$kd";
        return $kode;
	}

}

/* End of file M_cart.php */
/* Location: ./application/models/M_cart.php */