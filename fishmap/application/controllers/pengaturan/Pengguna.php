<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
// load base class if needed
require_once APPPATH . 'controllers/base/OperatorBase.php';

// --

class Pengguna extends ApplicationBase
{
    private $roles = ['id' => [2, 3], 'value' => ['Administrator', 'Contributor']];

    // constructor
    public function __construct()
    {
        // parent constructor
        parent::__construct();
        // load model
        $this->load->model('pengaturan/m_user');
        // load library
        $this->load->library('tnotification');
        $this->load->library('pagination');
    }

    // list data
    public function index()
    {
        // set page rules
        $this->_set_page_rule("R");
        // set template content
        $this->smarty->assign("template_content", "pengaturan/pengguna/index.html");
        /* start of pagination --------------------- */
        // pagination
        $config['base_url'] = site_url("pengaturan/pengguna/index/");
        $config['total_rows'] = $this->m_user->getPengguna(['2'], '', '1');
        $config['uri_segment'] = 4;
        $config['per_page'] = 50;

        $config['attributes'] = array('class' => 'page-link');
        $config['next_link'] = 'Selanjutnya';
        $config['prev_link'] = 'Sebelumnya';
        $config['first_link'] = 'Awal';
        $config['last_link'] = 'Akhir';
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tag_close'] = '</li>';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_tag_close'] = '</li>';
        $config['first_tag_open'] = '<li class="page-item">';
        $config['first_tag_close'] = '</li>';

        $this->pagination->initialize($config);
        $pagination['data'] = $this->pagination->create_links();
        // pagination attribute
        $start = $this->uri->segment(4, 0) + 1;
        $end = $this->uri->segment(4, 0) + $config['per_page'];
        $end = $end > $config['total_rows'] ? $config['total_rows'] : $end;
        $pagination['start'] = $config['total_rows'] == 0 ? 0 : $start;
        $pagination['end'] = $end;
        $pagination['total'] = $config['total_rows'];
        // pagination assign value
        $this->smarty->assign("pagination", $pagination);
        $this->smarty->assign("no", $start);
        /* end of pagination ---------------------- */
        // get data
        $limit = [$start - 1, $config['per_page']];
        $rs_id = $this->m_user->getPengguna(['2'], $limit);
        $this->smarty->assign("rs_id", $rs_id);
        // notification
        $this->tnotification->display_notification();
        $this->tnotification->display_last_field();
        // output
        parent::display();
    }

    // add form
    public function add()
    {
        // set page rules
        $this->_set_page_rule("C");
        // set template content
        $this->smarty->assign("template_content", "pengaturan/pengguna/add.html");
        // load js css
        $this->smarty->load_javascript('fishmap/plugins/select2/js/select2.min.js');
        $this->smarty->load_style('fishmap/plugins/select2/css/select2.min.css');
        $this->smarty->load_style('fishmap/plugins/select2/css/select2-bootstrap4.css');
        // role
        $this->smarty->assign("roles", $this->roles);
        $this->smarty->assign("lock", ['id' => ['0', '1'], 'value' => ['Unlock', 'Lock']]);
        // notification
        $this->tnotification->display_notification();
        $this->tnotification->display_last_field();
        // output
        parent::display();
    }

    // edit form
    public function edit($id = null)
    {
        // set page rules
        $this->_set_page_rule("U");
        if (empty($id)) {
            // default error
            $this->tnotification->sent_notification("error", "Data gagal diedit");
            redirect($_SERVER['HTTP_REFERER']);
        }
        // set template content
        $this->smarty->assign("template_content", "pengaturan/pengguna/edit.html");
        // load js css
        $this->smarty->load_javascript('fishmap/plugins/select2/js/select2.min.js');
        $this->smarty->load_style('fishmap/plugins/select2/css/select2.min.css');
        $this->smarty->load_style('fishmap/plugins/select2/css/select2-bootstrap4.css');
        // role
        $result = $this->m_user->get_by_id($id);
        $this->smarty->assign("roles", $this->roles);
        $this->smarty->assign("result", $result);
        $this->smarty->assign("lock", ['id' => ['0', '1'], 'value' => ['Unlock', 'Lock']]);
        // notification
        $this->tnotification->display_notification();
        $this->tnotification->display_last_field();
        // output
        parent::display();
    }

    // add process
    public function add_process()
    {
        // set page rules
        $this->_set_page_rule("C");
        // cek input
        $this->tnotification->set_rules('user_mail', 'User Email', 'trim|required|valid_email|max_length[50]|is_unique[com_user.user_mail]');
        $this->tnotification->set_rules('user_name', 'User Name', 'trim|required|max_length[50]|is_unique[com_user.user_name]');
        $this->tnotification->set_rules('user_pass', 'Password', 'trim|required|max_length[255]');
        $this->tnotification->set_rules('user_pass_conf', 'Password Confirm', 'trim|required|max_length[255]|matches[user_pass]');
        $this->tnotification->set_rules('lock_st', 'Lock Status', 'trim|required|max_length[1]');
        $this->tnotification->set_rules('role_id', 'Hak Akses', 'required');

        // process
        if ($this->tnotification->run() !== false) {
            $this->db->trans_start();
            $password = password_hash($this->input->post('user_pass'), PASSWORD_DEFAULT);
            // parameter
            $po = $this->input->post(NULL);
            // insert
            $params = [
                'user_name' => $po['user_name'],
                'user_pass' => $password,
                'user_mail' => $po['user_mail'],
                'lock_st' => $po['lock_st'],
                'mdb' => $this->com_user['user_id'],
                'created_at' => date('Y-m-d H:i:s'),
                'created_by' => $this->com_user['user_name'],
            ];
            if ($this->m_user->insert($params)) {
                // get last id
                $user_id = $this->m_user->get_insert_id();
                // insert hak akses
                $params = [
                    'user_id' => $user_id,
                    'role_id' => $po['role_id'],
                ];
                $this->m_user->insertRole($params);
                // notification
                $this->tnotification->delete_last_field();
                $this->tnotification->sent_notification("success", "Data berhasil disimpan");
                $this->db->trans_complete();
            } else {
                // default error
                $this->tnotification->sent_notification("error", "Data gagal disimpan");
            }
        } else {
            // default error
            $this->tnotification->sent_notification("error", "Data gagal disimpan");
        }
        // default redirect
        redirect($_SERVER['HTTP_REFERER']);
    }

    // add process
    public function edit_process()
    {
        // set page rules
        $this->_set_page_rule("C");
        // cek input
        $this->tnotification->set_rules('user_mail', 'User Email', 'trim|required|valid_email|max_length[50]');
        $this->tnotification->set_rules('user_name', 'User Name', 'trim|required|max_length[50]');
        $this->tnotification->set_rules('user_pass', 'Password', 'trim|max_length[255]');
        $this->tnotification->set_rules('user_pass_conf', 'Password Confirm', 'trim|max_length[255]|matches[user_pass]');
        $this->tnotification->set_rules('lock_st', 'Lock Status', 'trim|required|max_length[1]');
        $this->tnotification->set_rules('role_id', 'Hak Akses', 'required');
        $this->tnotification->set_rules('user_id', 'User ID', 'required');

        // process
        if ($this->tnotification->run() !== false) {
            $this->db->trans_start();
            // parameter
            $po = $this->input->post(NULL);
            // insert
            $params = [
                // 'user_name' => $po['user_name'],
                'user_mail' => $po['user_mail'],
                'lock_st' => $po['lock_st'],
                'updated_at' => date('Y-m-d H:i:s'),
                'updated_by' => $this->com_user['user_name'],
            ];
            if (!empty($po['user_pass'])) {
                $password = password_hash($po['user_pass'], PASSWORD_DEFAULT);
                $params['user_pass'] = $password;
            }
            if ($this->m_user->update($params, ['user_id' => $po['user_id']])) {
                // get last id
                $user_id = $po['user_id'];
                // insert hak akses
                $params = [
                    'user_id' => $user_id,
                    'role_id' => $po['role_id'],
                ];
                $this->m_user->insertRole($params);
                // notification
                $this->tnotification->delete_last_field();
                $this->tnotification->sent_notification("success", "Data berhasil disimpan");
                $this->db->trans_complete();
            } else {
                // default error
                $this->tnotification->sent_notification("error", "Data gagal disimpan");
            }
        } else {
            // default error
            $this->tnotification->sent_notification("error", "Data gagal disimpan");
        }
        // default redirect
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function delete_process($id = null)
    {
        // set page rules
        $this->_set_page_rule("D");
        //
        if (empty($id)) {
            // default error
            $this->tnotification->sent_notification("error", "Data gagal dihapus");
            redirect($_SERVER['HTTP_REFERER']);
        }
        //
        $params = [
            'user_id' => $id
        ];
        $rs = $this->m_user->delete($params);
        if ($rs) {
            $this->tnotification->sent_notification("success", "Data berhasil dihapus");
        } else {
            $this->tnotification->sent_notification("error", "Data gagal dihapus");
        }
        redirect($_SERVER['HTTP_REFERER']);
    }
}
