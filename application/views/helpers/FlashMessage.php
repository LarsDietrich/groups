<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FlashMessage
 *
 * @author craigbrookes
 */
class View_Helper_FlashMessage {
    //put your code here

    protected $_flashMessenger;
    
    public function flashMessage()
    {
        
        
         $flashMessenger = $this->_getFlashMessenger();

        //get messages from previous requests
        $messages = $flashMessenger->getMessages();
        
        //initialise return string
        $output ='<ul>';

        //process messages
        foreach ($messages as $message)
        {
            if (is_array($message)) {
                list($key,$message) = each($message);
            }
            $output .= sprintf("<li><span style='color:red;'>%s</span></li>",$message);
        }

        return $output.'</ul>';
        
    }
    
    
    /**
     * Lazily fetches FlashMessenger Instance.
     *
     * @return Zend_Controller_Action_Helper_FlashMessenger
     */
    public function _getFlashMessenger()
    {
        if (null === $this->_flashMessenger) {
            $this->_flashMessenger =
                Zend_Controller_Action_HelperBroker::getStaticHelper(
                    'FlashMessenger');
        }
        return $this->_flashMessenger;
    }
    
    
    
}




?>
