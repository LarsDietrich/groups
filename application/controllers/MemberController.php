<?php

class MemberController extends Zend_Controller_Action
{
    /**
     *
     * @var Zend_Session_Namespace 
     */
    protected $userSession;

    public function init()
    {
       $ajaxContext = $this->_helper->getHelper('AjaxContext');
        $ajaxContext->addActionContext('members', 'html')
                ->initContext();
        
        $this->userSession = Zend_Registry::get("user_session");
    }

    public function indexAction()
    {
        // action body
    }
    
    public function membersAction()
    {
       $mapper = new Application_Model_MembersMapper();
       $this->view->members = $mapper->findAllByFieldsAndValues(array("group_id"=>$this->getRequest()->getParam("groupid")));
        
    }


}

