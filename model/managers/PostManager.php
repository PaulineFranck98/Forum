<?php

    namespace Model\Managers;

    use App\Manager;
    use App\DAO;
    use Model\Managers\PostManager;

    // Inheritance principle
    class PostManager extends Manager{

        protected $className = "Model\Entities\Post";
        protected $tableName = "post";


        public function __construct(){
            // Inheritance 
            // PostManager inherits all of the public and protected methods, properties and constants from the parent class Manager
            parent::connect();
        }

        // method to retrieve all posts of a topic
        public function findAllPostsByTopicId($id)
        {
             // creation of variable $sql that stores sql query
            $sql = "SELECT *
                    FROM post p  
                    WHERE p.topic_id = :id";
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
        // method to update the textcontent of a post
        public function update($postId, $textContent){

            // creation of variable $sql that stores sql query
            $sql = "UPDATE ". $this->tableName . "p
                    SET p.textcontent = :textcontent
                    WHERE p.id_post = :id";
            // prepare data
            $data =[
                'textcontent' => $textContent,
                'id' => $postId
            ];
            // var_dump($data); die();
            // Use resolution operator(`::`)to access static properties and methods of DAO class
            DAO::update($sql, $data);


        }

        // method to retrieve posts when searched in search bar
        public function searchPosts($search){

            // creation of variable $sql that stores sql query
            $sql = "SELECT * FROM ".$this->tableName ." p
                    WHERE p.textcontent
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

        public function findPostsByUserId($userId) {
            
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

        public function countPostsByUserId($userId){

            $sql = "SELECT COUNT(*) FROM " . $this->tableName . "p
                    WHERE p.user_id = :id";
                    
            $data = [
                'id' => $userId
            ];

            return $this->getOneOrNullResult(
                // Use resolution operator(`::`)to access static properties and methods of DAO class
                DAO::select($sql, $data, false), 
                $this->className
            );

        }
    }

