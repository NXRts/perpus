<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Auth extends CI_Controller {
	public function index(){
		$data = array(
			'judul' => 'Login',	
		);
		$this->load->view('login', $data);
	}

	public function profile($user_id){
		$this->db->from('user');
		$this->db->where('user_id',$user_id);
		$user = $this->db->get()->row();
		$data = array(
			'judul' => 'Edit Profile',	
			'user'  => $user,	
		);
		$this->template->load('template','profile', $data);
	}

	public function password(){
		$data = array(
			'judul' => 'Ganti password',
		);
		$this->template->load('template','password', $data);
	}

	public function updatePassword(){
		$user_id = $this->session->userdata('user_id');
		$passwordBaru = $this->input->post('passwordBaru');
		$passwordKonf = $this->input->post('passwordKonf');
	
		$this->db->from('user')->where('user_id',$user_id);
		$passwordDatabase = $this->db->get()->row()->password;
		if($passwordBaru<>$passwordKonf){
			$this->session->set_flashdata('notifikasi','		
			<div class="alert alert-danger alert-dismissible" role="alert">
				Konfirmasi tidak ditemukan!
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>');
			redirect('auth/password');
		} else {
			$data = array(
				'password' =>  md5($passwordBaru),
			);
			$where = array(
				'user_id' => $user_id,
			);
			$this->db->update('user',$data, $where);  
			$this->session->set_flashdata('notifikasi','
			<div class="alert alert-success alert-dismissible" role="alert">
				Password berhasil Disimpan!
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>');
			redirect('auth/password');
		}
	}

	public function update(){
		$data = array(
			'nama_lengkap' => $this->input->post('nama'),
			'alamat'       => $this->input->post('alamat'),
			'email'        => $this->input->post('email'),
		);
		$where = array(
			'user_id' => $this->input->post('user_id')
		);
		$this->db->update('user',$data, $where);
		$this->session->set_userdata($data);
		$this->session->set_flashdata('notifikasi','
		<div class="alert alert-success alert-dismissible" role="alert">
			Berhasil Disimpan!
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		</div>');
		redirect('auth/profile');
		
	}

	public function register(){
		$data = array(
			'judul' => 'Register',	
		);
		$this->load->view('register', $data);
	}

	public function logout(){
		$this->session->sess_destroy();
        redirect('auth');
	}

    public function login(){
        $username = $this->input->post('username');
        $password = md5($this->input->post('password'));
        $this->db->from('user')->where('username',$username);
        $data = $this->db->get()->row();
        if($data==NULL){
            $this->session->set_flashdata('notifikasi','
			<div class="alert alert-danger alert-dismissible" role="alert">
				Username tidak ditemukan!
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>');
			redirect('auth');
        } else if($data->password==$password){
            // berhasil login 
            $data = array(
                'is_login'     => TRUE,
				'username'     => $data->username,
				'user_id'      => $data->user_id,
				'nama_lengkap' => $data->nama_lengkap,
				'alamat'       => $data->alamat,
				'email'        => $data->email,
				'role'         => $data->role,
			);
            $this->session->set_userdata($data);
            redirect('home');
        } else {
            $this->session->set_flashdata('notifikasi','
			<div class="alert alert-danger alert-dismissible" role="alert">
				Password salah!
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>');
			redirect('auth');
        }
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
				'role'         => 'peminjam',
			);
			$this->db->insert('user',$data);
			$this->session->set_flashdata('notifikasi','
			<div class="alert alert-success alert-dismissible" role="alert">
				Berhasil register silahkan login!
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>');
			redirect('auth');
		} else {
			$this->session->set_flashdata('notifikasi','
			<div class="alert alert-danger alert-dismissible" role="alert">
				Username sudah digunakan!
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>');
			redirect('auth/	');
		}
	}
}