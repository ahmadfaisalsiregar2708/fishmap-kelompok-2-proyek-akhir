<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
// load base class if needed
require_once APPPATH . 'controllers/base/OperatorBase.php';

// --

class Profil extends ApplicationBase
{
    const PATH_FILE_PUBLIC = 'resource/doc/images/profil/';
    protected $uploadConfig = array(
        'allowed_types' => 'gif|jpg|png|jpeg',
        'max_size'      => '1024',
      );
    // constructor
    public function __construct()
    {
        // parent constructor
        parent::__construct();
        // load model
        $this->load->model('pengaturan/m_user');
        // load library
        $this->load->library('tnotification');
    }

    public function index()
    {
        // set page rules
        $this->_set_page_rule("R");
        // set template content
        $this->smarty->assign("template_content", "pengaturan/profil/index.html");
        // data
        $rs_id = $this->m_user->getAccountDetail($this->com_user['user_id']);
        $rs_id['sosmed'] = json_decode($rs_id['sosmed'], true);
        // send
        $this->smarty->assign('rs_id', $rs_id);
        // notification
        $this->tnotification->display_notification();
        $this->tnotification->display_last_field();
        // output
        parent::display();
    }

    public function edit_bio()
    {
        // set page rules
        $this->_set_page_rule("U");
        // cek input
        $this->tnotification->set_rules('user_id', 'ID User', 'trim|required|max_length[100]');
        $this->tnotification->set_rules('id', 'ID', 'trim|max_length[100]');
        $this->tnotification->set_rules('name', 'Nama', 'trim|required|max_length[100]');
        $this->tnotification->set_rules('user_mail', 'Email', 'trim|required|max_length[100]');
        $this->tnotification->set_rules('phone', 'Phone', 'trim|required|max_length[20]');
        $this->tnotification->set_rules('mobile', 'Mobile', 'trim|required|max_length[15]');
        $this->tnotification->set_rules('address', 'Address', 'trim|required|max_length[255]');
        $this->tnotification->set_rules('pesan', 'Moto', 'trim|required');
        // process
        if ($this->tnotification->run() !== false) {
            // parameter post
            $post = $this->input->post(NULL);
            // params update
            $params = [
                'name' => $post['name'],
                'phone' => $post['phone'],
                'mobile' => $post['mobile'],
                'address' => $post['address'],
                'pesan' => $post['pesan'],
                'updated_at' => date('Y-m-d H:i:s'),
                'updated_by' => $this->com_user['user_id'],
            ];
            $params2 = [
                'user_mail' => $post['user_mail'],
                'updated_at' => date('Y-m-d H:i:s'),
                'updated_by' => $this->com_user['user_id'],
            ];
            $this->db->trans_start();
            $rs = $this->m_user->update($params2, ['user_id'=>$post['user_id']]);
            if(! empty($post['id'])){
                $rs2 = $this->m_user->updateBiodata($params, ['id'=>$post['id']]);
            } else {
                $params['user_id'] = $this->com_user['user_id'];
                $rs2 = $this->m_user->insertBiodata($params);
            }
            $this->db->trans_complete();
            //
            if($this->db->trans_status()){
                // notification
                $this->tnotification->delete_last_field();
                $this->tnotification->sent_notification("success", "Data berhasil disimpan");
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

    public function edit_pass()
    {
        // set page rules
        $this->_set_page_rule("U");
        // cek input
        $this->tnotification->set_rules('user_id', 'ID User', 'trim|required|max_length[100]');
        $this->tnotification->set_rules('user_pass', 'Password', 'trim|required|max_length[100]');
        $this->tnotification->set_rules('user_pass_conf', 'Konfirmasi Password', 'trim|required|max_length[100]|matches[user_pass]');
        // process
        if ($this->tnotification->run() !== false) {
            // parameter post
            $post = $this->input->post(NULL);
            $params = [
                'user_pass' => password_hash($post['user_pass'], PASSWORD_DEFAULT),
            ];
            //
            $rs = $this->m_user->update($params, ['user_id'=>$post['user_id']]);
            if($rs){
                // notification
                $this->tnotification->delete_last_field();
                $this->tnotification->sent_notification("success", "Data berhasil disimpan");
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

    public function edit_sosmed()
    {
        // set page rules
        $this->_set_page_rule("U");
        $def = ['github'=>null, 'twitter'=>null, 'instagram'=>null, 'facebook'=>null];
        $post = $this->input->post(NULL);
        if(! empty($post)){
            $rs = $this->m_user->getAccountDetail([$post['user_id']]);
            if(! empty($rs['sosmed'])){
                $sosmed = json_decode($rs['sosmed'], true);
            } else {
                $sosmed = $def;
            }
            $sosmed[$post['name']] = $post['value'];
            // update
            $r = $this->m_user->updateBiodata(['sosmed'=>json_encode($sosmed)], ['id'=>$rs['id']]);
            if($r){
                $csrf = [
                    'name' => $this->security->get_csrf_token_name(),
                    'hash' => $this->security->get_csrf_hash(),
                ];
                echo json_encode($csrf);
            } else {
                show_404();
            }
        } else {
            show_404();
        }
    }

    public function ubah_foto()
    {
        // set page rules
        $this->_set_page_rule("U");
        // cek input
        $this->tnotification->set_rules('id', 'ID', 'trim|max_length[100]');
        // process
        if ($this->tnotification->run() !== false) {
            $post = $this->input->post(NULL);
            $image = self::_upload_file('foto');
            $post_image  = self::PATH_FILE_PUBLIC.($image['file_name'] ?? '../ajax-loader.gif');
            $rs = $this->m_user->updateBiodata(['foto'=>$post_image], ['id'=>$post['id']]);
            $rs = $this->m_user->update(['user_photo'=>$post_image], ['user_id'=>$post['user_id']]);
            if($rs) {
                // notification
                $this->tnotification->delete_last_field();
                $this->tnotification->sent_notification("success", "Data berhasil disimpan");
            } else {
                $this->tnotification->sent_notification("error", "Data gagal disimpan");
            }
        } else {
            // default error
            $this->tnotification->sent_notification("error", "Data gagal disimpan");
        }
        // default redirect
        redirect($_SERVER['HTTP_REFERER']);
    }

    // upload file
    private function _upload_file($input_name) {
        // set page rules
        $this->_set_page_rule("C");
        $config['upload_path']          = self::PATH_FILE_PUBLIC;
        $config['allowed_types']        = $this->uploadConfig['allowed_types'];
        $config['max_size']             = $this->uploadConfig['max_size'];

        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        // process
        if ( ! $this->upload->do_upload($input_name))
        {
            throw new Exception($this->upload->display_errors());
        }
        else
        {
            $uploaded = $this->upload->data();
            if (is_file($uploaded['full_path']) == false) {
                throw new Exception('File tidak ditemukan');
            }
            return $uploaded;
        }
    }
}