<?php

if (!defined('BASEPATH')) {
  exit('No direct script access allowed');
}
// load base class if needed
require_once APPPATH . 'controllers/base/OperatorBase.php';

class Runningtext extends ApplicationBase
{
  // constructor
  public function __construct()
  {
    // parent constructor
    parent::__construct();
    // load model
    $this->load->model('pengaturan/M_runningtext');
    // load library
    $this->load->library('tnotification');
    $this->load->library('pagination');
  }

  // list data
  public function index($active = null)
  {
    // set page rules
    $this->_set_page_rule("R");
    // set template content
    $this->smarty->assign("template_content", "pengaturan/runningtext/index.html");
    // get search parameter
    $search = $this->tsession->userdata('search_data');
    $this->smarty->assign("search", $search);
    // search parameters                    
    $search_param['running_text'] = empty($search['running_text']) ? '%' : '%' . $search['running_text'] . '%';
    /* start of pagination --------------------- */
    // pagination                
    $params = [
      $search_param['running_text']
    ];
    $config['base_url'] = site_url("pengaturan/runningtext/index/");
    $config['total_rows'] = $this->M_runningtext->get_total_slide($params);
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
    $rs_id = $this->M_runningtext->get_runningtext($params, $limit);
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

    // set template content
    $this->smarty->assign("template_content", "pengaturan/runningtext/add.html");
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
    $this->smarty->assign("template_content", "pengaturan/runningtext/edit.html");
    // load js css
    $this->smarty->load_javascript('fishmap/js/form-text-editor.js');
    // post
    //get data
    $result = $this->M_runningtext->get_id_runningtext($slide_id);
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
        "running_text" => $this->input->post("running_text"),
      );
      $this->tsession->set_userdata('search_data', $params);
    }
    // default redirect
    redirect($_SERVER['HTTP_REFERER']);
  }

  // up prosess
  public function add_process()
  {
    // set page rules
    $this->_set_page_rule("C");

    // cek input
    $this->tnotification->set_rules('running_text', 'Running text', 'required');
    $this->tnotification->set_rules('alamat_tautan', 'Tautan link', 'required');

    // process
    if ($this->tnotification->run() !== false) {
      $params = [
        'running_text'      => $this->input->post('running_text', TRUE),
        'alamat_tautan'     => $this->input->post('alamat_tautan', TRUE),
        'running_active'    => '1',
        'updated_at'        => date("Y-m-d H:i:s"),
        'updated_by'        => $this->com_user['user_name'],
      ];

      // update
      if ($this->M_runningtext->insert($params)) {
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

  // up prosess
  public function update_process($id = null)
  {
    // set page rules
    $this->_set_page_rule("C");

    // cek input
    $this->tnotification->set_rules('running_text', 'Running text', 'required');
    $this->tnotification->set_rules('alamat_tautan', 'Tautan link', 'required');

    // process
    if ($this->tnotification->run() !== false) {
      $params = [
        'running_text'      => $this->input->post('running_text', TRUE),
        'alamat_tautan'     => $this->input->post('alamat_tautan', TRUE),
        'updated_at'        => date("Y-m-d H:i:s"),
        'updated_by'        => $this->com_user['user_name'],
      ];
      $where = [
        'id' => $id
      ];
      // update
      if ($this->M_runningtext->update($params, $where)) {
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
  public function delete_process($id = null)
  {
    // set page rules
    $this->_set_page_rule("D");

    if (empty($id)) {
      // default error
      $this->tnotification->sent_notification("error", "Data gagal dihapus");
      redirect($_SERVER['HTTP_REFERER']);
    }
    // parameter         
    $params = [
      'id'   => $id
    ];

    $rs = $this->M_runningtext->delete($params);
    if ($rs) {
      $this->tnotification->sent_notification("success", "Data berhasil dihapus");
    } else {
      $this->tnotification->sent_notification("error", "Data gagal dihapus");
    }
    redirect($_SERVER['HTTP_REFERER']);
  }

  //  Action status active
  public function status_active()
  {
    $id = $this->input->post('id');
    $elment = $this->input->post('running_active');
    $data = ['running_active' => $elment];
    $this->M_runningtext->update(['running_active' => $elment == 1 ? '0' : 1], ['id' => $id,]);

    $data['name'] = $this->security->get_csrf_token_name();
    $data['csrf'] = $this->security->get_csrf_hash();
    echo json_encode($data);
  }

  // Get data untuk cek status aktif 
  public function getdata()
  {
    $item = $this->M_runningtext->getdata();
    echo json_encode($item);
  }
}
