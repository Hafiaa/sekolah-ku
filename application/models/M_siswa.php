<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_siswa extends CI_Model {

	public function get($where=null){
		$this->db->select('*');
		$this->db->from('siswa');
		$this->db->join('kelas', 'siswa.id_kelas = kelas.id_kelas');
		$this->db->join('jurusan', 'siswa.id_jurusan  = jurusan.id_jurusan');
		if ($where) {
			$this->db->where($where);
		}
		return $this->db->get();
	}

	public function insertimport($data)
    {
        $this->db->insert('siswa', $data);
        return $this->db->insert_id();
    }

	public function insert(){
		$data = [
			'nisn' 					=> strip_tags(htmlspecialchars($this->input->post('nisn'))),
			'nama_siswa'			=> strip_tags(htmlspecialchars($this->input->post('nama_siswa'))),
			'id_kelas'				=> strip_tags(htmlspecialchars($this->input->post('id_kelas'))),
			'id_jurusan'			=> strip_tags(htmlspecialchars($this->input->post('id_jurusan'))),
			'tempat_lahir'			=> strip_tags(htmlspecialchars($this->input->post('tempat_lahir'))),
			'tanggal_lahir'			=> strip_tags(htmlspecialchars($this->input->post('tanggal_lahir'))),
			'beasiswa'				=> strip_tags(htmlspecialchars($this->input->post('beasiswa'))),
			'persen_spp'			=> $this->input->post('persen_spp'),
			'persen_baju_seragam'	=> $this->input->post('persen_baju_seragam'),
			'persen_biaya_lain'		=> $this->input->post('persen_biaya_lain'),
			'uang_seragam'			=> $this->M_setting->get('harga_seragam')->row()->value,
		];
		

		if($this->db->insert('siswa', $data)){
			$bulan = ['Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni'];
			$id_siswa = $this->db->insert_id();
			$siswa = $this->get(['siswa.id_siswa' => $id_siswa])->row();
			$harga_spp = $this->M_jurusan->get(['id_jurusan' => $siswa->id_jurusan])->row()->harga_spp;
			foreach ($this->M_kelas->get()->result() as $key) {
				if ($key->id_kelas != 4 && $key->id_kelas >= $siswa->id_kelas) {
					for ($i=0; $i < 12; $i++) { 
						$this->db->insert('spp', [
							'kode_spp' 		=> 'KDS_'.$id_siswa.$key->id_kelas.$i,
							'id_siswa'		=> $id_siswa,
							'id_kelas' 		=> $key->id_kelas,
							'bulan'			=> $bulan[$i],
							'jumlah_spp'	=> $harga_spp
						]);
					}
				}
			}
			return TRUE;
		}else{
			return FALSE;
		}

	}

	public function update($id_siswa){
		$data = [
			'nisn' 					=> strip_tags(htmlspecialchars($this->input->post('nisn'))),
			'nama_siswa'			=> strip_tags(htmlspecialchars($this->input->post('nama_siswa'))),
			'id_kelas'				=> strip_tags(htmlspecialchars($this->input->post('id_kelas'))),
			'id_jurusan'			=> strip_tags(htmlspecialchars($this->input->post('id_jurusan'))),
			'tempat_lahir'			=> strip_tags(htmlspecialchars($this->input->post('tempat_lahir'))),
			'tanggal_lahir'			=> strip_tags(htmlspecialchars($this->input->post('tanggal_lahir'))),
			'beasiswa'				=> strip_tags(htmlspecialchars($this->input->post('beasiswa'))),
			'persen_spp'			=> $this->input->post('persen_spp'),
			'persen_baju_seragam'	=> $this->input->post('persen_baju_seragam'),
			'persen_biaya_lain'		=> $this->input->post('persen_biaya_lain'),
		];

		$this->db->update('siswa', $data, ['md5(id_siswa)' => $id_siswa]);

		$bulan = ['Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni'];
		$siswa = $this->get(['md5(siswa.id_siswa)' => $id_siswa])->row();
		$harga_spp = $this->M_jurusan->get(['id_jurusan' => $siswa->id_jurusan])->row()->harga_spp;
		foreach ($this->M_kelas->get()->result() as $key) {
			if ($key->id_kelas != 4 && $key->id_kelas >= $siswa->id_kelas) {
				if ($this->M_spp->get(['id_siswa' => $siswa->id_siswa, 'id_kelas' => $key->id_kelas])->num_rows() == 0) {
					for ($i=0; $i < 12; $i++) { 
						$this->db->insert('spp', [
							'kode_spp' 		=> 'KDS_'.$siswa->id_siswa.$key->id_kelas.$i,
							'id_siswa'		=> $siswa->id_siswa,
							'id_kelas' 		=> $key->id_kelas,
							'bulan'			=> $bulan[$i],
							'jumlah_spp'	=> $harga_spp
						]);
					}
				}
			}
		}
		return 1;
	}

	public function delete($id_siswa){
		$this->db->delete('spp', ['md5(id_siswa)' 					=> $id_siswa]);
		$this->db->delete('seragam', ['md5(id_siswa)' 				=> $id_siswa]);
		$this->db->delete('siswa_biaya_lain', ['md5(id_siswa)' 		=> $id_siswa]);
		$this->db->delete('bayar_biaya_lain', ['md5(id_siswa)' 		=> $id_siswa]);
		$this->db->delete('tabungan', ['md5(id_siswa)' => $id_siswa]);
		return $this->db->delete('siswa', ['md5(id_siswa)' 			=> $id_siswa]);
	}



	// kenaikan kelas 
	public function update_naik_kelas($data, $where){
		return $this->db->update('siswa', $data, $where);
	}
	// end kenaikan kelas



}

/* End of file M_siswa.php */
/* Location: ./application/models/M_siswa.php */