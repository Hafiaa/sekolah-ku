<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_backup_data extends CI_Model {

	public function get($where=null){
		$this->db->order_by('id_backup_data', 'DESC');
		if ($where) {
			$this->db->where($where);
		}
		return $this->db->get('backup_data');
	}


	public function insert($name_file){
		return $this->db->insert('backup_data', [
			'name_backup_data'	=> $name_file
		]);
	}

	public function delete($id_backup_data){
		unlink('./backup/db/'.$this->get(['md5(id_backup_data)' => $id_backup_data])->row()->name_backup_data);
		return $this->db->delete('backup_data', ['md5(id_backup_data)' => $id_backup_data]);
	}

}

/* End of file M_backup_data.php */
/* Location: ./application/models/M_backup_data.php */