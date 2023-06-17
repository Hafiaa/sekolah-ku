<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_kelas extends CI_Model {

	public function get($where=null){
		if ($where) {
			$this->db->where($where);
		}
		return $this->db->get('kelas');
	}


	

}

/* End of file M_kelas.php */
/* Location: ./application/models/M_kelas.php */