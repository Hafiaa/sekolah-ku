<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Biaya_lain extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->load->model(['M_siswa', 'M_pemasukan', 'M_kelas', 'M_jurusan', 'M_biaya_lain', 'M_setting']);
	}

	public function index()
	{

		$data = [
			'title' 			=> 'Biaya Lain',
			'judul' 			=> 'Halaman biaya lain siswa',
		];
		
		if (isset($_GET['nis'])) {
			if ($this->M_siswa->get(['siswa.nisn' => $_GET['nis']])->num_rows()) {
				$data['siswa'] 	= $this->M_siswa->get(['siswa.nisn' => $_GET['nis']])->row();
				$data['siswa_biaya_lain']   	= $this->M_biaya_lain->get()->result();
				$data['biaya_lain']   			= $this->M_setting->get_biaya_lain()->result();
			}else{
				$data['error']	= TRUE;
			}
		}
		$this->lib->templateadmin('biaya_lain/index', $data);
	}

	


	public function add(){
		$siswa = $this->M_siswa->get(['siswa.nisn' => $_GET['nis']])->row();
		if ($this->M_siswa->get(['siswa.nisn' => $_GET['nis']])->num_rows()) {
			if (isset($_POST['add'])) {
				if ($this->M_biaya_lain->insert(md5($siswa->id_siswa))) {
					$this->session->set_flashdata('message', 'Data biaya lain berhasil di tambahkan');
				}else{
					$this->session->set_flashdata('failed', 'Data biaya lain gagal di tambahkan');
				}
				redirect('admin/biaya_lain/index?nis='.$siswa->nisn);
			}
			// $this->lib->templateadmin('biaya_lain/form', $data);
		}else{
			redirect('admin/biaya_lain');
		}
	}

	public function insert($id_siswa){
		if ($this->M_biaya_lain->insert($id_siswa)) {
			$this->session->set_flashdata('message', 'Data biaya lain berhasil di tambahkan');
		}else{
			$this->session->set_flashdata('failed', 'Data biaya lain gagal di tambahkan !');
		}
		redirect('admin/biaya_lain/index?nis='.$_GET['nis']);
	}

	public function delete($id_siswa, $id_biaya_lain){
		if($this->M_biaya_lain->delete($id_biaya_lain)){
			$this->session->set_flashdata('message', 'Data biaya lain berhasil di hapus');
		}else{
			$this->session->set_flashdata('failed', 'Data biaya lain gagal di hapus');
		}
		redirect('admin/biaya_lain/index?nis='.$_GET['nis']);
	}


	public function bayar_biaya_lain($id_siswa, $id_siswa_biaya_lain){
		if ($this->M_siswa->get(['md5(id_siswa)' => $id_siswa])->num_rows()) {
			$data = [
				'title' 			=> 'Pembayaran Biaya Lain',
				'judul' 			=> 'Halaman pembayaran biaya lain siswa',
				'siswa'				=> $this->M_siswa->get(['md5(siswa.id_siswa)' => $id_siswa])->row(),
				'siswa_biaya_lain'	=> $this->M_biaya_lain->get(['md5(id_siswa_biaya_lain)' => $id_siswa_biaya_lain])->row(),
				'bayar_biaya_lain'	=> $this->M_biaya_lain->get_bayar(['md5(id_siswa_biaya_lain)' => $id_siswa_biaya_lain])->result()
			];
			if (isset($_POST['jumlah_bayar_biaya_lain'])) {
				if ($this->M_biaya_lain->insert_bayar($id_siswa, $id_siswa_biaya_lain)) {
					$this->session->set_flashdata('message', 'Data pembayaran biaya lain berhasil di tambahkan');
				}else{
					$this->session->set_flashdata('failed', 'Data pembayaran biaya lain gagal di tambahkan');
				}
				redirect('admin/biaya_lain/bayar_biaya_lain/'.$id_siswa.'/'.$id_siswa_biaya_lain.'?nis='.$_GET['nis']);
			}
			$this->lib->templateadmin('biaya_lain/bayar_biaya_lain', $data);
		}else{
			redirect('admin/biaya_lain');
		}
	}

	public function delete_bayar_biaya_lain($id_siswa, $id_siswa_biaya_lain, $id_bayar_biaya_lain){
		if ($this->M_biaya_lain->delete_bayar($id_bayar_biaya_lain)) {
			$this->session->set_flashdata('message', 'Data pembayaran lain berhasil di hapus');
		}else{
			$this->session->set_flashdata('failed', 'Data pembayaran lain gagal di hapus!');
		}
		redirect('admin/biaya_lain/bayar_biaya_lain/'.$id_siswa.'/'.$id_siswa_biaya_lain.'?nis='.$_GET['nis']);
	}

	



}

/* End of file Spp.php */
/* Location: ./application/controllers/admin/Spp.php */