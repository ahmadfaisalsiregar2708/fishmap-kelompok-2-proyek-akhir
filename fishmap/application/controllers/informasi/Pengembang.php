<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
// load base class if needed
require_once APPPATH . 'controllers/base/OperatorBase.php';

class Pengembang extends ApplicationBase
{
    const PATH_FILE_PUBLIC = 'resource/doc/images/';
    const PATH_FILE_PUBLIC2 = 'resource/doc/files/';
    protected $uploadConfig = array(
        'allowed_types' => '*',
        'max_size'      => '1024',
    );
    protected $category = 'pengembang';

    // constructor
    public function __construct()
    {
        // parent constructor
        parent::__construct();
        // load model
        $this->load->model('informasi/M_pengembang');
        $this->load->model('informasi/M_post_file');
        // load library
        $this->load->library('tnotification');
        $this->load->library('pagination');
        //
        $this->uploadConfig = $this->config->item('uploadConfig');
    }

    // list data
    public function index()
    {
        // set page rules
        $this->_set_page_rule("R");
        // set template content
        $this->smarty->assign("template_content", "informasi/pengembang/index.html");
        // load js                                       
        $this->smarty->load_javascript("fishmap/plugins/datetimepicker/js/datepicker.min.js");
        // load css
        $this->smarty->load_style("fishmap/plugins/datetimepicker/css/datepicker.min.css");
        // get search parameter
        $search = $this->tsession->userdata('search_data_pengembang');
        $this->smarty->assign("search", $search);
        // search parameters                    
        $search_param['post_title'] = empty($search['post_title']) ? '%' : '%' . $search['post_title'] . '%';
        $search_param['post_date'] = empty($search['post_date']) ? '%'  : '%' . $search['post_date'] . '%';
        /* start of pagination --------------------- */
        // pagination                
        $params = [
            'post_category' => $this->category,
            $search_param['post_title'],
            $search_param['post_date']
        ];
        $config['base_url'] = site_url("informasi/pengembang/index/");
        $config['total_rows'] = $this->M_pengembang->get_total_pengembang($params);
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
        $rs_id = $this->M_pengembang->get_pengembang($params, $limit);
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
        // create new row
        $params = array(
            'post_date'       => date("Y-m-d H:i:s"),
            'post_author'       => $this->com_user['user_name'],
            'post_status'       => "draft",
            'post_category'       => $this->category,
            'created_at'        => date("Y-m-d H:i:s"),
            'created_by'        => $this->com_user['user_name']
        );
        $rs = $this->M_pengembang->insert($params);
        $post_id = $this->db->insert_id();
        redirect('informasi/pengembang/edit/' . $post_id . '/add');
    }

    // edit form
    public function edit($post_id = null, $form = "")
    {
        // set page rules
        $this->_set_page_rule("U");
        if (empty($post_id)) {
            // default error
            $this->tnotification->sent_notification("error", "Data gagal diedit");
            redirect($_SERVER['HTTP_REFERER']);
        }
        // set template content
        $this->smarty->assign("template_content", "informasi/pengembang/edit.html");
        // load js                              
        $this->smarty->load_javascript("fishmap/plugins/datetimepicker/js/jquery.datetimepicker.full.min.js");
        $this->smarty->load_javascript('fishmap/plugins/select2/js/select2.min.js');
        $this->smarty->load_javascript('fishmap/js/form-select2.js');
        $this->smarty->load_javascript("fishmap/plugins/summernote/summernote-lite.js");
        $this->smarty->load_javascript("fishmap/plugins/summernote/ajaximageupload.js");
        $this->smarty->load_javascript("fishmap/plugins/fancy-file-uploader/jquery.ui.widget.js");
        $this->smarty->load_javascript("fishmap/plugins/fancy-file-uploader/jquery.fileupload.js");
        $this->smarty->load_javascript("fishmap/plugins/fancy-file-uploader/jquery.iframe-transport.js");
        $this->smarty->load_javascript("fishmap/plugins/fancy-file-uploader/jquery.fancy-fileupload.js");
        // load css
        $this->smarty->load_style("fishmap/plugins/datetimepicker/css/jquery.datetimepicker.min.css");
        $this->smarty->load_style('fishmap/plugins/select2/css/select2.min.css');
        $this->smarty->load_style('fishmap/plugins/select2/css/select2-bootstrap4.css');
        $this->smarty->load_style("fishmap/plugins/summernote/summernote-lite.css");
        $this->smarty->load_style("fishmap/plugins/summernote/ajaximageupload.css");
        $this->smarty->load_style("fishmap/plugins/fancy-file-uploader/fancy_fileupload.css");
        // post
        $result = $this->M_pengembang->get_by_id($post_id);
        $result['post_content'] = htmlspecialchars_decode($result['post_content']);
        $this->smarty->assign("result", $result);
        // post file      
        $rs_file = $this->M_post_file->get_post_file($post_id);
        $this->smarty->assign("rs_file", $rs_file);
        $this->smarty->assign("form", $form);
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
            $this->tsession->unset_userdata('search_data_pengembang');
        } else {
            $params = array(
                "post_title" => $this->input->post("post_title"),
                "post_date"  => $this->input->post("post_date")
            );
            $this->tsession->set_userdata('search_data_pengembang', $params);
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
        $this->tnotification->set_rules('post_id', 'ID Post', 'trim|required');
        $this->tnotification->set_rules('post_title', 'Judul', 'trim|required');
        $this->tnotification->set_rules('post_content', 'Konten', 'trim|required');

        // process
        if ($this->tnotification->run() !== false) {
            // parameters
            $params = array(
                'post_title'        => $this->input->post('post_title', TRUE),
                'post_content'      => htmlspecialchars($this->input->post('post_content', TRUE)),
                'post_status'       => $this->input->post('post_status', TRUE),
                'post_link'         => NULL,
                'post_date'         => $this->input->post('post_date'),
                'updated_at'        => date("Y-m-d H:i:s"),
                'updated_by'        => $this->com_user['user_name'],
            );
            /* UPLOAD */
            if ($_FILES['post_image']['name']) {
                $image      = self::_upload_file('post_image'); // file_name                                                                                    
                $post_image = self::PATH_FILE_PUBLIC . ($image['file_name'] ?? 'ajax-loader.gif');
                if (($post_image)) {
                    $params['post_image'] = $post_image;
                }
            }
            if ($_FILES['file_path']['name']) {
                $file           = self::_upload_file('file_path'); // file_name                                                                            
                $file_path      = self::PATH_FILE_PUBLIC . ($file['file_name'] ?? 'ajax-loader.gif');
                $file_type      = pathinfo($_FILES['file_path']['name'], PATHINFO_EXTENSION);
            }
            /* END UPLOAD */
            $where = array(
                'post_id' => $this->input->post('post_id', TRUE),
            );
            // update pengembang
            if ($this->M_pengembang->update($params, $where)) {
                // parameters file
                if ($file) {
                    $params2 = array(
                        'file_nm'           => $file['file_name'],
                        'file_type'         => $file_type,
                        'file_path'         => $file_path,
                        'updated_at'        => date("Y-m-d H:i:s"),
                        'updated_by'        => $this->com_user['user_name']
                    );
                    $where = array(
                        'file_id' => $this->input->post('file_id', TRUE),
                    );
                    // update file
                    if (!$this->M_post_file->update($params2, $where)) {
                        $this->tnotification->sent_notification("error", "File gagal disimpan");
                        redirect($_SERVER['HTTP_REFERER']);
                    }
                }
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
    public function delete_process($post_id = null)
    {
        // set page rules
        $this->_set_page_rule("D");

        if (empty($post_id)) {
            // default error
            $this->tnotification->sent_notification("error", "Data gagal dihapus");
            redirect($_SERVER['HTTP_REFERER']);
        }
        // parameter         
        $params = [
            'post_id'   => $post_id
        ];
        $rs_informasi = $this->M_pengembang->delete($params);
        $rs_file      = $this->M_post_file->delete($params);
        if ($rs_informasi == $rs_file) {
            $this->tnotification->sent_notification("success", "Data berhasil dihapus");
        } else {
            $this->tnotification->sent_notification("error", "Data gagal dihapus");
        }
        redirect($_SERVER['HTTP_REFERER']);
    }

    // upload gambar sampul & file
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

    // ajax image upload 
    public function upload_file()
    {
        $this->load->library('upload');
        if (isset($_FILES["image"]["name"])) {
            $config['upload_path'] = './resource/doc/images/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('image')) {
                $this->upload->display_errors();
                return FALSE;
            } else {
                $data = $this->upload->data();
                //Compress Image
                $config['image_library'] = 'gd2';
                $config['source_image'] = './resource/doc/images/' . $data['file_name'];
                $config['create_thumb'] = FALSE;
                $config['maintain_ratio'] = TRUE;
                $config['quality'] = '60%';
                $config['width'] = 800;
                $config['height'] = 800;
                $config['new_image'] = './resource/doc/images/' . $data['file_name'];
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();
                echo base_url() . 'resource/doc/images/' . $data['file_name'];
            }
        }
    }

    public function delete_doc($file_id = null)
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
        $rs_informasi = $this->M_post_file->delete($params);
        if ($rs_informasi) {
            $this->tnotification->sent_notification("success", "Data berhasil dihapus");
        } else {
            $this->tnotification->sent_notification("error", "Data gagal dihapus");
        }
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function delete_img($post_id = null)
    {
        // set page rules
        $this->_set_page_rule("D");
        if (empty($post_id)) {
            // default error
            $this->tnotification->sent_notification("error", "Data gagal dihapus");
            redirect($_SERVER['HTTP_REFERER']);
        }
        // parameter         
        $params = [
            'post_id'   => $post_id
        ];
        $rs_informasi = $this->M_pengembang->update(['post_image' => NULL, 'updated_by' => $this->com_user['user_id']], $params);
        if ($rs_informasi) {
            $this->tnotification->sent_notification("success", "Data berhasil dihapus");
        } else {
            $this->tnotification->sent_notification("error", "Data gagal dihapus");
        }
        redirect($_SERVER['HTTP_REFERER']);
    }
    //
    public function fancy_upload($input_name = 'file_fancy')
    {
        // set page rules
        $this->_set_page_rule("C");
        //
        $post = $this->input->post(NULL);
        //
        $config['upload_path']          = self::PATH_FILE_PUBLIC;
        $config['allowed_types']        = '*';
        if ($post['name'] == 'dokumen') {
            $config['upload_path']      = self::PATH_FILE_PUBLIC2;
        }

        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        // process
        $result = [
            "success" => false,
        ];
        if (!$this->upload->do_upload($input_name)) {
            $res = $this->upload->display_errors();
            $mes = false;
        } else {
            $uploaded = $this->upload->data();
            if (is_file($uploaded['full_path']) == false) {
                $res = 'File tidak ditemukan';
                $mes = false;
            }
            // return $uploaded;
            $res = base_url() . $config['upload_path'] . '/' . $uploaded['file_name'];
            $res2 = $config['upload_path'] . $uploaded['file_name'];
            $mes = true;
            if ($post['name'] == 'sampul') {
                // update img in post
                self::_update_img($post['id'], $res2);
            }
            if ($post['name'] == 'dokumen') {
                // update img in post
                self::_update_dokumen($post['id'], $uploaded);
            }
        }
        $result['success'] = $mes;
        $result['error'] = $res;
        $result['errorcode'] = '404';

        //
        echo json_encode($result);
    }

    private function _update_img($id = '', $path = null)
    {
        // set page rules
        $this->_set_page_rule("U");
        if (empty($id)) {
            die;
        } else {
            $rs = $this->M_pengembang->update(['post_image' => $path, 'updated_by' => $this->com_user['user_id']], ['post_id' => $id]);
        }
    }

    private function _update_dokumen($id = null, $file = null)
    {
        if (empty($id) and empty($doc_id)) {
            die;
        }
        $params = array(
            'post_id'           => $id,
            'file_nm'           => $file['file_name'],
            'file_type'         => $file['file_ext'],
            'file_path'         => $file['full_path'],
            'created_at'        => date("Y-m-d H:i:s"),
            'created_by'        => $this->com_user['user_name']
        );
        $rs = $this->M_post_file->insert($params);
    }
}
