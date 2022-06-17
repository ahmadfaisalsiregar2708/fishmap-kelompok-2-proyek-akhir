<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
// load base class if needed
require_once APPPATH . 'controllers/base/PublicBase.php';

// --

class Page extends ApplicationBase
{
    const PATH_FILE_PUBLIC = 'resource/doc/images/';
    private $nama = [
        "image" => 'Foto',
        "video" => 'Video',        
    ];
    private $bacabuku = '4';
    protected $post_status = 'publish';
    // constructor
    public function __construct()
    {
        // parent constructor
        parent::__construct();
        // load model
        $this->load->model('M_page');
        $this->load->model('informasi/M_berita');
        $this->load->model('pengaturan/M_user');
        $this->load->model('pengaturan/M_menu');
        $this->load->model('pengaturan/M_slide');
        $this->load->model('pengaturan/M_preference');
        $this->load->model('layanan/M_layanan');
        $this->load->model('pengaturan/M_popup');        
        // load library
        $this->load->library('pagination');
        // menu page
        $menu = $this->M_menu->menu_id('2');
        $submenu = $this->M_menu->list('2');
        // send
        $this->smarty->assign('pathImage', self::PATH_FILE_PUBLIC);
        $this->smarty->assign('_menu', $menu);
        $this->smarty->assign('_submenu', $submenu);
    }

    // view
    public function index()
    {
        // set template content        
        $this->smarty->assign("template_content", "page/index.html");
        // get berita     
        $berita = $this->M_page->getBerita(['berita'], [0, 4]);
        $artikel = $this->M_page->getBerita(['artikel'], [0, 5]);        
        $tim = $this->M_page->getBerita(['tim'], [0, 7]);
        $layanan = $this->M_layanan->get_layanan_beranda(['1'], [0, 12]);
        $slide = $this->M_slide->slide_index();
        $popup = $this->M_popup->get_popup_public(['%'], [0, 1]);
        // parameter
        $params = [
            'doc_title' => ['%']
        ];
        $rs_file = $this->M_popup->get_popup_layanan_public($params, [0, 5]);
        $title = $this->M_menu->menu_id('1');            
        // send data        
        $this->smarty->assign('rs_file', $rs_file);
        $this->smarty->assign('berita', $berita);
        $this->smarty->assign('artikel', $artikel);        
        $this->smarty->assign('tim', $tim);
        $this->smarty->assign('layanan', $layanan);
        $this->smarty->assign('slide', $slide);
        $this->smarty->assign('popup', $popup);
        $this->smarty->assign('title', $title['title']);    
        // output
        parent::display();
    }

    // indek
    public function indek($id = null)
    {
        // set template content
        $this->smarty->assign("template_content", "page/indek.html");
        $params = [
            'post_category' => $id, 
            'post_status'   => $this->post_status
        ]; 
        /* start of pagination --------------------- */
        // pagination                     f   
        $config['base_url'] = site_url($id . "/");  // 'berita', 'artikel', 'tim'                                
        $config['total_rows'] = $this->M_page->count_where($params);
        $config['uri_segment'] = 2;
        $config['per_page'] = 12;

        $config['attributes'] = array('class' => 'page-link');
        $config['next_link'] = '<span class="ti-arrow-right"></span>';
        $config['prev_link'] = '<span class="ti-arrow-left"></span>';
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
        $start = $this->uri->segment(2, 0) + 1;
        $end = $this->uri->segment(2, 0) + $config['per_page'];
        $end = $end > $config['total_rows'] ? $config['total_rows'] : $end;
        $pagination['start'] = $config['total_rows'] == 0 ? 0 : $start;
        $pagination['end'] = $end;
        $pagination['total'] = $config['total_rows'];
        // pagination assign value
        $this->smarty->assign("pagination", $pagination);
        $this->smarty->assign("no", $start);
        /* end of pagination ---------------------- */
        // parameter
        $params = [
            'post_category' => $id
        ];
        $limit = [($start - 1), $config['per_page']];
        $result = $this->M_page->getBerita($params, $limit);
        // send    
        $this->smarty->assign('result', $result);        
        $this->smarty->assign('title', ucfirst($id));                        
        // output
        parent::display();
    }

    // cari kata kunci
    public function cari()
    {
        // set template content        
        $this->smarty->assign("template_content", "page/pencarian.html");
        // get search parameter
        $search = $this->tsession->userdata('cari_data');
        $this->smarty->assign("search", $search);
        // search parameters                    
        $search_param['cari'] = empty($search['cari']) ? '%' : '%' . $search['cari'] . '%';
        /* start of pagination --------------------- */                       
        // parameters
        $params = [
            'post_title'    => $search_param['cari'],
            'post_content'  => $search_param['cari']
        ];
        $config['base_url'] = site_url("cari/");
        $config['total_rows'] = $this->M_berita->get_total_search($params);
        $config['uri_segment'] = 2;
        $config['per_page'] = 10;

        $config['attributes'] = array('class' => 'page-link');
        $config['next_link'] = '<span class="ti-arrow-right"></span>';
        $config['prev_link'] = '<span class="ti-arrow-left"></span>';
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
        $start = $this->uri->segment(2, 0) + 1;
        $end = $this->uri->segment(2, 0) + $config['per_page'];
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
        $rs_id = $this->M_berita->get_search($params, $limit);
        // send
        $this->smarty->assign('rs_search', $rs_id);
        $this->smarty->assign('title', 'Pencarian');    
        // output
        parent::display();
    }

    // temukan kata kunci
    public function temukan()
    {
        // set template content        
        $this->smarty->assign("template_content", "page/pencarian.html");
        // get search parameter
        $search = $this->tsession->userdata('temukan_data');
        $this->smarty->assign("search", $search);
        // search parameters                    
        $search_param['temukan'] = empty($search['temukan']) ? '%' : '%' . $search['temukan'] . '%';
        /* start of pagination --------------------- */
        // parameters
        $params = [
            'post_title'    => $search_param['temukan'],
            'post_content'  => $search_param['temukan']
        ];
        $config['base_url'] = site_url("temukan/");
        $config['total_rows'] = $this->M_berita->get_total_search($params);
        $config['uri_segment'] = 2;
        $config['per_page'] = 10;

        $config['attributes'] = array('class' => 'page-link');
        $config['next_link'] = '<span class="ti-arrow-right"></span>';
        $config['prev_link'] = '<span class="ti-arrow-left"></span>';
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
        $start = $this->uri->segment(2, 0) + 1;
        $end = $this->uri->segment(2, 0) + $config['per_page'];
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
        $rs_id = $this->M_berita->get_search($params, $limit);
        // send
        $this->smarty->assign('rs_search', $rs_id);
        $this->smarty->assign('title', 'Pencarian');    
        // output
        parent::display();
    }

    // view halaman
    public function view($id = '', $title = '%')
    {
        // set template content
        if(empty($id) && empty($title)){
            $this->smarty->assign("template_content", "base/templates/404.html");
            $this->smarty->assign('title', '404 Page Not Found');                        
        } else {
            $this->smarty->assign("template_content", "page/view.html");
            parent::counter($id);
            //parameters
            $title2 = explode('-', $title); 
            for ( $i = 0; $i < count( $title2 ); $i++ ) {              
              $post_title = empty($title2[$i]) ? '%' : '%' . $title2[$i] . '%';
            }        
            $params = [
                'post_id'     =>  $id, 
                'post_title'  =>  htmlspecialchars($post_title)
            ]; 
            // data
            $result = $this->M_page->get_page($params);
            if (empty($result)) {
                $this->smarty->assign("template_content", "base/templates/404.html");
                $this->smarty->assign('title', '404 Page Not Found');                        
            } else {
                $author = $this->M_user->getAccountDetailUsername(['user_name' => $result['created_by']]);
                // send
                $this->smarty->assign('post', $result);
                $this->smarty->assign('author', $author);
                $this->smarty->assign('title', $result['post_title']);    
            }
        }
        // output
        parent::display();
    }

    // data
    public function data()
    {
        // load model
        $this->load->model('halaman/m_dokumen_kategori');
        $this->load->model('halaman/m_dokumen_file');
        // set template content
        $this->smarty->assign("template_content", "page/data/index.html");
        // data
        $result = $this->m_dokumen_kategori->list_kategori();
        if (empty($result)) {
            $this->smarty->assign("template_content", "base/templates/404.html");
            $this->smarty->assign('title', '404 Page Not Found');                        
        } else {
            // get data
            $title = $this->M_menu->menu_id('10');
            // send
            $this->smarty->assign('doc', $result);            
            $this->smarty->assign('title', $title['title']);    
        }
        // output
        parent::display();
    }

    // data detail
    public function dataDetail($id = null)
    {
        // load css
        $this->smarty->load_style("fishmap/plugins/datetimepicker/css/datepicker.min.css");
        // load model
        $this->load->model('halaman/m_dokumen_kategori');
        $this->load->model('halaman/m_dokumen_file');
        // set template content
        if (empty($id)) {
            $this->smarty->assign("template_content", "base/templates/404.html");
            $this->smarty->assign('title', '404 Page Not Found');                        
        } else {
            // set template content
            $this->smarty->assign("template_content", "page/data/detail.html");
            // search
            $get = $this->input->get();
            $this->smarty->assign('search', $get);
            $judul = (empty($get['q']) ? '%' : '%' . $get['q'] . '%');
            $tahun = (empty($get['t']) ? '%' : $get['t']);
            $params = [$judul, $tahun, $id];
            // data
            $result = $this->m_dokumen_kategori->get_by_id($id);
            /* start of pagination --------------------- */
            // pagination             
            $config['base_url'] = site_url("data-detail/" . $id . "/");
            $config['total_rows'] = count($this->m_dokumen_file->get_dokumen_files($params));
            $config['uri_segment'] = 3;
            $config['per_page'] = 12;

            $config['attributes'] = array('class' => 'page-link');
            $config['next_link'] = '<span class="ti-arrow-right"></span>';
            $config['prev_link'] = '<span class="ti-arrow-left"></span>';
            $config['first_link'] = 'Awal';
            $config['last_link'] = 'Akhir';
            $config['full_tag_open'] = '<ul class="pagination p-center download-list">';
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
            $start = $this->uri->segment(3, 0) + 1;
            $end = $this->uri->segment(3, 0) + $config['per_page'];
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
            $file = $this->m_dokumen_file->get_dokumen_files($params, $limit);
            $title = $this->M_menu->menu_id('10');
            // send
            $this->smarty->assign('doc', $result);
            $this->smarty->assign('file', $file);            
            $this->smarty->assign('title', $title['title']);       
        }
        // output
        parent::display();
    }

    // galeri
    public function galeri($tipe = '')
    {
        // set template content
        if (empty($tipe)) {
            $this->smarty->assign("template_content", "base/templates/404.html");
            $this->smarty->assign('title', '404 Page Not Found');                        
        } else {
            $this->smarty->assign("template_content", "page/galeri.html");
            // load
            $this->smarty->load_style("default/js/lightGallery/dist/css/lightgallery-bundle.css");
            $this->smarty->load_javascript("default/js/lightGallery/dist/lightgallery.umd.js");
            $this->smarty->load_javascript("default/js/lightGallery/dist/plugins/thumbnail/lg-thumbnail.umd.js");
            $this->smarty->load_javascript("default/js/lightGallery/dist/plugins/zoom/lg-zoom.umd.js");
            $this->smarty->load_javascript("default/js/lightGallery/dist/plugins/video/lg-video.umd.js");
            // load model
            $this->load->model('galeri/M_gallery_album');
            $this->load->model('galeri/M_gallery_files');
            // data
            /* start of pagination --------------------- */
            // pagination                
            $params = [
                $tipe,
            ];
            $config['base_url'] = site_url("galeri-album/" . $tipe . "/");
            $config['total_rows'] = count($this->M_gallery_album->getAlbum($params));
            $config['uri_segment'] = 3;
            $config['per_page'] = 12;

            $config['attributes'] = array('class' => 'page-link');
            $config['next_link'] = '<span class="ti-arrow-right"></span>';
            $config['prev_link'] = '<span class="ti-arrow-left"></span>';
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
            $start = $this->uri->segment(3, 0) + 1;
            $end = $this->uri->segment(3, 0) + $config['per_page'];
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
            $result = $this->M_gallery_album->getAlbum($params, $limit);
            //     
            if (empty($result)) {
                $this->smarty->assign("template_content", "base/templates/404.html");
                $this->smarty->assign('title', '404 Page Not Found');                        
            } else {
                // send
                $this->smarty->assign('galeri', $result);
                $this->smarty->assign('tipe', $this->nama[$tipe]);
                if ($tipe == 'image') {
                    $title = $this->M_menu->menu_id('17');
                } elseif ($tipe == 'video') {
                    $title = $this->M_menu->menu_id('18');
                }
                $this->smarty->assign('title', $title['title']);                        
            }
        }
        // output
        parent::display();
    }

    // ajax galeri    
    public function ajax_galeri($id = null)
    {
        if (empty($id)) {
            show_404();
        }
        $id = str_replace("gallery-", "", $id);
        // load model
        $this->load->model('galeri/M_gallery_album');
        $this->load->model('galeri/M_gallery_files');
        //
        $album = $this->M_gallery_album->get_by_id($id);
        $rs = $this->M_gallery_files->get_where(['album_id' => $id]);
        $result = [];
        foreach ($rs as $a => $b) {
            $html = '<div class="lightGallery-captions">
            <h3>' . ucwords($album["album_title"]) . '</h3>
            ' . html_entity_decode($b['file_desc']) . '
            </div>';
            $result[] = [
                "src" => ($b['file_type'] == 'image') ? base_url() . $b['file_path'] : $b['file_url'],
                "thumb" => base_url() . $b['file_path'],
                "subHtml" => $html,
            ];
        }
        if (!empty($result)) {
            echo json_encode($result);
        }
    }
    
    // layanan
    public function layanan()
    {
        // set template content
        $this->smarty->assign("template_content", "page/layanan.html");
        // load model
        $this->load->model('layanan/M_layanan');
        // get data
        $rs_id = $this->M_layanan->get_layanan_front_end();
        $title = $this->M_menu->menu_id('4');
        // send
        $this->smarty->assign('layanan', $rs_id);        
        $this->smarty->assign('title', $title['title']);    
        // output
        parent::display();
    }

    // prediksi
    // public function prediksi()
    // {           
    //     // set template content
    //     $this->smarty->assign("template_content", "page/prediksi.php");                                   
    //     // output
    //     parent::display();
    // }

    // cari kata kunci
    public function proses_cari()
    {
        // parameter
        $params = array(
            "cari" => trim(htmlspecialchars($this->input->post("_cari")))
        );
        $this->tsession->set_userdata('cari_data', $params);
        // default redirect        
        redirect("/cari");
    }

    // temukan kata kunci
    public function proses_temukan()
    {
        // parameter        
        $params = array(
            "temukan" => trim(htmlspecialchars($this->input->post("_temukan")))
        );
        $this->tsession->set_userdata('temukan_data', $params);
        // default redirect        
        redirect("/temukan");
    }
    
}
