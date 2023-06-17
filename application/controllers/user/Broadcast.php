<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Broadcast extends CI_Controller {

	public function index()
	{
		$this->lib->templateuser('broadcast/index');
	}

}

/* End of file broadcast.php */
/* Location: ./application/controllers/user/broadcast.php */