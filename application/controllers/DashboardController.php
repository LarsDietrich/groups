<?php

class DashboardController extends Zend_Controller_Action
{

    protected $userSession;
    /**
     *
     * @var Application_Model_SiteUsers 
     */
    protected $userDetais;

    public function init()
    {
        /* Initialize action controller here */
        $this->userSession = Zend_Registry::get("user_session");
         if($this->userSession->userDetails)
        {
            
            $this->view->userDetails = $this->userSession->userDetails;
            $this->userDetais = $this->userSession->userDetails;
        }else{
            $this->_helper->redirector("signin",array("prependBase"=>false));
        }
    }

    public function indexAction()
    {
        
        $groups = $this->userDetais->getGroups();
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

