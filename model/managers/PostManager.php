<?php

    namespace Model\Managers;

    use App\Manager;
    use App\DAO;
    use Model\Managers\PostManager;

    class PostManager extends Manager{

        protected $className = "Model\Entities\Post";
        protected $tableName = "post";


        public function __construct(){
            
            parent::connect();
        }

        public function findAllPostsByTopicId($id)
        {

            $sql = "SELECT *
                    FROM post p  
                    WHERE p.topic_id = :id";

            $data = [
                'id' => $id
            ];

            return $this->getMultipleResults(
                DAO::select($sql, $data, true), 
                $this->className
            );
        
        }
    }

