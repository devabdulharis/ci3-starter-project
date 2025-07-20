<?php
defined('BASEPATH') or exit('No direct script access allowed');

use App\Libraries\REST_Controller;
class Ping extends REST_Controller
{
    // Gunakan metode HTTP sesuai kebutuhan
    public function index_get()
    {
        $response = array('rc' => '00', 'msg' => 'pong');
        $this->response($response, REST_Controller::HTTP_OK);
    }
}