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
            $categoryManager = new CategoryManager();

            $topics = $topicManager->findTopicsByCategoryId($categoryId);

            $category = $categoryManager->findOneById($categoryId);

            return [
                        "view" => VIEW_DIR."forum/detailCategory.php",
                        "data" => [
                            "topics" => $topics,
                            "category" => $category
                        ]
                    ];
        }


         /*************************************Post*************** */

        public function findAllPostsByTopicId($topicId)
        {   
            $postManager = new PostManager();
            $topicManager = new TopicManager();

            $posts = $postManager->findAllPostsByTopicId($topicId);

            $topic = $topicManager->findOneById($topicId);

            return [
                        "view" => VIEW_DIR."forum/detailTopic.php",
                        "data" => [
                            "posts" => $posts,
                            "topic" => $topic
                        ]
                    ];

 
        }

        public function addCategoryForm(){

            return [
                "view" => VIEW_DIR."form/addCategoryForm.php",
    
            ];


        }

        public function addCategory(){

            $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            
            $categoryManager = new CategoryManager();

            $categories = $categoryManager->findAll(["title", "DESC"]);

            if($title){

                $data = [
                    'title' => $title
                ];

                $categoryManager->add($data);

                Session::addFlash('success', 'Category has been added successfully');
                $this->redirectTo('home');
            }

            Session::addFlash('warning', 'Something went wrong');

            return [
                "view" => VIEW_DIR."home.php",
                "data" => [
                    "categories" => $categories
                ]
            ];

        }

        public function addTopicForm($categoryId){

           
            $categoryManager = new CategoryManager();


            $category = $categoryManager->findOneById($categoryId);

            return [

                "view" => VIEW_DIR."form/addTopicForm.php",
                "data" => [
                    "category" => $category
                ]
    
            ];


        }

        public function addTopicByCategory($id){

            $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $topicManager = new TopicManager();   
            $categoryManager = new CategoryManager();
            $category = $categoryManager->findOneById($id);
            $topics = $topicManager->findTopicsByCategoryId($id);
            $creationDate = new \DateTime('now');
            $creationDateFormated = $creationDate->format('Y-m-d');

            if($title){

                $data = [
                    'title' => $title,
                    'category_id' => $id,
                    'creationdate' => $creationDateFormated,
                    'closed' => 0,
                    'user_id' => 1
                ];

                // var_dump($data); die();
                $topicManager->add($data);

                Session::addFlash('success', 'Topic has been added successfully');
                $this->redirectTo('forum', 'findTopicsByCategoryId', $id);
            }

            Session::addFlash('warning', 'Something went wrong');

            return [
                "view" => VIEW_DIR."home.php",
                'data' => [
                    "topics" => $topics,
                    "category" => $category
                ]
            ];


        }

        
        public function addPostForm($topicId){

           
            $topicManager = new TopicManager();


            $topic = $topicManager->findOneById($topicId);

            return [

                "view" => VIEW_DIR."form/addPostForm.php",
                "data" => [
                    "topic" => $topic
                ]
    
            ];


        }

        public function addPostByTopic($id){

            $textContent = filter_input(INPUT_POST, 'textcontent', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $postManager = new PostManager();
            $topicManager = new TopicManager();   
            $topic = $topicManager->findOneById($id);
            $posts = $postManager->findAllPostsByTopicId($id);
            $creationDate = new \DateTime('now');
            $creationDateFormated = $creationDate->format('Y-m-d');

            if($textContent){

                $data = [
                    'textcontent' => $textContent,
                    'topic_id' => $id,
                    'creationdate' => $creationDateFormated,
                    'user_id' => 1
                ];

                // var_dump($data); die();
                $postManager->add($data);

                Session::addFlash('success', 'Post has been added successfully');
                $this->redirectTo('forum', 'findAllPostsByTopicId', $id);
            }

            Session::addFlash('warning', 'Something went wrong');

            return [
                "view" => VIEW_DIR."home.php",
                'data' => [
                    "posts" => $posts,
                    "topic" => $topic
                ]
            ];


        }

        

    }
