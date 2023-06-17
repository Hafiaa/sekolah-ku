<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Siswa extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		// if ($this->session->userdata('login') != 'admin' && $this->session->userdata('username') == '' ) {
		// 	$this->session->set_flashdata('message', '<div class="alert alert-danger"><i class="fa fa-warning"></i> Ooppss... Silahkan Login Terlebih Dahulu! </div>');
		// 	redirect('auth');
		// }
		$this->load->model(['M_jurusan', 'M_kelas', 'M_siswa', 'M_setting', 'M_seragam', 'M_spp', 'M_biaya_lain', 'M_tabungan']);
		$this->load->library('excel');
	}

	public function index()
	{

		$data = [
			'title' 	=> 'Siswa',
			'judul' 	=> 'Halaman data siswa',
			'siswa'	=> $this->M_siswa->get()->result()
		];
		$this->lib->templateadmin('siswa/index', $data);
	}

	public function export_siswa(){
		$data['siswa'] = $this->M_siswa->get()->result();
		$this->load->view('admin/siswa/export', $data);
	}

	public function detail($id_siswa){
		if ($this->M_siswa->get(['md5(id_siswa)' => $id_siswa])->num_rows()) {
			$data = [
				'title' 	 => 'Siswa',
				'judul' 	 => 'Halaman detail siswa',
				'siswa'		 => $this->M_siswa->get(['md5(id_siswa)' => $id_siswa])->row()
			];
			$data['spp']	 			= $this->M_spp->get(['md5(id_siswa)' 		=> $id_siswa])->result();
			$data['seragam'] 			= $this->M_seragam->get(['md5(id_siswa)' 	=> $id_siswa])->result();
			$data['siswa_biaya_lain'] 	= $this->M_biaya_lain->get(['md5(id_siswa)' => $id_siswa])->result();
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
			$this->lib->templateadmin('siswa/detail', $data);
		}else{
			redirect('admin/siswa');
		}
	}

	public function add(){
		$this->form_validation->set_rules('nisn', 'NIS', 'trim|required|is_unique[siswa.nisn]');
		$this->__validation();
		if ($this->form_validation->run() == TRUE) {
			if ($this->M_siswa->insert()) {
				$this->session->set_flashdata('message', 'Data siswa berhasil di tambahkan');
			}else{
				$this->session->set_flashdata('failed', 'Data siswa gagal di tambahkan !');
			}
			redirect('admin/siswa');
		}
		$data = [
			'title' 	=> 'Siswa',
			'judul' 	=> 'Halaman tambah siswa',
			'kelas'		=> $this->M_kelas->get()->result(),
			'jurusan'	=> $this->M_jurusan->get()->result()
		];
		$this->lib->templateadmin('siswa/tambah', $data);
	}

	public function update($id_siswa){
		if ($this->M_siswa->get(['md5(id_siswa)' => $id_siswa])->num_rows()) {
			$data = [
				'title' 	=> 'Siswa',
				'judul' 	=> 'Halaman edit siswa',
				'siswa'		=> $this->M_siswa->get(['md5(id_siswa)' => $id_siswa])->row(),
				'kelas'		=> $this->M_kelas->get()->result(),
				'jurusan'	=> $this->M_jurusan->get()->result()
			];
			if ($data['siswa']->nisn == $this->input->post('nisn')) {
				$this->form_validation->set_rules('nisn', 'NIS', 'trim|required');
			}else{
				$this->form_validation->set_rules('nisn', 'NIS', 'trim|required|is_unique[siswa.nisn]');
			}
			if ($this->form_validation->run() == TRUE) {
				if ($this->M_siswa->update($id_siswa)) {
					$this->session->set_flashdata('message', 'Data siswa berhasil di edit');
				}else{
					$this->session->set_flashdata('failed', 'Data siswa gagal di edit !');
				}
				redirect('admin/siswa');
			}
			$this->lib->templateadmin('siswa/edit', $data);
		}else{
			redirect('admin/siswa');
		}
	}

	public function delete($id_siswa){
		if ($this->M_siswa->delete($id_siswa)) {
			$this->session->set_flashdata('message', 'Data siswa berhasil di hapus');
		}else{
			$this->session->set_flashdata('failed', 'Data siswa gagal di hapus, karena masih terpakai oleh data lain !');
		}
		redirect('admin/siswa');
	}

	public function __validation(){
		$this->form_validation->set_rules('nama_siswa', 'Nama Siswa', 'trim|required');
		$this->form_validation->set_rules('id_kelas', 'Kelas', 'trim|required');
		$this->form_validation->set_rules('id_jurusan', 'Jurusan', 'trim|required');
		$this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'trim|required');
		$this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'trim|required');
	}



	// kenaikan kelas
	public function kenaikan_kelas(){
		if (isset($_POST['cari'])) {
			$result = explode(',', $this->input->post('kelas'));
			$id_kelas = $result[0];
			$id_jurusan = $result[1];
			$siswa 		= $this->M_siswa->get(['siswa.id_kelas' => $id_kelas, 'siswa.id_jurusan' => $id_jurusan]);
			if ($siswa->num_rows() > 0) {
				$data['id_kelas']		= $id_kelas;
				$data['id_jurusan']		= $id_jurusan;
				$data['nama_kelas']		= $this->M_kelas->get(['id_kelas' => $id_kelas])->row()->nama_kelas;
				$data['nama_jurusan']	= $this->M_jurusan->get(['id_jurusan' => $id_jurusan])->row()->nama_jurusan;
			 	$data['siswa']			= $siswa->result();
			}else{
				$kelas 					= $this->M_kelas->get(['id_kelas' => $id_kelas])->row()->nama_kelas;
				$jurusan 				= $this->M_jurusan->get(['id_jurusan' => $id_jurusan])->row()->nama_jurusan;
				$data['messageError']	= 'Data siswa kelas <b> '.$kelas.' </b> &nbsp; jurusan <b> '.$jurusan.' </b> tidak di temukan !';
			}
		}
		$data['title']		= 'Kenaikan Kelas';
		$data['judul']		= 'Halaman kenaikan kelas siswa';
		$data['kelas']		= $this->M_kelas->get()->result();
		$data['jurusan']	= $this->M_jurusan->get()->result();
		$this->lib->templateadmin('kenaikan_kelas/index', $data);
	}
	public function act_naik_kelas($id_kelas, $id_jurusan){
		$i=1;
		$id_naik_kelas = $this->input->post('id_naik_kelas');
		foreach ($this->M_siswa->get(['siswa.id_kelas' => $id_kelas, 'siswa.id_jurusan' => $id_jurusan])->result() as $key) {
			if ($this->input->post('naik_'.$i)) {
				$this->M_siswa->update_naik_kelas(['id_kelas' => $id_naik_kelas], ['id_siswa' => $key->id_siswa]);
			}
		$i++;
		}
		$this->session->set_flashdata('message', 'Data kenaikan siswa berhasil di perbarui');
		redirect('admin/siswa/kenaikan_kelas');	
	}
	// end kenaikan kelas





	public function saveimport()
    {
        if(isset($_FILES["file"]["name"]))
        {
            $path = $_FILES["file"]["tmp_name"];
            $object = PHPExcel_IOFactory::load($path);
            foreach($object->getWorksheetIterator() as $worksheet)
            {
                $highestRow = $worksheet->getHighestRow();
                $highestColumn = $worksheet->getHighestColumn();
                for($row=2; $row<=$highestRow; $row++)
                {   
                    $nisn       			= $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                    $nama_siswa 			= $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                    $id_kelas   			= $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                    $id_jurusan   			= $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                    $tempat_lahir  			= $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                    $tanggal_lahir 			= $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                    $beasiswa 				= $worksheet->getCellByColumnAndRow(6, $row)->getValue() ? $worksheet->getCellByColumnAndRow(6, $row)->getValue() : ''; 
                    $persen_spp 			= $worksheet->getCellByColumnAndRow(7, $row)->getValue(); 
                    $persen_biaya_lain 		= $worksheet->getCellByColumnAndRow(8, $row)->getValue();
                    $persen_baju_seragam 	= $worksheet->getCellByColumnAndRow(9, $row)->getValue();

                    $id_kelas 					= $this->M_kelas->get(['nama_kelas' 	=> strtoupper($id_kelas)])->row()->id_kelas;
                    $id_jurusan 				= $this->M_jurusan->get(['nama_jurusan' => strtoupper($id_jurusan)])->row()->id_jurusan;

                    $data = [
						'nisn' 					=> $nisn,
						'nama_siswa'			=> $nama_siswa,
						'id_kelas'				=> $id_kelas,
						'id_jurusan'			=> $id_jurusan,
						'tempat_lahir'			=> $tempat_lahir,
						'tanggal_lahir'			=> date('Y-m-d', strtotime($tanggal_lahir)),
						'beasiswa'				=> $beasiswa,
						'persen_spp'			=> $persen_spp,
						'persen_biaya_lain'		=> $persen_biaya_lain,
						'persen_baju_seragam'	=> $persen_baju_seragam,
						'uang_seragam'			=> $this->M_setting->get('harga_seragam')->row()->value,
					];
		            if ($this->M_siswa->get(['siswa.nisn' => $nisn])->num_rows() == 0) {
		            	$id_siswa   = $this->M_siswa->insertimport($data);
		            	$bulan 	  	= ['Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni'];
						$siswa 		= $this->M_siswa->get(['siswa.id_siswa' => $id_siswa])->row();
						$harga_spp  = $this->M_jurusan->get(['id_jurusan' => $siswa->id_jurusan])->row()->harga_spp;
						foreach ($this->M_kelas->get()->result() as $key) {
							if ($key->id_kelas != 4 && $key->id_kelas >= $siswa->id_kelas) {
								for ($i=0; $i < 12; $i++) { 
									$this->db->insert('spp', [
										'kode_spp' 		=> 'KDS_'.$id_siswa.$key->id_kelas.$i,
										'id_siswa'		=> $id_siswa,
										'id_kelas' 		=> $key->id_kelas,
										'bulan'			=> $bulan[$i],
										'jumlah_spp'	=> $harga_spp
									]);
								}
							}
						}
		            }
                }
            }
	    $this->session->set_flashdata('message', 'Import data siswa berhasil di tambahkan');
	    redirect('admin/siswa');
        }                
    }


}

/* End of file Jurusan.php */
/* Location: ./application/controllers/admin/Jurusan.php */