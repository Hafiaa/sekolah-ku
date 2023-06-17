<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pemasukan extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model(['M_pemasukan']);
	}

	public function index()
	{
		
		$data = [
			'title' 		=> 'Pemasukan',
			'judul' 		=> 'Halaman data pemasukan',
			'pemasukan'	=> $this->M_pemasukan->get()->result()
		];
		$this->lib->templateadmin('pemasukan/index', $data);
	}


	public function reset_pemasukan(){
		if ($this->M_pemasukan->reset()) {
			$this->session->set_flashdata('message', 'Data pemasukan berhasil di reset');
		}else{
			$this->session->set_flashdata('failed', 'Data pemasukan gagal di reset');
		}
		redirect('admin/pemasukan');
	}


	

	
}

/* End of file Pemasukan.php */
/* Location: ./application/controllers/admin/Pemasukan.php */