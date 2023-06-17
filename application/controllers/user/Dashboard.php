<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model(['M_jurusan', 'M_siswa']);
	}
	public function index()
	{
		$data['title']		= 'Home';
		$data['jml_siswa']	= $this->M_siswa->get()->num_rows();
		$data['jml_jurusan']	= $this->M_jurusan->get()->num_rows();
		$this->lib->templateuser('dashboard', $data);
	}

}

/* End of file Dashboard.php */
/* Location: ./application/controllers/user/Dashboard.php */