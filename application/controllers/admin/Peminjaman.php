<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Peminjaman extends CI_Controller {
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
		$this->db->from('peminjam a')->order_by('a.tanggal_peminjaman', 'DESC');
		$this->db->join('buku b','a.buku_id=b.buku_id','left');
		$this->db->join('user c','a.user_id=c.user_id','left');
		$this->db->order_by('a.peminjaman_id', 'DESC');

		$buku = $this->db->get()->result_array();
		$data = array(
			'judul'     => 'Data Peminjaman',	
			'buku'      => $buku,
		);
		$this->template->load('template', 'admin/peminjaman', $data);
	}

	public function laporan(){
		$tanggal1 = $this->input->get('tanggal1');
		$tanggal2 = $this->input->get('tanggal2');
		$status = $this->input->get('status');
		$this->db->from('peminjam a')->order_by('a.tanggal_peminjaman','DESC');
        $this->db->join('buku b','a.buku_id=b.buku_id','left');
        $this->db->join('user c','a.user_id=c.user_id','left');
        $this->db->order_by('a.peminjaman_id','DESC');
        $this->db->where('a.tanggal_peminjaman >=',$tanggal1);
        $this->db->where('a.tanggal_peminjaman <=',$tanggal2);
		if($status!=='-'){
			$this->db->where('a.status_peminjaman',$status);
		}
		$buku = $this->db->get()->result_array();
		$data = array(
			'judul'		    => 'Data Peminjaman Buku',
			'buku'          => 	$buku,
		);
		$this->load->view('admin/laporan', $data);
	}


    public function tolak($peminjaman_id){
		$data = array(
			'status_peminjaman' => 'Ditolak',
		);
		$where = array(
			'peminjaman_id' => $peminjaman_id,
		);
		$this->db->update('peminjam', $data, $where);
		$this->session->set_flashdata('notifikasi', '
		<div class="alert alert-success alert-dismissible" role="alert">
			Anda telah menolak Peminjaman Buku
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		</div>');
		redirect('admin/peminjaman');
	}

    public function terima($peminjaman_id, $buku_id){
		$data = array(
			'status_peminjaman' => 'Dipinjam',
		);
		$where = array(
			'peminjaman_id' => $peminjaman_id,
		);
		$this->db->update('peminjam', $data, $where);
		$data = array(
			'status' => 'Dipinjam',
		);
		$where = array(
			'buku_id' => $buku_id,
		);
		$this->db->update('buku', $data, $where);
		$this->session->set_flashdata('notifikasi', '
		<div class="alert alert-success alert-dismissible" role="alert">
			Anda telah menerima Peminjaman Buku
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		</div>');
		redirect('admin/peminjaman');
	}

    public function kembali($peminjaman_id, $buku_id){
		$data = array(
			'status_peminjaman' => 'Sudah Kembali',
			'tanggal_pengembalian'           => date('Y-m-d'),
		);
		$where = array(
			'peminjaman_id' => $peminjaman_id,
		);
		$this->db->update('peminjam', $data, $where);
		$data = array(
			'status' => 'Tersedia',
		);
		$where = array(
			'buku_id' => $buku_id,
		);
		$this->db->update('buku', $data, $where);
		$this->session->set_flashdata('notifikasi', '
		<div class="alert alert-success alert-dismissible" role="alert">
			Anda telah menerima Peminjaman Buku
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		</div>');
		redirect('admin/peminjaman');
	}
}