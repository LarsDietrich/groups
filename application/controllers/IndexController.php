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
        $testMap = new Application_Model_SiteUsersMapper();
        $row = $testMap->findWherePriKeyEquals(1);
        print_r($row);
        echo $row->secondname;
        
        $row->secondname = "changedtothis";
        
        $testMap->saveUpdate($row);
        
        
        $newRow =$testMap->findRowByExample($row);
       print_r($newRow);
        
        
        
    }


}

