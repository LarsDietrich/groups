<?php

class Application_Model_DbTable_Siteusers extends Zend_Db_Table_Abstract
{

    protected $_name = 'siteusers';
    
    protected $_primary = "id";
    
    public function get_primary() {
        return $this->_primary;
    }


}

