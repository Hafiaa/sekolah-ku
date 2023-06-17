<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_biaya_lain extends CI_Model {

	public function get($where=null){
		if ($where) {
			$this->db->where($where);
		}
		return $this->db->get('siswa_biaya_lain');
	}

	public function get_bayar($where=null){
		if ($where) {
			$this->db->where($where);
		}
		return $this->db->get('bayar_biaya_lain');
	}


	public function insert($id_siswa){
		$result = $this->M_siswa->get(['md5(id_siswa)' => $id_siswa])->row();
		$row 	= $this->M_setting->get_biaya_lain(['nama_biaya_lain' => $this->input->post('nama_biaya_lain')])->row();
		return $this->db->insert('siswa_biaya_lain', [
			'id_siswa'					=> $result->id_siswa,
			'nama_biaya_lain'			=> $this->input->post('nama_biaya_lain'),
			'jumlah_biaya_lain'			=> $row->harga_biaya_lain,
			'persen_biaya_lain'			=> $result->persen_biaya_lain,
		]);
	}

	public function insert_bayar($id_siswa, $id_siswa_biaya_lain){
		$siswa_biaya_lain = $this->get(['md5(id_siswa_biaya_lain)' => $id_siswa_biaya_lain])->row();
		$kode_bayar_biaya_lain = 'KDBBL_'.time();
		$this->db->insert('bayar_biaya_lain', [
			'id_siswa_biaya_lain' 		=> $siswa_biaya_lain->id_siswa_biaya_lain,
			'id_siswa'					=> $siswa_biaya_lain->id_siswa,
			'kode_bayar_biaya_lain'		=> $kode_bayar_biaya_lain,
			'jumlah_bayar_biaya_lain'	=> $this->input->post('jumlah_bayar_biaya_lain'),
			'operator'					=> $this->session->userdata('fullname')
		]);
		return $this->M_pemasukan->add($kode_bayar_biaya_lain, $this->input->post('jumlah_bayar_biaya_lain'), 'biaya lain', $this->session->userdata('fullname'));
	}
	// public function update($id_biaya_lain){
	// 	$result = $this->get(['md5(id_biaya_lain)' => $id_biaya_lain])->row();
	// 	if ($result->status_biaya_lain) {
	// 		$this->M_pemasukan->delete($result->kode_biaya_lain);
	// 		$jumlah_biaya_lain = $this->input->post('jumlah_biaya_lain');
	// 		$potong_biaya_lain = (($jumlah_biaya_lain * $result->persen_biaya_lain) / 100);
	// 		$this->M_pemasukan->add($result->kode_biaya_lain, ($jumlah_biaya_lain - $potong_biaya_lain), 'biaya lain');
	// 	}
	// 	return $this->db->update('biaya_lain', [
	// 		'keterangan_biaya_lain'	=> strip_tags(htmlspecialchars($this->input->post('keterangan_biaya_lain'))),
	// 		'jumlah_biaya_lain'		=> $this->input->post('jumlah_biaya_lain')
	// 	], ['md5(id_biaya_lain)' => $id_biaya_lain]);
	// }

	public function delete($id_biaya_lain){
		foreach ($this->get_bayar(['md5(id_siswa_biaya_lain)' => $id_biaya_lain])->result() as $key) {
			$this->delete_bayar(md5($key->id_bayar_biaya_lain));
		}
		return $this->db->delete('siswa_biaya_lain', ['md5(id_siswa_biaya_lain)' => $id_biaya_lain]);
	}
	public function delete_bayar($id_bayar_biaya_lain){
		$this->M_pemasukan->delete($this->get_bayar(['md5(id_bayar_biaya_lain)' => $id_bayar_biaya_lain])->row()->kode_bayar_biaya_lain);
		return $this->db->delete('bayar_biaya_lain', ['md5(id_bayar_biaya_lain)' => $id_bayar_biaya_lain]);
	}

	public function update_status($id_biaya_lain){
		$result =  $this->get(['md5(id_siswa_biaya_lain)' => $id_biaya_lain])->row();
		if ($result->status_siswa_biaya_lain) {			
			$this->M_pemasukan->delete($result->kode_siswa_biaya_lain);
			return $this->db->update('siswa_biaya_lain', ['status_siswa_biaya_lain' => 0], ['md5(id_siswa_biaya_lain)' => $id_biaya_lain]);
		}else{
			$potong_biaya_lain = (($result->jumlah_biaya_lain * $result->persen_biaya_lain) / 100);
			$this->db->update('siswa_biaya_lain', ['status_siswa_biaya_lain' => 1], ['md5(id_siswa_biaya_lain)' => $id_biaya_lain]);
			return $this->M_pemasukan->add($result->kode_siswa_biaya_lain, ($result->jumlah_biaya_lain - $potong_biaya_lain), 'biaya lain');
		}
	}

}

/* End of file M_biaya_lain.php */
/* Location: ./application/models/M_biaya_lain.php */