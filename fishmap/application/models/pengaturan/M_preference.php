<?php
require_once APPPATH . 'models/base/AplicationModel.php';
class M_preference extends AplicationModel
{
    protected $primary_key = 'pref_id';
    protected $table_name = 'com_preferences';

    function __construct()
    {
        parent::__construct();
    }
}
