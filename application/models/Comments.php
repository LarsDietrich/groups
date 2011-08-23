<?php

class Application_Model_Comments extends Application_Model_RowAbstract
{
        public $id,$comment,$relid,$type,$added,$memberid;
        
        
        public function equals(Application_Model_RowAbstract $row) {
            if($row instanceof Application_Model_Comments){
                if($row->type == $this->type
                        && $row->memberid == $this->memberid
                        && $row->relid == $this->relid)
                    return true;
            }
            return false;
        }


}

