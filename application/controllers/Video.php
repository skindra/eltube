<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Video extends MY_Controller {
    
	public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        // $this->load->library('ciqrcode'); //pemanggilan library QR CODE
    }

    public function index()
    {
        $id = (isset($_GET['play'])) ? $_GET['play'] : null ;
        $play = $this->db->get_where('data_eltube',['id'=>$id])->row();
        if ($play) {
            $data =[
                'id_eltube' => $id,
                'user' => 'Umum',
                'browser' => '',
            ];
            $this->db->insert('laporan',$data);
        }

        $mainView = 'video/index';
        $judul ="Play Video";
        $this->load->view('operator/mainview', compact('mainView','play','judul'));
            
    }



}
