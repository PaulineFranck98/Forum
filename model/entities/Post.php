<?php

    namespace Model\Entities;

    use App\Entity;

    final class Post extends Entity {

        private $id;
        private $creationdate;
        private $textcontent;
        private $user;
        private $topic;

        public function __construct($data){

            $this->hydrate($data);

        }

        // Get the value of id 
        public function getId(){

            return $this->id;
        }

        /**
         * Set the value of id
         * @return self
         */
        public function setId($id){

            $this->id = $id;

            return $this;
        }

        // Get value of creationdate
        public function getCreationdate(){

            $formattedDate = $this->creationdate->format("d/m/Y, H:i:s");

            return $formattedDate;

        }

        // Set value of creationdate
        public function setCreationdate($date){

            $this->creationdate = new \DateTime($date);

            return $this;

        }

        // Get textcontent
        public function getTextcontent(){

            return $this->textcontent;

        }

          /**
         * Set the value of textcontent
         * 
         * @return self
         */
        public function setTextcontent($textcontent){

            $this->textcontent = $textcontent;

            return $this;

        }
        
        // Get value of User
        public function getUser(){

            return $this->user;

        }

        /**
         * Set the value of user
         * 
         * @return self
         */
        public function setUser($user){

            $this->user = $user;

            return $this;
        }

        // get value of Topic
        public function getTopic(){

            return $this->topic;
        }

         /**
         * Set the value of topic
         * 
         * @return self
         */
        public function setTopic($topic){

            $this->topic = $topic;

            return $this;
        }





    }