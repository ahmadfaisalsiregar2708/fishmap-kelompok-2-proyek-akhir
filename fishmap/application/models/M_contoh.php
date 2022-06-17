<?php
// load base class
require_once( APPPATH . 'models/base/AplicationModel.php' );

class M_contoh extends AplicationModel {
	protected $primary_key = 'user_id';
	protected $table_name = 'com_user';
	
}