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
        
       $mapper = new Application_Model_GroupsMapper();
       $group = $mapper->findWherePriKeyEquals(1);
       $group->createGroupUrl();
       echo"<pre>";
       print_r($group);
       echo "</pre>";
       
        
        
        
    }


}

