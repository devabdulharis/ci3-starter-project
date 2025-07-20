<?php
defined('BASEPATH') or exit('No direct script access allowed');

use App\Libraries\REST_Controller;

class Secure extends REST_Controller
{
    public function test_get()
    {
        $response = [
            'rc' => '00',
            'msg' => 'Authenticated!'
        ];
        $this->response($response, REST_Controller::HTTP_OK);
    }
}
