<?php

    namespace Controller;

    use App\Session;
    use App\AbstractController;
    use App\ControllerInterface;
    use Model\Managers\TopicManager;
    use Model\Managers\PostManager;
    use Model\Managers\CategoryManager;
    use Model\Managers\UserManager;
    
    class ForumController extends AbstractController implements ControllerInterface{

        public function findAllTopics(){
          

           $topicManager = new TopicManager();

           $topics = $topicManager->findAll(["creationdate", "DESC"]);

            return [
                "view" => VIEW_DIR."forum/listTopics.php",
                "data" => [
                    "topics" => $topics
                ]
            ];
        
        }


        /*************************************Topic*************** */

        public function findTopicsByCategoryId($categoryId)
        {   
            $topicManager = new TopicManager();

            $topics = $topicManager->findTopicsByCategoryId($categoryId);

            return [
                        "view" => VIEW_DIR."forum/detailCategory.php",
                        "data" => [
                        "topics" => $topics
                        ]
                    ];
        }


         /*************************************Post*************** */

        public function findAllPostsByTopicId($id)
        {   
            $postManager = new PostManager();

            $posts = $postManager->findAllPostsByTopicId($id);

            return [
                        "view" => VIEW_DIR."forum/detailTopic.php",
                        "data" => [
                        "posts" => $posts
                        ]
                    ];

 
        }
        

    }
