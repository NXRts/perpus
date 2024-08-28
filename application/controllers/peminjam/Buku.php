<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Buku extends CI_Controller {
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
		$this->db->from('buku a')->order_by('a.judul', 'ASC');
		$this->db->join('kategori b','a.kategori_id=b.kategori_id','left');
		$buku = $this->db->get()->result_array();
		// Mengambil data kategori
		$this->db->from('kategori')->order_by('nama_kategori', 'ASC');
		$kategori = $this->db->get()->result_array();

		$data = array(
			'judul'     => 'Halaman Buku',	
			'buku'      => $buku,	
			'kategori'  => $kategori,	
		);
		$this->template->load('template', 'peminjam/buku', $data);
	}

	public function ulasan($buku_id){
		// Mengambil data buku berdasarkan ID
		$this->db->from('buku')->where('buku_id', $buku_id);
		$buku = $this->db->get()->row_array(); // Mengambil satu baris data sebagai array asosiatif
		// Mengambil data user
		$this->db->from('ulasanbuku a');
		$this->db->join('user b','a.user_id=b.user_id','left');
		$this->db->where('a.buku_id', $buku_id);
		$ulasan = $this->db->get()->result_array(); // Mengambil satu baris data sebagai array asosiatif
		$data = array(
			'judul'     => 'Halaman Ulasan Buku',	
			'buku'      => $buku,
			'ulasan'    => $ulasan,
		);
		$this->template->load('template', 'peminjam/ulasan', $data);
	}

    public function ajukan($buku_id){
        // Mengambil data buku berdasarkan ID dan menggabungkan dengan tabel kategori
        $this->db->from('buku a');
        $this->db->join('kategori b', 'a.kategori_id = b.kategori_id', 'left');
        $this->db->where('a.buku_id', $buku_id);
        $buku = $this->db->get()->row_array(); // Mengambil satu baris data sebagai array asosiatif
    
        $data = array(
            'judul' => 'Peminjaman',
            'buku' => $buku,
        );
        $this->template->load('template', 'peminjam/ajukan', $data);
    }
    
	public function pinjam(){
        $this->db->from('peminjam')
                 ->where('buku_id', $this->input->post('buku_id'))
                 ->where('status_peminjaman', 'Proses');
        $cek = $this->db->get()->row();
        if($cek==NULL){
            $data = array(
                'buku_id' => $this->input->post('buku_id'),
                'user_id' => $this->session->userdata('user_id'),
                'tanggal_peminjaman' => $this->input->post('tanggal_peminjaman'),
                'status_peminjaman' => 'Proses',
                
            );
            $this->db->insert('peminjam', $data);
            $this->session->set_flashdata('notifikasi', '
            <div class="alert alert-success" role="alert">
                berhasil mengajukan peminjaman, silahkan tunggu konfirmasi oleh admin.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>');
            redirect('peminjam/buku'); 
        } else {
            $this->session->set_flashdata('notifikasi', '
            <div class="alert alert-success" role="alert">
                Anda sudah mengajukan peminjaman atau sudah ada yang mengajukan peminjaman buku oleh orang lain, silahkan tunggu konfirmasi oleh admin.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>');
            redirect('peminjam/buku'); 
        }
    }  

	public function add_koleksi($buku_id){
		$this->db->from('koleksi')
                 ->where('buku_id', $buku_id)
                 ->where('user_id', $this->session->userdata('user_id'));
        $cek = $this->db->get()->row();
		if($cek==NULL){
			$data = array(
				'buku_id' => $buku_id,
				'user_id' => $this->session->userdata('user_id'),
			);
			$this->db->insert('koleksi', $data);
			$this->session->set_flashdata('notifikasi', '
			<div class="alert alert-success" role="alert">
				berhasil menambah koleksi buku.
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>');
			redirect('peminjam/buku'); 
    	} else {
			$this->session->set_flashdata('notifikasi', '
			<div class="alert alert-danger" role="alert">
				anda sudah menambah koleksi buku sebelumnya.
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>');
			redirect('peminjam/buku'); 
		} 
	}

	public function submit_ulasan(){
		$data = array(
			'buku_id' => $this->input->post('buku_id'),
			'user_id' => $this->session->userdata('user_id'),
			'ulasan'  => $this->input->post('ulasan'),
			'rating'  => $this->input->post('rating'),
		);
		$this->db->insert('ulasanbuku', $data);
		$this->session->set_flashdata('notifikasi', '
		<div class="alert alert-success" role="alert">
			Anda berhasil memberikan ulasan!
		<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		</div>');
		redirect('peminjam/buku'); 
	}

	public function ulasanhapus($buku_id){
		$where = array(
			'buku_id' => $buku_id,
			'user_id' => $this->session->userdata('user_id'),
		);
		$this->db->delete('ulasanbuku', $where);
		$this->session->set_flashdata('notifikasi', '
			<div class="alert alert-success alert-dismissible" role="alert">
				Ulasan Berhasil Dihapus!
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>');
		redirect('peminjam/buku/ulasan/'.$buku_id);
	}
}