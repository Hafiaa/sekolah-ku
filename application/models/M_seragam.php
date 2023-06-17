<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_seragam extends CI_Model {

	public function get($where){
		if ($where) {
			$this->db->where($where);
		}
		return $this->db->get('seragam');
	}	



	public function add($id_siswa){
		$id_siswa = $this->M_siswa->get(['md5(id_siswa)' => $id_siswa])->row()->id_siswa;
		$kode_seragam = 'KDBS_'.time();
		$this->M_pemasukan->add($kode_seragam, $this->input->post('jumlah_seragam'), 'baju seragam', $this->session->userdata('fullname'));
		return $this->db->insert('seragam', [
			'id_siswa'			=> $id_siswa,
			'kode_seragam'		=> $kode_seragam,
			'jumlah_seragam'	=> $this->input->post('jumlah_seragam'),
			'operator'			=> $this->session->userdata('fullname')
		]);
	}


	public function delete($id_seragam){
		$kode_pemasukan = $this->M_seragam->get(['md5(id_seragam)' => $id_seragam])->row()->kode_seragam;
		$this->M_pemasukan->delete($kode_pemasukan);
		return $this->db->delete('seragam', ['md5(id_seragam)' => $id_seragam]);
	}

}

/* End of file M_seragam.php */
/* Location: ./application/models/M_seragam.php */