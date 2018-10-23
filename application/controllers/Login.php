<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function index()
	{
		$data['judul'] = 'Erporate | Login';
		$this->load->view('login', $data);
	}

	public function process()
	{
		$this->load->model('M_login');
		if ($this->input->post('login')) {
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$where = array('username'=>$username);

			$result = $this->M_login->queryLogin($where, "user")->num_rows();
			if ($result > 0) {
				$print = $this->M_login->queryLogin($where, "user")->result();
				foreach ($print as $value) {
					$sess_data['id_user'] 	= $value->id_user;
					$sess_data['username'] 	= $value->username;
					$sess_data['level'] = $value->level;
					$pass_db = $value->password;
				}

				if ($password == $pass_db) {
					$this->session->set_userdata($sess_data);
					redirect('dashboard');
				} else {
					$this->session->set_flashdata('error', 'Maaf password anda salah');
					redirect(base_url());
				}
			} else {
				$this->session->set_flashdata('error', "Maaf username <strong>$username</strong> tidak ada dalam database kami");
				redirect(base_url());
			}

		} else {
			redirect(base_url());
		}
	}

}

/* End of file Login.php */
/* Location: ./application/controllers/Login.php */