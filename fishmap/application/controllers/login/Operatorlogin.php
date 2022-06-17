<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
// load base class if needed
require_once APPPATH . 'controllers/base/OperatorLoginBase.php';

// --

class Operatorlogin extends ApplicationBase
{
    // constructor
    public function __construct()
    {
        // parent constructor
        parent::__construct();
        // load global
        $this->load->library('tnotification');
    }

    // view
    public function index($status = "")
    {
        // set template content
        $this->smarty->assign("template_content", "login/operator/form.html");
        // clear captcha
        $captcha_data = $this->tsession->userdata('data');
        if (isset($captcha_data['captcha_time'])) {
            $capctha_path = 'resource/doc/captcha/' . $captcha_data['captcha_time'] . '.jpg';
            if (is_file($capctha_path)) {
                unlink($capctha_path);
            }
        }
        // set captcha
        $this->load->helper("captcha");
        $vals = array(
            'img_path' => FCPATH . '/resource/doc/captcha/',
            'img_url' => base_url() . '/resource/doc' . '/captcha/',
            'font_path' => FCPATH . '/resource/doc/font/COURIER.TTF',
            'font_size' => 96,
            'img_height' => 39,
            'img_width' => 200,
            'expiration' => 7200,
        );
        $captcha = create_captcha($vals);
        $data = array(
            'captcha_time' => $captcha['time']  = isset($captcha['time']) ? $captcha['time'] : '',
            'ip_address' => $_SERVER["REMOTE_ADDR"],
            'word' => $captcha['word']  = isset($captcha['word']) ? $captcha['word'] : '',
        );
        $this->tsession->set_userdata("data", $data);
        $this->smarty->assign("captcha", $captcha);

        // bisnis proses
        if (!empty($this->com_user)) {
            // logout
            $rs = $this->m_account->get_user_profil($this->com_user);
            // redirect('login/operatorlogin/logout_process');
            $this->smarty->assign('login_st', $rs);
        } else {
            $this->smarty->assign("login_st", $status);
        }
        // output
        parent::display();
    }

    // login process
    public function login_process()
    {
        // set rules
        $this->tnotification->set_rules('username', 'Username', 'trim|required|max_length[30]');
        $this->tnotification->set_rules('pass', 'Password', 'trim|required|max_length[30]');
        $this->tnotification->set_rules('captcha', 'Kode Captcha', 'trim|required');
        // process
        if ($this->tnotification->run() !== false) {
            // captcha
            $captcha = trim($this->input->post('captcha', true));
            $captcha_data = $this->tsession->userdata('data');
            $expiration = time() - 7200;
            if ($captcha_data['word'] == $captcha and $captcha_data['captcha_time'] > $expiration) {
                // skip --
            } else {
                // output
                $this->tsession->set_flashdata('captcha', 'Kode Captcha Kamu Salah.!');
                redirect('login/operatorlogin/index');
            }
            // params
            $username = trim($this->input->post('username', true));
            $password = trim($this->input->post('pass', true));
            // get user detail
            $result = $this->m_account->get_user_login_auto_role($username, $password, $this->portal_id);
            // Cek New
            if ($result['user_name'] === $username) {
                if (password_verify($password, $result['user_pass'])) {
                    if ($result['lock_st'] == '1') {
                        // output
                        redirect('login/operatorlogin/index/locked');
                    }
                    // load setting
                    $this->load->model('m_settings');
                    //
                    $data_user = ['user_id' => $result['user_id'], 'role_id' => $result['role_id']];
                    // set session to all portal by user
                    $portal = $this->m_settings->get_portal_user($result['user_id']);
                    foreach ($portal as $a => $b) {
                        $this->tsession->set_userdata($b['portal_session'], $data_user);
                    }
                    // insert login time
                    $this->m_account->save_user_login($result['user_id'], $_SERVER['REMOTE_ADDR']);
                    // redirect
                    redirect($result['default_page']);
                } else {
                    $this->tsession->set_flashdata('username', 'Password Kamu Salah.!!');
                    redirect('login/operatorlogin/index');
                }
            } else {
                $this->tsession->set_flashdata('username', 'Username Atau password Kamu Salah.!!');
                redirect('login/operatorlogin/index');
            }
        } else {
            // default error
            $this->tsession->set_flashdata('notif', 'Password Kamu Salah.!!');
            redirect('login/operatorlogin/index');
        }
        // output
        redirect('login/operatorlogin');
    }

    // logout process
    public function logout_process()
    {
        // load setting
        $this->load->model('m_settings');
        // user id
        $user_id = $this->tsession->userdata('session_operator');
        // insert logout time
        $this->m_account->update_user_logout($user_id['user_id']);
        // unset session
        $portal = $this->m_settings->get_all_portal();
        foreach ($portal as $a => $b) {
            $this->tsession->unset_userdata($b['portal_session']);
        }
        // output
        redirect('login/operatorlogin');
    }
}
