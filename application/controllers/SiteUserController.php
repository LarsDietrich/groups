<?php

class SiteUserController extends Zend_Controller_Action
{

    /**
     *
     * @var Zend_Session_Namespace 
     */
    protected $userSession;
    
    public function init()
    {
        /* Initialize action controller here */
        $this->userSession = Zend_Registry::get("user_session");
        
    }

    /**
     * also mapped to /join
     */
    public function indexAction()
    {
        $joinForm = ($this->userSession->joinform !=null)?unserialize($this->userSession->joinform):new Application_Form_Join();
        $this->view->joinForm = $joinForm;
        $this->userSession->joinform = null;
        
    }
    
    public function createAction()
    {
        
        $joinForm = new Application_Form_Join();
        if($this->getRequest()->isPost() && $joinForm->isValid($this->getRequest()->getPost()))
        {
            try{
                $userMapper = new Application_Model_SiteUsersMapper();
                $locationMapper = new Application_Model_LocationsMapper();
                $user = new Application_Model_SiteUsers($this->getRequest()->getPost());
                
                
                $location = new Application_Model_Locations($this->getRequest()->getPost());
                $location->populateLocationFromCounty();
                
                $fullAddress = $this->getRequest()->getParam("address1").", ".$this->getRequest()->getParam("address2");
                $location->address = $fullAddress;
                $location = $locationMapper->saveUpdate($location);
                $user->added = date("Y-m-d h:i:s");
                $user->location_id = $location->id;
                $user = $userMapper->saveUpdate($user);
                $this->userSession->userDetails = $user;
                $this->userSession->firstTime = TRUE;
                $this->_helper->redirector("dashboard",array("prependBase"=>false));
                
            }catch (Exception $e){
                echo $e->getMessage();
            }
            
        }else{
            
            $joinForm->populate($this->getRequest()->getPost());
            $this->userSession->joinform = serialize($joinForm);
            $this->_helper->redirector("join",array("prependBase"=>false));
        }
        
    }
    
    public function dashboardAction()
    {
        if($this->userSession->userDetails)
        {
            $this->view->userDetails = $this->userSession->userDetails;
        }else{
            $this->_helper->redirector("signin",array("prependBase"=>false));
        }
            
    }
    
    public function signinAction()
    {
        $form = new Application_Form_Signin();
        if(!$this->getRequest()->isPost()){
            $this->view->form = $form;
        }else if($this->getRequest()->isPost() && $form->isValid($this->getRequest()->getPost())){
            $username = $this->getRequest()->getParam("handle");
            $password = $this->getRequest()->getParam("password");
            $user = new Application_Model_SiteUsers(array("handle"=>$username,"password"=>$password));
            $mapper = new Application_Model_SiteUsersMapper();
            $foundUser = $mapper->findRowByExample($user);
            
            if($foundUser->isEmpty()!=true)
            {
                $this->userSession->userDetails = $foundUser;
                $this->userSession->firstTime = FALSE;
                $this->_helper->redirector("dashboard",array("prependBase"=>false));
                
            }else{
                $this->_helper->FlashMessenger->addMessage("username or password incorrect");
                $this->_helper->redirector("signin",array("prependBase"=>false));
            }
            
        }else{
            $this->view->form = $form;
        }
    }
    
    public function signoutAction()
    {
        $this->userSession->unsetAll();
        $redirect = ($this->getRequest()->getParam("returnto")==NULL)?$this->getFrontController()->getBaseUrl():$this->getRequest()->getParam("returnto");
        $this->_helper->redirector("","");
    }


}

