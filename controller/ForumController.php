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



        // function that allows to retrieve all topics
        public function index(){
          
            // creation of a new instance of the TopicManager class = object creation
           $topicManager = new TopicManager();

            // I create a variable '$topics' which will take the form of an array of objects.
            // I use the model layer to retrieve informations from the database.
            // The model layer returns the results to the controller for processing.
           $topics = $topicManager->findAll(["creationdate", "DESC"]);

            // I return a view in HTML format
            // I send to the VIEW layer an array of data (variables)
            return [
                "view" => VIEW_DIR."forum/listTopics.php",
                "data" => [
                    "topics" => $topics
                ]
            ];
        
        }


        /* ============================ TOPIC ====================================================*/

        // function that allows to retrieve all the topics from a specific category
        public function findTopicsByCategoryId($categoryId)
        {   

            // creation of a new instance of the TopicManager class = object creation
            $topicManager = new TopicManager();

            // creation of a new instance of the CategoryManager class = object creation
            $categoryManager = new CategoryManager();

            $topics = $topicManager->findTopicsByCategoryId($categoryId);

            $category = $categoryManager->findOneById($categoryId);

            // I return a view in HTML format
            // I send to the VIEW layer an array of data (variables)
            return [
                        "view" => VIEW_DIR."forum/detailCategory.php",
                        "data" => [
                            "topics" => $topics,
                            "category" => $category
                        ]
                    ];
        }


        /* ============================  POST ====================================================*/

        // function that allows to retrieve all the posts from a specific topic
        public function findAllPostsByTopicId($topicId)
        {   
            // creation of a new instance of the PostManager class = object creation
            $postManager = new PostManager();

            // creation of a new instance of the TopicManager class = object creation
            $topicManager = new TopicManager();

            // creation of a new instance of the UserManager class = object creation
            $userManager = new UserManager();

            $posts = $postManager->findAllPostsByTopicId($topicId);

            $topic = $topicManager->findOneById($topicId);

            
            // I return a view in HTML format.
            // I send to the VIEW layer an array of data (variables)
            return [
                        "view" => VIEW_DIR."forum/detailTopic.php",
                        "data" => [
                            "posts" => $posts,
                            "topic" => $topic
                            
                        ]
                    ];

 
        }

        /* ==========  CATEGORY (ADD/ UPDATE) ======================================================================*/

        public function addCategoryForm(){

            // I return a view in HTML format.
            return [
                "view" => VIEW_DIR."form/addCategoryForm.php",
    
            ];


        }

        // function that allows to add a category (title)
        public function addCategory(){

            $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            // creation of a new instance of the CategoryManager class = object creation
            $categoryManager = new CategoryManager();

            // I create a variable '$categories' which will take the form of an array of objects.
            // I use the model layer to retrieve information from the database.
            // The model layer returns the results to the controller for processing.
            $categories = $categoryManager->findAll(["title", "DESC"]);

            if($title){

                $data = [
                    'title' => $title
                ];

                $categoryManager->add($data);

                // if the category has been added successfully, a success message will be displayed
                Session::addFlash('success', 'Category has been added successfully');
                // redirect to the Home page
                $this->redirectTo('home');
            }
            // if the category has not been added successfully, an error message will be displayed
            Session::addFlash('warning', 'Something went wrong');

            // I return a view in HTML format.
            // I send to the VIEW layer an array of data (variables)
            return [
                "view" => VIEW_DIR."home.php",
                "data" => [
                    "categories" => $categories
                ]
            ];

        }

        
        public function updateCategoryForm($categoryId){
            
            // creation of a new instance of the CategoryManager class = object creation
            $categoryManager = new CategoryManager();

            $category = $categoryManager->findOneById($categoryId);

            // I return a view in HTML format
            // I send to the VIEW layer an array of data (variables)
            return [

                "view" => VIEW_DIR."form/updateCategoryForm.php",
                "data" => [
                    "category" => $category
                ]
    
            ];

        }

        // function that allows to update the title of a category 
        public function updateCategory($categoryId){

            $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            
            // creation of a new instance of the CategoryManager class = object creation
            $categoryManager = new CategoryManager();

            $data = [
                'title' => $title,
                'id_category' => $categoryId
            ];

            $categoryManager->update($categoryId, $title); 

            // if the category has been updated successfully, a success message will be displayed
            Session::addFlash('success', 'Category has been updated successfully');

            // redirect to the topics list of the updated category
            $this->redirectTo('forum', 'findTopicsByCategoryId', $categoryId);

        }

        /* ==========  TOPIC (ADD/ UPDATE) ======================================================================*/

        public function addTopicForm($categoryId){

           // creation of a new instance of the CategoryManager class = object creation
            $categoryManager = new CategoryManager();


            $category = $categoryManager->findOneById($categoryId);

            // I return a view in HTML format
            // I send to the VIEW layer an array of data (variables)
            return [

                "view" => VIEW_DIR."form/addTopicForm.php",
                "data" => [
                    "category" => $category
                ]
    
            ];


        }


        // function that allows to add a topic (title) and its post (textcontent) in a category
        public function addTopicByCategory($id){

            $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $textContent = filter_input(INPUT_POST, 'textcontent', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            // creation of a new instance of the TopicManager class = object creation
            $topicManager = new TopicManager();   

            // creation of a new instance of the CategoryManager class = object creation
            $categoryManager = new CategoryManager();

            $category = $categoryManager->findOneById($id);
            $topics = $topicManager->findTopicsByCategoryId($id);
            $creationDate = new \DateTime('now');
            $creationDateFormated = $creationDate->format('Y-m-d H:i:s');
            $user_id = Session::getUser()->getId();

            if($title){

                $data = [
                    'title' => $title,
                    'category_id' => $id,
                    'creationdate' => $creationDateFormated,
                    'closed' => 0,
                    'user_id' => $user_id
                ];

            
                $topicId = $topicManager->add($data);

                $dataMessage = [
                    'textcontent' => $textContent,
                    'creationdate' => $creationDateFormated,
                    'user_id' => $user_id,
                    'topic_id' => $topicId,
                ];

                // creation of a new instance of the PostManager class = object creation
                $postManager = new PostManager();

                $postManager->add($dataMessage);

                // if the topic and its post have been added successfully, a success message will be displayed
                Session::addFlash('success', 'Topic and Post have been added successfully');
                $this->redirectTo('forum', 'findTopicsByCategoryId', $id);
            }
            // if the topic and its post have not been added successfully, an error message will be displayed
            Session::addFlash('warning', 'Something went wrong');

            // I return a view in HTML format
            // I send to the VIEW layer an array of data (variables)
            return [
                "view" => VIEW_DIR."home.php",
                'data' => [
                    "topics" => $topics,
                    "category" => $category
                ]
            ];


        }

        public function updateTopicForm($topicId){
            
            // creation of a new instance of the TopicManager class = object creation
            $topicManager = new TopicManager();

            $topic = $topicManager->findOneById($topicId);

            // I return a view in HTML format
            // I send to the VIEW layer an array of data (variables)
            return [

                "view" => VIEW_DIR."form/updateTopicForm.php",
                "data" => [
                    "topic" => $topic
                ]
    
            ];


        }

        // function that allows to update the title of a topic 
        public function updateTopic($topicId){
            

            $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            
            // creation of a new instance of the TopicManager class = object creation
            $topicManager = new TopicManager();

            $data = [
                'title' => $title,
                'id_topic' => $topicId
            ];

            $topicManager->update($topicId, $title); 

            // if the topic has been updated successfully, a success message will be displayed
            Session::addFlash('success', 'Topic has been updated successfully');
            
            // redirect to posts list if the updated topic
            $this->redirectTo('forum', 'findAllPostsByTopicId', $topicId);



        }

        /* ==========  POST (ADD/ UPDATE) ======================================================================*/

         
        public function addPostForm($topicId){

           // creation of a new instance of the TopicManager class = object creation
            $topicManager = new TopicManager();


            $topic = $topicManager->findOneById($topicId);

            // I return a view in HTML format
            // I send to the VIEW layer an array of data (variables)
            return [

                "view" => VIEW_DIR."form/addPostForm.php",
                "data" => [
                    "topic" => $topic
                ]
    
            ];


        }

        // function that allows to add a post in a topic (textcontent)
        public function addPostByTopic($id){

            $textContent = filter_input(INPUT_POST, 'textcontent', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            // creation of a new instance of the PostManager class = object creation
            $postManager = new PostManager();

            // creation of a new instance of the TopicManager class = object creation
            $topicManager = new TopicManager();   

            $topic = $topicManager->findOneById($id);
            $posts = $postManager->findAllPostsByTopicId($id);
            $creationDate = new \DateTime('now');
            $creationDateFormated = $creationDate->format('Y-m-d H:i:s');
            
            $user_id = Session::getUser()->getId();

            if($textContent){

                $data = [
                    'textcontent' => $textContent,
                    'topic_id' => $id,
                    'creationdate' => $creationDateFormated,
                    'user_id' => $user_id
                ];

                // var_dump($data); die();
                $postManager->add($data);

                // if the post has been added successfully, a success message will be displayed
                Session::addFlash('success', 'Post has been added successfully');

                // redirect to posts list of the topic (where post was created)
                $this->redirectTo('forum', 'findAllPostsByTopicId', $id);
            }

            // if the post has not been added successfully, an error message will be displayed
            Session::addFlash('warning', 'Something went wrong');

            // I return a view in HTML format
            // I send to the VIEW an array of data (variables)
            return [
                "view" => VIEW_DIR."home.php",
                'data' => [
                    "posts" => $posts,
                    "topic" => $topic
                ]
            ];


        }

        public function updatePostForm($postId){
            
            // creation of a new instance of the PostManager class = object creation
            $postManager = new PostManager();

            $post = $postManager->findOneById($postId);

            // I return a view in HTML format
            // I send to the VIEW an array of data (variables)
            return [

                "view" => VIEW_DIR."form/updatePostForm.php",
                "data" => [
                    "post" => $post
                ]
    
            ];

        }


        // function that allows to update the textcontent of a post
        public function updatePost($postId){

            $textContent = filter_input(INPUT_POST, 'textcontent', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            // creation of a new instance of the PostManager class = object creation
            $postManager = new PostManager();
            
            $data = [
                'textcontent' => $textContent,
                'id_post' => $postId
            ];

            $postManager->update($postId, $textContent);

            // if the post was successfully updated, a success message will be displayed
            Session::addFlash('success', 'Post has been updated successfully');

            // redirect to Home page (--> must change)
            $this->redirectTo('home');

        }

        // function that allows to close a topic (no post can be added)
        public function closeTopic($id){

            // creation of a new instance of the TopicManager class = object creation
            $topicManager = new TopicManager();

            $topic = $topicManager->findOneById($id);
            
            // if user in session = the user who created the topic OR if is Admin then can close the topic
            if($topic && (Session::getUser() == $topic->getUser()) || (Session::isAdmin())){

                $topicManager->closeTopic($id);

                // if the topic has been closed successfully, a success message will be displayed
                Session::addFlash('success', 'Topic has been closed successfully');

                // redirect to the posts list of the closed topic 
                $this->redirectTo('forum', 'findAllPostsByTopicId', $id);

            } else {

                // if the topic has not been closed successfully, an error message will be displayed
                Session::addFlash('error', 'The Post has not been closed');

                // redirect to the posts list of the closed topic 
                $this->redirectTo('forum', 'findAllPostsByTopicId', $id);
            }
        }   

    }
