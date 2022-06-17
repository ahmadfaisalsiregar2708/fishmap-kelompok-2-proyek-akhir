<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require_once( BASEPATH . 'plugins/jcryption/jcryption.php' );

class CI_Jcryption extends jcryption{

    function __construct($public_key_file, $private_key_file){
        parent::__construct($public_key_file, $private_key_file);
    }
}
