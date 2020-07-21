<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {

	public function index()
	{
		$baru_upload = $this->Home->query('select * from data_eltube order by date_upload desc limit 12')->result();
        $video = $this->Home->query('select * from data_eltube ORDER BY views DESC limit 6')->result();
        $viewer = $this->Home->query('SELECT * FROM data_eltube ORDER BY RAND() LIMIT 12')->result();
		$judul = "Menu Utama";
		$jumlah     = $this->db->count_all('data_eltube');
		$pagination = $this->Home->makePagination(base_url('home/all'), 3, $jumlah);
        $this->load->view('_template/konten', compact('judul','video','baru_upload','viewer','jumlah','pagination'));

	}

	public function All($page = null)
	{
		$video       = $this->Home->getAllVideo($page);
		$judul       = "Menu Utama";
		$jumlah      = $this->db->count_all('david');
		$pagination  = $this->Home->makePagination(base_url('home/all'), 3, $jumlah);
        $this->load->view('_template/all', compact('judul','video','baru_upload','viewer','jumlah','pagination'));
	}

	
	public function logout()
	{
        $this->Operator->logout();
        redirect(base_url(), 'refresh');
	}


}
