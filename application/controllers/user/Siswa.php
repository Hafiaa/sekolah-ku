<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Siswa extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model(['M_siswa', 'M_spp', 'M_seragam', 'M_biaya_lain', 'M_tabungan']);
	}
	public function index()
	{
		$data[] = '';
		if (isset($_POST['nisn'])) {
			if ($this->M_siswa->get(['siswa.nisn' => $this->input->post('nisn')])->num_rows()) {
				$data['siswa']	 	= $this->M_siswa->get(['siswa.nisn' => $this->input->post('nisn')])->row();
				$id_siswa 			= md5($data['siswa']->id_siswa);
				$data['spp']	 	= $this->M_spp->get(['md5(id_siswa)' 		=> $id_siswa])->result();
				$data['seragam'] 	= $this->M_seragam->get(['md5(id_siswa)' 	=> $id_siswa])->result();
				$data['siswa_biaya_lain'] = $this->M_biaya_lain->get(['md5(id_siswa)' => $id_siswa])->result();
				$data['tabungan']			= $this->M_tabungan->get(['md5(id_siswa)' => $id_siswa])->result();
				$masuk 	= 0;
				$keluar	= 0;
				foreach ($this->M_tabungan->get(['md5(id_siswa)' => $id_siswa])->result() as $key) {
					if ($key->status_tabungan) {
						$masuk += $key->jumlah_tabungan;
					}else{
						$keluar += $key->jumlah_tabungan;
					}
				}
				$data['uang_masuk']		= $masuk;
				$data['uang_keluar']	= $keluar;
			}else{
				$data['error'] = TRUE;
				$data['pesan'] = 'Siswa berdasarkan nisn <b>'. $this->input->post('nisn') .'</b> tidak ditemukan';
			}
		}
		$this->lib->templateuser('siswa/index', $data);
	}

}

/* End of file siswa.php */
/* Location: ./application/controllers/user/siswa.php */