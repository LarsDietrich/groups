<?php

class Application_Model_Events extends Application_Model_RowAbstract
{

        public $id,$groups_id, $eventtime,$title,$venues_id,$status,$description,$organiser,$tags;
        
        protected $group,$venue,$eventOrganiser,$comments;
        
        public function getId() {
            return $this->id;
        }

        public function getGroups_id() {
            return $this->groups_id;
        }

        public function getEventtime() {
            return $this->eventtime;
        }

        public function getTitle() {
            return $this->title;
        }

        public function getVenues_id() {
            return $this->venues_id;
        }

        public function getStatus() {
            return $this->status;
        }

        public function getDescription() {
            return $this->description;
        }

        public function getOrganiser() {
            return $this->organiser;
        }

        public function getTags() {
            return $this->tags;
        }
        /**
         * convienence method to get the associated
         * Application_Model_Groups object
         * 
         * @return Application_Model_Groups 
         */
        public function getGroup() {
            if(!isset($this->group))    
            {
                $mapper = new Application_Model_GroupsMapper();
                $this->group = $mapper->findWherePriKeyEquals($this->groups_id);
            }
            return $this->group;
        }
        /**
         * convienence method to get the associated
         * Application_Model_Venues object
         * 
         * @return Application_Model_Venues 
         */
        public function getVenue() {
            if(!isset($this->venue))
            {
                $mapper = new Application_Model_VenuesMapper();
                $this->venue = $mapper->findWherePriKeyEquals($this->venues_id);
            }
            return $this->venue;
        }
        /**
         * convienence method to get the associated
         * Application_Model_SiteUsers object
         * 
         * @return Application_Model_SiteUsers 
         */
        public function getEventOrganiser() {
            if(!isset($this->eventOrganiser))
            {
                $mapper = new Application_Model_SiteUsersMapper();
                $this->eventOrganiser = $mapper->findWherePriKeyEquals($this->organiser);
            }
            
            return $this->eventOrganiser;
        }
        
        /**
         * convienence method to get the associated
         * Application_Model_Comments objects
         * 
         * @return array 
         */
        public function getComments() {
            if(!isset($this->comments))
            {
                $mapper = new Application_Model_CommentsMapper();
                $this->comments = $mapper->findAllByFieldsAndValues(array("id"=>$this->id));
            }
            return $this->comments;
        }


        
        
}

