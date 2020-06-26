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
            $this->load->view('operator/index', compact('input'));
            return;
        }

        if ($this->Operator->login($input)) {
            redirect(base_url('admin'), 'refresh');
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
            $judul    = "";
            $mainView = "operator/form";
            $this->load->view('operator/mainview', compact('judul','operator','mainView'));
            return;
        }

        $update = $this->Operator->update($id, $input);
        if (! $update) {
            flashMessage('error', 'Data gagal diupdate!');
        } else {
            flashMessage('success', 'Data berhasil diupdate.');
        }

        redirect('phonebook-contact', 'refresh');
    }

	
	public function logout()
	{
        $this->Operator->logout();
        redirect(base_url(), 'refresh');
	}


}