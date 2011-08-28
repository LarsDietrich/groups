<?php

class Application_Model_Locations extends Application_Model_RowAbstract
{

    public $id,$latitude,$longitude,$county,$hashid;
    
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

    
    public function getCounty() {
        return $this->county;
    }

    public function getHashid() {
        return $this->hashid;
    }

            
    
    
    public function populateLocationFromAddress($address)
    {
        $httpClient = new Zend_Http_Client(self::GOOGLE_MAPS_URL);
        $httpClient->setParameterGet("sensor", "false")
                ->setParameterGet("address",  urlencode($address))
                ->setParameterGet("region", "IE");
        $result = $httpClient->request('GET');
        $response = Zend_Json_Decoder::decode($result->getBody(),Zend_Json::TYPE_OBJECT);
        if($response->status == "OK"){
         $res = $response->results[0];   
         $this->longitude = $res->geometry->location->lng;
         $this->latitude = $res->geometry->location->lat;
         $this->hashid = md5($this->latitude.$this->longitude);
         return TRUE;
        }
        return FALSE;

    }
    
    
    public function populateLocationFromCounty($county = NULL)
    {
        if(NULL === $county && NULL != $this->county){
            return $this->populateLocationFromAddress("co. ".$this->county);
        }
        else if(NULL != $county){
            $county = (stripos($county, "co."))?$county:"co. ".$county;
            return $this->populateLocationFromAddress ($county);
        }
        throw new Exception("no county present for ".__FUNCTION__." in ".__CLASS__);
        
    }


}

