<?php

class Application_Model_Locations extends Application_Model_RowAbstract
{

    public $id,$latitude,$longitude,$address;
    
    public function getId() {
        return $this->id;
    }

    public function getLatitude() {
        return $this->latitude;
    }

    public function getLongitude() {
        return $this->longitude;
    }

    public function getAddress() {
        return $this->address;
    }


}

