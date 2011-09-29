<?php

class Dashboard_IndexController extends Zend_Controller_Action {

    protected $userSession;

    /**
     *
     * @var Application_Model_SiteUsers 
     */
    protected $userDetails;

    public function init() {
        /* Initialize action controller here */
        
            $this->userSession = Zend_Registry::get("user_session");
            $auth = Zend_Auth::getInstance();
            $this->userDetails = $auth->getIdentity();
            $this->view->js[] = new Application_Model_Js("dashboard");
            $this->userDetails = $auth->getIdentity();
            $this->view->userDetails = $this->userDetails;

           
        
    }

    public function indexAction() {

        $groups = $this->userDetails->getGroups();
        $this->view->pageTitle = "test title";
        $this->view->groups = $groups;


        $activity = array();
        $members = array();
        $events = array();

        foreach ($groups as $group) {
            $activity[$group->getName()] = $group->getGroupActivityFromTime();
            $members[$group->getName()] = $group->getGroupMembers();
            $events[$group->getName()] = $group->getGroupEventsAfterTimestamp(strtotime("30 days ago"));
        }
        $activegroup = $groups[0];
        if ($this->getRequest()->getParam("gid")) {
            $activegroup = (array_key_exists($this->getRequest()->getParam("gid"), $groups)) ? $groups[$this->getRequest()->getParam("gid")] : $activegroup;
        }
        $this->view->activegroup = $activegroup;
        $this->view->activity = $activity;
        $this->view->members = $members;
        $this->view->events = $events;
    }
    
    
    public function showAction()
    {
        $this->_helper->viewRenderer->setNoRender(true);
        if(! null == $this->getRequest()->getParam("group")){
         
            echo $this->getRequest()->getParam("group");
        }
        
    }

}

