<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends CI_Controller {

	function __construct()
	{
		parent::__construct();
        if (!$this->session->userdata('id_user')) {
            redirect(base_url());
        }
		$this->load->library('cart');
        $this->load->model('M_cart');
	}

	function add_to_cart(){ 
        $data = array(
            'id' => $this->input->post('id_menu'), 
            'name' => $this->input->post('nama_menu'), 
            'price' => $this->input->post('harga_menu'), 
            'qty' => $this->input->post('quantity'), 
        );
        $this->cart->insert($data);
        echo $this->show_cart(); //tampilkan cart setelah added
    }
 
    function show_cart(){ //Fungsi untuk menampilkan Cart
        $output = '';
        $no = 0;
        foreach ($this->cart->contents() as $items) {
            $no++;
            $output .='
                <tr>
                    <td>'.$items['name'].'</td>
                    <td>'.number_format($items['price']).'</td>
                    <td>'.$items['qty'].'</td>
                    <td>'.number_format($items['subtotal']).'</td>
                    <td><button type="button" id="'.$items['rowid'].'" class="hapus_cart btn btn-danger btn-xs">Hapus</button></td>
                </tr>
            ';
        }
        $output .= '
            <tr>
                <th colspan="3">Total</th>
                <th colspan="2">'.'Rp '.number_format($this->cart->total()).'</th>
            </tr>
        ';
        return $output;
    }
 
    function load_cart(){ //load data cart
        echo $this->show_cart();
    }

    function batal()
    {
    	$this->cart->destroy();
    	echo $this->show_cart();
    }

    function send_to_db()
    {
         $kode = $this->M_cart->get_kode();
    	 foreach ($this->cart->contents() as $items) {
    	 	$data = array(
                'kd_pesanan' => $kode,
    	 		'nama_menu' => $items['name'],
    	 		'harga' => $items['price'],
    	 		'qty' => $items['qty'],
    	 		'nmr_meja' => $this->input->post('nmr_meja'),
    	 		'nm_pelayan' => $this->session->userdata('username')
    	 	);

    	 	$this->M_cart->send_db($data, 'pesanan');
    	 }
    	 
	 	$data_upd = array('status' => 1);
		$where = array('id_meja' => $this->input->post('nmr_meja'));
	 	$this->M_cart->update_meja($data_upd, $where, 'meja');

    	 echo $this->batal();
    }

    function bayar()
    {
        $data_upd = array('status' => 0);
        $where = array('id_meja' => $this->input->post('nmr_meja'));
        $data_upd2 = array('status_byr' => 1);
        $where2 = array('nmr_meja' => $this->input->post('nmr_meja'));

        $this->M_cart->update_bayar($data_upd, $where, 'meja');
        $this->M_cart->update_stts_byr($data_upd2, $where2, 'pesanan');
    }
 
    function hapus_cart(){ //fungsi untuk menghapus item cart
        $data = array(
            'rowid' => $this->input->post('row_id'), 
            'qty' => 0, 
        );
        $this->cart->update($data);
        echo $this->show_cart();
    }

}

/* End of file Cart.php */
/* Location: ./application/controllers/Cart.php */