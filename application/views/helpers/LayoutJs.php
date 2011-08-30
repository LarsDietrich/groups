<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of LayoutJs
 *
 * @author craigbrookes
 */
class View_Helper_LayoutJs {
    
    
    public function layoutJs(array $js)
    {
        $base = new Zend_View_Helper_BaseUrl();
        $html =""; 
        foreach ($js as $jsOb) {
            if(strpos($jsOb->getJs(),"http")!== false){
                $html.="<script src='".$jsOb->getJs()."' type='text/javascript' ></script>\n";
            }else{
                $html.="<script src='".$base->getBaseUrl().$jsOb->getJs()."' type='text/javascript' ></script>\n";
            }
            
                
        }
        return $html;
    }
    
}

?>
