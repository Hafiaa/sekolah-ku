<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {


	function __construct(){
		parent::__construct();
		$this->load->model(['M_pemasukan', 'M_pengeluaran', 'M_kelas', 'M_jurusan', 'M_siswa', 'M_spp', 'M_tabungan', 'M_setting']);
	}

	// public function index()
	// {
		
	// }


	public function pemasukan(){
		$data 	= [
			'title'			=> 'Laporan Umum',
			'judul'			=> 'Halaman data laporan pemasukan'
		];
		if (isset($_POST['cari'])) {
			$tanggal1 	= date('Y-m-d H:m:s', strtotime(date('Y-m-d', strtotime($this->input->post('tanggal1'))).' 00:00:00'));
			$tanggal2 	= date('Y-m-d H:m:s', strtotime(date('Y-m-d', strtotime($this->input->post('tanggal2'))).' 23:59:00'));
			if ($this->input->post('type_pemasukan') != 'all') {
				$this->db->where('type_pemasukan', $this->input->post('type_pemasukan'));
			}
			$this->db->where('tanggal_pemasukan >=', $tanggal1);
			$this->db->where('tanggal_pemasukan <=', $tanggal2);
			$this->db->order_by('tanggal_pemasukan', 'ASC');
			$pemasukan 	= $this->M_pemasukan->get()->result();
			if (count($pemasukan) > 0) {
				$data['pemasukan']	=  $pemasukan;
			}else{
				$data['messageError'] = TRUE;
			}
			
		}
		$this->lib->templateadmin('laporan/pemasukan', $data);
	}


	public function pengeluaran(){
		$data 	= [
			'title'			=> 'Laporan Umum',
			'judul'			=> 'Halaman data laporan pengeluaran'
		];
		if (isset($_POST['cari'])) {
			$tanggal1 	= date('Y-m-d H:m:s', strtotime(date('Y-m-d', strtotime($this->input->post('tanggal1'))).' 00:00:00'));
			$tanggal2 	= date('Y-m-d H:m:s', strtotime(date('Y-m-d', strtotime($this->input->post('tanggal2'))).' 23:59:00'));
			$this->db->where('tanggal_pengeluaran >=', $tanggal1);
			$this->db->where('tanggal_pengeluaran <=', $tanggal2);
			$this->db->order_by('tanggal_pengeluaran', 'ASC');
			$pengeluaran 	= $this->M_pengeluaran->get()->result();
			if (count($pengeluaran) > 0) {
				$data['pengeluaran']	=  $pengeluaran;
			}else{
				$data['messageError'] = TRUE;
			}
			
		}
		$this->lib->templateadmin('laporan/pengeluaran', $data);
	}

	public function spp(){
		$data 	= [
			'title'			=> 'Laporan Umum',
			'judul'			=> 'Halaman data laporan bagan spp',
			'kelas'			=> $this->M_kelas->get()->result(),
			'jurusan'		=> $this->M_jurusan->get()->result()
		];
		if (isset($_POST['cari'])) {
			$result = explode(',', $this->input->post('kelas'));
			$id_kelas = $result[0];
			$id_jurusan = $result[1];
			$kelas 		= $this->M_kelas->get(['id_kelas' => $id_kelas])->row();
			$jurusan 	= $this->M_jurusan->get(['id_jurusan' => $id_jurusan])->row();
			$siswa 		= $this->M_siswa->get(['siswa.id_kelas' => $kelas->id_kelas, 'siswa.id_jurusan' => $jurusan->id_jurusan])->result();
			if (count($siswa)) {
				$data['nama_kelas']		= $kelas->nama_kelas;
				$data['nama_jurusan']	= $jurusan->nama_jurusan;
				$data['siswa']		 	= $siswa;
				$data['id_kelas']		= $id_kelas;
				$data['id_jurusan']		= $id_jurusan;
			}else{
				$data['messageError'] 	= 'Data siswa kelas <b>'.$kelas->nama_kelas.' </b>&nbsp; jurusan <b>'.$jurusan->nama_jurusan.'</b> &nbsp; tidak di temukan !';
			}
		}
		$this->lib->templateadmin('laporan/spp', $data);
	}


	public function seragam(){
		$data 	= [
			'title'			=> 'Laporan Umum',
			'judul'			=> 'Halaman data laporan baju seragam',
			'kelas'			=> $this->M_kelas->get()->result(),
			'jurusan'		=> $this->M_jurusan->get()->result()
		];
		if (isset($_POST['cari'])) {
			$result = explode(',', $this->input->post('kelas'));
			$id_kelas = $result[0];
			$id_jurusan = $result[1];
			$kelas 		= $this->M_kelas->get(['id_kelas' => $id_kelas])->row();
			$jurusan 	= $this->M_jurusan->get(['id_jurusan' => $id_jurusan])->row();
			$siswa 		= $this->M_siswa->get(['siswa.id_kelas' => $kelas->id_kelas, 'siswa.id_jurusan' => $jurusan->id_jurusan])->result();
			if (count($siswa)) {
				$data['nama_kelas']		= $kelas->nama_kelas;
				$data['nama_jurusan']	= $jurusan->nama_jurusan;
				$data['id_jurusan']		= $id_jurusan;
				$data['id_kelas']		= $id_kelas;
				$data['siswa']		 	= $siswa;
			}else{
				$data['messageError'] 	= 'Data siswa kelas <b>'.$kelas->nama_kelas.' </b>&nbsp; jurusan <b>'.$jurusan->nama_jurusan.'</b> &nbsp; tidak di temukan !';
			}
		}
		$this->lib->templateadmin('laporan/seragam', $data);
	}

	public function print_seragam($id_kelas, $id_jurusan, $type=null)
	{
		$data = [
			'title'		=> 'Laporan Pebayaran Seragam',
			'kelas'		=> $this->M_kelas->get(['id_kelas' => $id_kelas])->row(),
			'jurusan'	=> $this->M_jurusan->get(['id_jurusan' => $id_jurusan])->row(),
			'siswa'		=> $this->M_siswa->get(['siswa.id_kelas' => $id_kelas, 'siswa.id_jurusan' => $id_jurusan])->result(),
			'type'		=> $type
		];
		$this->load->view('admin/laporan/print_seragam', $data);
	}
	public function exel_seragam($id_kelas, $id_jurusan, $type=null)
	{
		$data = [
			'title'		=> 'Laporan Pebayaran Seragam',
			'kelas'		=> $this->M_kelas->get(['id_kelas' => $id_kelas])->row(),
			'jurusan'	=> $this->M_jurusan->get(['id_jurusan' => $id_jurusan])->row(),
			'siswa'		=> $this->M_siswa->get(['siswa.id_kelas' => $id_kelas, 'siswa.id_jurusan' => $id_jurusan])->result(),
			'type'		=> $type
		];
		$this->load->view('admin/laporan/exel_seragam', $data);
	}

	public function biaya_lain(){
		$data 	= [
			'title'			=> 'Laporan Umum',
			'judul'			=> 'Halaman data laporan biaya lain',
			'kelas'			=> $this->M_kelas->get()->result(),
			'jurusan'		=> $this->M_jurusan->get()->result(),
			'biaya_lain'	=> $this->M_setting->get_biaya_lain()->result(),
		];
		if (isset($_POST['cari'])) {
			$result = explode(',', $this->input->post('kelas'));
			$id_kelas = $result[0];
			$id_jurusan = $result[1];
			$kelas 		= $this->M_kelas->get(['id_kelas' => $id_kelas])->row();
			$jurusan 	= $this->M_jurusan->get(['id_jurusan' => $id_jurusan])->row();
			$siswa 		= $this->M_siswa->get(['siswa.id_kelas' => $kelas->id_kelas, 'siswa.id_jurusan' => $jurusan->id_jurusan])->result();
			if (count($siswa)) {
				$data['id_kelas']		= $id_kelas;
				$data['id_jurusan']		= $id_jurusan;
				$data['nama_kelas']		= $kelas->nama_kelas;
				$data['nama_jurusan']	= $jurusan->nama_jurusan;
				$data['siswa']		 	= $siswa;
			}else{
				$data['messageError'] 	= 'Data siswa kelas <b>'.$kelas->nama_kelas.' </b>&nbsp; jurusan <b>'.$jurusan->nama_jurusan.'</b> &nbsp; tidak di temukan !';
			}
		}
		$this->lib->templateadmin('laporan/biaya_lain', $data);
	}

	public function print_biaya_lain($id_kelas, $id_jurusan, $nama_biaya_lain, $type=null)
	{
		$data = [
			'title'				=> 'Laporan Biaya Lain',
			'kelas'				=> $this->M_kelas->get(['id_kelas' => $id_kelas])->row(),
			'jurusan'			=> $this->M_jurusan->get(['id_jurusan' => $id_jurusan])->row(),
			'siswa'				=> $this->M_siswa->get(['siswa.id_kelas' => $id_kelas, 'siswa.id_jurusan' => $id_jurusan])->result(),
			'type'		 		=> $type,
			'nama_biaya_lain'	=> preg_replace('/%20/', ' ', $nama_biaya_lain),
			'nama_kelas'		=> $this->M_kelas->get(['id_kelas' => $id_kelas])->row()->nama_kelas,
			'nama_jurusan'		=> $this->M_jurusan->get(['id_jurusan' => $id_jurusan])->row()->nama_jurusan
		];
		$this->load->view('admin/laporan/print_biaya_lain', $data);
	}
	public function exel_biaya_lain($id_kelas, $id_jurusan, $nama_biaya_lain, $type=null)
	{
		$data = [
			'title'				=> 'Laporan Biaya Lain',
			'kelas'				=> $this->M_kelas->get(['id_kelas' => $id_kelas])->row(),
			'jurusan'			=> $this->M_jurusan->get(['id_jurusan' => $id_jurusan])->row(),
			'siswa'				=> $this->M_siswa->get(['siswa.id_kelas' => $id_kelas, 'siswa.id_jurusan' => $id_jurusan])->result(),
			'type'		 		=> $type,
			'nama_biaya_lain'	=> preg_replace('/%20/', ' ', $nama_biaya_lain),
			'nama_kelas'		=> $this->M_kelas->get(['id_kelas' => $id_kelas])->row()->nama_kelas,
			'nama_jurusan'		=> $this->M_jurusan->get(['id_jurusan' => $id_jurusan])->row()->nama_jurusan
		];
		$this->load->view('admin/laporan/exel_biaya_lain', $data);
	}


	public function print_pemasukan($tanggal1, $tanggal2, $type_pemasukan){
		$type_pemasukan = preg_replace('/%20/', ' ', $type_pemasukan);
		if ($type_pemasukan != 'all') {
			$this->db->where('type_pemasukan', $type_pemasukan);
		}
		$tanggal1 	= date('Y-m-d H:m:s', strtotime(date('Y-m-d', strtotime($tanggal1)).' 00:00:00'));
		$tanggal2 	= date('Y-m-d H:m:s', strtotime(date('Y-m-d', strtotime($tanggal2)).' 23:59:00'));
		$this->db->where('tanggal_pemasukan >=', $tanggal1);
		$this->db->where('tanggal_pemasukan <=', $tanggal2);
		$this->db->order_by('tanggal_pemasukan', 'ASC');
		$pemasukan 	= $this->M_pemasukan->get()->result();

		$data['tanggal']		= $this->lib->date_indo($tanggal1).' &nbsp; - &nbsp; '.$this->lib->date_indo($tanggal2);
		$data['type_pemasukan']	= ucfirst($type_pemasukan);
		$data['pemasukan']		= $pemasukan;
		$this->load->view('admin/laporan/print_pemasukan', $data);
	}

	public function exel_pemasukan($tanggal1, $tanggal2, $type_pemasukan){
		$type_pemasukan = preg_replace('/%20/', ' ', $type_pemasukan);
		if ($type_pemasukan != 'all') {
			$this->db->where('type_pemasukan', $type_pemasukan);
		}
		$tanggal1 	= date('Y-m-d H:m:s', strtotime(date('Y-m-d', strtotime($tanggal1)).' 00:00:00'));
		$tanggal2 	= date('Y-m-d H:m:s', strtotime(date('Y-m-d', strtotime($tanggal2)).' 23:59:00'));
		$this->db->where('tanggal_pemasukan >=', $tanggal1);
		$this->db->where('tanggal_pemasukan <=', $tanggal2);
		$this->db->order_by('tanggal_pemasukan', 'ASC');
		$pemasukan 	= $this->M_pemasukan->get()->result();

		$data['tanggal']		= $this->lib->date_indo($tanggal1).' &nbsp; - &nbsp; '.$this->lib->date_indo($tanggal2);
		$data['type_pemasukan']	= ucfirst($type_pemasukan);
		$data['pemasukan']		= $pemasukan;
		$this->load->view('admin/laporan/exel_pemasukan', $data);
	}

	public function print_pengeluaran($tanggal1, $tanggal2){
		$tanggal1 	= date('Y-m-d H:m:s', strtotime(date('Y-m-d', strtotime($tanggal1)).' 00:00:00'));
		$tanggal2 	= date('Y-m-d H:m:s', strtotime(date('Y-m-d', strtotime($tanggal2)).' 23:59:00'));
		$this->db->where('tanggal_pengeluaran >=', $tanggal1);
		$this->db->where('tanggal_pengeluaran <=', $tanggal2);
		$this->db->order_by('tanggal_pengeluaran', 'ASC');
		$pengeluaran 				= $this->M_pengeluaran->get()->result();
		$data['tanggal']			= $this->lib->date_indo($tanggal1).' &nbsp; - &nbsp; '.$this->lib->date_indo($tanggal2);
		$data['pengeluaran']		= $pengeluaran;
		$this->load->view('admin/laporan/print_pengeluaran', $data);
	}

	public function exel_pengeluaran($tanggal1, $tanggal2){
		$tanggal1 	= date('Y-m-d H:m:s', strtotime(date('Y-m-d', strtotime($tanggal1)).' 00:00:00'));
		$tanggal2 	= date('Y-m-d H:m:s', strtotime(date('Y-m-d', strtotime($tanggal2)).' 23:59:00'));
		$this->db->where('tanggal_pengeluaran >=', $tanggal1);
		$this->db->where('tanggal_pengeluaran <=', $tanggal2);
		$this->db->order_by('tanggal_pengeluaran', 'ASC');
		$pengeluaran 				= $this->M_pengeluaran->get()->result();
		$data['tanggal']			= $this->lib->date_indo($tanggal1).' &nbsp; - &nbsp; '.$this->lib->date_indo($tanggal2);
		$data['pengeluaran']		= $pengeluaran;
		$this->load->view('admin/laporan/exel_pengeluaran', $data);
	}

	public function print_spp($id_kelas, $id_jurusan)
	{
		$data['title']			= 'laporan Spp';
		$data['nama_kelas']		= $this->M_kelas->get(['id_kelas' => $id_kelas])->row()->nama_kelas;
		$data['nama_jurusan']	= $this->M_jurusan->get(['id_jurusan' => $id_jurusan])->row()->nama_jurusan;
		$data['siswa']			= $this->M_siswa->get(['siswa.id_kelas' => $id_kelas, 'siswa.id_jurusan' => $id_jurusan])->result();
		$data['kelas']			= $this->M_kelas->get()->result();
		$this->load->view('admin/laporan/print_spp', $data);
	}
	public function exel_spp($id_kelas, $id_jurusan)
	{
		$data['title']			= 'laporan Spp';
		$data['nama_kelas']		= $this->M_kelas->get(['id_kelas' => $id_kelas])->row()->nama_kelas;
		$data['nama_jurusan']	= $this->M_jurusan->get(['id_jurusan' => $id_jurusan])->row()->nama_jurusan;
		$data['kelas']			= $this->M_kelas->get()->result();
		$data['id_kelas']		= $id_kelas;
		$data['siswa']			= $this->M_siswa->get(['siswa.id_kelas' => $id_kelas, 'siswa.id_jurusan' => $id_jurusan])->result();
		$this->load->view('admin/laporan/exel_spp', $data);
	}


	public function tabungan(){
		$data 	= [
			'title'			=> 'Laporan Umum',
			'judul'			=> 'Halaman data laporan saldo tabungan',
			'kelas'			=> $this->M_kelas->get()->result(),
			'jurusan'		=> $this->M_jurusan->get()->result()
		];
		if (isset($_POST['cari'])) {
			$result = explode(',', $this->input->post('kelas'));
			$id_kelas = $result[0];
			$id_jurusan = $result[1];
			$kelas 		= $this->M_kelas->get(['id_kelas' => $id_kelas])->row();
			$jurusan 	= $this->M_jurusan->get(['id_jurusan' => $id_jurusan])->row();
			$siswa 		= $this->M_siswa->get(['siswa.id_kelas' => $kelas->id_kelas, 'siswa.id_jurusan' => $id_jurusan])->result();
			if (count($siswa)) {
				$data['id_kelas']		= $id_kelas;
				$data['id_jurusan']		= $id_jurusan;
				$data['nama_kelas']		= $kelas->nama_kelas;
				$data['nama_jurusan']	= $jurusan->nama_jurusan;
				$data['siswa']		 	= $siswa;
			}else{
				$data['messageError'] 	= 'Data siswa kelas <b>'.$kelas->nama_kelas.' </b>&nbsp; jurusan <b>'.$jurusan->nama_jurusan.'</b> &nbsp; tidak di temukan !';
			}
		}
		$this->lib->templateadmin('laporan/tabungan', $data);
	}
	public function print_tabungan($id_kelas, $id_jurusan, $type){
		$data['title']			= 'Print Saldo Saldo Tabungan';
		$data['nama_kelas']		= $this->M_kelas->get(['id_kelas' 	  	=> $id_kelas])->row()->nama_kelas;
		$data['nama_jurusan']	= $this->M_jurusan->get(['id_jurusan' 	=> $id_jurusan])->row()->nama_jurusan;
		$data['siswa']			= $this->M_siswa->get(['siswa.id_kelas' => $id_kelas, 'siswa.id_jurusan' => $id_jurusan])->result();
		$data['type']			= $type;
		$this->load->view('admin/laporan/print_tabungan', $data);
	}

















	public function spp_hari(){
		$data 	= [
			'title'			=> 'Laporan Spp',
			'judul'			=> 'Halaman data laporan spp perhari'
		];
		if (isset($_POST['cari'])) {
			$tanggal1 	= date('Y-m-d', strtotime($this->input->post('tanggal1')));
			$this->db->like('tanggal_bayar_spp', $tanggal1);
			$spp 	= $this->M_spp->get()->result();
			
			if (count($spp) > 0) {
				$data['spp'] =  $spp;
				$data['siswa'] = $this->M_siswa->get()->result();
			}else{
				$data['messageError'] = TRUE;
			}
			
		}
		$this->lib->templateadmin('laporan_spp/spp_hari', $data);
	}
	public function print_spp_hari($tanggal, $type){
		$tanggal 			= date('Y-m-d', strtotime($tanggal));
		$data['tanggal']	= $tanggal;
		$data['siswa']		= $this->M_siswa->get()->result();
		$data['type']		= $type;
		$this->load->view('admin/laporan_spp/print_spp_hari', $data);
	}





	public function spp_bulan(){
		$data 	= [
			'title'			=> 'Laporan Spp',
			'judul'			=> 'Halaman data laporan spp perbulan',
			'kelas'			=> $this->M_kelas->get()->result(),
			'jurusan'		=> $this->M_jurusan->get()->result()
		];
		if (isset($_POST['cari'])) {
			$tanggal1 	= date('Y-m-d H:m:s', strtotime(date('Y-m-d', strtotime($this->input->post('tanggal1'))).' 00:00:00'));
			$tanggal2 	= date('Y-m-d H:m:s', strtotime(date('Y-m-d', strtotime($this->input->post('tanggal2'))).' 23:59:00'));
			$this->db->where('tanggal_bayar_spp >=', $tanggal1);
			$this->db->where('tanggal_bayar_spp <=', $tanggal2);
			if ($this->M_spp->get(['status_spp' => 1])->num_rows()) {
				$data['spp'] = TRUE;
				$data['messageError'] = FALSE;
			}else{
				$data['spp'] = FALSE;
				$data['messageError'] = TRUE;
			}
		}
		$this->lib->templateadmin('laporan_spp/spp_bulan', $data);
	}
	public function print_spp_bulan($tanggal1, $tanggal2, $type){
		$data['title']		= 'Print Spp Perbulan';
		$data['kelas']		= $this->M_kelas->get()->result();
		$data['jurusan']	= $this->M_jurusan->get()->result();
		$data['tanggal1'] 	= date('Y-m-d H:m:s', strtotime(date('Y-m-d', strtotime($tanggal1)).' 00:00:00'));
		$data['tanggal2'] 	= date('Y-m-d H:m:s', strtotime(date('Y-m-d', strtotime($tanggal2)).' 23:59:00'));
		$data['type']		= $type;
		$this->load->view('admin/laporan_spp/print_spp_bulan', $data);
	}






	public function spp_kelas(){
		$data 	= [
			'title'			=> 'Laporan Spp',
			'judul'			=> 'Halaman data laporan spp perkelas',
			'kelas'			=> $this->M_kelas->get()->result(),
			'jurusan'		=> $this->M_jurusan->get()->result()
		];
		if (isset($_POST['cari'])) {
			$result = explode(',', $this->input->post('kelas'));
			$id_kelas = $result[0];
			$id_jurusan = $result[1];
			$siswa 		= $this->M_siswa->get(['siswa.id_kelas' => $id_kelas, 'siswa.id_jurusan' => $id_jurusan]);
			$tanggal1 	= date('Y-m-d H:m:s', strtotime(date('Y-m-d', strtotime($this->input->post('tanggal1'))).' 00:00:00'));
			$tanggal2 	= date('Y-m-d H:m:s', strtotime(date('Y-m-d', strtotime($this->input->post('tanggal2'))).' 23:59:00'));
			if ($siswa->num_rows()) {
				foreach ($siswa->result() as $key) {
					$this->db->where('tanggal_bayar_spp >=', $tanggal1);
					$this->db->where('tanggal_bayar_spp <=', $tanggal2);
					if ($this->M_spp->get(['id_siswa' => $key->id_siswa, 'status_spp' => 1])->num_rows()) {
						$data['spp']	= TRUE;
						$data['id_kelas'] = $id_kelas;
						$data['id_jurusan'] = $id_jurusan;
						$data['tanggal1'] = $tanggal1;
						$data['tanggal2'] = $tanggal2;
						$data['messageError'] = FALSE;
					}else{
						$data['messageError'] = 'Data spp perbulan tanggal <b>'.$this->lib->date_indo($tanggal1).' &nbsp; - &nbsp;  '.$this->lib->date_indo($tanggal2).' </b>, siswa kelas <b>'.$this->M_kelas->get(['id_kelas' => $id_kelas])->row()->nama_kelas.' </b> jurusan <b>'.$this->M_jurusan->get(['id_jurusan' => $id_jurusan])->row()->nama_jurusan.'</b> tidak di temukan !';
					}
				}
			}else{
				$data['messageError'] = 'Data spp perbulan tanggal <b>'.$this->lib->date_indo($tanggal1).' &nbsp; - &nbsp;  '.$this->lib->date_indo($tanggal2).' </b>, siswa kelas <b>'.$this->M_kelas->get(['id_kelas' => $id_kelas])->row()->nama_kelas.' </b> jurusan <b>'.$this->M_jurusan->get(['id_jurusan' => $id_jurusan])->row()->nama_jurusan.'</b> tidak di temukan !';
			}
		}
		$this->lib->templateadmin('laporan_spp/spp_kelas', $data);
	}
	public function print_spp_kelas($id_kelas, $id_jurusan, $tanggal1, $tanggal2, $type){
		$siswa 		= $this->M_siswa->get(['siswa.id_kelas' => $id_kelas, 'siswa.id_jurusan' => $id_jurusan]);
		$tanggal1 	= date('Y-m-d H:m:s', strtotime(date('Y-m-d', strtotime($tanggal1)).' 00:00:00'));
		$tanggal2 	= date('Y-m-d H:m:s', strtotime(date('Y-m-d', strtotime($tanggal2)).' 23:59:00'));
		$data['id_kelas']	= $id_kelas;
		$data['id_jurusan']	= $id_jurusan;
		$data['tanggal1']	= $tanggal1;
		$data['tanggal2']	= $tanggal2;
		$data['type']		= $type;
		$this->load->view('admin/laporan_spp/print_spp_kelas', $data);
	}










	public function tabungan_hari(){
		$data 	= [
			'title'			=> 'Laporan Transaksi Saldo Tabungan',
			'judul'			=> 'Halaman data laporan transaksi saldo tabungan perhari'
		];
		if (isset($_POST['cari'])) {
			$tanggal1 	= date('Y-m-d', strtotime($this->input->post('tanggal1')));
			$this->db->like('tanggal_tabungan', $tanggal1);
			$tabungan 	= $this->M_tabungan->get()->result();
			
			if (count($tabungan) > 0) {
				$data['tabungan'] =  $tabungan;
				$data['siswa'] = $this->M_siswa->get()->result();
			}else{
				$data['messageError'] = TRUE;
			}
			
		}
		$this->lib->templateadmin('laporan_tabungan/tabungan_hari', $data);
	}
	public function print_tabungan_hari($tanggal, $type){
		$tanggal 			= date('Y-m-d', strtotime($tanggal));
		$data['tanggal']	= $tanggal;
		$data['siswa']		= $this->M_siswa->get()->result();
		$data['type']		= $type;
		$this->load->view('admin/laporan_tabungan/print_tabungan_hari', $data);
	}



	public function tabungan_bulan(){
		$data 	= [
			'title'			=> 'Laporan Transaksi Saldo Tabungan',
			'judul'			=> 'Halaman data laporan transaksi saldo tabungan perbulan',
			'kelas'			=> $this->M_kelas->get()->result(),
			'jurusan'		=> $this->M_jurusan->get()->result()
		];
		if (isset($_POST['cari'])) {
			$tanggal1 	= date('Y-m-d H:m:s', strtotime(date('Y-m-d', strtotime($this->input->post('tanggal1'))).' 00:00:00'));
			$tanggal2 	= date('Y-m-d H:m:s', strtotime(date('Y-m-d', strtotime($this->input->post('tanggal2'))).' 23:59:00'));
			$this->db->where('tanggal_tabungan >=', $tanggal1);
			$this->db->where('tanggal_tabungan <=', $tanggal2);
			$tabungan 	= $this->M_tabungan->get()->result();			
			if (count($tabungan) > 0) {
				$data['tabungan'] =  $tabungan;
				$data['tanggal1'] = $tanggal1;
				$data['tanggal2'] = $tanggal2;
				$data['siswa'] = $this->M_siswa->get()->result();
			}else{
				$data['messageError'] = TRUE;
			}
			
		}
		$this->lib->templateadmin('laporan_tabungan/tabungan_bulan', $data);
	}

	public function print_tabungan_bulan($tanggal1, $tanggal2, $type){
		$tanggal1 	= date('Y-m-d H:m:s', strtotime(date('Y-m-d', strtotime($tanggal1)).' 00:00:00'));
		$tanggal2 	= date('Y-m-d H:m:s', strtotime(date('Y-m-d', strtotime($tanggal2)).' 23:59:00'));
		$data = [
			'kelas'			=> $this->M_kelas->get()->result(),
			'jurusan'		=> $this->M_jurusan->get()->result()
		];
		$data['tanggal1'] = $tanggal1;
		$data['tanggal2'] = $tanggal2;
		$data['siswa']		= $this->M_siswa->get()->result();
		$data['type']		= $type;
		$this->load->view('admin/laporan_tabungan/print_tabungan_bulan', $data);
	}



	public function tabungan_kelas()
	{
		$data 	= [
			'title'			=> 'Laporan Transaksi Saldo Tabungan',
			'judul'			=> 'Halaman data laporan transaksi saldo tabungan perkelas',
			'kelas'			=> $this->M_kelas->get()->result(),
			'jurusan'		=> $this->M_jurusan->get()->result()
		];
		if (isset($_POST['cari'])) {
			$result = explode(',', $this->input->post('kelas'));
			$id_kelas = $result[0];
			$id_jurusan = $result[1];
			$tabungan = $this->M_siswa->get(['siswa.id_kelas' => $id_kelas, 'siswa.id_jurusan' => $id_jurusan])->result();
			if (count($tabungan) > 0) {
				$data['tabungan'] =  $tabungan;
				$data['id_kelas'] = $id_kelas;
				$data['id_jurusan'] = $id_jurusan;
				$data['nama_kelas'] = $this->M_kelas->get(['id_kelas' => $id_kelas])->row()->nama_kelas;
				$data['nama_jurusan'] = $this->M_jurusan->get(['id_jurusan' => $id_jurusan])->row()->nama_jurusan;
			}else{
				$data['messageError'] = TRUE;
			}
			
		}
		$this->lib->templateadmin('laporan_tabungan/tabungan_kelas', $data);
	}
	public function print_tabungan_kelas($id_kelas, $id_jurusan, $type)
	{
		$data['id_kelas']		= $id_kelas;
		$data['id_jurusan']		= $id_jurusan;
		$data['nama_kelas'] 	= $this->M_kelas->get(['id_kelas' => $id_kelas])->row()->nama_kelas;
		$data['nama_jurusan'] 	= $this->M_jurusan->get(['id_jurusan' => $id_jurusan])->row()->nama_jurusan;
		$data['type'] 			= $type;
		$this->load->view('admin/laporan_tabungan/print_tabungan_kelas', $data);

	}



}

/* End of file Laporan.php */
/* Location: ./application/controllers/admin/Laporan.php */