<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_pemasukan extends CI_Model {

	public function get($where = null){
		$this->db->order_by('tanggal_pemasukan', 'DESC');
		if ($where) {
			$this->db->where($where);
		}
		return $this->db->get('pemasukan');
	}



	public function add($kode_pemasukan, $jumlah_pemasukan, $type_pemasukan, $operator){
		return $this->db->insert('pemasukan', [
			'kode_pemasukan' 	=> $kode_pemasukan,
			'jumlah_pemasukan'	=> $jumlah_pemasukan,
			'type_pemasukan'	=> $type_pemasukan,
			'operator'			=> $operator
		]);
	}


	public function delete($kode_pemasukan){
		return $this->db->delete('pemasukan', ['kode_pemasukan' => $kode_pemasukan]);
	}

	public function reset(){
		return $this->db->empty_table('pemasukan');
	}

}

/* End of file M_pemasukan.php */
/* Location: ./application/models/M_pemasukan.php */