<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
// load base class if needed
require_once APPPATH . 'controllers/base/OperatorBase.php';

class Layanan extends ApplicationBase
{
    const PATH_FILE_PUBLIC = 'resource/doc/images/';
    protected $uploadConfig = array(
        'allowed_types' => 'jpg|png|image|jpeg|gif',
        'max_size'      => '1024',
        'max_width'     => '200',
        'max_height'    => '200',
    );

    // constructor
    public function __construct()
    {
        // parent constructor
        parent::__construct();
        // load model
        $this->load->model('layanan/M_layanan');
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
        $this->smarty->assign("template_content", "layanan/layanan/index.html");
        // get search parameter
        $search = $this->tsession->userdata('search_data_layanan');
        $this->smarty->assign("search", $search);
        // search parameters                    
        $search_param['title'] = empty($search['title']) ? '%' : '%' . $search['title'] . '%';
        /* start of pagination --------------------- */
        // pagination                
        $params = [
            $search_param['title'],
        ];
        $config['base_url'] = site_url("layanan/layanan/index/");
        $config['total_rows'] = $this->M_layanan->get_total_layanan($params);
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
        $rs_id = $this->M_layanan->get_layanan($params, $limit);
        $this->smarty->assign('rs_id', $rs_id);
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
        $this->smarty->assign("template_content", "layanan/layanan/add.html");
        // load js              
        // notification
        $this->tnotification->display_notification();
        $this->tnotification->display_last_field();
        // output
        parent::display();
    }

    // edit form
    public function edit($layanan_id = null)
    {
        // set page rules
        $this->_set_page_rule("U");
        if (empty($layanan_id)) {
            // default error
            $this->tnotification->sent_notification("error", "Data gagal diedit");
            redirect($_SERVER['HTTP_REFERER']);
        }
        // set template content
        $this->smarty->assign("template_content", "layanan/layanan/edit.html");
        // load js css
        // post        
        $result = $this->M_layanan->get_id_layanan($layanan_id);
        $result['desc'] = htmlspecialchars_decode($result['desc']);
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
            $this->tsession->unset_userdata('search_data_layanan');
        } else {
            $params = array(
                "title" => $this->input->post("title")
            );
            $this->tsession->set_userdata('search_data_layanan', $params);
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
        $this->tnotification->set_rules('title', 'Judul', 'trim|required');
        $this->tnotification->set_rules('url', 'Url', 'trim|required');
        $this->tnotification->set_rules('desc', 'Konten', 'trim|required');

        // process
        if ($this->tnotification->run() !== false) {
            // parameters
            if ($_FILES['icon']['name']) {
                $image       = self::_upload_file('icon'); // file_name                                                                            
                $icon        = self::PATH_FILE_PUBLIC . ($image['file_name'] ?? 'ajax-loader.gif');
            }
            $position = $this->M_layanan->get_total_layanan(['%']);
            $params = array(
                'title'             => $this->input->post('title', TRUE),
                'desc'              => htmlspecialchars($this->input->post('desc', TRUE)),
                'url'               => $this->input->post('url', TRUE),
                'icon'              => $icon,
                'layanan_active'    => $this->input->post('layanan_active'),
                'position'          => $position + 1,
                'created_at'        => date("Y-m-d H:i:s"),
                'created_by'        => $this->com_user['user_name']
            );
            // insert
            if ($this->M_layanan->insert($params)) {
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
        $this->tnotification->set_rules('layanan_id', 'ID', 'trim|required');
        $this->tnotification->set_rules('title', 'Judul', 'trim|required');
        $this->tnotification->set_rules('url', 'Url', 'trim|required');
        $this->tnotification->set_rules('desc', 'Konten', 'trim|required');

        // process
        if ($this->tnotification->run() !== false) {
            // parameters
            if ($_FILES['icon']['name']) {
                $image      = self::_upload_file('icon'); // file_name                                                                                    
                $icon       = self::PATH_FILE_PUBLIC . ($image['file_name'] ?? 'ajax-loader.gif');
            } else {
                $icon = NULL;
            }
            $params = array(
                'title'             => $this->input->post('title', TRUE),
                'desc'              => htmlspecialchars($this->input->post('desc', TRUE)),
                'url'               => $this->input->post('url', TRUE),
                'layanan_active'    => $this->input->post('layanan_active'),
                'updated_at'        => date("Y-m-d H:i:s"),
                'updated_by'        => $this->com_user['user_name'],
            );
            if (!empty($icon)) {
                $params['icon'] = $icon;
            }
            $where = array(
                'layanan_id' => $this->input->post('layanan_id', TRUE),
            );
            // update
            if ($this->M_layanan->update($params, $where)) {
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
    public function delete_process($layanan_id = null, $param_delete = null)
    {
        // set page rules
        $this->_set_page_rule("D");

        if (empty($layanan_id)) {
            // default error
            $this->tnotification->sent_notification("error", "Data gagal dihapus");
            redirect($_SERVER['HTTP_REFERER']);
        }
        // parameter         
        $params = [
            'layanan_id'   => $layanan_id
        ];
        $rs = $this->M_layanan->delete($params);
        if ($rs) {
            $this->tnotification->sent_notification("success", "Data berhasil dihapus");
        } else {
            $this->tnotification->sent_notification("error", "Data gagal dihapus");
        }
        if ($param_delete) {
            redirect('layanan/layanan');
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
        $config['max_width']            = $this->uploadConfig['max_width'];
        $config['max_height']           = $this->uploadConfig['max_height'];

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

    //  Action status active
    public function status_active()
    {
        $elment = $this->input->post('layanan_active');
        $id = $this->input->post('layanan_id');
        $this->M_layanan->update(['layanan_active' => $elment == 1 ? '0' : 1], ['layanan_id' => $id,]);

        $data['name'] = $this->security->get_csrf_token_name();
        $data['csrf'] = $this->security->get_csrf_hash();

        echo json_encode($data);
    }

    // Drag Drop
    public function drag_and_drop()
    {
        $ids = $this->input->post('ids');
        $arr = explode(',', $ids);
        for ($i = 1; $i <= count($arr); $i++) {
            $sql = "UPDATE layanan SET position = " . $i . " WHERE layanan_id = " . $arr[$i - 1];
            $this->db->query($sql);
        }
        $data['name'] = $this->security->get_csrf_token_name();
        $data['csrf'] = $this->security->get_csrf_hash();
        echo json_encode($data);
    }
}
