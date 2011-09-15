<?php

class Dashboard_IndexController extends Zend_Controller_Action
{

    protected $userSession;
    /**
     *
     * @var Application_Model_SiteUsers 
     */
    protected $userDetails;
    
    
    

     public function init()
    {
        /* Initialize action controller here */
        $auth = Zend_Auth::getInstance();
        
        if($auth->hasIdentity()){
              $this->view->js[] = new Application_Model_Js("dashboard");
              $this->userDetails = $auth->getIdentity();
              $this->view->userDetails = $this->userDetails;
        }else{
            $this->_redirect("/signin");
        }
        
        
    }

    public function indexAction()
    {
        
        $groups = $this->userDetails->getGroups();
        $this->view->pageTitle = "test title";
        $this->view->groups = $groups;
        
        
        $activity = array();
        $members = array();
        $events = array();
        
        foreach($groups as $group)
        {
            $activity[$group->getName()]=$group->getGroupActivityFromTime();
            $members[$group->getName()]= $group->getGroupMembers();
            $events[$group->getName()]=$group->getGroupEventsAfterTimestamp(strtotime("30 days ago"));
        }
        $activegroup = $groups[0];
        if($this->getRequest()->getParam("gid")){
            $activegroup = (array_key_exists($this->getRequest()->getParam("gid"), $groups))?$groups[$this->getRequest()->getParam("gid")]:$activegroup;
        }
        $this->view->activegroup = $activegroup;
        $this->view->activity = $activity;
        $this->view->members = $members;
        $this->view->events = $events;
        
        
    }


}

