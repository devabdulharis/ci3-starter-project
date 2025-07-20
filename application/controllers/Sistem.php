<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sistem extends MY_Controller {

    public function index() {
        $this->load->view('sistem/v_sistem_conf');
    }

}