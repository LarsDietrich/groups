<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
        echo "<pre>";
        $testMap = new Application_Model_SiteUsersMapper();
        $row = $testMap->findWherePriKeyEquals(1);
        $row->getGroups();
        print_r($row);
        echo $row->secondname;
        
        $row->secondname = "changedtothis";
        
        $testMap->saveUpdate($row);
        
        
        $newRow =$testMap->findRowByExample($row);
        
        $groupMapper = new Application_Model_GroupsMapper();
        $group = $groupMapper->findWherePriKeyEquals(1);
        $group->getGroupEventsAfterTimestamp(strtotime("20th August"));
        $group->getGroupMembers();
        print_r($group);
        
       print_r($newRow);
       
       echo "</pre>";
        
        
        
    }


}

