<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
// load base class if needed
require_once APPPATH . 'controllers/base/OperatorBase.php';

class Popup extends ApplicationBase
{
    const PATH_FILE_PUBLIC = 'resource/doc/images/';
    protected $uploadConfig = array(
        'allowed_types' => 'gif|jpg|png',
        'max_size'      => '1024',
    );
    protected $popup = [
        1 => "Gambar_popup", 2 => "Tautan"
    ];

    // constructor
    public function __construct()
    {
        // parent constructor
        parent::__construct();
        // load model
        $this->load->model('pengaturan/M_popup');
        // $this->load->model('layanan/M_produk');
        $this->load->model('layanan/M_layanan');
        $this->load->model('halaman/M_dokumen_kategori');
        // load library
        $this->load->library('tnotification');
        $this->load->library('pagination');

        $this->smarty->assign('popup', $this->popup);
    }

    // list data
    public function index($active = null)
    {
        // set page rules
        $this->_set_page_rule("R");
        // set template content
        $this->smarty->assign("template_content", "pengaturan/popup/index.html");

        // get popup image parameter
        $rs_id = $this->M_popup->get_popup(["%"], [0, 5]);
        if ($active == 1 || $active == null) {
            $this->smarty->assign('rs_id', $rs_id);
        }
        $this->smarty->assign('rs_id', $rs_id);


        // get tautan
        if ($active == 2) {
            $params = [
                'doc_title' => ['%'],
                'id'    => $rs_id['id']
            ];
            $rs_file = $this->M_popup->get_popup_layanan($params, [0, 5]);
            $this->smarty->assign('rs_file', $rs_file);
        }
        // send data
        $this->smarty->assign('active', $active);
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
        // get data
        $rs_id = $this->M_layanan->get_layanan("%");
        $this->smarty->assign('rs_id', $rs_id);
        // view
        $this->smarty->assign("template_content", "pengaturan/popup/add.html");
        // load js              
        $this->smarty->load_javascript('fishmap/js/form-text-editor.js');
        // notification
        $this->tnotification->display_notification();
        $this->tnotification->display_last_field();
        // output
        parent::display();
    }

    // edit form
    public function edit($slide_id = null)
    {
        // set page rules
        $this->_set_page_rule("U");
        if (empty($slide_id)) {
            // default error
            $this->tnotification->sent_notification("error", "Data gagal diedit");
            redirect($_SERVER['HTTP_REFERER']);
        }
        // set template content
        $this->smarty->assign("template_content", "pengaturan/popup/edit.html");
        // load js css
        $this->smarty->load_javascript('fishmap/js/form-text-editor.js');
        // post
        // $rs_id = $this->M_produk->get_p("%");
        $result = $this->M_popup->get_id_popup($slide_id);
        // $result['slide_desc'] = htmlspecialchars_decode($result['slide_desc']);
        $params = [
            'doc_title' => ['%'],
            'id'    => $slide_id
        ];
        $rs_file = $this->M_popup->get_popup_layanan($params, [0, 5]);
        $this->smarty->assign('rs_file', $rs_file);
        $this->smarty->assign('rs_id', $rs_id);
        $this->smarty->assign("result", $result);
        // notification
        $this->tnotification->display_notification();
        $this->tnotification->display_last_field();
        // output
        parent::display();
    }

    // search process
    public function search_process()
    {
        // set page rules
        $this->_set_page_rule("R");
        // data
        if ($this->input->post('save') == "Reset") {
            $this->tsession->unset_userdata('search_data');
        } else {
            $params = array(
                "title" => $this->input->post("title"),
            );
            $this->tsession->set_userdata('search_data', $params);
        }
        // default redirect
        redirect($_SERVER['HTTP_REFERER']);
    }

    // add process
    public function add_process()
    {
        // set page rules
        $this->_set_page_rule("C");
        // cek input        
        $this->tnotification->set_rules('title', 'Judul Popup', 'trim|required');
        $this->tnotification->set_rules('is_active', 'Popup Aktif', 'trim|max_length[100]|required');

        // process
        if ($this->tnotification->run() !== false) {
            // parameters
            if ($_FILES['img']['name']) {
                $image       = self::_upload_file('img'); // file_name                                                                            
                $img         = self::PATH_FILE_PUBLIC . ($image['file_name'] ?? 'ajax-loader.gif');
            }
            $params = array(
                'text'              => $this->input->post('title', TRUE),
                'title'             => $this->input->post('title', TRUE),
                'img'               => $img,
                'is_active'         => $this->input->post('is_active', TRUE),
                'created_at'        => date("Y-m-d H:i:s"),
                'created_by'        => $this->com_user['user_name']
            );

            $popup_produk = [
                'popup_id'          => $this->input->post('produk_id'),
                'post_id'         => $this->input->post('produk_id'),
                'created_at'        => date("Y-m-d H:i:s"),
            ];
            // $this->db->insert('popup_produk', $popup_produk);

            // insert
            if ($this->M_popup->insert($params)) {
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

    // edit process
    public function edit_process()
    {
        // set page rules
        $this->_set_page_rule("C");
        // cek input
        $this->tnotification->set_rules('alamat_tautan', 'tautan link', 'required');

        // process
        if ($this->tnotification->run() !== false) {
            // parameters
            if ($_FILES['img']['name']) {
                $image      = self::_upload_file('img'); // file_name                                                                                    
                $img        = self::PATH_FILE_PUBLIC . ($image['file_name'] ?? 'ajax-loader.gif');
            } else {
                $img = NULL;
            }
            $params = array(
                'alamat_tautan'     => $this->input->post('alamat_tautan'),
                'updated_at'        => date("Y-m-d H:i:s"),
                'updated_by'        => $this->com_user['user_name'],
            );

            $where = array(
                'id' => $this->input->post('id', TRUE),
            );

            if (!empty($img)) {
                $params['img'] = $img;
            }
            $where = array(
                'id' => $this->input->post('id', TRUE),
            );
            // update
            if ($this->M_popup->update($params, $where)) {
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

    // delete process
    public function delete_process($popup_id = null)
    {
        // set page rules
        $this->_set_page_rule("D");

        if (empty($popup_id)) {
            // default error
            $this->tnotification->sent_notification("error", "Data gagal dihapus");
            redirect($_SERVER['HTTP_REFERER']);
        }
        // parameter         
        $params = [
            'id'   => $popup_id
        ];
        $rs = $this->M_popup->delete($params);
        if ($rs) {
            $this->tnotification->sent_notification("success", "Data berhasil dihapus");
        } else {
            $this->tnotification->sent_notification("error", "Data gagal dihapus");
        }
        redirect($_SERVER['HTTP_REFERER']);
    }

    // upload file
    function _upload_file($input_name)
    {
        // set page rules
        $this->_set_page_rule("C");
        $config['upload_path']          = self::PATH_FILE_PUBLIC;
        $config['allowed_types']        = $this->uploadConfig['allowed_types'];
        $config['max_size']             = $this->uploadConfig['max_size'];

        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        // process
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

    // ajax status active
    public function status_active()
    {
        $elment = $this->input->post('is_active');
        $id = $this->input->post('id');
        $this->M_popup->update(['is_active' => $elment == 1 ? '0' : 1], ['id' => $id,]);

        $data['name'] = $this->security->get_csrf_token_name();
        $data['csrf'] = $this->security->get_csrf_hash();

        echo json_encode($data);
    }


    public function add_file($cat_id = null)
    {
        // set page rules
        $this->_set_page_rule("C");
        // set template content
        $this->smarty->assign("template_content", "pengaturan/popup/file/add.html");
        // load js                                       
        $this->smarty->load_javascript("fishmap/plugins/datetimepicker/js/datepicker.min.js");
        // load css
        $this->smarty->load_style("fishmap/plugins/datetimepicker/css/datepicker.min.css");
        // get data 
        $this->smarty->assign("id", $cat_id);
        // notification
        $this->tnotification->display_notification();
        $this->tnotification->display_last_field();
        // output
        parent::display();
    }

    public function add_file_proccess()
    {
        // set page rules
        $this->_set_page_rule("C");
        // cek input or validation
        $this->tnotification->set_rules('name_tautan', 'Nama Tautan', 'trim|required');
        // process
        if ($this->tnotification->run() !== false) {
            // parameters
            if ($_FILES['photo']['name']) {
                $image       = self::_upload_file('photo'); // file_name                                                                            
                $photo         = self::PATH_FILE_PUBLIC . ($image['file_name'] ?? 'ajax-loader.gif');
            }
            $params = array(
                'id'                => $this->input->post('id', TRUE),
                'name'              => $this->input->post('name_tautan', TRUE),
                'alamat_tautan'     => $this->input->post('alamat_tautan', TRUE),
                'photo'             => $photo,
                'created_at'        => date("Y-m-d H:i:s"),
                'created_by'        => $this->com_user['user_name']
            );
            // insert
            if ($this->M_popup->insert_layanan($params)) {
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

    // Edit File
    public function edit_file($id = null)
    {
        // set page rules
        $this->_set_page_rule("R");
        // set template content
        $this->smarty->assign("template_content", "pengaturan/popup/file/edit.html");

        // get popup image parameter
        if ($id) {
            $result = $this->M_popup->get_id_layanan($id);
            $this->smarty->assign('result', $result);
        }
        // notification
        $this->tnotification->display_notification();
        $this->tnotification->display_last_field();
        // output
        parent::display();
    }

    // Edit Proccess
    public function edit_file_proccess_layanan()
    {
        // set page rules
        $this->_set_page_rule("C");
        // cek input
        $this->tnotification->set_rules('name_tautan', 'Nama Tautan', 'trim|required');

        // process
        if ($this->tnotification->run() !== false) {
            // parameters
            if ($_FILES['photo']['name']) {
                $image      = self::_upload_file('photo'); // file_name                                                                                    
                $photo        = self::PATH_FILE_PUBLIC . ($image['file_name'] ?? 'ajax-loader.gif');
            } else {
                $photo = NULL;
            }
            $params = array(
                'name'              => $this->input->post('name_tautan', TRUE),
                'alamat_tautan'     => $this->input->post('alamat_tautan', TRUE),
                'updated_at'        => date("Y-m-d H:i:s"),
                'updated_by'        => $this->com_user['user_name'],
            );

            $where = array(
                'id' => $this->input->post('id', TRUE),
            );

            if (!empty($photo)) {
                $params['photo'] = $photo;
            }
            $where = array(
                'pop_id' => $this->input->post('id', TRUE),
            );
            // update
            if ($this->M_popup->edit_file_proccess_layanan($params, $where)) {
                // notification
                $this->tnotification->delete_last_field();
                $this->tnotification->sent_notification("success", "Data berhasil disimpan");
            } else {
                // default error
                $this->tnotification->sent_notification("error", "Data gagal disimpan");
            }
        } else {
            // default error
            $this->tnotification->sent_notification("error", "Data gagal disimpan nih");
        }
        // default redirect
        redirect($_SERVER['HTTP_REFERER']);
    }

    // Delete Proccess popup layanan
    public function delete_proccess_layanan($popup_id)
    {
        // set page rules
        $this->_set_page_rule("D");

        if (empty($popup_id)) {
            // default error
            $this->tnotification->sent_notification("error", "Data gagal dihapus");
            redirect($_SERVER['HTTP_REFERER']);
        }
        // parameter         
        $params = [
            'pop_id'   => $popup_id
        ];
        $rs = $this->M_popup->delete_proccess_layanan($params);
        if ($rs) {
            $this->tnotification->sent_notification("success", "Data berhasil dihapus");
        } else {
            $this->tnotification->sent_notification("error", "Data gagal dihapus");
        }
        redirect($_SERVER['HTTP_REFERER']);
    }
}
