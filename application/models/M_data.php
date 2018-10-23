<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_data extends CI_Model {

	public function get_meja()
	{
		return $this->db->get('meja')->result();
	}

	public function get_menu()
	{
		return $this->db->get('menu')->result();
	}

}

/* End of file M_data.php */
/* Location: ./application/models/M_data.php */