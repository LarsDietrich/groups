<?php

/**
 * Description of LayoutGroups
 *
 * @author craigbrookes
 */
class View_Helper_LayoutGroups {
    //put your code here
    
    

    public function layoutGroups(array $groups)
    {
        
       
        $html="";
        $base = new Zend_View_Helper_BaseUrl();
        foreach ($groups as $g) {
           if(!$g instanceof Application_Model_Groups) 
               throw new Application_Exception_ModelException ("the layout function ".__FUNCTION__." requires an array with instances of Application_Model_Groups ");
           else{

            $html.="<div style='width:inherit;'>
                       <a href='".$base->getBaseUrl()."/dashboard/show/group/name/".$g->getUrl()."'><h4>".$g->getName()."</h4></a>
                    </div>";
           }
        }
        return $html;
        
    }
    
}


?>
