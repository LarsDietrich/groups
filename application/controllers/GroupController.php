<?php

class GroupController extends Zend_Controller_Action
{

    /**
     *
     * @var Application_Model_Groups 
     */
    protected $group=null;
    protected $groupid;




    public function init()
    {
        if($this->getRequest()->getParam("format")){
            $ajaxContext = $this->_helper->getHelper('AjaxContext');
            $ajaxContext->addActionContext("members",'html');
            $ajaxContext->addActionContext('events', 'html');
            $ajaxContext->initContext();
        }
        
        $mapper = new Application_Model_GroupsMapper();
        
        $groupurl = $this->getRequest()->getParam("groupname");
        if($groupurl){
            $group = $mapper->findRowByFieldsAndValues(array("url"=>$this->getRequest()->getParam("groupname")));
        
            if(!$group->isEmpty())
                $this->group = $group;
        }

        $this->groupid = (null === $this->group)?$this->getRequest()->getParam("groupid"):$this->group->id;
    }

    public function indexAction()
    {
        // action body
    }

    public function eventAction()
    {
        // action body
    }

    public function eventsAction()
    {
        // action body
        
        $modelMapper = new Application_Model_EventsMapper();
        $events = $modelMapper->getEventsByGroupIdAndAfterDate($this->groupid, strtotime("90 days ago"));
        $this->view->events = $events;
        
    }
    
    public function membersAction()
    {
        $modelMapper = new Application_Model_MembersMapper();
        $this->view->members = $modelMapper->findAllByFieldsAndValues(array("group_id"=>$this->groupid));
        echo __FUNCTION__;
    }


}





