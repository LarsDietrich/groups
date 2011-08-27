<?php

class Application_Model_Locations extends Application_Model_RowAbstract
{

    public $id,$latitude,$longitude,$address,$county;
    
    const GOOGLE_MAPS_URL = "http://maps.googleapis.com/maps/api/geocode/json";
    
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
    
    public function getCounty() {
        return $this->county;
    }

        
    
    
    public function populateLocationFromAddress($address)
    {
        $httpClient = new Zend_Http_Client(self::GOOGLE_MAPS_URL);
        $httpClient->setParameterGet("sensor", "false")
                ->setParameterGet("address",  urlencode($address))
                ->setParameterGet("region", "IE");
        $result = $httpClient->request('GET');
        $response = Zend_Json_Decoder::decode($result->getBody(),Zend_Json::TYPE_OBJECT);
        print_r($response);
        if($response->status == "OK"){
         $res = $response->results[0];   
         $this->longitude = $res->geometry->location->lng;
         $this->latitude = $res->geometry->location->lat;
         $this->address = $address;
        }

                
    }
    
    
    public function populateLocationFromCounty()
    {
        return $this->populateLocationFromAddress("co. ".$this->county);
    }


}

