<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Unggah extends Operator_Controller {
    
	public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }

    public function index()
    {
        $input = (object) $this->input->post(null,true);
        if (! $_POST) {
            $input = (object) $this->Unggah->getDefaultValues();
        }

        /* upload File */
        
        if (!empty($_FILES) && $_FILES['gambar']['size'] > 0) {
            $upload_ = $this->upload_gambar('gambar');
            if ($upload_) {
                $input->gambar =  $upload_['file_name']; 
            }

        }
        if (!empty($_FILES) && $_FILES['Isi']['size'] > 0) {
            $upload_v = $this->upload_video('Isi');
            if ($upload_v) {
                $input->Isi =  $upload_v['file_name']; 
            }

        }

        

        if (! $this->Unggah->validate() || $this->form_validation->error_array() ) {
            $judul = 'Halaman Unggah Video';
            $mainView = 'unggah/index';
            $action = 'unggah/';
            $button = 'Upload';
            $this->load->view('operator/mainview', compact('judul','user','mainView','input','action','button'));
            return;
        }

        if ($this->Unggah->insert($input)) {
            flashMessage('success', 'Data  berhasil disimpan.');
        } else {
            flashMessage('error', 'Data  Gagal disimpan.');
        }

        redirect('unggah');
    }

    /* Upload Gambar */
    function upload_gambar($fieldname)
    {
        $config_g = [
            'upload_path'      => './upload/',
            'allowed_types'    => 'mp4|3gp|flv',    // Hanya *.jpg saja
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
    function upload_video($fieldname)
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
        $operator = $this->Operator->find('id_user',$id);
        if (! $operator) {
            flashMessage('error', 'Data tidak ditemukan!');
            redirect('operator', 'refresh');
        }

        $input = (object) $this->input->post(null, true);
        if (! $_POST) {
            $input = (object) $operator;
        }

        $validate = $this->Operator->validate();
        if (! $validate) {
            $judul    = "Edit Data";
            $mainView = "operator/form";
            $action = 'operator/edit/'.$id;
            $button = "Ubah";
            $this->load->view('operator/mainview', compact('judul','operator','mainView','input','action','button'));
            return;
        }

        $data = [
            'username' => $input->username,
            'password' => password_hash($input->password, PASSWORD_DEFAULT),
        ];

        $update = $this->Operator->where('id_user',$id)->update($data);
        if (! $update) {
            flashMessage('error', 'Data gagal diupdate!');
        } else {
            flashMessage('success', 'Data berhasil diupdate.');
        }

        redirect(base_url('operator'), 'refresh');
    }

	
	public function hapus($id=null)
	{
        $hapus =  $this->Operator->where('id_user',$id)->where('role_user',2)->delete();
        if (! $hapus) {
            flashMessage('error', 'Data gagal diHapus!');
        } else {
            flashMessage('success', 'Data berhasil diHapus.');
        }
        redirect(base_url('operator'), 'refresh');
    }
    
    function kategori($id=null)
    {
        $subkategori = $this->db->get_where('subkategori',['id_kategori' => $id])->result();

        $str = '';
        foreach ($subkategori as $s ) {
            $str  .= "<option value='$s->id_sub_kategori'>$s->nama_subkategori</option>";
        }

        echo $str;
        
    }


}
