<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of LayoutCss
 *
 * @author craigbrookes
 * 
 */

class View_Helper_LayoutCss{
    
    
    public function layoutCss(array $css)
    {
        $base = new Zend_View_Helper_BaseUrl();
        $html =""; 
        foreach ($css as $cssOb) {
            $html.="<link rel='stylesheet' href='".$base->getBaseUrl().$cssOb->getCss()."' type='text/css' media='screen' />\n";
                
        }
        return $html;
    }
}


?>
