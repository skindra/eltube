<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Operator extends Admin_Controller {


    public function index()
    {
        $user = $this->Operator->getAll();
        $judul = 'Halaman Operator User';
        $mainView = 'operator/index';
        $this->load->view('operator/mainview', compact('judul','user','mainView'));
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
    
    public function kategori()
    {
        $data = [
            'nama_kategori' => $_POST['kategori'],
        ];

        if($this->db->insert('kategori',$data)){
            flashMessage('success', 'kategori berhasil tambah.');
        } else {
            flashMessage('error', 'kategori gagal tambah!');
        }
        redirect('unggah');
    }


    public function subkategori()
    {
        $data = [
            'nama_subkategori' => $_POST['nama_subkategori'],
            'id_kategori' => $_POST['id_kategori'],
        ];

        if($this->db->insert('subkategori',$data)){
            flashMessage('success', 'subkategori berhasil tambah.');
        } else {
            flashMessage('error', 'subkategori gagal tambah!');
        }
        redirect('unggah');
    }


}
