<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_pengeluaran extends CI_Model {

	public function get($where=null){
		$this->db->order_by('tanggal_pengeluaran', 'DESC');
		if ($where) {
			$this->db->where($where);
		}
		return $this->db->get('pengeluaran');
	}


	public function insert(){
		return $this->db->insert('pengeluaran', [
			'jumlah_pengeluaran'		=> $this->input->post('jumlah_pengeluaran'),
			'keterangan_pengeluaran'	=> $this->input->post('keterangan_pengeluaran'),
			'operator'					=> $this->session->userdata('fullname')
		]);
	}

	public function update($id_pengeluaran){
		return $this->db->update('pengeluaran', [
			'jumlah_pengeluaran'		=> $this->input->post('jumlah_pengeluaran'),
			'keterangan_pengeluaran'	=> $this->input->post('keterangan_pengeluaran'),
			'operator'					=> $this->session->userdata('fullname')
		], ['md5(id_pengeluaran)' => $id_pengeluaran]);
	}


	public function delete($id_pengeluaran){
		return $this->db->delete('pengeluaran', ['md5(id_pengeluaran)' => $id_pengeluaran]);
	}

	public function reset(){
		return $this->db->empty_table('pengeluaran');
	}

}

/* End of file M_pengeluaran.php */
/* Location: ./application/models/M_pengeluaran.php */