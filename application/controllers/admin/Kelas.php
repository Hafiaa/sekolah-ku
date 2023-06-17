<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelas extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model(['M_kelas']);
		
	}

	public function index()
	{
		$data = [
			'title' 	=> 'Kelas',
			'judul' 	=> 'Halaman data kelas',
			'kelas'	=> $this->M_kelas->get()->result()
		];
		$this->lib->templateadmin('kelas/index', $data);
	}

}

/* End of file Kelas.php */
/* Location: ./application/controllers/admin/Kelas.php */
