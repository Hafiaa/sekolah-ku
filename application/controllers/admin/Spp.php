<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Spp extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model(['M_siswa', 'M_spp', 'M_pemasukan', 'M_kelas', 'M_jurusan']);
	}

	public function index()
	{
		$data = [
			'title' 	=> 'Spp',
			'judul' 	=> 'Halaman data spp siswa',
		];
		
		if (isset($_GET['nis'])) {
			if ($this->M_siswa->get(['siswa.nisn' => $_GET['nis']])->num_rows()) {
				$data['siswa'] 	= $this->M_siswa->get(['siswa.nisn' => $_GET['nis']])->row();
				$data['spp']   	= $this->M_spp->get(['id_siswa' => $data['siswa']->id_siswa])->result();
			}else{
				$data['error']	= TRUE;
			}
		}
		
		$this->lib->templateadmin('spp/index', $data);
	}

	public function otomatis_spp($id_siswa){
		$nis = $this->input->post('nis');
		if ($this->M_spp->otomatis_spp($id_siswa)) {
			$this->session->set_flashdata('message', 'Pembayaran spp berhasil');
		}else{
			$this->session->set_flashdata('failed', 'Pembayaran spp gagal');
		}
		redirect('admin/spp/index?nis='.$nis,'refresh');
	}

	public function act($id_siswa, $id_spp, $status_spp){
		if ($this->M_spp->update($id_spp, $status_spp)) {
			$this->session->set_flashdata('message', 'Pembayaran spp berhasil');
		}else{
			$this->sesion->set_flashdata('failed', 'Pembayaran spp gagal !');
		}
		redirect('admin/spp/index?nis='.$this->M_siswa->get(['md5(siswa.id_siswa)' => $id_siswa])->row()->nisn);
	}

}