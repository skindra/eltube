<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Unggah extends Operator_Controller {
    
	public function __construct()
    {
        parent::__construct();
        $this->load->library(array('form_validation','ciqrcode'));
    }

    public function index()
    {
        $input = (object) $this->input->post(null,true);
        if (! $_POST) {
            $input = (object) $this->Unggah->getDefaultValues();
        }

        /* upload File */
        if (!empty($_FILES) && $_FILES['gambar']['size'] && $_FILES['Isi']['size'] > 0) {
            $upload_ = $this->Unggah->upload_gambar('gambar');
            $upload_v = $this->Unggah->upload_video('Isi');
            if ($upload_ && $upload_v ) {
                $input->gambar =  $upload_['file_name']; 
                $input->Isi =  $upload_v['file_name']; 
            }

        }else{
            $this->form_validation->set_rules('gambar', 'Sampul Gambar', 'trim|required');
            $this->form_validation->set_rules('Isi', 'File Video', 'trim|required'); 
            
        }

        

        if (! $this->Unggah->validate() || $this->form_validation->error_array() ) {
            $judul = 'Halaman Unggah Video';
            $mainView = 'unggah/index';
            $action = 'unggah';
            $button = 'Upload';
            $this->load->view('operator/mainview', compact('judul','user','mainView','input','action','button'));
            return;
        }

        
        $no = $this->db->query("select id from eltube order by id DESC LIMIT 1")->row_array();
        $nn = $no['id']+1;
        $input->id = $nn;
        $url = 'http://bookless.id/video/video?play='.$input->id;
        $errorCorrectionLevel = 'L';
        $matrixPointSize = 10;
        $uniq = 'qr'.md5($url.'|'.$errorCorrectionLevel.'|'.$matrixPointSize).".png";
        $input->barcode = $uniq ;

        //generate Barcode;
        if ($this->barcode($input)) {
            if ($this->Unggah->simpan($input)) {
                flashMessage('success', 'Data  berhasil disimpan.');
            } else {
                flashMessage('error', 'Data  Gagal disimpan.');
            }
        }         

        redirect('unggah');
    }

    function barcode($input)
    {
        $this->load->helper('download');

        $file = "http://bookless.id/buku/create?data=http://bookless.id/video/video?play=".$input->id;
        $content = file_get_contents($file);
        if(file_put_contents('/var/www/html/video/img/'.$input->barcode, $content)){
            return true;
        }else{
            return false;
        };
        
    }

    /* Upload Gambar */
    function upload_gambar1($fieldname)
    {
        $config_g = [
            'upload_path'      => './upload/',
            'allowed_types'    => 'jpg|png',    // Hanya *.jpg saja
            'max_size'         => 20024,     // 100MB
            // 'max_width'        => 0,
            // 'max_height'       => 0,
            'overwrite'        => true,
            'file_ext_tolower' => true,
        ];

        
        $this->load->library('upload', $config_g);
        $this->upload->initialize($config_g);
        if ($this->upload->do_upload($fieldname)) {
            // Upload OK, return uploaded file info.
            return $this->upload->data();
        } else {
            // Add error to $_error_array
            $this->form_validation->add_to_error_array($fieldname, $this->upload->display_errors('', ''));
            return false;
        }
    }
    /* Upload Video */
    function upload_video1($fieldname)
    {
        $config = [
            'upload_path'      => './upload/',
            'allowed_types'    => 'mp4|3gp',    // Hanya *.mp4 saja
            'max_size'         => 200024,     // 100MB
            // 'max_width'        => 0,
            // 'max_height'       => 0,
            // 'overwrite'        => true,
            // 'file_ext_tolower' => true,
        ];

        
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if ($this->upload->do_upload($fieldname)) {
            // Upload OK, return uploaded file info.
            return $this->upload->data();
        } else {
            // Add error to $_error_array
            $this->form_validation->add_to_error_array($fieldname, $this->upload->display_errors('', ''));
            return false;
        }
    }

    
	public function add()
	{
		
        $input = (object) $this->input->post(null, true);
        if (! $_POST) {
            $input = (object) $this->Operator->getDefaultValues();
        }

        if (! $this->Operator->validate()) {
            $judul    = "Tambah Data";
            $mainView = "operator/form";
            $action = 'operator/add/';
            $button = "Tambah";
            $this->load->view('operator/mainview', compact('judul','operator','mainView','input','action','button'));
            return;
        }


        $data = [
            'username' => $input->username,
            'password' => password_hash($input->password, PASSWORD_DEFAULT),
            'role_user' => 2
        ];

        if ($this->Operator->insert($data)) {
            redirect(base_url('operator'), 'refresh');
        }

        

        flashMessage(
            'error',
            'Username atau password salah.
				Atau akun anda sedang diblokir.'
        );
        redirect('operator', 'refresh');
    }
    
    public function edit($id = null)
    {
        $unggah = $this->db->get_where('data_eltube',['id'=>$id] )->row();
        if (! $unggah) {
            flashMessage('error', 'Data tidak ditemukan!');
            redirect('Unggah', 'refresh');
        }

        $input = (object) $this->input->post(null, true);
        if (! $_POST) {
            $input = (object) $unggah;
        }

        
        /* upload File Gambar */
        if (!empty($_FILES) && $_FILES['gambar']['size'] > 0) {
            $upload_ = $this->Unggah->upload_gambar('gambar');
            if ($upload_ ) {
                $input->gambar =  $upload_['file_name']; 
            }

        }
        /* upload File Video */
        if (!empty($_FILES) && $_FILES['Isi']['size'] > 0) {
            $upload_v = $this->Unggah->upload_video('Isi');
            if ( $upload_v ) {
                $input->Isi =  $upload_v['file_name']; 
            }

        }

        $validate = $this->Unggah->validate();
        if (! $validate || $this->form_validation->error_array()) {
            $judul = 'Halaman Edit Video';
            $mainView = 'unggah/index';
            $action = 'unggah/edit/'.$id;
            $button = 'Ubah';
            $this->load->view('operator/mainview', compact('judul','mainView','input','action','button','unggah'));
            return;
        }


        if ($this->Unggah->where('id', $id)->update($input)) {
            flashMessage('success', 'Data  berhasil diUbah.');
        } else {
            flashMessage('error', 'Data  Gagal diUbah.');
        }     

        redirect('data');
    }
    public function hapus()
    {
        unlink("../../../video/uploads/Logo_Kampung_IT_02.png");
        unlink("../../../video/uploads/candaaan_rosul_pada_nenek-nenek.mp4");
        // redirect(base_url('data'), 'refresh');
    }
	
	public function delete($id=null)
	{
        $unggah = $this->db->get_where('data_eltube',['id'=>$id] )->row();
        if (! $unggah) {
            flashMessage('error', 'Data tidak ditemukan!');
            redirect('Unggah', 'refresh');
        }

        $hapus = $this->Unggah->where('id',$id)->delete();

        if (! $hapus) {
             // delete_files(base_url().'uploads/berkas/c.jpg');
             flashMessage('error', 'Data gagal diHapus!');
        } else {
            unlink("../../../../video/uploads/".$unggah->gambar);
            unlink("../../../../video/uploads/".$unggah->Isi);
            flashMessage('success', 'Data berhasil diHapus.');
        }
        redirect(base_url('data'), 'refresh');
    }
    
    function kategori($id=null)
    {
        $subkategori = $this->db->get_where('subkategori',['id_kategori' => $id])->result();

        $str = '';
        foreach ($subkategori as $s ) {
            $str  .= "<option value='$s->id_subkategori'>$s->nama_subkategori</option>";
        }

        echo $str;
        
    }

    public function modal($modal = null)
    {
        if ($modal == 'kategori') {
            $data = [
                'Judul' => 'Tambah Kategori',
            ];
            return $this->load->view('unggah/kategori',$data);
        } else {
            $data = [
                'Judul' => 'Tambah Sub Kategori',
            ];
            return $this->load->view('unggah/subkategori',$data);
        }
        
    }


}
