<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

// --

class Forbidden extends CI_Controller
{
    // constructor
    public function __construct()
    {
        parent::__construct();
    }

    // forbidden page
    public function index()
    {
        $this->load->view('login/forbidden/index.html');
    }
}
