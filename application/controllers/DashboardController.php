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
        
        
        $this->view->pageTitle = "test title";
        $this->view->groups = $this->userDetais->getGroups();
        
    }


}

