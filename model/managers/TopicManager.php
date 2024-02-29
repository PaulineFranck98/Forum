<?php

    namespace Model\Managers;
    
    use App\Manager;
    use App\DAO;
    use Model\Managers\TopicManager;

    // Inheritance principle
    class TopicManager extends Manager{

        protected $className = "Model\Entities\Topic";
        protected $tableName = "topic";


        public function __construct(){
            // Inheritance 
            // TopicManager inherits all of the public and protected methods, properties and constants from the parent class Manager
            parent::connect();
        }

        // method to retrieve all the topics of a category
        public function findTopicsByCategoryId($id){

             // creation of variable $sql that stores sql query
            $sql = "SELECT *
                    FROM ".$this->tableName." t 
                    WHERE t.category_id = :id";
            // prepare data
            $data = [
                'id' => $id
            ];

            return $this->getMultipleResults(
                // Use resolution operator(`::`)to access static properties and methods of DAO class
                DAO::select($sql, $data, true), 
                $this->className
            );
        
        }

        //method to update the title of a topic
        public function update($topicId, $title){
            // creation of variable $sql that stores sql query
            $sql = "UPDATE ".$this->tableName." t
                    SET t.title = :title
                    WHERE t.id_topic = :id";
            // prepare data
            $data = [
                'title' => $title,
                'id' => $topicId
            ];
            // Use resolution operator(`::`)to access static properties and methods of DAO class
            DAO::update($sql, $data);
            
        }
        // method to close a topic 
        public function closeTopic($topicId) {
            // creation of variable $sql that stores sql query
            $sql = "UPDATE ".$this->tableName." t
                    SET t.closed = 1
                    WHERE t.id_topic = :id";
            // prepare data
            $data = [
                'id' => $topicId
            ];

            // Use resolution operator(`::`)to access static properties and methods of DAO class
            DAO::update($sql, $data);
    
        }

        // method to retrieve topics when searched in search bar
        public function searchTopics($search){

            // creation of variable $sql that stores sql query
            $sql = "SELECT * FROM ".$this->tableName ." t
                    WHERE t.title
                    LIKE :search";
            // prepare data
            $data = [
                'search' => '%' . $search . '%'
            ];

            return $this->getMultipleResults(
                // Use resolution operator(`::`)to access static properties and methods of DAO class
                DAO::select($sql, $data, true), 
                $this->className
            );

        }

        public function findTopicsByUserId($userId) {
            
            $sql = "SELECT * FROM " . $this->tableName . " 
                    WHERE user_id = :id 
                    ORDER BY creationdate DESC";

            $data = [
                'id' => $userId
            ];

            return $this->getMultipleResults(
                DAO::select($sql, $data, true),
                $this->className
            );
        }

        public function countTopicsByUserId($userId){

            $sql = "SELECT COUNT(*) FROM " . $this->tableName . "t
            WHERE t.user_id = :id";
            
            $data = [
                'id' => $userId
            ];

            return $this->getMultipleResults(
                DAO::select($sql, $data, true),
                $this->className
            );
        }
        


    }