<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends CI_Controller {

	// SETTING PROFIL
	public function update_profil(){
		$this->form_validation->set_rules('fullname', 'Full Name', 'trim');
		$this->form_validation->set_rules('username', 'Username', 'trim');
		$this->form_validation->set_rules('password', 'Password', 'trim');
		
		if ($this->form_validation->run() == TRUE) {
			$password = $this->input->post('password');
			$result = $this->db->get_where('account', ['id_account' => $this->session->userdata('id_account')])->row();
			if (password_verify($password, $result->password)) {
				$config['upload_path'] = './assets/img/account/';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['max_size']  = 5000;

				$this->load->library('upload', $config);

				if ( ! $this->upload->do_upload('foto_account')){
					 $check =  $this->db->update('account', [
						'fullname' => $this->input->post('fullname'),
						'username' => $this->input->post('username')
					], ['id_account' => $this->session->userdata('id_account')]);
				}
				else{
					$foto = $this->upload->data();
					unlink('./assets/img/account/'.$result->foto);
					 $check =  $this->db->update('account', [
						'fullname'					=> $this->input->post('fullname'),
						'username'					=> $this->input->post('username'),
						'foto_account'			=> $foto['file_name']
					], ['id_account' 			=> $this->session->userdata('id_account')]);
				}
				if ($check) {
					$this->session->unset_userdata('id_account');
					$this->session->unset_userdata('login');
					$this->session->unset_userdata('username');
					$this->session->unset_userdata('fullname');
					$this->session->unset_userdata('foto_account');
					$this->session->set_flashdata('message', '<div class="alert alert-info"><i class="fa fa-check-square"></i> Edit Profil Berhasil Anda Akan Kembali Kehalaman login, Silahkan login kembali! </div>');
					redirect('auth');

				}else{
					$this->session->set_flashdata('failed', 'Edit Profil Gagal');
					redirect('admin');
				}
			}else{
				$this->session->set_flashdata('failed', 'Confirm Password Salah');
				redirect('admin');
			}
		}
	}

	public function update_password(){
		$this->form_validation->set_rules('pw1', 'Password', 'trim');
		$this->form_validation->set_rules('pw2', 'Password', 'trim');
		if ($this->form_validation->run() == TRUE) {
			$pw1 = $this->input->post('pw1');
			$pw2 = $this->input->post('pw2');
			$password_lama = $this->input->post('password_lama');
			if ($pw1 == $pw2) {
				$result = $this->db->get_where('account', ['id_account' => $this->session->userdata('id_account')])->row();
				if (password_verify($password_lama, $result->password)) {
					if ($this->db->update('account', ['password' => password_hash($pw1, PASSWORD_DEFAULT)], ['id_account' => $this->session->userdata('id_account')])) {
						$this->session->unset_userdata('id');
						$this->session->unset_userdata('login');
						$this->session->unset_userdata('fullname');
						$this->session->unset_userdata('password');
						$this->session->unset_userdata('username');
						$this->session->unset_userdata('foto_account');
						$this->session->set_flashdata('message', '<div class="alert alert-info"><i class="fa fa-check-square"></i> Edit Password Berhasil Anda Akan Kembali Kehalaman login, Silahkan login kembali! </div>');
						redirect('auth');
					}else{
						$this->session->set_flashdata('failed', 'Edit Password Gagal');
						redirect('admin');
					}
				}else{
					$this->session->set_flashdata('failed', 'Cofirm Password Lama Tidak Sesuai');
					redirect('admin');
				}
			}else{
				$this->session->set_flashdata('failed', 'Cofirm Password Tidak Sesuai');
				redirect('admin');
			}
		}
	}

}

/* End of file Account.php */
/* Location: ./application/controllers/admin/Account.php */
