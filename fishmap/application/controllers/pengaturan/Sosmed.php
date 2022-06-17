<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
// load base class if needed
require_once APPPATH . 'controllers/base/OperatorBase.php';

// --

class Sosmed extends ApplicationBase
{
    // constructor
    public function __construct()
    {
        // parent constructor
        parent::__construct();
        // load model
        $this->load->model('pengaturan/m_preference');
        // load library
        $this->load->library('tnotification');
    }

    public function index()
    {
        // set page rules
        $this->_set_page_rule("R");
        // set template content
        $this->smarty->assign("template_content", "pengaturan/sosmed/index.html");
        // load js dan css
        $this->smarty->load_javascript("fishmap/plugins/fancy-file-uploader/jquery.ui.widget.js");
        $this->smarty->load_javascript("fishmap/plugins/fancy-file-uploader/jquery.fileupload.js");
        $this->smarty->load_javascript("fishmap/plugins/fancy-file-uploader/jquery.iframe-transport.js");
        $this->smarty->load_javascript("fishmap/plugins/fancy-file-uploader/jquery.fancy-fileupload.js");
        $this->smarty->load_style("fishmap/plugins/fancy-file-uploader/fancy_fileupload.css");

        // load js                                     
        $this->smarty->load_javascript('fishmap/plugins/select2/js/select2.min.js');
        $this->smarty->load_javascript('fishmap/js/form-select2.js');
        $this->smarty->load_javascript("fishmap/plugins/summernote/summernote-lite.js");
        $this->smarty->load_javascript("fishmap/plugins/summernote/ajaximageupload.js");
        // load css
        $this->smarty->load_style('fishmap/plugins/select2/css/select2.min.css');
        $this->smarty->load_style('fishmap/plugins/select2/css/select2-bootstrap4.css');
        $this->smarty->load_style("fishmap/plugins/summernote/summernote-lite.css");
        $this->smarty->load_style("fishmap/plugins/summernote/ajaximageupload.css");
        //
        $tmp = $this->m_preference->get_where(['pref_group' => 'sosmed']);
        $pref = [];
        $icon = [
            'facebook' => 'lni lni-facebook-original',
            'instagram' => 'lni lni-instagram-original',
            'twitter' => 'lni lni-twitter-original',
            'youtube' => 'lni lni-youtube',
            'tiktok' => 'lni lni-tiktok',
        ];
        foreach ($tmp as $a => $b) {
            $pref[$b['pref_nm']] = [
                'id' => $b['pref_id'],
                'value' => $b['pref_value'],
                'icon' => $icon[$b['pref_nm']] ?? NULL,
            ];
        }
        //
        $this->smarty->assign('rs', $pref);
        // notification
        $this->tnotification->display_notification();
        // output
        parent::display();
    }
    public function edit_process()
    {
        // set page rules
        $this->_set_page_rule("U");
        //
        $tmp = $this->m_preference->get_where(['pref_group' => 'sosmed']);
        foreach ($tmp as $b) {
            $this->tnotification->set_rules($b['pref_nm'] . '[]', $b['pref_nm'], 'trim|required');
        }
        // process
        if ($this->tnotification->run() !== false) {
            $po = $this->input->post(NULL);
            //
            $rs = false;
            $this->db->trans_start();
            foreach ($po as $a => $b) {
                $where = [
                    'pref_id' => $b['id']
                ];
                $params = [
                    'pref_value' => $b['value'],
                    'updated_by' => $this->com_user['user_id'],
                ];
                $rs = $this->m_preference->update($params, $where);
            }
            $this->db->trans_complete();
            if ($rs) {
                // sukses
                $this->tnotification->sent_notification("success", "Data berhasil disimpan");
            } else {
                // gagal
                $this->tnotification->sent_notification("error", "Data gagal disimpan");
            }
            redirect($_SERVER['HTTP_REFERER']);
            die;
        }
        // error
        $this->tnotification->sent_notification("error", "Data gagal disimpan");
        redirect($_SERVER['HTTP_REFERER']);
    }
}
