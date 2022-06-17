<?php

class ApplicationBase extends CI_Controller
{
    // init base variable
    protected $portal = 'portal_public';
    protected $portal_id;
    protected $com_portal;
    protected $com_user;

    public function __construct()
    {
        // load basic controller
        parent::__construct();
        // load app data
        $this->base_load_app();
        // view app data
        $this->base_view_app();
    }

    /*
     * Method pengolah base load
     * diperbolehkan untuk dioverride pada class anaknya
     */

    protected function base_load_app()
    {
        // load themes (themes default : default)
        $this->smarty->load_themes("default");
        // load model
        $this->load->model('pengaturan/m_preference');
        // load lobrary
        $this->load->library('Datetimemanipulation');
        $this->smarty->assign('dtm', $this->datetimemanipulation);
        $pref = [];
        $_pref = $this->m_preference->get_where(['pref_group' => 'general']);
        $_pref2 = $this->m_preference->get_where(['pref_group' => 'footer']);
        foreach ($_pref as $a => $b) {
            $pref[$b['pref_nm']] = $b['pref_value'];
        }
        foreach ($_pref2 as $a => $b) {
            $pref[$b['pref_nm']] = $b['pref_value'];
        }
        $this->smarty->assign("pref", $pref);
        // load javascript
        $this->smarty->load_javascript("default/js/jquery.min.js");
        $this->smarty->load_javascript("default/js/popper.min.js");
        $this->smarty->load_javascript("default/js/bootstrap.min.js");
        $this->smarty->load_javascript("default/js/select2.min.js");
        $this->smarty->load_javascript("default/js/slick.js");
        $this->smarty->load_javascript("default/js/moment.min.js");
        $this->smarty->load_javascript("default/js/daterangepicker.js");
        $this->smarty->load_javascript("default/js/summernote.min.js");
        $this->smarty->load_javascript("default/js/metisMenu.min.js");
        $this->smarty->load_javascript("default/js/swiper.min.js");
        $this->smarty->load_javascript("default/js/custom.js");
        $this->smarty->load_javascript("fishmap/js/cookies.js");
        // load style
        // $this->smarty->load_style("");        
        // load csrf data
        $csrf = [
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash(),
        ];
        $this->smarty->assign('csrf', $csrf);
    }

    /*
     * Method pengolah base view
     * diperbolehkan untuk dioverride pada class anaknya
     */

    protected function base_view_app()
    {
        // load model
        $this->load->model('pengaturan/M_popup');
        $this->load->model('pengaturan/M_runningtext');
        $this->smarty->assign("config", $this->config);
        // display site title
        self::_display_site_title();
        // get session admin
        self::_get_admin_session();
        // parameter
        $params = [
            'doc_title' => ['%']
        ];
        // data
        $rs_file = $this->M_popup->get_popup_layanan_public($params, [0, 5]);
        $popup = $this->M_popup->get_popup_public(['%'], [0, 1]);
        $runningtext = $this->M_runningtext->get_runningtext_public(['%']);
        $runningtext_active = $this->M_runningtext->get_runningtext_public_active(['%']);
        // send
        $this->smarty->assign('rs_file', $rs_file);
        $this->smarty->assign('popup', $popup);
        $this->smarty->assign('runningtext', $runningtext);
        $this->smarty->assign('runningtext_active', $runningtext_active);
        $this->smarty->assign('mainMenu', self::_displayMenu(1, 0));
        $this->smarty->assign('aboutUs', self::about_us(1, 0));
        $this->smarty->assign('footer', self::footer());
        // bisa ditambah assign menu lainnya disini
        // sosmed
        self::_sosmed();
    }

    /*
     * Method layouting base document
     * diperbolehkan untuk dioverride pada class anaknya
     */

    protected function display($tmpl_name = 'base/public/document.html')
    {
        // --
        // set template
        $this->smarty->display($tmpl_name);
    }

    // site title
    private function _display_site_title()
    {
        // load model
        $this->load->model('pengaturan/M_user');
        //
        $this->portal_id = $this->config->item($this->portal);
        // site data
        $this->com_portal = $this->m_site->get_site_data_by_id($this->portal_id);
        $author = $this->M_user->getAccountDetail(['user_id' => $this->com_portal['mdb']]);
        if (!empty($this->com_portal)) {
            $this->smarty->assign("site", $this->com_portal);
            $this->smarty->assign("author", $author);
        }
    }

    // get session admin
    private function _get_admin_session()
    {
        // load setting
        $this->load->model('m_settings');
        $session = $this->m_settings->get_portal_by_id($this->portal_id);
        // session admin
        $this->com_user = $this->tsession->userdata($session['portal_session']);
    }

    // navbar menu
    private function _displayMenu($group = '1', $isChild = '0')
    {
        // get data
        $rs = $this->m_site->_displayMenu([$isChild, $group]);
        if (empty($isChild)) {
            $html = '<ul class="nav-menu">';
        } else {
            $html = '<ul class="nav-dropdown nav-submenu">';
        }
        foreach ($rs as $a => $b) {
            $html .= '<li>';
            $url = $b['url'];
            if ($url == '#') {
                $html .= '<a href="' . $url . '"> ' . ucfirst($b['title']) . '<span class="submenu-indicator"></span></a>';
            } else {
                $html .= '<a href="' . base_url() . $url . '"> ' . ucfirst($b['title']) . ' <span class="submenu-indicator"></span></a>';
            }
            if (!empty($b['hasChild'])) {
                $html .= self::_displayMenu($group, $b['id']);
            }
            $html .= '</li>';
        }
        $html .= '</ul>';
        // return html
        return $html;
    }

    // footer for column tentang kami
    private function about_us($group = '1', $isChild = '0')
    {
        $rs = $this->m_site->_displayMenu([$isChild, $group]);
        // List Tentang Kami                                
        foreach ($rs as $a => $b) {
            if ($b['id'] == '2') {
                $html = '<h4 class="widget_title">' . ucfirst($b['title']) . '</h4>';
                $html .= '<ul class="footer-menu">';
                $parent_id = $b['id'];
                $ls = $this->m_site->about_us($parent_id);
                foreach ($ls as $a => $b) {
                    $html .= '<li>';
                    $html .= ' <a href="' . base_url() . $b['url'] . '"> ' . ucfirst($b['title']) . '</a>';
                    $html .= '</li>';
                }
                $html .= '</ul>';
            }
        }
        // return 
        return $html;
    }

    // footer for other column
    public function footer()
    {
        // data
        $tmp = $this->m_preference->get_where(['pref_group' => 'footer']);
        $pref = [];
        foreach ($tmp as $a => $b) {
            $pref[$b['pref_nm']] = [
                'id' => $b['pref_id'],
                'value' => $b['pref_value'],
            ];
        }
        // send
        $this->smarty->assign('rs', $pref);
        // column 
        $col = [];
        for ($i = 1; $i < 4; $i++) {
            $tmp = $this->m_preference->get_where(['pref_group' => 'column_' . $i]);
            foreach ($tmp as $a => $b) {
                $col[$i][$b['pref_nm']] = [
                    'id' => $b['pref_id'],
                    'value' => $b['pref_value'],
                ];
            }
        }
        // send
        $this->smarty->assign('col', $col);
    }

    // social media
    private function _sosmed()
    {
        $preference = $this->m_preference->get_where(['pref_group' => 'sosmed']);
        $sosmed = [];
        foreach ($preference as $a => $b) {
            $sosmed[$b['pref_nm']] = $b['pref_value'];
        }
        $this->smarty->assign('sosmed', $sosmed);
    }

    // counter
    protected function counter($id = null)
    {
        // load model
        $this->load->model('m_page');
        if (!empty($id)) {
            // get data by id
            $rs = $this->m_page->get_by_id(['post_id' => $id]);
            if (!empty($rs)) {
                // parameter
                $params = [
                    'counter' => $rs['counter'] + 1,
                    'updated_by' => '1',
                ];
                // get data by id
                $rs = $this->m_page->update($params, ['post_id' => $id]);
            }
        }
    }
}
