<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Peminjaman extends CI_Controller {
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
		$this->db->from('peminjam a')->order_by('a.tanggal_peminjaman', 'DESC');
		$this->db->join('buku b','a.buku_id=b.buku_id','left');
		$this->db->where('user_id',$this->session->userdata('user_id'));
		$buku = $this->db->get()->result_array();
		$data = array(
			'judul'     => 'Riwayat Peminjaman',	
			'buku'      => $buku,
		);
		$this->template->load('template', 'peminjam/riwayat', $data);
	}

    public function batal($peminjaman_id){
		$data = array(
			'status_peminjaman' => 'Dibatalkan',
		);
		$where = array(
			'peminjaman_id' => $peminjaman_id,
		);
		$this->db->update('peminjam', $data, $where);
		$this->session->set_flashdata('notifikasi', '
		<div class="alert alert-success alert-dismissible" role="alert">
			Berhasil Membatalkan Peminjaman Buku
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		</div>');
		redirect('peminjam/peminjaman');
	}
}