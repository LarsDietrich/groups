<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ActivityLogMapper
 *
 * @author craigbrookes
 */
class Application_Model_ActivityLogMapper extends Application_Model_RowMapperAbstract{
    
    
    public function __construct() {
        parent::__construct("Application_Model_DbTable_ActivityLog", "Application_Model_ActivityLog");
    }

    public function getGroupActivityAfterTime($groupid,$timestamp)
    {
        
        $this->getDbTable()->getAdapter()->setProfiler(true);
        $select = $this->getDbTable()->select()->where("groups_id=?",  intval($groupid))
                ->where("added > ?",date("Y-m-d H:i:s",$timestamp));
        $fetched = $select->query()->fetchAll();

        $rows = array();
        foreach($fetched as $row)
        {
            $rows[]= new $this->_model($row);
        }
        return $rows;
    }
}

?>
