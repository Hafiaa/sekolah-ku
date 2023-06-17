<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_tabungan extends CI_Model {

	public function get($where=null){
		if ($where) {
			$this->db->where($where);
		}
		return $this->db->get('tabungan');
	}

	public function insert($id_siswa, $jumlah_tabungan, $status_tabungan){
		$siswa = $this->M_siswa->get(['md5(id_siswa)' => $id_siswa])->row();
		return $this->db->insert('tabungan', [
			'id_siswa'			=> $siswa->id_siswa,
			'jumlah_tabungan'	=> $jumlah_tabungan,
			'status_tabungan'	=> $status_tabungan,
			'operator'			=> $this->session->userdata('fullname')
		]);
	}

	public function delete($id_tabungan){
		return $this->db->delete('tabungan', ['md5(id_tabungan)' => $id_tabungan]);
	}

}

/* End of file M_tabungan.php */
/* Location: ./application/models/M_tabungan.php */