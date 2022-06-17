<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
// load base class if needed
require_once APPPATH . 'controllers/base/OperatorBase.php';

class Slide extends ApplicationBase
{
    const PATH_FILE_PUBLIC = 'resource/doc/images/';
    protected $uploadConfig = array(
        'allowed_types' => 'gif|jpg|png',
        'max_size'      => '1024',
    );

    // constructor
    public function __construct()
    {
        // parent constructor
        parent::__construct();
        // load model
        $this->load->model('pengaturan/M_slide');
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
        $this->smarty->assign("template_content", "pengaturan/slide/index.html");
        // get search parameter
        $search = $this->tsession->userdata('search_data');
        $this->smarty->assign("search", $search);
        // search parameters                    
        $search_param['slide_nm'] = empty($search['slide_nm']) ? '%' : '%' . $search['slide_nm'] . '%';
        /* start of pagination --------------------- */
        // pagination                
        $params = [
            $search_param['slide_nm']
        ];
        $config['base_url'] = site_url("pengaturan/slide/index/");
        $config['total_rows'] = $this->M_slide->get_total_slide($params);
        $config['uri_segment'] = 4;
        $config['per_page'] = 10;

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
        $rs_id = $this->M_slide->get_slide($params, $limit);
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
        //get data
        $rs_id = $this->M_slide->get_url_produk();
        // print_r(json_encode($rs_id));
        // die;
        $this->smarty->assign('rs_id', $rs_id);
        // set template content
        $this->smarty->assign("template_content", "pengaturan/slide/add.html");
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
        $this->smarty->assign("template_content", "pengaturan/slide/edit.html");
        // load js css
        $this->smarty->load_javascript('fishmap/js/form-text-editor.js');
        // post
        //get data
        $rs_id = $this->M_slide->get_url_produk();
        $result = $this->M_slide->get_id_slide($slide_id);
        $result['slide_desc'] = htmlspecialchars_decode($result['slide_desc']);
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
                "slide_nm" => $this->input->post("slide_nm"),
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
        $this->tnotification->set_rules('slide_nm', 'Judul', 'trim|required');
        $this->tnotification->set_rules('slide_desc', 'Deskripsi', 'trim|max_length[100]|required');
        // $this->tnotification->set_rules('slide_active', 'Slide Aktif', 'trim|max_length[100]|required');
        // $this->tnotification->set_rules('slide_url', 'Slide Url', 'trim|required');
        $this->tnotification->set_rules('slide_stiky', 'Slide Stiky', 'trim|required');

        // process
        if ($this->tnotification->run() !== false) {
            // parameters
            if ($_FILES['slide_img']['name']) {
                $image       = self::_upload_file('slide_img'); // file_name                                                                            
                $slide_img   = self::PATH_FILE_PUBLIC . ($image['file_name'] ?? 'ajax-loader.gif');
            }
            $params = array(
                'slide_nm'          => $this->input->post('slide_nm', TRUE),
                'slide_desc'        => htmlspecialchars($this->input->post('slide_desc', TRUE)),
                'slide_img'         => $slide_img,
                'slide_active'      => '1',
                'slide_stiky'       => $this->input->post('slide_stiky', TRUE),
                'out_url'           => $this->input->post('out_url', TRUE),
                'created_at'        => date("Y-m-d H:i:s"),
                'created_by'        => $this->com_user['user_name']
            );

            // print_r(json_encode($params));
            // die;
            // insert
            if ($this->M_slide->insert($params)) {
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
        $this->tnotification->set_rules('slide_id', 'ID', 'trim|required');
        $this->tnotification->set_rules('slide_nm', 'Judul', 'trim|max_length[100]|required');
        $this->tnotification->set_rules('slide_desc', 'Deskripsi', 'trim|max_length[100]|required');
        // $this->tnotification->set_rules('slide_active', 'Slide Aktif', 'trim|required');
        // $this->tnotification->set_rules('slide_url', 'Slide Url', 'trim|required');
        $this->tnotification->set_rules('slide_stiky', 'Slide Stiky', 'trim|required');

        // process
        if ($this->tnotification->run() !== false) {
            // parameters
            if ($_FILES['slide_img']['name']) {
                $image     = self::_upload_file('slide_img'); // file_name                                                                                    
                $slide_img = self::PATH_FILE_PUBLIC . ($image['file_name'] ?? 'ajax-loader.gif');
            } else {
                $slide_img = NULL;
            }
            $params = array(
                'slide_nm'          => $this->input->post('slide_nm', TRUE),
                'slide_desc'        => htmlspecialchars($this->input->post('slide_desc', TRUE)),
                'slide_stiky'       => $this->input->post('slide_stiky', TRUE),
                'out_url'           => $this->input->post('out_url', TRUE),
                'updated_at'        => date("Y-m-d H:i:s"),
                'updated_by'        => $this->com_user['user_name'],
            );

            if (!empty($slide_img)) {
                $params['slide_img'] = $slide_img;
            }
            $where = array(
                'slide_id' => $this->input->post('slide_id', TRUE),
            );
            // update
            if ($this->M_slide->update($params, $where)) {
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
    public function delete_process($slide_id = null)
    {
        // set page rules
        $this->_set_page_rule("D");

        if (empty($slide_id)) {
            // default error
            $this->tnotification->sent_notification("error", "Data gagal dihapus");
            redirect($_SERVER['HTTP_REFERER']);
        }
        // parameter         
        $params = [
            'slide_id'   => $slide_id
        ];
        $rs = $this->M_slide->delete($params);
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

    //  Action status active
    public function status_active()
    {
        $id = $this->input->post('slide_id');
        $elment = $this->input->post('slide_active');
        $data = ['slide_active' => $elment];
        $this->M_slide->update(['slide_active' => $elment == 1 ? '0' : 1], ['slide_id' => $id,]);

        $data['name'] = $this->security->get_csrf_token_name();
        $data['csrf'] = $this->security->get_csrf_hash();

        echo json_encode($data);
    }

    // Get data untuk cek status aktif 
    public function getdata()
    {
        $item = $this->M_slide->getdata();
        echo json_encode($item);
    }
}
