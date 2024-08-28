<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Koleksi extends CI_Controller {
	public function __construct(){
		parent::__construct();
		if($this->session->userdata('is_login') == FALSE){
			redirect('auth');
		}
		if($this->session->userdata('role') == 'Admin'){
			redirect('home');
		}
		if($this->session->userdata('role') == 'Petugas'){
			redirect('home');
		}
	}

    public function index(){
		// Mengambil data buku
		$this->db->from('koleksi a')
		        ->join('buku b','a.buku_id=b.buku_id','left')
		        ->join('kategori c','c.kategori_id=b.buku_id','left')
                ->where('a.user_id', $this->session->userdata('user_id'));
		$buku = $this->db->get()->result_array();
		$data = array(
			'judul'     => 'Halaman Koleksi Buku',	
			'buku'      => $buku,	
		);
		$this->template->load('template', 'peminjam/koleksi', $data);
	}

    public function hapus($buku_id){
		$where = array(
			'buku_id' => $buku_id,
			'user_id' => $this->session->userdata('user_id'),
		);
		$this->db->delete('koleksi', $where);
		$this->session->set_flashdata('notifikasi', '
			<div class="alert alert-success alert-dismissible" role="alert">
				Berhasil Dihapus!
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>');
		redirect('peminjam/koleksi');
	}
}