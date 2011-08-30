<?php

/**
 * Description of GroupFilter
 * allows for urls to follow the format of
 * sitename/group-name
 *
 * @author craigbrookes
 */
class Application_Plugin_GroupFilter extends Zend_Controller_Plugin_Abstract {
    //put your code here
    
    public function preDispatch(Zend_Controller_Request_Abstract $request) {
       $controller = $request->getControllerName();
       $groupMapper = new Application_Model_GroupsMapper();
       $group = $groupMapper->findRowByFieldsAndValues(array("url"=>$controller));
      
       if(!$group->isEmpty()){
           
           $request->setControllerName("group");
       }
    }

}

?>
