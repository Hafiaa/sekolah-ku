<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Seragam extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		// if ($this->session->userdata('login') != 'admin' && $this->session->userdata('username') == '' ) {
		// 	$this->session->set_flashdata('message', '<div class="alert alert-danger"><i class="fa fa-warning"></i> Ooppss... Silahkan Login Terlebih Dahulu! </div>');
		// 	redirect('auth');
		// }
		$this->load->model(['M_siswa', 'M_seragam', 'M_pemasukan', 'M_kelas', 'M_jurusan']);
	}

	public function index()
	{
		$data = [
			'title' 	=> 'Baju Seragam',
			'judul' 	=> 'Halaman data baju seragam siswa',
		];
		
		if (isset($_GET['nis'])) {
			if ($this->M_siswa->get(['siswa.nisn' => $_GET['nis']])->num_rows()) {
				$data['siswa'] 	= $this->M_siswa->get(['siswa.nisn' => $_GET['nis']])->row();
				$data['seragam']   	= $this->M_seragam->get(['id_siswa' => $data['siswa']->id_siswa])->result();
			}else{
				$data['error']	= TRUE;
			}
		}
		if (isset($_POST['jumlah_seragam'])) {
			$siswa = $this->M_siswa->get(['siswa.nisn' => $_GET['nis']])->row();
			if ($this->M_seragam->add(md5($siswa->id_siswa))) {
				$this->session->set_flashdata('message', 'Pembayaran seragam berhasil');
			}else{
				$this->session->set_flashdata('failed', 'Pembayaran seragam gagal !');
			}
			redirect('admin/seragam/index?nis='.$_GET['nis']);
		}
		$this->lib->templateadmin('seragam/index', $data);
	}


	// public function add($id_siswa){
	// 	if ($this->M_siswa->get(['md5(id_siswa)' => $id_siswa])->num_rows()) {
	// 		if (isset($_POST['jumlah_seragam'])) {
	// 			if ($this->M_seragam->add($id_siswa)) {
	// 				$this->session->set_flashdata('message', 'Pembayaran seragam berhasil');
	// 			}else{
	// 				$this->session->set_flashdata('failed', 'Pembayaran seragam gagal !');
	// 			}
	// 			redirect('admin/seragam/add/'.$id_siswa);
	// 		}
	// 		$data = [
	// 			'title' 		=> 'Baju Seragam',
	// 			'judul' 		=> 'Halaman pembayaran baju seragam siswa',
	// 			'siswa'			=> $this->M_siswa->get(['md5(id_siswa)' => $id_siswa])->row(),
	// 			'seragam'		=> $this->M_seragam->get(['md5(id_siswa)' => $id_siswa])->result()
	// 		];
	// 		$this->lib->templateadmin('seragam/form', $data);
	// 	}else{
	// 		redirect('admin/seragam');
	// 	}
	// }

	public function delete($id_seragam){
		if($this->M_seragam->delete($id_seragam)){
			$this->session->set_flashdata('message', 'Data pembayaran seragam berhasil di hapus');
		}else{
			$this->session->set_flashdata('failed', 'Data pembayaran seragam gagal di hapus');
		}
		redirect('admin/seragam/index?nis='.$_GET['nis']);
	}

}

/* End of file Spp.php */
/* Location: ./application/controllers/admin/Spp.php */