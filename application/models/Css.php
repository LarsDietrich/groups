<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Css
 *
 * @author craigbrookes
 */
class Application_Model_Css {
    //put your code here
    

    /**
     *
     * @var Zend_Config 
     */
    protected $config;
    protected $cssPath;
    protected $file;
    protected $fullPath;
  
    public function __construct($file,$path = NULL) {
        if(strrchr(strtolower($file), ".")!= ".css")
        {
            $this->file=$file.".css";
        }else{
            $this->file = $file;
        }
        
        if(NULL === $path)
        {
            
            $this->config = Zend_Registry::get("config");
            
            $this->cssPath = $this->config->dir->css;
            
        }else{
            $this->cssPath = $path;
        }
            
        
    }
    
    
    public function getCssPath() {
        return $this->cssPath;
    }

    public function setCssPath($cssPath) {
        $this->cssPath = $cssPath;
    }

    public function getFile() {
        return $this->file;
    }

    public function setFile($file) {
        $this->file = $file;
    }
    
    public function getCss()
    {
        if(!$this->fullPath)
            return $this->cssPath.$this->file;
        
        return $this->fullPath;
    }
    
    public function setSetFullPath($setFullPath) {
        $this->setFullPath = $setFullPath;
    }



    



    
    
    
}

?>
