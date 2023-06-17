<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_jurusan extends CI_Model {

	public function get($where=null){
		if ($where) {
			$this->db->where($where);
		}
		return $this->db->get('jurusan');
	}

	public function insert(){
		return $this->db->insert('jurusan', [
			'nama_jurusan' 	=> strip_tags(htmlspecialchars($this->input->post('nama_jurusan'))),
			'harga_spp'		=> $this->input->post('harga_spp') 
		]);
	}

	public function update($id_jurusan){
		return $this->db->update('jurusan', [
			'nama_jurusan' => strip_tags(htmlspecialchars($this->input->post('nama_jurusan'))),
			'harga_spp'	   => $this->input->post('harga_spp')
		], ['md5(id_jurusan)' => $id_jurusan]);
	}

	public function delete($id_jurusan){
		if ($this->db->get_where('siswa', ['id_jurusan' => $id_jurusan])->num_rows()) {
			return false;
		}else{
			return $this->db->delete('jurusan', ['md5(id_jurusan)' => $id_jurusan]);
		}
	}



}

/* End of file M_jurusan.php */
/* Location: ./application/models/M_jurusan.php */