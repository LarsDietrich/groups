<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AuthFilter
 *
 * @author craigbrookes
 */
class Application_Plugin_AuthFilter extends Zend_Controller_Plugin_Abstract {
    
    /**
     *
     * @var Zend_Auth 
     */
    protected $auth;
    /**
     *
     * @var Zend_Acl 
     */
    protected $acl;

    protected $userSession;

    protected $activeGroup;
    
    function __construct($auth, $acl) {
        $this->auth = $auth;
        $this->acl = $acl;
        $this->userSession = Zend_Registry::get("user_session");
        $this->activeGroup = $this->userSession->groupName;
    }

    

    public function preDispatch(Zend_Controller_Request_Abstract $request) {
        $userRole = "Guest";
        $resource = $request->getControllerName();
        
        $privilege = $request->getActionName();
        if($this->auth->hasIdentity()){
            $roles = $this->auth->getIdentity()->getMembers();
            
            
            foreach($roles as $role){
                
                if($role->getGroup()->name == $this->activeGroup){
                    $userRole = $role->getRole();
                }
            }
            
        }
        
        if (!$this->acl->has($resource)) {
        $resource = null;
        }
         if (!$this->acl->isAllowed($userRole, $resource, $privilege)) {
            $request->setModuleName("default");
            $request->setControllerName("siteuser");
            $request->setActionName("signin");
         }
    }

}

?>
