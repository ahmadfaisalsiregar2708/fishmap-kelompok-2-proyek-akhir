<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
// load base class if needed
require_once APPPATH . 'controllers/base/PublicBase.php';

// --

class Post extends ApplicationBase
{
    const PATH_FILE_PUBLIC = 'resource/doc/images/';
    private $_kate = [        
        'berita' => 'Berita',        
        'artikel' => 'Artikel',
    ];
    
    // constructor
    public function __construct()
    {
        // parent constructor
        parent::__construct();
        // load file helper
        $this->load->helper('download');             
        $this->load->helper('file');             
        // load model
        $this->load->model('halaman/M_dokumen_file');
        $this->load->model('informasi/M_post_file');
        $this->load->model('m_page');
        $this->load->model('pengaturan/m_user');
        // send
        $this->smarty->assign('pathImage', self::PATH_FILE_PUBLIC);
        self::sidebar();
        $this->smarty->assign('_tpla', $this->_kate);
    }

    // index
    public function index($id = '', $title = '%')
    {
        // set template content
        if(empty($id) && empty($title)){
            $this->smarty->assign("template_content", "base/templates/404.html");
            $this->smarty->assign('title', '404 Page Not Found');                        
        } else {
            parent::counter($id);
            $this->smarty->assign("template_content", "post/index.html");
            // data                              
            $title2 = explode('-', $title); 
            for ( $i = 0; $i < count( $title2 ); $i++ ) {              
              $post_title = empty($title2[$i]) ? '%' : '%' . $title2[$i] . '%';
            }            
            $params = [
              'post_id'     =>  $id, 
              'post_title'  =>  htmlspecialchars($post_title)
            ];            
            $result = $this->m_page->get_page($params);
            if(empty($result)){
                $this->smarty->assign("template_content", "base/templates/404.html");
                $this->smarty->assign('title', '404 Page Not Found');                        
            } else {
                $author = $this->m_user->getAccountDetailUsername(['user_name'=>$result['created_by']]);
                // send
                $this->smarty->assign('post', $result);
                $this->smarty->assign('author', $author);
                $this->smarty->assign('title', $result['post_title']);    
            }
        }     
        // output
        parent::display();
    }

    // download file from dokumen file
    function download_doc($id = '')
    {        
        if(!empty($id)){   
            // get file by id            
            $doc_file = $this->M_dokumen_file->get_by_id($id);    
            if(empty($doc_file['doc_file'])){   
              redirect($_SERVER['HTTP_REFERER']);
            } else {                                 
              force_download($doc_file['doc_file'], NULL);            
            }
        }        
        else {
            $this->smarty->assign("template_content", "base/templates/404.html");
            $this->smarty->assign('title', '404 Page Not Found');                        
            // output
            parent::display();
        }
    }

    // download file from post file
    function download_post($id = '')
    {        
      if(!empty($id)){   
          // get file by id                      
          $post_file = $this->M_post_file->get_by_id($id);  
          if(empty($post_file['file_path'])){   
            redirect($_SERVER['HTTP_REFERER']);
          } else {
            $del_path = substr($post_file['file_path'], 0, strpos($post_file['file_path'], 'resource'));
            $file = str_replace($del_path, '', $post_file['file_path']);                                        
            force_download(FCPATH.$file, NULL);                        
          }                   
      }
      else {
          $this->smarty->assign("template_content", "base/templates/404.html");
          $this->smarty->assign('title', '404 Page Not Found');                        
          // output
          parent::display();
      }
    }

    // get sidebar 
    private function sidebar()
    {
        $rs = $this->m_page->getSidebar();
        $this->smarty->assign('_tpl', $rs);
        $rs = $this->m_page->getTrend();
        foreach ($rs as $a => $b) {
            $rs[$a]['diff'] = self::datediff('h', $b['post_date'], date("Y-m-d H:i:s"));
        }
        $this->smarty->assign('_tpk', $rs);
    }

    // datedif - counting hours from post date
    private function datediff($interval, $datefrom, $dateto, $using_timestamps = false) 
    {
        /*
          $interval can be:
          yyyy - Number of full years
          q - Number of full quarters
          m - Number of full months
          y - Difference between day numbers
            (eg 1st Jan 2004 is "1", the first day. 2nd Feb 2003 is "33". The datediff is "-32".)
          d - Number of full days
          w - Number of full weekdays
          ww - Number of full weeks
          h - Number of full hours
          n - Number of full minutes
          s - Number of full seconds (default)
        */

        /*
        example:
        $count_from = "2010-09-30 00:00:01"; // 24-Hour Format: YYYY-MM-DD HH:MM:SS"
        $count_to = date("Y-m-d H:i:s");//today (2012-08-23 00:00:01)
        echo datediff("d",$count_from,$count_to);
        return: 693 (days)
        */
        
        if (!$using_timestamps) {
          $datefrom = strtotime($datefrom, 0);
          $dateto = strtotime($dateto, 0);
        }
        $difference = $dateto - $datefrom; // Difference in seconds
          
        switch($interval) {
          
          case 'yyyy': // Number of full years
      
            $years_difference = floor($difference / 31536000);
            if (mktime(date("H", $datefrom), date("i", $datefrom), date("s", $datefrom), date("n", $datefrom), date("j", $datefrom), date("Y", $datefrom)+$years_difference) > $dateto) {
              $years_difference--;
            }
            if (mktime(date("H", $dateto), date("i", $dateto), date("s", $dateto), date("n", $dateto), date("j", $dateto), date("Y", $dateto)-($years_difference+1)) > $datefrom) {
              $years_difference++;
            }
            $datediff = $years_difference;
            break;
      
          case "q": // Number of full quarters
      
            $quarters_difference = floor($difference / 8035200);
            while (mktime(date("H", $datefrom), date("i", $datefrom), date("s", $datefrom), date("n", $datefrom)+($quarters_difference*3), date("j", $dateto), date("Y", $datefrom)) < $dateto) {
              $months_difference++;
            }
            $quarters_difference--;
            $datediff = $quarters_difference;
            break;
      
          case "m": // Number of full months
      
            $months_difference = floor($difference / 2678400);
            while (mktime(date("H", $datefrom), date("i", $datefrom), date("s", $datefrom), date("n", $datefrom)+($months_difference), date("j", $dateto), date("Y", $datefrom)) < $dateto) {
              $months_difference++;
            }
            $months_difference--;
            $datediff = $months_difference;
            break;
      
          case 'y': // Difference between day numbers
      
            $datediff = date("z", $dateto) - date("z", $datefrom);
            break;
      
          case "d": // Number of full days
      
            $datediff = floor($difference / 86400);
            break;
      
          case "w": // Number of full weekdays
      
            $days_difference = floor($difference / 86400);
            $weeks_difference = floor($days_difference / 7); // Complete weeks
            $first_day = date("w", $datefrom);
            $days_remainder = floor($days_difference % 7);
            $odd_days = $first_day + $days_remainder; // Do we have a Saturday or Sunday in the remainder?
            if ($odd_days > 7) { // Sunday
              $days_remainder--;
            }
            if ($odd_days > 6) { // Saturday
              $days_remainder--;
            }
            $datediff = ($weeks_difference * 5) + $days_remainder;
            break;
      
          case "ww": // Number of full weeks
      
            $datediff = floor($difference / 604800);
            break;
      
          case "h": // Number of full hours
      
            $datediff = floor($difference / 3600);
            break;
      
          case "n": // Number of full minutes
      
            $datediff = floor($difference / 60);
            break;
      
          default: // Number of full seconds (default)
      
            $datediff = $difference;
            break;
        }    
      
    return $datediff;
    }
}