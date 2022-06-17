<?php

// if (!defined('BASEPATH')) {
//     exit('No direct script access allowed');
// }
// load base class if needed
require_once APPPATH . 'controllers/base/PublicBase.php';

// --

class Prediksi extends ApplicationBase
{
    // constructor
    public function __construct()
    {
        // parent constructor
        parent::__construct();    
    }

    // prediksi
    public function index()
    {           
        // set template content
        $this->smarty->assign("template_content", "prediksi.php");   
        //$this->smarty->assign("template_content", "python_app/predik.php"); 
        // output
        parent::display();
    }
        
}
