<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori extends Operator_Controller {
    
	public function __construct()
    {
        parent::__construct();
        $this->load->library(array('form_validation'));
    }

    public function index()
    {
        $input = (object) $this->input->post(null,true);
        if (! $_POST) {
            $input = (object) $this->Kategori->getDefaultValues();
        }

        $judul = 'Halaman Kategori';
        $mainView = 'kategori/index';
        $action = 'unggah';
        $button = 'Upload';
        $this->load->view('operator/mainview', compact('judul','mainView','input'));
        
    }

    public function hapuskategori($id=null)
    {
        $hapus = $this->Kategori->where('id_kategori',$id)->delete();
        if (! $hapus) {
            flashMessage('error', 'Data gagal diHapus!');
        } else {
            flashMessage('success', 'Data berhasil diHapus.');
        }
        return true;
        
    }

    public function ubahkategori()
    {
        $this->form_validation->set_rules('nama_kategori', 'Nama Kategori', 'trim|required');

        if ($this->form_validation->run() == FALSE)
        {
            return $this->index();
        }else{
            $data = [
                'nama_kategori' => $_POST['nama_kategori'],
            ];
            $id = ['id_kategori' => $_POST['id_kategori']];
            $ubah = $this->db->update('kategori',$data,$id);
            if (! $ubah) {
                flashMessage('error', 'Data gagal diUbah!');
            } else {
                flashMessage('success', 'Data '.$_POST['nama_kategori'].' berhasil diUbah.');
            }
        }

        
        redirect('kategori');
    }

    public function hapussubkategori($id=null)
    {
        $hapus = $this->db->where('id_subkategori',$id)->delete('subkategori');
        if (! $hapus) {
            flashMessage('error', 'Data gagal diHapus!');
        } else {
            flashMessage('success', 'Data berhasil diHapus.');
        }
        return true;
        
    }

    public function ubahsubkategori()
    {
        $this->form_validation->set_rules('nama_subkategori', 'Nama Sub Kategori', 'trim|required');

        if ($this->form_validation->run() == FALSE)
        {
            return $this->index();
        }else{
            $data = [
                'nama_subkategori' => $_POST['nama_subkategori'],
            ];
            $id = ['id_subkategori' => $_POST['id_subkategori']];
            $ubah = $this->db->update('subkategori',$data,$id);
            if (! $ubah) {
                flashMessage('error', 'Data gagal diUbah!');
            } else {
                flashMessage('success', 'Data '.$_POST['nama_subkategori'].' berhasil diUbah.');
            }
        }

        
        redirect('kategori');
    }

    
    public function modalubah($modal = null,$id =null)
    {
        if ($modal == 'kategori') {
            $data = [
                'Judul' => 'Ubah Kategori',
                'id' => '1',
                'kategori' => $this->db->get_where('kategori',['id' => 1])->row(),
            ];
            return $this->load->view('kategori/modal',$data);
        } else {
            $data = [
                'Judul' => 'Tambah Sub Kategori',
            ];
            return $this->load->view('kategori/modal',$data);
        }
        
    }



}
