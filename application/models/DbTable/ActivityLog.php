<?php

class Application_Model_DbTable_ActivityLog extends Zend_Db_Table_Abstract
{

    protected $_name = 'activitylog';
    
    protected $_primary = "id";
    
    public function get_primary() {
        return $this->_primary;
    }


}

