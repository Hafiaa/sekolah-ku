<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model(['M_pengeluaran', 'M_pemasukan', 'M_siswa', 'M_jurusan']);
	}

	public function index()
	{

		$jumlah_pengeluaran = 0;
		$jumlah_pemasukan = 0;

		foreach ($this->M_pengeluaran->get()->result() as $key) {
			$jumlah_pengeluaran += $key->jumlah_pengeluaran;
		}
		foreach ($this->M_pemasukan->get()->result() as $key) {
			$jumlah_pemasukan += $key->jumlah_pemasukan;
		}
		
		$data = [
			'title'					=> "Dashboard",
			'jumlah_siswa'			=> $this->M_siswa->get()->num_rows(),
			'jumlah_pengeluaran'	=> $jumlah_pengeluaran,
			'jumlah_pemasukan'		=> $jumlah_pemasukan,
			'jumlah_jurusan'		=> $this->M_jurusan->get()->num_rows()
		];
		$this->lib->templateadmin('dashboard', $data);
	}


	

}

/* End of file Dashboard.php */
/* Location: ./application/controllers/admin/Dashboard.php */