<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
// load base class if needed
require_once APPPATH . 'controllers/base/OperatorBase.php';

class Data extends ApplicationBase
{
    const PATH_FILE_PUBLIC = 'resource/doc/';
    protected $uploadConfig = array(
        'allowed_types' => 'xlsx|xls|csv',
        'max_size'      => '10240',
    );

    // constructor
    public function __construct()
    {
        // parent constructor
        parent::__construct();
        // load model
        $this->load->model('halaman/M_dokumen_kategori');
        $this->load->model('halaman/M_dokumen_file');
        // load library
        $this->load->library('tnotification');
        $this->load->library('pagination');
    }

    // list kategori
    public function index()
    {
        // set page rules
        $this->_set_page_rule("R");
        // set template content
        $this->smarty->assign("template_content", "halaman/data/kategori/index.html");
        // get search parameter
        $search = $this->tsession->userdata('search_data_dokumen');
        $this->smarty->assign("search", $search);
        // search parameters                    
        $search_param['cat_title'] = empty($search['cat_title']) ? '%' : '%' . $search['cat_title'] . '%';
        /* start of pagination --------------------- */
        // pagination                
        $params = [
            $search_param['cat_title']
        ];
        $config['base_url'] = site_url("halaman/data/kategori/index/");
        $config['total_rows'] = $this->M_dokumen_kategori->count_where($params);
        $config['uri_segment'] = 4;
        $config['per_page'] = 20;

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
        $rs_id = $this->M_dokumen_kategori->get_dokumen_kategori($params, $limit);
        $this->smarty->assign('rs_id', $rs_id);
        // notification
        $this->tnotification->display_notification();
        $this->tnotification->display_last_field();
        // output
        parent::display();
    }

    // add kategori
    public function add()
    {
        // set page rules
        $this->_set_page_rule("C");
        // set template content
        $this->smarty->assign("template_content", "halaman/data/kategori/add.html");
        // notification
        $this->tnotification->display_notification();
        $this->tnotification->display_last_field();
        // output
        parent::display();
    }

    // edit kategori
    public function edit($cat_id = null)
    {
        // set page rules
        $this->_set_page_rule("U");
        if (empty($cat_id)) {
            // default error
            $this->tnotification->sent_notification("error", "Data gagal diedit");
            redirect($_SERVER['HTTP_REFERER']);
        }
        // set template content
        $this->smarty->assign("template_content", "halaman/data/kategori/edit.html");
        // load js                      
        // post
        $result = $this->M_dokumen_kategori->get_by_id($cat_id);
        $this->smarty->assign("result", $result);
        // notification
        $this->tnotification->display_notification();
        $this->tnotification->display_last_field();

        $search = $this->tsession->userdata('search_file');
        $this->smarty->assign("search", $search);
        // search parameters                    
        $search_param['doc_title'] = empty($search['doc_title']) ? '%' : '%' . $search['doc_title'] . '%';
        /* start of pagination --------------------- */
        // pagination            
        $params = [
            'doc_title' => $search_param['doc_title'],
            'cat_id'    => $cat_id
        ];
        $config['base_url'] = site_url("halaman/data/edit/" . $cat_id . "/");
        $config['total_rows'] = $this->M_dokumen_file->count_dokumen_file($params);
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
        $rs_file = $this->M_dokumen_file->get_dokumen_file($params, $limit);
        $this->smarty->assign('rs_file', $rs_file);
        $this->smarty->assign("result", $this->M_dokumen_kategori->get_id_kategori($cat_id));
        // notification
        $this->tnotification->display_notification();
        $this->tnotification->display_last_field();
        // output
        parent::display();
    }

    // search kategori process
    public function search_process()
    {
        // set page rules
        $this->_set_page_rule("R");
        // data
        if ($this->input->post('save') == "Reset") {
            $this->tsession->unset_userdata('search_data_dokumen');
        } else {
            $params = array(
                "cat_title" => $this->input->post("cat_title")
            );
            $this->tsession->set_userdata('search_data_dokumen', $params);
        }
        // default redirect
        redirect($_SERVER['HTTP_REFERER']);
    }

    // add kategori process
    public function add_process()
    {
        // set page rules
        $this->_set_page_rule("C");
        // cek input        
        $this->tnotification->set_rules('cat_title', 'Judul', 'trim|max_length[255]|required');
        $this->tnotification->set_rules('cat_desc', 'Deskripsi', 'trim|required');

        // process
        if ($this->tnotification->run() !== false) {
            // parameters            
            $params = array(
                'cat_title'         => $this->input->post('cat_title', TRUE),
                'cat_desc'          => htmlspecialchars($this->input->post('cat_desc', TRUE)),
                'created_at'        => date("Y-m-d H:i:s"),
                'created_by'        => $this->com_user['user_name']
            );

            // insert
            if ($this->M_dokumen_kategori->insert($params)) {
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

    // edit kategori process
    public function edit_process()
    {
        // set page rules
        $this->_set_page_rule("C");
        // cek input
        $this->tnotification->set_rules('cat_id', 'ID', 'trim|required');
        $this->tnotification->set_rules('cat_title', 'Judul', 'trim|max_length[255]|required');
        $this->tnotification->set_rules('cat_desc', 'Deskripsi', 'trim|required');

        // process
        if ($this->tnotification->run() !== false) {
            // parameters        
            $params = array(
                'cat_title'         => $this->input->post('cat_title', TRUE),
                'cat_desc'          => htmlspecialchars($this->input->post('cat_desc', TRUE)),
                'updated_at'        => date("Y-m-d H:i:s"),
                'updated_by'        => $this->com_user['user_name'],
            );
            $where = array(
                'cat_id' => $this->input->post('cat_id', TRUE),
            );
            // update
            if ($this->M_dokumen_kategori->update($params, $where)) {
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

    // delete kategori process
    public function delete_process($cat_id = null, $param_delete = null)
    {
        // set page rules
        $this->_set_page_rule("D");

        if (empty($cat_id)) {
            // default error
            $this->tnotification->sent_notification("error", "Data gagal dihapus");
            redirect($_SERVER['HTTP_REFERER']);
        }
        // parameter         
        $params = [
            'cat_id'   => $cat_id
        ];
        $rs = $this->M_dokumen_kategori->delete($params);
        $doc_file = $this->M_dokumen_file->delete($params);
        if ($rs &&  $doc_file) {
            $this->tnotification->sent_notification("success", "Data berhasil dihapus");
        } else {
            $this->tnotification->sent_notification("error", "Data gagal dihapus");
        }
        if ($param_delete) {
            redirect('halaman/data');
        }
        redirect($_SERVER['HTTP_REFERER']);
    }


    // add file
    public function add_file($cat_id = null)
    {
        // set page rules
        $this->_set_page_rule("C");
        // set template content
        $this->smarty->assign("template_content", "halaman/data/file/add.html");
        // load js                                       
        $this->smarty->load_javascript("fishmap/plugins/datetimepicker/js/datepicker.min.js");
        // load css
        $this->smarty->load_style("fishmap/plugins/datetimepicker/css/datepicker.min.css");
        // get data 
        $this->smarty->assign("result", $this->M_dokumen_kategori->get_id_kategori($cat_id));
        // notification
        $this->tnotification->display_notification();
        $this->tnotification->display_last_field();
        // output
        parent::display();
    }

    // edit file
    public function edit_file($doc_id = null)
    {
        // set page rules
        $this->_set_page_rule("U");
        if (empty($doc_id)) {
            // default error
            $this->tnotification->sent_notification("error", "Data gagal diedit");
            redirect($_SERVER['HTTP_REFERER']);
        }
        // set template content
        $this->smarty->assign("template_content", "halaman/data/file/edit.html");
        // load js                                       
        $this->smarty->load_javascript("fishmap/plugins/datetimepicker/js/datepicker.min.js");
        // load css
        $this->smarty->load_style("fishmap/plugins/datetimepicker/css/datepicker.min.css");
        // post
        $result = $this->M_dokumen_file->get_id_file($doc_id);
        $this->smarty->assign("result", $result);
        // notification
        $this->tnotification->display_notification();
        $this->tnotification->display_last_field();
        // output
        parent::display();
    }

    // search file process
    public function search_file_process()
    {
        // set page rules
        $this->_set_page_rule("R");
        // data
        if ($this->input->post('save') == "Reset") {
            $this->tsession->unset_userdata('search_file');
        } else {
            $params = array(
                "doc_title" => $this->input->post("doc_title")
            );
            $this->tsession->set_userdata('search_file', $params);
        }
        // default redirect
        redirect($_SERVER['HTTP_REFERER']);
    }

    // add file process
    public function add_file_process($cat_id)
    {
        // set page rules
        $this->_set_page_rule("C");
        // cek input        
        $this->tnotification->set_rules('doc_title', 'Judul', 'trim|max_length[255]|required');
        $this->tnotification->set_rules('doc_year', 'Tahun', 'trim|max_length[4]|required');

        // process
        if ($this->tnotification->run() !== false) {
            // parameters
            if ($_FILES['doc_file']['name']) {
                $file           = self::_upload_file('doc_file'); // file_name                                                                            
                $doc_file       = self::PATH_FILE_PUBLIC . ($file['file_name'] ?? 'ajax-loader.gif');
                $doc_type       = pathinfo($_FILES['doc_file']['name'], PATHINFO_EXTENSION);
            }
            $params = array(
                'cat_id'            => $cat_id,
                'doc_title'         => $this->input->post('doc_title', TRUE),
                'doc_year'          => $this->input->post('doc_year', TRUE),
                'doc_month'         => $this->input->post('doc_month', TRUE),
                'doc_desc'          => htmlspecialchars($this->input->post('doc_desc', TRUE)) ?? NULL,
                'doc_type'          => $doc_type,
                'doc_file'          => $doc_file,
                'created_at'        => date("Y-m-d H:i:s"),
                'created_by'        => $this->com_user['user_name']
            );

            // insert
            if ($this->M_dokumen_file->insert($params)) {
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

    // edit file process
    public function edit_file_process()
    {
        // set page rules
        $this->_set_page_rule("C");
        // cek input
        $this->tnotification->set_rules('doc_id', 'ID', 'trim|required');
        $this->tnotification->set_rules('doc_title', 'Judul', 'trim|max_length[255]|required');
        $this->tnotification->set_rules('doc_year', 'Tahun', 'trim|max_length[4]|required');

        // process
        if ($this->tnotification->run() !== false) {
            // parameters
            if ($_FILES['doc_file']['name']) {
                $file           = self::_upload_file('doc_file'); // file_name                                                                            
                $doc_file       = self::PATH_FILE_PUBLIC . ($file['file_name'] ?? 'ajax-loader.gif');
                $doc_type       = pathinfo($_FILES['doc_file']['name'], PATHINFO_EXTENSION);
            } else {
                $doc_file   = NULL;
                $doc_type   = NULL;
            }
            $params = array(
                'doc_title'         => $this->input->post('doc_title', TRUE),
                'doc_year'          => $this->input->post('doc_year', TRUE),
                'doc_month'         => $this->input->post('doc_month', TRUE),
                'doc_desc'          => htmlspecialchars($this->input->post('doc_desc', TRUE)) ?? NULL,
                'updated_at'        => date("Y-m-d H:i:s"),
                'updated_by'        => $this->com_user['user_name'],
            );
            if (!empty($doc_file)) {
                $params['doc_file'] = $doc_file;
                $params['doc_type'] = $doc_type;
            }
            $where = array(
                'doc_id' => $this->input->post('doc_id', TRUE),
            );

            // update
            if ($this->M_dokumen_file->update($params, $where)) {
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
    public function delete_file_process($doc_id = null)
    {
        // set page rules
        $this->_set_page_rule("D");

        if (empty($doc_id)) {
            // default error
            $this->tnotification->sent_notification("error", "Data gagal dihapus");
            redirect($_SERVER['HTTP_REFERER']);
        }
        // parameter         
        $params = [
            'doc_id'   => $doc_id
        ];
        $rs = $this->M_dokumen_file->delete($params);
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

    //  action status active
    public function status_active()
    {
        $element = $this->input->post('doc_active');
        $id = $this->input->post('doc_id');
        $this->M_dokumen_file->update(['doc_active' => $element == 1 ? '0' : 1], ['doc_id' => $id,]);

        $data['name'] = $this->security->get_csrf_token_name();
        $data['csrf'] = $this->security->get_csrf_hash();

        echo json_encode($data);
    }
}
