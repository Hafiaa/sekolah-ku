<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_setting extends CI_Model {

	public function get($key=null){
		if ($key) {
			$this->db->where(['name' => $key]);
		}
		return $this->db->get('setting');
	}



	public function update($key, $value){
		return $this->db->update('setting', ['value' => $value], ['name' => $key]);
	}

	public function get_biaya_lain($where = NULL)
	{
		if ($where) {
			$this->db->where($where);
		}
		return $this->db->get('biaya_lain');
	}
	public function add_biaya_lain()
	{
		return $this->db->insert('biaya_lain', [
			'nama_biaya_lain'		=> strip_tags(htmlspecialchars($this->input->post('nama_biaya_lain'))),
			'harga_biaya_lain'		=> $this->input->post('harga_biaya_lain')
		]);
	}
	public function edit_biaya_lain($id)
	{
		$result = $this->get_biaya_lain(['md5(id_biaya_lain)' => $id])->row();
		$this->db->update('siswa_biaya_lain', ['nama_biaya_lain' => $this->input->post('nama_biaya_lain')], ['nama_biaya_lain' => $result->nama_biaya_lain]);
		return $this->db->update('biaya_lain', [
			'nama_biaya_lain'		=> strip_tags(htmlspecialchars($this->input->post('nama_biaya_lain'))),
			'harga_biaya_lain'		=> $this->input->post('harga_biaya_lain')
		], ['md5(id_biaya_lain)' => $id]);	
	}
	public function delete_biaya_lain($id)
	{
		$result = $this->get_biaya_lain(['md5(id_biaya_lain)' => $id])->row();
		if ($this->db->get_where('siswa_biaya_lain', ['nama_biaya_lain' => $result->nama_biaya_lain])->num_rows()) {
			return FALSE;
		}
		return $this->db->delete('biaya_lain', ['md5(id_biaya_lain)' => $id]);
	}


	
}

/* End of file M_setting.php */
/* Location: ./application/models/M_setting.php */