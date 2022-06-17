<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
// load base class if needed
require_once APPPATH . 'controllers/base/OperatorBase.php';

class Pengaturan extends ApplicationBase
{
    const PATH_FILE_PUBLIC = 'resource/doc/images/';
    protected $uploadConfig = array(
        'allowed_types' => 'gif|jpg|png',
        'max_size'      => '1024',
    );
    // constructor
    public function __construct()
    {
        parent::__construct();
        // load model
        $this->load->model('pengaturan/m_preference');
        // load library
        $this->load->library('tnotification');
    }

    // welcome operator
    public function index()
    {
        // set page rules
        $this->_set_page_rule("R");
        // set template content
        $this->smarty->assign("template_content", "pengaturan/pengaturan/index.html");
        // load js dan css
        $this->smarty->load_javascript("fishmap/plugins/fancy-file-uploader/jquery.ui.widget.js");
        $this->smarty->load_javascript("fishmap/plugins/fancy-file-uploader/jquery.fileupload.js");
        $this->smarty->load_javascript("fishmap/plugins/fancy-file-uploader/jquery.iframe-transport.js");
        $this->smarty->load_javascript("fishmap/plugins/fancy-file-uploader/jquery.fancy-fileupload.js");
        $this->smarty->load_style("fishmap/plugins/fancy-file-uploader/fancy_fileupload.css");
        //
        $tmp = $this->m_preference->get_where(['pref_group' => 'general']);
        $pref = [];
        foreach ($tmp as $a => $b) {
            $pref[$b['pref_nm']] = [
                'id' => $b['pref_id'],
                'value' => $b['pref_value'],
            ];
        }
        //
        $this->smarty->assign('rs', $pref);
        // notification
        $this->tnotification->display_notification();
        // output
        parent::display();
    }

    public function footer()
    {
        // set page rules
        $this->_set_page_rule("R");
        // set template content
        $this->smarty->assign("template_content", "pengaturan/pengaturan/footer.html");
        // load js dan css
        $this->smarty->load_javascript("fishmap/plugins/fancy-file-uploader/jquery.ui.widget.js");
        $this->smarty->load_javascript("fishmap/plugins/fancy-file-uploader/jquery.fileupload.js");
        $this->smarty->load_javascript("fishmap/plugins/fancy-file-uploader/jquery.iframe-transport.js");
        $this->smarty->load_javascript("fishmap/plugins/fancy-file-uploader/jquery.fancy-fileupload.js");
        $this->smarty->load_style("fishmap/plugins/fancy-file-uploader/fancy_fileupload.css");
        //
        $tmp = $this->m_preference->get_where(['pref_group' => 'footer']);
        $pref = [];
        foreach ($tmp as $a => $b) {
            $pref[$b['pref_nm']] = [
                'id' => $b['pref_id'],
                'value' => $b['pref_value'],
            ];
        }
        $this->smarty->assign('rs', $pref);
        // column 
        $col = [];
        for ($i = 1; $i < 4; $i++) {
            $tmp = $this->m_preference->get_where(['pref_group' => 'column_' . $i]);
            foreach ($tmp as $a => $b) {
                $col[$i][$b['pref_nm']] = [
                    'id' => $b['pref_id'],
                    'value' => $b['pref_value'],
                ];
            }
        }
        $this->smarty->assign('col', $col);
        //
        // notification
        $this->tnotification->display_notification();
        // output
        parent::display();
    }

    public function edit_process()
    {
        // set page rules
        $this->_set_page_rule("U");
        $this->tnotification->set_rules('site_title[]', 'Site Title', 'trim|required');
        $this->tnotification->set_rules('site_logo[]', 'Site Logo', 'trim|required');
        $this->tnotification->set_rules('site_footer[]', 'Site Footer', 'trim|required');
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
                //
                if ($a == 'site_logo') {
                    if ($_FILES['site_logoo']['name']) {
                        $logo = self::_upload_file("site_logoo"); // file_name
                        $params = [
                            'pref_value' => base_url() . '/' . self::PATH_FILE_PUBLIC . ($logo['file_name'] ?? 'ajax-loader.gif'),
                            'updated_by' => $this->com_user['user_id'],
                        ];
                        $rs = $this->m_preference->update($params, $where);
                    }
                } elseif ($a == 'site_icon') {
                    if ($_FILES['site_iconn']['name']) {
                        $icon = self::_upload_file("site_iconn"); // file_name
                        $params = [
                            'pref_value' => base_url() . '/' . self::PATH_FILE_PUBLIC . ($icon['file_name'] ?? 'ajax-loader.gif'),
                            'updated_by' => $this->com_user['user_id'],
                        ];
                        $rs = $this->m_preference->update($params, $where);
                    }
                } else {
                    $params = [
                        'pref_value' => $b['value'],
                        'updated_by' => $this->com_user['user_id'],
                    ];
                    $rs = $this->m_preference->update($params, $where);
                }
                //
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

    public function footer_process()
    {
        // set page rules
        $this->_set_page_rule("U");
        $this->tnotification->set_rules('site_title[]', 'Site Title', 'trim');
        // process
        if ($this->tnotification->run() !== false) {
            $po = $this->input->post(NULL);
            // echo "<pre>";
            // print_r($po); die;
            //
            $rs = false;
            $this->db->trans_start();
            foreach ($po as $a => $b) {
                $where = [
                    'pref_id' => $b['id']
                ];
                //
                // jika isi kolom
                $col = null;
                if (isset($b['text'])) {
                    $col = [
                        'text' => $b['text'],
                        'link' => $b['link'],
                    ];
                }
                $col = json_encode($col);
                //
                $params = [
                    'pref_value' => $b['value'] ?? $col,
                    'updated_by' => $this->com_user['user_id'],
                ];
                $rs = $this->m_preference->update($params, $where);
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() == true) {
                // sukses
                $this->tnotification->sent_notification("success", "Data berhasil disimpan");
                redirect($_SERVER['HTTP_REFERER']);
                die;
            }
        }
        // error
        $this->tnotification->sent_notification("error", "Data gagal disimpan");
        redirect($_SERVER['HTTP_REFERER']);
    }

    function _upload_file($input_name)
    {
        // set page rules
        $this->_set_page_rule("C");
        $config['upload_path']          = self::PATH_FILE_PUBLIC;
        $config['allowed_types']        = $this->uploadConfig['allowed_types'];
        $config['max_size']             = $this->uploadConfig['max_size'];

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload($input_name)) {
            throw new Exception($this->upload->display_errors());
        } else {
            $uploaded = $this->upload->data();
            if (is_file($uploaded['full_path']) == false) {
                throw new Exception('File tidak ditemukan');
            }
            return $uploaded;
        }
    }
}
