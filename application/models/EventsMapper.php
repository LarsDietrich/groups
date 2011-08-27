<?php

class Application_Model_EventsMapper extends Application_Model_RowMapperAbstract
{
        
    public function __construct() {
        parent::__construct("Application_Model_DbTable_Events", "Application_Model_Events");
    }
    
    /**
     *
     * @param int $groupid
     * @param int $timestamp
     * @return array
     *  
     */
    public function getEventsByGroupIdAndAfterDate($groupid,$timestamp)
    {
        $sql = $this->getDbTable()->select()->where("groups_id=?", intval($groupid))->where("eventtime > ?",  intval($timestamp));
        $rows = $sql->query()->fetchAll();
        $ret =array();
        foreach ($rows as $key) {
            $ret[] = new Application_Model_Events($key);
        }
        return $ret;
    }
    
    

}

