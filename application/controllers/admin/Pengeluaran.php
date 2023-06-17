<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengeluaran extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model(['M_pengeluaran']);
	}

	public function index()
	{
		$data = [
			'title' 		=> 'Pengeluaran',
			'judul' 		=> 'Halaman data pengeluaran',
			'pengeluaran'	=> $this->M_pengeluaran->get()->result()
		];
		$this->lib->templateadmin('pengeluaran/index', $data);
	}

	public function add(){
		$this->form_validation->set_rules('jumlah_pengeluaran', 'Jumlah Pengeluaran', 'trim|required');
		$this->form_validation->set_rules('keterangan_pengeluaran', 'Keterangan Pengeluaran', 'trim|required');
		if ($this->form_validation->run() == TRUE) {
			if ($this->M_pengeluaran->insert()) {
				$this->session->set_flashdata('message', 'Data pengeluaran berhasil di tambahkan');
			}else{
				$this->session->set_flashdata('failed', 'Data pengeluaran gagal di tambahkan !');
			}
			redirect('admin/pengeluaran');
		}
		$data = [
			'title'		=> 'Pengeluaran',
			'judul'		=> 'Halaman tambah pengeluaran'
		];
		$this->lib->templateadmin('pengeluaran/tambah', $data);
	}

	public function update($id_pengeluaran){
		$this->form_validation->set_rules('jumlah_pengeluaran', 'Jumlah Pengeluaran', 'trim|required');
		$this->form_validation->set_rules('keterangan_pengeluaran', 'Keterangan Pengeluaran', 'trim|required');
		if ($this->form_validation->run() == TRUE) {
			if ($this->M_pengeluaran->update($id_pengeluaran)) {
				$this->session->set_flashdata('message', 'Data pengeluaran berhasil di edit');
			}else{
				$this->sesison->set_flashdata('failed', 'Data pengeluaran gagal di edit !');
			}
			redirect('admin/pengeluaran');
		}
		$data = [
			'title' 		=> 'Pengeluaran',
			'judul' 		=> 'Halaman tambah pengeluaran',
			'pengeluaran'	=> $this->M_pengeluaran->get(['md5(id_pengeluaran)' => $id_pengeluaran])->row()
		];
		$this->lib->templateadmin('pengeluaran/edit', $data);
	}

	public function delete($id_pengeluaran){
		if ($this->M_pengeluaran->delete($id_pengeluaran)) {
			$this->session->set_flashdata('message', 'Data pengeluaran berhasil di hapus');
		}else{
			$this->session->set_flashdata('failed', 'Data pengeluaran gagal di hapus');
		}
		redirect('admin/pengeluaran');
	}


	public function reset_pengeluaran(){
		if ($this->M_pengeluaran->reset()) {
			$this->session->set_flashdata('message', 'Data pengeluaran berhasil di reset');
		}else{
			$this->session->set_flashdata('failed', 'Data pengeluaran gagal di reset');
		}
		redirect('admin/pengeluaran');
	}

}

/* End of file Kelas.php */
/* Location: ./application/controllers/admin/Kelas.php */
