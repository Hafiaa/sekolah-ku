<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Backup extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model(['M_backup_data']);
	}


	public function index(){
		$data['title'] 	= 'Data Backup';
		$data['judul']	= 'Halaman data backup';
		$data['backup']	= $this->M_backup_data->get()->result();
		$this->lib->templateadmin('backup/index', $data);
	}


	// BACKUP DATABASE
	public function db()
	{
		$this->load->dbutil();
		$prefs = array(
		'format' => 'zip',
		'filename' => 'my_db_backup.sql'
		);
		$backup =& $this->dbutil->backup($prefs);
		$db_name = 'backup-on-' . date("d-M-Y H:i:s") . '.zip'; 
		$this->M_backup_data->insert($db_name);
		$save  = './backup/db/' . $db_name;
		$this->load->helper('file');
		write_file($save, $backup);
		$this->load->helper('download');
 		force_download($db_name, $backup);
	}

	public function import()
	{
		$config['upload_path'] = './backup/db/';
		$config['allowed_types'] = '*';
		$config['max_size']  = '20000';		
		$this->load->library('upload', $config);
		if (!$this->upload->do_upload('file')){
			$error = array('error' => $this->upload->display_errors());
			var_dump($error); die();
			$this->session->set_flashdata('failed', 'Database gagal di perbarui karena extension bukan .sql !');
		}
		else{
			$data = $this->upload->data();
			$file_restore = $this->load->file('./backup/db/'.$data['file_name'], true);
			$file_array = explode(';', $file_restore);
			$i = 0;
			while($i < (count($file_array) - 1)){
				if ($file_array[$i]) {
					$this->db->query("SET FOREIGN_KEY_CHECKS = 0");
					$this->db->query($file_array[$i]);
					$this->db->query("SET FOREIGN_KEY_CHECKS = 1");
				}
				$i++;
			}
			unlink('./backup/db/'.$data['file_name']);
			$this->session->set_flashdata('message', 'Database berhasil di perbarui ');
		}
		redirect('admin','refresh');
	}

	// END :: DATABASE


	public function delete($id_backup_data){
		if ($this->M_backup_data->delete($id_backup_data)) {
			$this->session->set_flashdata('message', 'Data backup berhasil di hapus');
		}else{
			$this->session->set_flashdata('failed', 'Data backup gagal di hapus');
		}
		redirect('admin/backup');
	}

}

/* End of file Backup.php */
/* Location: ./application/controllers/admin/Backup.php */