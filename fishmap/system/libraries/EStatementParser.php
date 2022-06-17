<?php

require_once( BASEPATH . 'plugins/estatementparser/StatementParser.php' );

class CI_EStatementParser extends StatementParser {

    //put your code here
    function CI_EstatementParser($filepath, $filenm) {
        parent::__construct($filepath, $filenm);
    }

}
