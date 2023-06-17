<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_spp extends CI_Model {

	public function get($where=null){
		if ($where) {
			$this->db->where($where);
		}
		return $this->db->get('spp');
	}



	public function update($id_spp, $status_spp){
		$result = $this->get(['md5(id_spp)' => $id_spp])->row();
		$siswa 	= $this->M_siswa->get(['siswa.id_siswa' => $result->id_siswa])->row();
		if ($status_spp) {
			$this->M_pemasukan->delete($result->kode_spp);
			return $this->db->update('spp', ['status_spp' => 0, 'operator' => ''], ['md5(id_spp)' => $id_spp]);
		}else{
			$potong_spp = ($result->jumlah_spp * $siswa->persen_spp) / 100;
			$this->M_pemasukan->add($result->kode_spp, ($result->jumlah_spp - $potong_spp), 'spp', $this->session->userdata('fullname'));
			return $this->db->update('spp', ['status_spp' => 1, 'persen_spp' => $siswa->persen_spp, 'operator' => $this->session->userdata('fullname')], ['md5(id_spp)' => $id_spp]);
		}
	}


	public function otomatis_spp($id_siswa){
		$siswa = $this->M_siswa->get(['md5(id_siswa)' => $id_siswa])->row();
		$this->db->order_by('id_spp', 'ASC');
		$this->db->limit($this->input->post('jumlah_otomatis_spp'));
		foreach ($this->M_spp->get(['id_siswa' => $siswa->id_siswa, 'status_spp' => 0])->result() as $key) {
			$result = $this->get(['id_spp' => $key->id_spp])->row();
			$potong_spp = ($result->jumlah_spp * $siswa->persen_spp) / 100;
			$this->M_pemasukan->add($result->kode_spp, ($result->jumlah_spp - $potong_spp), 'spp', $this->session->userdata('fullname'));
		 	$this->db->update('spp', ['status_spp' => 1, 'persen_spp' => $siswa->persen_spp, 'operator' => $this->session->userdata('fullname')], ['id_spp' => $key->id_spp]);
		}
		return 1;
	}

}

/* End of file M_spp.php */
/* Location: ./application/models/M_spp.php */