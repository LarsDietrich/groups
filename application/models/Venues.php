<?php

class Application_Model_Venues extends Application_Model_RowAbstract
{

    public $id, $locations_id, $name, $google_id, $content, $rating, $tags, $category;
    
    public function getId() {
        return $this->id;
    }

    public function getLocations_id() {
        return $this->locations_id;
    }

    public function getName() {
        return $this->name;
    }

    public function getGoogle_id() {
        return $this->google_id;
    }

    public function getContent() {
        return $this->content;
    }

    public function getRating() {
        return $this->rating;
    }

    public function getTags() {
        return $this->tags;
    }

    public function getCategory() {
        return $this->category;
    }


}

