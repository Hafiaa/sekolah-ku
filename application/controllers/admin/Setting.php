<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setting extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model(['M_setting', 'M_jurusan']);
	}

	public function index()
	{
		
	}

	public function harga_spp(){
		$data['jurusan']					= $this->M_jurusan->get()->result();
		$data['title']						= 'Setting';
		$data['judul']						= 'Halaman setting harga spp per jurusan';
		if (isset($_POST['save'])) {
			$i=1;
			foreach ($data['jurusan'] as $key) {
				$this->db->update('jurusan', ['harga_spp' => $this->input->post('harga_spp_'.$i)], ['id_jurusan' => $key->id_jurusan]);
			$i++;
			}
			$this->session->set_flashdata('message', 'Data harga spp per jurusan berhasil  di perbarui');
			redirect('admin/setting/harga_spp');
		}
		$this->lib->templateadmin('setting/spp', $data);
	}

	public function harga_seragam(){
		$this->form_validation->set_rules('harga_seragam', 'Harga Spp', 'trim|required');
		if ($this->form_validation->run() == TRUE) {
			if ($this->M_setting->update('harga_seragam', $this->input->post('harga_seragam'))) {
				$this->session->set_flashdata('message', 'Data harga spp berhasil di perbarui');
			}else{
				$this->session->set_flashdata('failed', 'Data harga spp gagal di perbarui !');
			}
			redirect('admin/setting/harga_seragam');
		}
		$data['harga_seragam'] 				= $this->M_setting->get('harga_seragam')->row()->value;
		$data['tanggal_harga_seragam'] 		= $this->M_setting->get('harga_seragam')->row()->tanggal_setting;
		$data['title']						= 'Setting';
		$data['judul']						= 'Halaman setting harga baju seragam';
		$this->lib->templateadmin('setting/seragam', $data);
	}

	public function broadcast()
	{
		$this->form_validation->set_rules('broadcast', 'Broadcast', 'trim|required');
		if ($this->form_validation->run() == TRUE) {
			if ($this->M_setting->update('broadcast', $this->input->post('broadcast'))) {
				$this->session->set_flashdata('message', 'Broadcast berhasil di perbarui');
			}else{
				$this->session->set_flashdata('failed', 'Broadcast gagal di perbarui !');
			}
			redirect('admin/setting/broadcast');
		}
		$data['broadcast']				= $this->M_setting->get('broadcast')->row()->value;
		$data['tanggal_broadcast'] 		= $this->M_setting->get('broadcast')->row()->tanggal_setting;
		$data['title']					= 'Setting';
		$data['judul']					= 'Halaman setting broadcast';
		$this->lib->templateadmin('setting/broadcast', $data);
	}


	public function biaya_lain()
	{
		$data['title']		= 'Setting';
		$data['judul']		= 'Halaman Biaya Lain';
		$data['biaya_lain']	= $this->M_setting->get_biaya_lain()->result();
		$this->lib->templateadmin('setting/biaya_lain/index', $data);
	}

	public function add_biaya_lain()
	{
		$this->form_validation->set_rules('nama_biaya_lain', 'Biaya Lain', 'trim|required|is_unique[biaya_lain.nama_biaya_lain]');
		$this->form_validation->set_rules('harga_biaya_lain', 'Harga Biaya Lain', 'trim|required');
		if ($this->form_validation->run() == TRUE) {
			if ($this->M_setting->add_biaya_lain()) {
					$this->session->set_flashdata('message', 'Tambah biaya lain berhasil');
				}else{
					$this->session->set_flashdata('failed', 'Tambah biaya lain gagal');
				}
				redirect('admin/setting/biaya_lain');
		}
		$data['title']		= 'Setting';
		$data['judul']		= 'Halaman tambah biaya lain';
		$this->lib->templateadmin('setting/biaya_lain/add', $data);
	}

	public function edit_biaya_lain($id)
	{
		$biaya_lain = $this->M_setting->get_biaya_lain(['md5(id_biaya_lain)' => $id])->row();
		if (!$biaya_lain) {
			redirect('admin/setting/biaya_lain');
		}
		if ($this->input->post('nama_biaya_lain') != $biaya_lain->nama_biaya_lain) {
			$this->form_validation->set_rules('nama_biaya_lain', 'Biaya Lain', 'trim|required|is_unique[biaya_lain.nama_biaya_lain]');
		}else{
			$this->form_validation->set_rules('nama_biaya_lain', 'Biaya Lain', 'trim|required');
		}
		$this->form_validation->set_rules('harga_biaya_lain', 'Harga Biaya Lain', 'trim|required');
		if ($this->form_validation->run() == TRUE) {
			if ($this->M_setting->edit_biaya_lain($id)) {
				$this->session->set_flashdata('message', 'Edit biaya lain berhasil');
			}else{
				$this->session->set_flashdata('message', 'Edit biaya lain berhasil');
			}
			redirect('admin/setting/biaya_lain');
		}
		$data['title']		= 'Setting';
		$data['judul']		= 'Halaman edit biaya lain';
		$data['biaya_lain']	= $biaya_lain;
		$this->lib->templateadmin('setting/biaya_lain/edit', $data);
	}

	public function delete_biaya_lain($id)
	{
		$biaya_lain = $this->M_setting->get_biaya_lain(['md5(id_biaya_lain)' => $id]);
		if ($biaya_lain->num_rows() > 0 ) {
			if ($this->M_setting->delete_biaya_lain($id)) {
				$this->session->set_flashdata('message', 'Delete biaya lain berhasil');
			}else{
				$this->session->set_flashdata('failed', 'Delete biaya lain gagal karena data ini masih terpakai');
			}
		}
		redirect('admin/setting/biaya_lain');
	}

	
	public function sekolah()
	{
		$data['nama_sekolah']			= $this->M_setting->get('nama_sekolah')->row()->value;
		$data['email_sekolah']			= $this->M_setting->get('email_sekolah')->row()->value;
		$data['no_telp_sekolah']		= $this->M_setting->get('no_telp_sekolah')->row()->value;
		$data['alamat_sekolah']			= $this->M_setting->get('alamat_sekolah')->row()->value;
		$data['tentang_kami']			= $this->M_setting->get('tentang_kami')->row()->value;
		$data['logo_sekolah']			= $this->M_setting->get('logo_sekolah')->row()->value;
		$data['title']					= 'Setting';
		$data['judul']					= 'Halaman setting sekolah';

		$this->form_validation->set_rules('nama_sekolah', 'Nama Sekolah', 'trim|required');
		$this->form_validation->set_rules('alamat_sekolah', 'Alamat Sekolah', 'trim|required');
		if ($this->form_validation->run() == TRUE) {
			$this->M_setting->update('nama_sekolah', $this->input->post('nama_sekolah'));
			$this->M_setting->update('alamat_sekolah', $this->input->post('alamat_sekolah'));
			$this->M_setting->update('email_sekolah', $this->input->post('email_sekolah'));
			$this->M_setting->update('no_telp_sekolah', $this->input->post('no_telp_sekolah'));
			$this->M_setting->update('tentang_kami', $this->input->post('tentang_kami'));
			if ($foto = $this->_do_upload('logo_sekolah')) {
				unlink('./assets/img/sekolah/' . $data['logo_sekolah']);		
				$this->M_setting->update('logo_sekolah', $foto);
			}
			$this->session->set_flashdata('message', 'Data sekolah berhasil di perbarui');
			redirect('admin/setting/sekolah');
		}
		$this->lib->templateadmin('setting/sekolah', $data);
	}

	private function _do_upload($name)
	{
		$config['upload_path'] = './assets/img/sekolah/';
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['max_size']  = '5000';
		
		$this->load->library('upload', $config);
		
		if ( ! $this->upload->do_upload($name)){
			$error = array('error' => $this->upload->display_errors());
			return FALSE;
		}else{
			$foto = $this->upload->data();
			return $foto['file_name'];
		}
	}

}

/* End of file Setting.php */
/* Location: ./application/controllers/admin/Setting.php */