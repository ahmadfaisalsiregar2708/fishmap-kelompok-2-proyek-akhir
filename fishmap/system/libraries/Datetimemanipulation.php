<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class CI_Datetimemanipulation {

    // init var
    public $arr_lang = array();
    public $arr_hari = array();
    public $arr_month = array();
    public $arr_month_short = array();

    function __construct() {
        // indonesia
        $this->arr_lang['in'] = array('01' => 'Januari', '02' => 'Februari', '03' => 'Maret', '04' => 'April', '05' => 'Mei', '06' => 'Juni', '07' => 'Juli', '08' => 'Agustus', '09' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember', '00' => '--');
        // english
        $this->arr_lang['en'] = array('01' => 'January', '02' => 'February', '03' => 'Maret', '04' => 'April', '05' => 'May', '06' => 'June', '07' => 'July', '08' => 'August', '09' => 'September', '10' => 'October', '11' => 'November', '12' => 'December', '00' => '--');
        // indonesia short date
        $this->arr_lang['ins'] = array('01' => 'Jan', '02' => 'Feb', '03' => 'Mar', '04' => 'Apr', '05' => 'Mei', '06' => 'Jun', '07' => 'Jul', '08' => 'Ags', '09' => 'Sep', '10' => 'Okt', '11' => 'Nov', '12' => 'Des', '00' => '--');
        // english short date
        $this->arr_lang['ens'] = array('01' => 'Jan', '02' => 'Feb', '03' => 'Mar', '04' => 'Apr', '05' => 'May', '06' => 'Jun', '07' => 'Jul', '08' => 'Ags', '09' => 'Sep', '10' => 'Oct', '11' => 'Nov', '12' => 'Dec', '00' => '--');
        // hari indonesia
        $this->arr_hari = array('1' => 'Senin', '2' => 'Selasa', '3' => 'Rabu', '4' => 'Kamis', '5' => 'Jumat', '6' => 'Sabtu', '7' => 'Minggu');
        // bulan indonesia
        $this->arr_month =  array('1' => 'Januari', '2' => 'Februari', '3' => 'Maret', '4' => 'April', '5' => 'Mei', '6' => 'Juni', '7' => 'Juli', '8' => 'Agustus', '9' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember', '00' => '--');

        // bulan indonesia
        $this->arr_month_short =  array('1' => 'Jan', '2' => 'Feb', '3' => 'Mar', '4' => 'Apr', '5' => 'Mei', '6' => 'Jun', '7' => 'Jul', '8' => 'Ags', '9' => 'Sep', '10' => 'Okt', '11' => 'Nov', '12' => 'Des');

    }

    function __destruct() {

    }

    public function get_full_date($tgl, $lang = "in") {
        // check input tanggal
        $tgl = explode(' ', $tgl);
        $tgl_day = isset($tgl[0]) ? $tgl[0] : '00-00-0000';
        $tgl_jam = isset($tgl[1]) ? $tgl[1] : '';
        // tanggal
        $tgl_day = explode('-', $tgl_day);
        if (count($tgl_day) != 3) {
            return '';
        }

        if($tgl_day[0] == '0000'){
            return '';
        }
        // jam
        $tgl_jam = explode(':', $tgl_jam);
        if (count($tgl_jam) != 3) {
            $tgl_jam = '';
        }
        // parse date
        $month_label = isset($this->arr_lang[$lang][$tgl_day[1]]) ? $this->arr_lang[$lang][$tgl_day[1]] : $this->arr_lang[$lang]['00'];
        $date_label = $tgl_day[2] . ' ' . $month_label . ' ' . $tgl_day[0];
        // parse time
        if (!empty($tgl_jam)) {
            $tgl_jam = $tgl_jam[0] . ':' . $tgl_jam[1] . ':' . $tgl_jam[2];
            $date_label .= ' Jam ' . $tgl_jam;
        }
        // return
        return $date_label;
    }

    public function get_short_date($tgl) {
        // check input tanggal
        $tgl = explode(' ', $tgl);
        $tgl_day = isset($tgl[0]) ? $tgl[0] : '00-00-0000';
        $tgl_jam = isset($tgl[1]) ? $tgl[1] : '';
        // tanggal
        $tgl_day = explode('-', $tgl_day);
        if (count($tgl_day) != 3) {
            return '';
        }
        // jam
        $tgl_jam = explode(':', $tgl_jam);
        if (count($tgl_jam) != 3) {
            $tgl_jam = '';
        }
        // parse date
        $date_label = $tgl_day[0] . '/' . $tgl_day[1] . '/' . $tgl_day[2];
        // parse time
        if (!empty($tgl_jam)) {
            $tgl_jam = $tgl_jam[0] . ':' . $tgl_jam[1] . ':' . $tgl_jam[2];
            $date_label .= ' ' . $tgl_jam;
        }
        // return
        return $date_label;
    }

    public function get_short_date_indo($date_indo) {
        // hari ind
        $hari = date("N", strtotime($date_indo));
        $date['hari'] = $this->arr_hari[$hari];
        // tanggal
        $tanggal = date("d", strtotime($date_indo));
        $date['tanggal'] = $tanggal;
        // bulan ind
        $bulan = date("m", strtotime($date_indo));
        $date['bulan'] = $this->arr_lang['in'][$bulan];
        $date['numeric_bulan']  = date("m", strtotime($date_indo));
        // tahun
        $tahun = date("Y", strtotime($date_indo));
        $date['tahun'] = $tahun;
        // return
        return $date['tanggal'].' '.$date['bulan'].' '.$date['tahun'];
    }

    // get date now
    public function get_date_now() {
        // hari ind
        $date['hari'] = $this->arr_hari[date('N')];
        // tanggal
        $date['tanggal'] = date('d');
        // bulan ind
        $date['bulan'] = $this->arr_lang['in'][date('m')];
        // bulan ind
        $date['bulan_num'] = date('m');
        // tahun
        $date['tahun'] = date('Y');
        // return
        return $date;
    }

    // get date now
    public function get_date_indonesia($date_indo) {
        // hari ind
        $hari = date("N", strtotime($date_indo));
        $date['hari'] = $this->arr_hari[$hari];
        // tanggal
        $tanggal = date("d", strtotime($date_indo));
        $date['tanggal'] = $tanggal;
        // bulan ind
        $bulan = date("m", strtotime($date_indo));
        $date['bulan'] = $this->arr_lang['in'][$bulan];
        $date['numeric_bulan']  = date("m", strtotime($date_indo));
        // tahun
        $tahun = date("Y", strtotime($date_indo));
        $date['tahun'] = $tahun;
        // return
        return $date;
    }

    public function get_bulan_indonesia($date_indo = 'in') {
        return array('01' => 'Januari', '02' => 'Februari', '03' => 'Maret', '04' => 'April', '05' => 'Mei', '06' => 'Juni', '07' => 'Juli', '08' => 'Agustus', '09' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember');
    }

    public function get_bulan_indonesia_int($date_indo = 'in') {
        return array('1' => 'Januari', '2' => 'Februari', '3' => 'Maret', '4' => 'April', '5' => 'Mei', '6' => 'Juni', '7' => 'Juli', '8' => 'Agustus', '9' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember');
    }

    public function  getBulan($bln){
        switch  ($bln){
            case  '01':
            return  "Januari";
            break;
            case  '02':
            return  "Februari";
            break;
            case  '03':
            return  "Maret";
            break;
            case  '04':
            return  "April";
            break;
            case  '05':
            return  "Mei";
            break;
            case  '06':
            return  "Juni";
            break;
            case  '07':
            return  "Juli";
            break;
            case  '08':
            return  "Agustus";
            break;
            case  '09':
            return  "September";
            break;
            case  '10':
            return  "Oktober";
            break;
            case  '11':
            return  "November";
            break;
            case  '12':
            return  "Desember";
            break;
        }
    }

    function nicetime($date) {
        if (empty($date)) {
            return "";
        }

        $periods = array("detik", "menit", "jam", "hari", "minggu", "bulan", "tahun", "dekade");
        $lengths = array("60", "60", "24", "7", "4.35", "12", "10");

        $now = time();
        $unix_date = strtotime($date);

        // check validity of date
        if (empty($unix_date)) {
            return "";
        }

        // is it future date or past date
        if ($now > $unix_date) {
            $difference = $now - $unix_date;
            $tense = "yang lalu";
        } else {
            $difference = $unix_date - $now;
            $tense = "yang lalu";
        }

        for ($j = 0; $difference >= $lengths[$j] && $j < count($lengths) - 1; $j++) {
            $difference /= $lengths[$j];
        }

        $difference = round($difference);

        if ($difference != 1) {
            $periods[$j].= "";
        }

        return "$difference $periods[$j] {$tense}";
    }

    // short date indo
    public function get_short_date_timer($tgl) {
        // check input tanggal
        $tgl = explode(' ', $tgl);
        $tgl_day = isset($tgl[0]) ? $tgl[0] : '00-00-0000';
        $tgl_jam = isset($tgl[1]) ? $tgl[1] : '';
        // tanggal
        $tgl_day = explode('-', $tgl_day);
        if (count($tgl_day) != 3) {
            return '';
        }
        // jam
        $tgl_jam = explode(':', $tgl_jam);
        if (count($tgl_jam) != 3) {
            $tgl_jam = '';
        }
        // parse date
        $date_label = $tgl_day[1] . '/' . $tgl_day[2] . '/' . $tgl_day[0];
        // parse time
        if (!empty($tgl_jam)) {
            $tgl_jam = $tgl_jam[0] . ':' . $tgl_jam[1] . ':' . $tgl_jam[2];
            $date_label .= ' ' . $tgl_jam;
        }
        // return
        return $date_label;
    }

    // get name of day
    public function get_day_name($hari){
        return $this->arr_hari[$hari];
    }

    // get all day
    public function get_all_day($hari){
        return $this->arr_hari;
    }

    // get name of month
    public function get_month_name($month){
        return $this->arr_month[$month];
    }

    // get name of month
    public function get_short_month_name($month){
        return $this->arr_month_short[$month];
    }

    public function get_all_month(){
        return $this->arr_month;
    }

    //fungsi ambil bulan dan tahun
    function month_year_letters($params) {
        $year = substr($params, 0, 4);
        $month = substr($params, 4, 2);
        return $this->arr_lang['in'][$month] . " " . $year;
    }

    // reverse date dari ind -> US
    function reverse_date_ind_us($date) {
        $exp = explode("-", $date);
        return $exp[2] . "-" . $exp[1] . "-" . $exp[0];
    }

    // tanggal dengan nama bulan 3 karakter (Mis: 1 Jan 1970)
    public function get_short_month_indo($date_indo) {
        // hari ind
        $hari = date("N", strtotime($date_indo));
        $date['hari'] = $this->arr_hari[$hari];
        // tanggal
        $tanggal = date("d", strtotime($date_indo));
        $date['tanggal'] = $tanggal;
        // bulan ind
        $bulan = date("m", strtotime($date_indo));
        $date['bulan'] = $this->arr_lang['ins'][$bulan];
        $date['numeric_bulan']  = date("m", strtotime($date_indo));
        // tahun
        $tahun = date("Y", strtotime($date_indo));
        $date['tahun'] = $tahun;
        // return
        return $date['tanggal'].' '.$date['bulan'].' '.$date['tahun'];
    }

}
