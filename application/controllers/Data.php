<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data extends Operator_Controller {
    
	public function __construct()
    {
        parent::__construct();
        $this->load->library(array('form_validation','ssp'));
        // $this->load->library('ciqrcode'); //pemanggilan library QR CODE
    }

     
    function data() {
        // nama tabel
        $table = 'data_eltube';
        // nama PK
        $primaryKey = 'id';
        // list field
        $columns = array(
            array('db' => 'id', 'dt' => '0'),
            array('db' => 'judul', 'dt' => '1'),
            array('db' => 'kategori', 'dt' => '2'),
            array('db' => 'subkategori', 'dt' => '3'),
            array('db' => 'gambar', 
                  'dt' => '4',
                  'formatter' => function( $d) {
                    //return "<a href='edit.php?id=$d'>EDIT</a>";
                    return '<img src="../../../video/uploads/'.$d.'" alt="..." class="img-thumbnail">';
                }),
            array(
                'db' => 'Isi',
                'dt' => '5',
            ),
            array(
                'db' => 'id',
                'dt' => '6',
                'formatter' => function( $d) {
                    //return "<a href='edit.php?id=$d'>EDIT</a>";
                    return anchor('unggah/edit/'.$d,'Ubah','class="btn btn-sm btn-info tooltips" data-placement="top" data-original-title="Edit"').' 
                        '.anchor('unggah/delete/'.$d,'Hapus','class="btn btn-sm btn-danger tooltips" data-placement="top" data-original-title="Delete" onclick="return confirm(\'Are you sure delete?\')"');
                }
            )
        );

        $sql_details = array(
            'user' => $this->db->username,
            'pass' => $this->db->password,
            'db' => $this->db->database,
            'host' => $this->db->hostname
        );

        echo json_encode(
                SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns)
        );
    }

    public function index()
    {
        $mainView   = 'data/index';
        $judul      = "Table Data Video";
        $pagination = "";
        $this->load->view('operator/mainview', compact('mainView','judul','pagination'));
            
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
