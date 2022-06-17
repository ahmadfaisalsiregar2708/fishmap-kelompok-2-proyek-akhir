<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
// load base class if needed
require_once APPPATH . 'controllers/base/OperatorBase.php';

class Dashboard extends ApplicationBase
{
    // constructor
    public function __construct()
    {
        parent::__construct();
        // load model
        $this->load->model([
            'informasi/M_berita',
            'informasi/M_tim',
            'informasi/M_artikel',            
        ]);
    }

    // welcome operator
    public function index()
    {
        // set page rules
        $this->_set_page_rule("R");
        // get rules                   
        $params_berita = ['post_category' => 'berita', '%', '%'];
        $params_artikel = ['post_category' => 'artikel', '%', '%'];
        $params_tim = ['post_category' => 'tim', '%', '%'];        
        // get berita
        $berita = $this->M_berita->get_total_berita($params_berita);
        $rs_berita = $this->M_berita->get_berita($params_berita,  [0, 6]);
        // get artikel
        $artikel = $this->M_artikel->get_total_artikel($params_artikel);
        $rs_artikel = $this->M_artikel->get_artikel($params_artikel, [0, 6]);
        // get tim
        $tim = $this->M_tim->get_total_tim($params_tim);        
        $this->smarty->assign(['berita' => $berita, 'tim' => $tim, 'artikel' => $artikel, 'rs_berita' => $rs_berita, 'rs_artikel' => $rs_artikel]);
        // set template content
        $this->smarty->assign("template_content", "dashboard.html");
        // load js                                       
        $this->smarty->load_javascript("fishmap/plugins/datetimepicker/js/datepicker.min.js");
        // load css
        $this->smarty->load_style("fishmap/plugins/datetimepicker/css/datepicker.min.css");
        // output
        parent::display();
    }
}
