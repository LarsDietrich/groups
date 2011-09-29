<?php


/**
 * Description of AuthFilter
 * The AuthFilter is called for every request and essentially checks if
 * there is a logged in user. After which it consults with ACL to see
 * if this user is allowed to access the requested resource
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

    /**
     *
     * @var Zend_Session_Namespace 
     */
    protected $userSession;

    protected $activeGroup;
    
    /**
     *
     * @var Zend_View_Helper_BaseUrl 
     */
    protected $baseUrl;
    
    function __construct($auth, $acl) {
        $this->auth = $auth;
        $this->acl = $acl;
        $this->userSession = Zend_Registry::get("user_session");
        $this->activeGroup = $this->userSession->groupName;
        $this->baseUrl = new Zend_View_Helper_BaseUrl();
        
    }

    

    public function preDispatch(Zend_Controller_Request_Abstract $request) {
        
        $userRole = "Guest";
        $module   = $request->getModuleName();
        
        if($module){
            $resource = $module.".".$request->getControllerName();
        }else{
            $resource = $request->getControllerName();
        }
        
        $privilege = $request->getActionName();
        
        if($this->auth->hasIdentity()){
            $userRole = "Member";
            $roles    = $this->auth->getIdentity()->getMembers();
            
            if($resource == "dashboard.show"){
                foreach($roles as $role){
                    $role->getGroup()->createGroupUrl();
                    
                    if($role->getGroup()->url == $this->getRequest()->getParam("name")){
                        $userRole = $role->getRole();
                        
                    }
            }
               
            }
        }

        if (!$this->acl->has($resource)) {
            $resource = null;
        }
        
        
        
         if (!$this->acl->isAllowed($userRole, $resource, $privilege)) {
             
             $this->getResponse()->setRedirect($this->baseUrl->baseUrl()."/signin");
         }
    }

}

?>
