<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Kategori extends CI_Controller {
	public function __construct(){
		parent::__construct();
		if($this->session->userdata('is_login')==FALSE){
			redirect('auth');
		}
		if($this->session->userdata('role') == 'Peminjam'){
			redirect('home');
		}
		if($this->session->userdata('role') == 'Petugas'){
			redirect('home');
		}
	}

	public function index(){
		$this->db->from('kategori');
		$this->db->order_by('nama_kategori', 'ASC');
		$kategori = $this->db->get()->result_array();
		$data = array(
			'judul'    => 'Halaman Kategori',	
			'kategori' => $kategori,	
		);
		$this->template->load('template', 'admin/kategori_index', $data);
	}

	public function edit($kategori_id){
		$this->db->from('kategori');
		$this->db->where('kategori_id', $kategori_id);  
		$kategori = $this->db->get()->row();  
		$data = array(
			'judul'    => 'Edit Kategori',
			'kategori' => $kategori  // Ganti 'user' menjadi 'kategori' agar lebih konsisten
		);
		$this->template->load('template', 'admin/kategori_edit', $data);
	}

	public function simpan(){
		$this->db->from('kategori')->where('nama_kategori', $this->input->post('nama_kategori'));
		$cek = $this->db->get()->row();
		if($cek == NULL){
			$data = array(
				'nama_kategori' => $this->input->post('nama_kategori'),
			);
			$this->db->insert('kategori', $data);
			$this->session->set_flashdata('notifikasi', '
			<div class="alert alert-success alert-dismissible" role="alert">
				Berhasil Disimpan!
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>');
			redirect('admin/kategori');
		} else {
			$this->session->set_flashdata('notifikasi', '
			<div class="alert alert-danger alert-dismissible" role="alert">
				Gagal Disimpan, kategori sudah ada!
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>');
			redirect('admin/kategori');
		}
	}

	public function update(){
		$data = array(
			'nama_kategori' => $this->input->post('kategori'),
		);
		$where = array(
			'kategori_id' => $this->input->post('kategori_id')
		);
		$this->db->update('kategori', $data, $where);
		$this->session->set_flashdata('notifikasi', '
		<div class="alert alert-success alert-dismissible" role="alert">
			Berhasil Disimpan!
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		</div>');
		redirect('admin/kategori');
	}

	public function hapus($kategori_id){
		$where = array(
			'kategori_id' => $kategori_id
		);
		$this->db->delete('kategori', $where);
		$this->session->set_flashdata('notifikasi', '
			<div class="alert alert-success alert-dismissible" role="alert">
				Berhasil Dihapus!
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>');
		redirect('admin/kategori');
	}
}