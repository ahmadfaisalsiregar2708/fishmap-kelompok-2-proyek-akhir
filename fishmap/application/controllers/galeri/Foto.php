<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
// load base class if needed
require_once APPPATH . 'controllers/base/OperatorBase.php';

class Foto extends ApplicationBase
{
    const PATH_FILE_PUBLIC = 'resource/doc/';
    protected $uploadConfig = array(
        'allowed_types' => 'jpg|png|image|jpeg|gif',
        'max_size'      => '1024',
    );


    // constructor
    public function __construct()
    {
        // parent constructor
        parent::__construct();
        // load model
        $this->load->model('galeri/M_gallery_album');
        $this->load->model('galeri/M_gallery_files');
        // load library
        $this->load->library('tnotification');
        $this->load->library('pagination');
    }

    // list album
    public function index()
    {
        // set page rules
        $this->_set_page_rule("R");
        // set template content
        $this->smarty->assign("template_content", "galeri/foto/album/index.html");
        // get search parameter
        $search = $this->tsession->userdata('search_data_foto');
        $this->smarty->assign("search", $search);
        // search parameters                    
        $search_param['album_title'] = empty($search['album_title']) ? '%' : '%' . $search['album_title'] . '%';
        /* start of pagination --------------------- */
        // pagination                
        $params = [
            'album_type' => 'image',
            $search_param['album_title']
        ];
        $config['base_url'] = site_url("galeri/foto/album/index/");
        $config['total_rows'] = $this->M_gallery_album->get_total_data($params);
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
        $limit = [($start - 1), $config['per_page']];
        $rs_id = $this->M_gallery_album->get_gallery_album($params, $limit);
        $this->smarty->assign('rs_id', $rs_id);
        // notification
        $this->tnotification->display_notification();
        $this->tnotification->display_last_field();
        // output
        parent::display();
    }

    // add album
    public function add()
    {
        // set page rules
        $this->_set_page_rule("C");
        // set template content
        $this->smarty->assign("template_content", "galeri/foto/album/add.html");
        // load js              
        // notification
        $this->tnotification->display_notification();
        $this->tnotification->display_last_field();
        // output
        parent::display();
    }

    // edit album
    public function edit($album_id = null)
    {
        // set page rules
        $this->_set_page_rule("U");
        // set template content
        $this->smarty->assign("template_content", "galeri/foto/album/index.html");
        $this->smarty->assign("template_content", "galeri/foto/album/edit.html");
        /* start of pagination --------------------- */
        // pagination            
        $params = [
            'album_id'    => $album_id
        ];
        $config['base_url'] = site_url("galeri/foto/edit/" . $album_id . "/");
        $config['total_rows'] = $this->M_gallery_files->count_gallery_files($params);
        $config['uri_segment'] = 5;
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
        $start = $this->uri->segment(5, 0) + 1;
        $end = $this->uri->segment(5, 0) + $config['per_page'];
        $end = $end > $config['total_rows'] ? $config['total_rows'] : $end;
        $pagination['start'] = $config['total_rows'] == 0 ? 0 : $start;
        $pagination['end'] = $end;
        $pagination['total'] = $config['total_rows'];
        // pagination assign value
        $this->smarty->assign("pagination", $pagination);
        $this->smarty->assign("no", $start);
        /* end of pagination ---------------------- */
        // get data                               
        $limit = [($start - 1), $config['per_page']];
        $rs_file = $this->M_gallery_files->get_gallery_files($params, $limit);
        $this->smarty->assign('rs_file', $rs_file);
        $this->smarty->assign("result", $this->M_gallery_files->get_id_album($album_id));
        // edit
        if (empty($album_id)) {
            // default error
            $this->tnotification->sent_notification("error", "Data gagal diedit");
            redirect($_SERVER['HTTP_REFERER']);
        }
        // load js css
        $this->smarty->load_style('admin/plugins/bootstrap/css/bootstrap.min.css');
        // post
        $result = $this->M_gallery_album->get_by_id($album_id);
        $this->smarty->assign("result", $result);
        // notification
        $this->tnotification->display_notification();
        $this->tnotification->display_last_field();
        // output
        parent::display();
    }

    // search album process
    public function search_process()
    {
        // set page rules
        $this->_set_page_rule("R");
        // data
        if ($this->input->post('save') == "Reset") {
            $this->tsession->unset_userdata('search_data_foto');
        } else {
            $params = array(
                "album_title" => $this->input->post("album_title")
            );
            $this->tsession->set_userdata('search_data_foto', $params);
        }
        // default redirect
        redirect($_SERVER['HTTP_REFERER']);
    }

    // add album process
    public function add_process()
    {
        // set page rules
        $this->_set_page_rule("C");
        // cek input        
        $this->tnotification->set_rules('album_title', 'Judul', 'trim|max_length[255]|required');
        $this->tnotification->set_rules('album_note', 'Catatan', 'trim|max_length[255]|required');

        // process
        if ($this->tnotification->run() !== false) {
            // parameters        
            $album_type = 'image';
            $params = array(
                'album_title'       => $this->input->post('album_title', TRUE),
                'album_note'        => htmlspecialchars($this->input->post('album_note', TRUE)),
                'album_type'        => $album_type,
                'created_at'        => date("Y-m-d H:i:s"),
                'created_by'        => $this->com_user['user_name']
            );

            // insert
            if ($this->M_gallery_album->insert($params)) {
                // notification
                $this->tnotification->delete_last_field();
                $this->tnotification->sent_notification("success", "Data berhasil disimpan");
                $album_id = $this->db->insert_id();
                redirect(site_url('galeri/foto/edit/' . $album_id));
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

    // edit album process
    public function edit_process()
    {
        // set page rules
        $this->_set_page_rule("C");
        // cek input
        $this->tnotification->set_rules('album_id', 'ID', 'trim|required');
        $this->tnotification->set_rules('album_title', 'Judul', 'trim|max_length[255]|required');

        // process
        if ($this->tnotification->run() !== false) {
            // parameters                    
            $params = array(
                'album_title'       => $this->input->post('album_title', TRUE),
                'album_note'        => htmlspecialchars($this->input->post('album_note', TRUE)),
                'updated_at'        => date("Y-m-d H:i:s"),
                'updated_by'        => $this->com_user['user_name'],
            );
            $where = array(
                'album_id' => $this->input->post('album_id', TRUE),
            );
            // update
            if ($this->M_gallery_album->update($params, $where)) {
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

    // delete album process
    public function delete_process($album_id = null)
    {
        // set page rules
        $this->_set_page_rule("D");

        if (empty($album_id)) {
            // default error
            $this->tnotification->sent_notification("error", "Data gagal dihapus");
            redirect($_SERVER['HTTP_REFERER']);
        }
        // parameter         
        $params = [
            'album_id'   => $album_id
        ];
        $rs = $this->M_gallery_album->delete($params);
        if ($rs) {
            $this->tnotification->sent_notification("success", "Data berhasil dihapus");
        } else {
            $this->tnotification->sent_notification("error", "Data gagal dihapus");
        }
        redirect('galeri/foto/index');
    }

    // add file
    public function add_file($album_id = null)
    {
        // set page rules
        $this->_set_page_rule("C");
        // set template content
        $this->smarty->assign("template_content", "galeri/foto/file/add.html");
        // load js                      
        // get data 
        $this->smarty->assign("result", $this->M_gallery_files->get_id_album($album_id));
        // notification
        $this->tnotification->display_notification();
        $this->tnotification->display_last_field();
        // output
        parent::display();
    }

    // edit file
    public function edit_file($file_id = null)
    {
        // set page rules
        $this->_set_page_rule("U");
        if (empty($file_id)) {
            // default error
            $this->tnotification->sent_notification("error", "Data gagal diedit");
            redirect($_SERVER['HTTP_REFERER']);
        }
        // set template content
        $this->smarty->assign("template_content", "galeri/foto/file/edit.html");
        // load js                      
        // post
        $result = $this->M_gallery_files->get_id_file($file_id);
        $this->smarty->assign("result", $result);
        // notification
        $this->tnotification->display_notification();
        $this->tnotification->display_last_field();
        // output
        parent::display();
    }

    // add file process
    public function add_file_process($album_id)
    {
        // set page rules
        $this->_set_page_rule("C");
        // cek input        
        $this->tnotification->set_rules('file_desc', 'Deskripsi', 'trim|max_length[255]|required');

        // process
        if ($this->tnotification->run() !== false) {
            // parameters
            if ($_FILES['file_path']['name']) {
                $file           = self::_upload_file('file_path'); // file_name                                                                            
                $file_path      = self::PATH_FILE_PUBLIC . ($file['file_name'] ?? 'ajax-loader.gif');
            }
            $file_type  = 'image';
            $file_url   = NULL;
            $params = array(
                'album_id'          => $album_id,
                'file_type'         => $file_type,
                'file_desc'         => htmlspecialchars($this->input->post('file_desc', TRUE)),
                'file_path'         => $file_path,
                'file_url'          => $file_url,
                'created_at'        => date("Y-m-d H:i:s"),
                'created_by'        => $this->com_user['user_name']
            );

            // insert
            if ($this->M_gallery_files->insert($params)) {
                // notification
                $this->tnotification->delete_last_field();
                $this->tnotification->sent_notification("success", "Data berhasil disimpan");
                redirect(site_url('galeri/foto/edit/' . $album_id));
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

    // edit file process
    public function edit_file_process()
    {
        // set page rules
        $this->_set_page_rule("C");
        // cek input
        $this->tnotification->set_rules('file_id', 'ID', 'trim|required');
        $this->tnotification->set_rules('file_desc', 'Deskripsi', 'trim|max_length[255]|required');
        // process
        if ($this->tnotification->run() !== false) {
            // parameters             
            if ($_FILES['file_path']['name']) {
                $file           = self::_upload_file('file_path'); // file_name                                                                            
                $file_path      = self::PATH_FILE_PUBLIC . ($file['file_name'] ?? 'ajax-loader.gif');
            } else {
                $file_path   = NULL;
            }
            $params = array(
                'file_desc'         => htmlspecialchars($this->input->post('file_desc', TRUE)),
                'file_url'          => NULL,
                'updated_at'        => date("Y-m-d H:i:s"),
                'updated_by'        => $this->com_user['user_name'],
            );
            if (!empty($file_path)) {
                $params['file_path'] = $file_path;
            }
            $where = array(
                'file_id' => $this->input->post('file_id', TRUE),
            );

            // update
            if ($this->M_gallery_files->update($params, $where)) {
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

    // delete file process
    public function delete_file_process($file_id = null)
    {
        // set page rules
        $this->_set_page_rule("D");

        if (empty($file_id)) {
            // default error
            $this->tnotification->sent_notification("error", "Data gagal dihapus");
            redirect($_SERVER['HTTP_REFERER']);
        }
        // parameter         
        $params = [
            'file_id'   => $file_id
        ];
        $rs = $this->M_gallery_files->delete($params);
        if ($rs) {
            $this->tnotification->sent_notification("success", "Data berhasil dihapus");
        } else {
            $this->tnotification->sent_notification("error", "Data gagal dihapus");
        }
        redirect('galeri/foto/index');
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
}
