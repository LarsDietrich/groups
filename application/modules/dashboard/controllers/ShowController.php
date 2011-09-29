<?php

/**
 * Description of ShowController
 *
 * @author craigbrookes
 */
class Dashboard_ShowController extends Zend_Controller_Action{
    
    
    public function groupAction()
    {
        $this->_helper->viewRenderer->setNoRender(true);
        print_r($this->getRequest()->getParams());
    }
    
    
    
}

?>
