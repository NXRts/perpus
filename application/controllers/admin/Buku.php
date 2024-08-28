<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Buku extends CI_Controller {
	public function __construct(){
		parent::__construct();
		if($this->session->userdata('is_login') == FALSE){
			redirect('auth');
		}
		if($this->session->userdata('role') == 'Peminjam'){
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
		$this->template->load('template', 'admin/buku_index', $data);
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
		$this->template->load('template', 'admin/ulasan', $data);
	}


	public function edit($buku_id){
		if($this->session->userdata('role') == 'Petugas'){
			redirect('home');
		};
		// Mengambil data buku berdasarkan ID
		$this->db->from('buku')->where('buku_id', $buku_id);
		$buku = $this->db->get()->row_array(); // Mengambil satu baris data sebagai array asosiatif
		// Mengambil data kategori
		$this->db->from('kategori')->order_by('nama_kategori', 'ASC');
		$kategori = $this->db->get()->result_array();
	
		$data = array(
			'judul'     => 'Halaman Edit Buku',	
			'buku'      => $buku,	
			'kategori'  => $kategori,
		);
		$this->template->load('template', 'admin/buku_edit', $data);
	}
	

	public function simpan(){
		$this->db->from('buku')->where('judul', $this->input->post('judul'));
		$cek = $this->db->get()->row();
		if($cek == NULL){
			$data = array(
				'judul'        => $this->input->post('judul'),
				'penerbit'     => $this->input->post('penerbit'),
				'penulis'      => $this->input->post('penulis'),
				'tahun_terbit' => $this->input->post('tahun_terbit'),
				'kategori_id'  => $this->input->post('kategori_id'),
				'status'       => 'Tersedia',
			);
			$this->db->insert('buku', $data);
			$this->session->set_flashdata('notifikasi', '
			<div class="alert alert-success alert-dismissible" role="alert">
				Berhasil Disimpan!
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>');
			redirect('admin/buku');
		} else {
			$this->session->set_flashdata('notifikasi', '
			<div class="alert alert-danger alert-dismissible" role="alert">
				Gagal Disimpan, buku sudah ada!
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>');
			redirect('admin/buku');
		}
	}

	public function update(){
		$data = array(
			'judul'        => $this->input->post('judul'),
			'penerbit'     => $this->input->post('penerbit'),
			'penulis'      => $this->input->post('penulis'),
			'tahun_terbit' => $this->input->post('tahun_terbit'),
			'kategori_id'  => $this->input->post('kategori_id'),
		);
		$where = array(
			'buku_id' => $this->input->post('buku_id')
		);
		$this->db->update('buku', $data, $where);
		$this->session->set_flashdata('notifikasi', '
		<div class="alert alert-success alert-dismissible" role="alert">
			Berhasil Disimpan!
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		</div>');
		redirect('admin/buku');
	}

	public function hapus($buku_id){
		if($this->session->userdata('role') == 'Petugas'){
			redirect('home');
		};
		$where = array(
			'buku_id' => $buku_id
		);
		$this->db->delete('buku', $where);
		$this->session->set_flashdata('notifikasi', '
			<div class="alert alert-success alert-dismissible" role="alert">
				Berhasil Dihapus!
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>');
		redirect('admin/buku');
	}
}