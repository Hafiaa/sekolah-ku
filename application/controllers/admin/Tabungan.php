<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tabungan extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model(['M_siswa', 'M_tabungan', 'M_kelas', 'M_jurusan', 'M_spp']);
	}

	public function index()
	{
		$data = [
			'title' 	=> 'Tabungan ',
			'judul' 	=> 'Halaman data tabungan siswa',
		];
		
		if (isset($_GET['nis'])) {
			if ($this->M_siswa->get(['siswa.nisn' => $_GET['nis']])->num_rows()) {
				$data['siswa'] 	= $this->M_siswa->get(['siswa.nisn' => $_GET['nis']])->row();
				$this->db->order_by('id_tabungan', 'DESC');
				$data['tabungan']   			= $this->M_tabungan->get(['id_siswa' => $data['siswa']->id_siswa])->result();
				$uang_keluar_tabsis 			= 0;
				$uang_masuk_tabungan_pribadi 	= 0;
				$uang_keluar_tabungan_pribadi 	= 0;
				foreach ($this->M_tabungan->get(['md5(id_siswa)' => md5($data['siswa']->id_siswa)])->result() as $key) {
					if ($key->status_tabungan == 1) {
						$uang_masuk_tabungan_pribadi 	+= 	$key->jumlah_tabungan;
					}elseif($key->status_tabungan == 2){
						$uang_keluar_tabsis += $key->jumlah_tabungan;
					}else{
						$uang_keluar_tabungan_pribadi 	+=	$key->jumlah_tabungan;
					}
				}
				$data['uang_masuk_tabungan_siswa']		= ($this->M_spp->get(['id_siswa' => $data['siswa']->id_siswa, 'status_spp' => 1])->num_rows() * 15000);
				$data['uang_keluar_tabungan_siswa']		= $uang_keluar_tabsis;
				$data['uang_masuk_tabungan_pribadi']	= $uang_masuk_tabungan_pribadi;
				$data['uang_keluar_tabungan_pribadi']	= $uang_keluar_tabungan_pribadi;
			}else{
				$data['error']	= TRUE;
			}
		}
		$this->lib->templateadmin('tabungan/index', $data);
	}


	public function form($id_siswa){
		if ($this->M_siswa->get(['md5(siswa.id_siswa)' => $id_siswa])->num_rows()) {
			if (isset($_POST['masuk'])) {
				if ($this->M_tabungan->insert($id_siswa, $this->input->post('jumlah_uang'), 1)) {
					$this->session->set_flashdata('message', 'Data uang berhasil di tabung');
				}else{
					$this->session->set_flashdata('failed', 'Data uang gagal di tabungkan !');
				}
				redirect('admin/tabungan/index?nis='.$_GET['nis']);
			}
			if (isset($_POST['keluar'])) {
				if ($this->M_tabungan->insert($id_siswa, $this->input->post('jumlah_uang'), $this->input->post('status_tabungan'))) {
					$this->session->set_flashdata('message', 'Data uang berhasil di ambil');
				}else{
					$this->session->set_flashdata('failed', 'Data uang gagal di ambil !');
				}
				redirect('admin/tabungan/index?nis='.$_GET['nis']);
			}
		}else{
			redirect('admin/tabungan/index?nis='.$_GET['nis']);
		}
	}


	public function delete($id_siswa, $id_tabungan){
		if ($this->M_tabungan->delete($id_tabungan)) {
			$this->session->set_flashdata('message', 'Transaksi tabungan berhasil di hapus');
		}else{
			$this->session->set_flashdata('failed', 'Transaksi tabungan gagal di hapus !');
		}
		redirect('admin/tabungan/index/?nis=' . $_GET['nis']);
	}






}

/* End of file Tabungan.php */
/* Location: ./application/controllers/admin/Tabungan.php */