<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pencarian extends MY_Controller {
    
	public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        // $this->load->library('ciqrcode'); //pemanggilan library QR CODE
    }

    public function index()
    {
        $kategori   = $this->input->get('kategori') ?? '';
        $sub        = $this->input->get('sub') ?? '';
        $video      = $this->db->like('kategori',$kategori, 'both')->like('subkategori',$sub, 'both')->limit(20)->get('data_eltube')->result();
        $mainView   = 'pencarian/index';
        $judul      = "Pencarian";
        $pagination = "";
        $this->load->view('operator/mainview', compact('mainView','video','judul','pagination'));
            
    }

    public function cari()
    {
        $cari   = $this->input->get('judul') ?? '';
        $video      = $this->db->like('judul',$cari, 'both')->limit(20)->get('data_eltube')->result();
        $mainView   = 'pencarian/index';
        $judul      = "Pencarian";
        $pagination = "";
        $this->load->view('operator/mainview', compact('mainView','video','judul','pagination'));
    }



}
