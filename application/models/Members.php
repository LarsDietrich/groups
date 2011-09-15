<?php

class Application_Model_Members extends Application_Model_RowAbstract
{
        public $id,$added,$lastlogin,$role,$user_id,$group_id;
        
        
        protected $siteuser, $group;
        
        public function getId() {
            return $this->id;
        }

        public function getAdded() {
            return $this->added;
        }

        public function getLastlogin() {
            return $this->lastlogin;
        }

        public function getRole() {
            return $this->role;
        }

        public function getUser_id() {
            return $this->user_id;
        }

        public function getGroup_id() {
            return $this->group_id;
        }

        /**
         *
         * @return Application_Model_SiteUsers
         * returns the associated site user object 
         */
        public function getSiteuser() {
            if(!isset($this->siteuser))
            {
                $mapper = new Application_Model_SiteUsersMapper();
                $this->siteuser = $mapper->findWherePriKeyEquals($this->user_id);
            }
            return $this->siteuser;
        }

        /**
         *
         * @return Application_Model_Groups
         * returns the associated group object 
         */
        public function getGroup() {
            if(!isset($this->group))
            {
                $mapper = new Application_Model_GroupsMapper();
                $this->group = $mapper->findWherePriKeyEquals($this->group_id);
            }
            return $this->group;
        }



}

