<?php

class DashboardController extends Zend_Controller_Action
{

    protected $userSession;


    public function init()
    {
        /* Initialize action controller here */
        $this->userSession = Zend_Registry::get("user_session");
         if($this->userSession->userDetails)
        {
            $this->view->userDetails = $this->userSession->userDetails;
        }else{
            $this->_helper->redirector("signin",array("prependBase"=>false));
        }
    }

    public function indexAction()
    {
        // action body
    }


}

