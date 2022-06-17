<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once( APPPATH.'third_party/TCPDF/tcpdf.php' );

class MY_Tcpdf extends TCPDF {

    function __construct() {
        // tcpdf constructor
        parent::__construct('P', 'mm', 'A4', true, 'UTF-8', false);

    }
}
// END TCPDF Class
