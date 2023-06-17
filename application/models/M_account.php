<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_account extends CI_Model {


	public function get($where=null){
		if ($where) {
			$this->db->where($where);
		}
		return $this->db->get('account');
	}


	public function update_profil(){
		$data  = [
			'fullname'	=> strip_tags(htmlspecialchars($this->input->post('fullname'))),
			'username'	=> strip_tags(htmlspecialchars($this->input->post('username')))
		];
		$config['upload_path'] = './assets/img/account/';
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['max_size']  = '200';

		$this->load->library('upload', $config);
		if ($this->upload->do_upload('foto_account')){
			unlink('./assets/img/account/'.$this->get(['id_account' => $this->session->userdata('id_account')])->row()->foto_account);
			$foto = $this->upload->data();
			$data['foto_account'] = $foto['file_name'];
		}
		return $this->db->update('account' $data, '')

	}
	

}

/* End of file M_account.php */
/* Location: ./application/models/M_account.php */