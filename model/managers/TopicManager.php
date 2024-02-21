<?php

    namespace Model\Managers;
    
    use App\Manager;
    use App\DAO;
    use Model\Managers\TopicManager;

    class TopicManager extends Manager{

        protected $className = "Model\Entities\Topic";
        protected $tableName = "topic";


        public function __construct(){
            parent::connect();
        }

        public function findTopicsByCategoryId($id)
        {

            //faire requete avec select     

            $sql = "SELECT *
                    FROM topic t 
                    WHERE t.category_id = :id";

            $data = [
                'id' => $id
            ];

            return $this->getMultipleResults(
                DAO::select($sql, $data, true), 
                $this->className
            );
        
        }


    }