<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Js
 *
 * @author craigbrookes
 */
class Application_Model_Js {
    
    protected $file;
    protected $fullFile = null;
    protected $filePath;
    protected $config;
    
    
    function __construct($file, $filePath=NULL) {
        if(strrchr(strtolower($file), ".")!= ".js")
        {
            $this->file=$file.".js";
        }else{
            $this->file = $file;
        }
        if(NULL === $filePath)
        {
            
            $this->config = Zend_Registry::get("config");
            
            $this->filePath = $this->config->dir->js;
            
        }else{
            $this->filePath = $filePath;
        }
    }

    
    public function getFile() {
        return $this->file;
    }

    public function setFile($file) {
        $this->file = $file;
    }

    public function getFullFile() {
        return $this->fullFile;
    }

    public function setFullFile($fullFile) {
        $this->fullFile = $fullFile;
    }

    public function getFilePath() {
        return $this->filePath;
    }

    public function setFilePath($filePath) {
        $this->filePath = $filePath;
    }
    
    public function getJs()
    {
        if(!$this->fullFile)
            return $this->filePath.$this->file;
        
        return $this->fullFile;
    }


    
    
}

?>
