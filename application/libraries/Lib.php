<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lib
{
	protected $ci;

	public function __construct()
	{
        $this->ci =& get_instance();
        date_default_timezone_set('Asia/Jakarta');  
	}

	public function templateadmin($content, $data=NULL){
		$this->ci->load->view('admin/template/header', $data);
	    $this->ci->load->view('admin/template/sidebar', $data);
	    $this->ci->load->view('admin/'.$content, $data);
	    $this->ci->load->view('admin/template/footer', $data);
	}

    public function templateuser($content, $data=NULL){
        $data['nama_sekolah']   = $this->ci->db->get_where('setting', ['name' => 'nama_sekolah' ])->row()->value;
        $data['alamat_sekolah'] = $this->ci->db->get_where('setting', ['name' => 'alamat_sekolah' ])->row()->value;
        $data['logo_sekolah']   = $this->ci->db->get_where('setting', ['name' => 'logo_sekolah' ])->row()->value;
        $data['email_sekolah']   = $this->ci->db->get_where('setting', ['name' => 'email_sekolah' ])->row()->value;
        $data['no_telp_sekolah']   = $this->ci->db->get_where('setting', ['name' => 'no_telp_sekolah' ])->row()->value;
        $data['tentang_kami']   = $this->ci->db->get_where('setting', ['name' => 'tentang_kami' ])->row()->value;
        $data['broadcast']   = $this->ci->db->get_where('setting', ['name' => 'broadcast' ])->row()->value;
        $data['tanggal_broadcast']   = $this->ci->db->get_where('setting', ['name' => 'broadcast' ])->row()->tanggal_setting;
        $this->ci->load->view('user/template/header', $data);
        $this->ci->load->view('user/'.$content, $data);
        $this->ci->load->view('user/template/footer', $data);
    }
    
   
    public function date_indo($date)
    {
        if ($date == '0000-00-00') {
            return '0000-00-00';
        }
        $BulanIndo = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");

        $tahun = substr($date, 0, 4);
        $bulan = substr($date, 5, 2);
        $tgl   = substr($date, 8, 2);

        $result = $tgl . " " . $BulanIndo[(int) $bulan - 1] . " " . $tahun;
        return ($result);
    }
     public function date_time($date)
    {
        if ($date == '0000-00-00 00:00:00') {
            return '0000-00-00 00:00:00';
        }
        $time = substr($date, 10);
        $BulanIndo = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");



        $tahun = substr($date, 0, 4);
        $bulan = substr($date, 5, 2);
        $tgl   = substr($date, 8, 2);

        $result = $tgl . " " . $BulanIndo[(int) $bulan - 1] . " " . $tahun . " " . $time;
        return ($result);
    }
    public function date_bulan($date)
    {
        if ($date == '') {
            return '';
        }
        $BulanIndo = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
        $bulan = substr($date, 5, 2);

        $result = $BulanIndo[(int) $bulan - 1];
        return ($result);
    }
    

}

/* End of file Mylibrary.php */
/* Location: ./application/libraries/Mylibrary.php */
