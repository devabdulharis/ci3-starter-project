<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Exceptions extends MY_Controller {
	
	public function custom_404()
	{
		$this->load->view('v_error_404');
	}
}