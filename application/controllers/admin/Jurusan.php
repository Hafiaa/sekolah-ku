<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jurusan extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		// if ($this->session->userdata('login') != 'admin' && $this->session->userdata('username') == '' ) {
		// 	$this->session->set_flashdata('message', '<div class="alert alert-danger"><i class="fa fa-warning"></i> Ooppss... Silahkan Login Terlebih Dahulu! </div>');
		// 	redirect('auth');
		// }
		$this->load->model(['M_jurusan']);
	}

	public function index()
	{
		$data = [
			'title' 	=> 'Jurusan',
			'judul' 	=> 'Halaman data jurusan',
			'jurusan'	=> $this->M_jurusan->get()->result()
		];
		$this->lib->templateadmin('jurusan/index', $data);
	}

	public function add(){
		$this->__validation();
		if ($this->form_validation->run() == TRUE) {
			if ($this->M_jurusan->insert()) {
				$this->session->set_flashdata('message', 'Data jurusan berhasil di tambahkan');
			}else{
				$this->session->set_flashdata('failed', 'Data jurusan gagal di tambahkan !');
			}
			redirect('admin/jurusan');
		}
		$data = [
			'title' 	=> 'Jurusan',
			'judul' 	=> 'Halaman tambah jurusan',
		];
		$this->lib->templateadmin('jurusan/tambah', $data);
	}

	public function update($id_jurusan){
		if ($this->M_jurusan->get(['md5(id_jurusan)' => $id_jurusan])->num_rows()) {
			$data = [
				'title' 	=> 'Jurusan',
				'judul' 	=> 'Halaman edit jurusan',
				'jurusan'	=> $this->M_jurusan->get(['md5(id_jurusan)' => $id_jurusan])->row()
			];
			if ($data['jurusan']->nama_jurusan == $this->input->post('nama_jurusan')) {
				$this->form_validation->set_rules('nama_jurusan', 'Jurusan', 'trim|required');
			}else{
				$this->__validation();
			}
			if ($this->form_validation->run() == TRUE) {
				if ($this->M_jurusan->update($id_jurusan)) {
					$this->session->set_flashdata('message', 'Data jurusan berhasil di edit');
				}else{
					$this->session->set_flashdata('failed', 'Data jurusan gagal di edit !');
				}
				redirect('admin/jurusan');
			}
			$this->lib->templateadmin('jurusan/edit', $data);
		}else{
			redirect('admin/jurusan');
		}
	}

	public function delete($id_jurusan){
		if ($this->M_jurusan->delete($id_jurusan)) {
			$this->session->set_flashdata('Data jurusan berhasil di hapus');
		}else{
			$this->session->set_flashdata('failed', 'Data jurusan gagal di hapus, karena masih terpakai oleh data lain !');
		}
		redirect('admin/jurusan');
	}

	public function __validation(){
		$this->form_validation->set_rules('nama_jurusan', 'Jurusan', 'trim|required|is_unique[jurusan.nama_jurusan]');
		$this->form_validation->set_rules('harga_spp', 'Harga Spp / Bulan', 'trim|required');
	}

}

/* End of file Jurusan.php */
/* Location: ./application/controllers/admin/Jurusan.php */