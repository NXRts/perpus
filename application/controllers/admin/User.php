<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class User extends CI_Controller {
	public function __construct(){ // underscore 2 kali
		parent:: __construct();
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
		$this->db->from('user');
		$this->db->order_by('nama_lengkap','ASC');
		$user = $this->db->get()->result_array();
		$data = array(
			'judul' => 'User',	
			'user'  => $user,	
		);
		$this->template->load('template','admin/user_index', $data);
	}

	public function edit($user_id){
		$this->db->from('user');
		$this->db->where('user_id', $user_id);  // Mengambil data berdasarkan user_id
		$user = $this->db->get()->row();  // Mengambil satu baris data
		$data = array(
			'judul' => 'Edit User',
			'user'  => $user,
		);
		$this->template->load('template','admin/user_edit', $data);
	}
	
	public function simpan(){
		$this->db->from('user')->where('username',$this->input->post('username'));
		$cek = $this->db->get()->row();
		if($cek==NULL){
			$data = array(
				'username'     => $this->input->post('username'),
				'password'     => md5($this->input->post('password')),
				'nama_lengkap' => $this->input->post('nama'),
				'alamat'       => $this->input->post('alamat'),
				'email'        => $this->input->post('email'),
				'role'         => $this->input->post('role'),
			);
			$this->db->insert('user',$data);
			$this->session->set_flashdata('notifikasi','
			<div class="alert alert-success alert-dismissible" role="alert">
				Berhasil Disimpan!
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>');
			redirect('admin/user');
		} else {
			$this->session->set_flashdata('notifikasi','
			<div class="alert alert-danger alert-dismissible" role="alert">
				Gagal Disimpan!
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>');
			redirect('admin/user');
		}
	}

	public function update(){
		$data = array(
			'nama_lengkap' => $this->input->post('nama'),
			'alamat'       => $this->input->post('alamat'),
			'email'        => $this->input->post('email'),
			'role'         => $this->input->post('role'),
		);
		$where = array(
			'user_id' => $this->input->post('user_id')
		);
		$this->db->update('user',$data, $where);
		$this->session->set_flashdata('notifikasi','
		<div class="alert alert-success alert-dismissible" role="alert">
			Berhasil Disimpan!
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		</div>');
		redirect('admin/user');
	}

	public function hapus($user_id){
		$where = array(
			'user_id' => $user_id
		);
		$this->db->delete('user',$where);
		$this->session->set_flashdata('notifikasi','
			<div class="alert alert-success alert-dismissible" role="alert">
				Berhasil Dihapus!
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>');
			redirect('admin/user');
	}

}
