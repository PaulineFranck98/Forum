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

        /* ============================ TOPIC =======================================*/

        // method to retrieve all topics
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



        // method to retrieve all the topics from a category
        public function findTopicsByCategoryId($categoryId)
        {   

            // creation of a new instance of the TopicManager class = object creation
            $topicManager = new TopicManager();

            // creation of a new instance of the CategoryManager class = object creation
            $categoryManager = new CategoryManager();

            $topics = $topicManager->findTopicsByCategoryId($categoryId);

            // use the model layer to retrieve informations from the database
            // fetches category by its ID using findOneById() (method from 'Manager.php') 
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

        // method to retrieve all the posts from a topic
        public function findAllPostsByTopicId($topicId)
        {   
            // creation of a new instance of the PostManager class = object creation
            $postManager = new PostManager();

            // creation of a new instance of the TopicManager class = object creation
            $topicManager = new TopicManager();

            // creation of a new instance of the UserManager class = object creation
            $userManager = new UserManager();

            $posts = $postManager->findAllPostsByTopicId($topicId);
            // use the model layer ($postManager, $topicManager) to retrieve informations from the database
            // fetches topic by its ID using findOneById() method from 'Manager.php' 
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

        // method to display the form to add a category
        public function addCategoryForm(){

            // I return a view in HTML format.
            return [
                "view" => VIEW_DIR."form/addCategoryForm.php",
    
            ];
        }


        // method to add a category (title)
        public function addCategory(){

            // retrieves category title from the POST request, sanitize the input
            $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            // creation of a new instance of the CategoryManager class = object creation
            $categoryManager = new CategoryManager();

            // I create a variable '$categories' which will take the form of an array of objects.
            // I use the model layer to retrieve information from the database.
            // The model layer returns the results to the controller for processing.
            $categories = $categoryManager->findAll(["title", "DESC"]);

            //check if title was provided
            if($title){

                // prepares data for new category
                $data = [
                    'title' => $title
                ];

                // add new category (data) to database using add() method from 'Manager.php'
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

        // method to display the form to update an existing category
        public function updateCategoryForm($categoryId){
            
            // creation of a new instance of the CategoryManager class = object creation
            $categoryManager = new CategoryManager();

            // fetches category by its ID using findOneById() method from 'Manager.php'
            $category = $categoryManager->findOneById($categoryId);

            // Return a view in HTML format
            // Send to the VIEW layer an array of data (variables)
            return [

                "view" => VIEW_DIR."form/updateCategoryForm.php",
                "data" => [
                    "category" => $category
                ]
    
            ];

        }

        // method  to update the title of a category 
        public function updateCategory($categoryId){

            // retrieves category title from the POST request, sanitize the input
            $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            
            // creation of a new instance of the CategoryManager class = object creation
            $categoryManager = new CategoryManager();

            // prepares data 
            $data = [
                'title' => $title,
                'id_category' => $categoryId
            ];

            // update category (data) in database using update() method from 'Manager.php'
            $categoryManager->update($categoryId, $title); 

            // if the category has been updated successfully, a success message will be displayed
            Session::addFlash('success', 'Category has been updated successfully');

            // redirect to the topics list of the updated category
            $this->redirectTo('forum', 'findTopicsByCategoryId', $categoryId);

        }

        /* ==========  TOPIC (ADD/ UPDATE) ======================================================================*/

        // method to display the form to add a topic to the category
        public function addTopicForm($categoryId){

           // creation of a new instance of the CategoryManager class = object creation
            $categoryManager = new CategoryManager();

            // fetches category by its ID using findOneById() method from 'Manager.php' 
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


        // method to add a topic (title) and its post (textcontent) to a category
        public function addTopicByCategory($id){

            // retrieves Topic title from the POST request, sanitize the input
            $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            // retrieves Post textcontent from the POST request, sanitize the input
            $textContent = filter_input(INPUT_POST, 'textcontent', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            // creation of a new instance of the TopicManager class = object creation
            $topicManager = new TopicManager();   

            // creation of a new instance of the CategoryManager class = object creation
            $categoryManager = new CategoryManager();

            // fetches category by its ID using findOneById() method from 'Manager.php' 
            $category = $categoryManager->findOneById($id);

            $topics = $topicManager->findTopicsByCategoryId($id);

            // creation of a new instance of DateTime to get the current time when a topic is created
            $creationDate = new \DateTime('now');

            //creation of a $creationDateFormated variable to store the new formatted date : year-month-day hours:minutes:seconds (only digits)
            $creationDateFormated = $creationDate->format('Y-m-d H:i:s');

            //stores the user in session in the variable $user_id
            $user_id = Session::getUser()->getId();

            // check if title was provided
            if($title){

                // prepares data for the new Topic
                $data = [
                    'title' => $title,
                    'category_id' => $id,
                    'creationdate' => $creationDateFormated,
                    'closed' => 0,
                    'user_id' => $user_id
                ];

                // add new topic (data) to database using add() method from 'Manager.php'
                $topicId = $topicManager->add($data);

                // prepares data for the new Post
                $dataMessage = [
                    'textcontent' => $textContent,
                    'creationdate' => $creationDateFormated,
                    'user_id' => $user_id,
                    'topic_id' => $topicId,
                ];

                // creation of a new instance of the PostManager class = object creation
                $postManager = new PostManager();

                // add new post (data) to database using add() method from 'Manager.php'
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

        // method to display the form to update an existing topic
        public function updateTopicForm($topicId){
            
            // creation of a new instance of the TopicManager class = object creation
            $topicManager = new TopicManager();

            // fetches topic by its ID using findOneById() method from 'Manager.php' 
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

        // method  to update the title of a topic 
        public function updateTopic($topicId){
            
            // retrieves Topic title from the POST request, sanitize the input
            $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            
            // creation of a new instance of the TopicManager class = object creation
            $topicManager = new TopicManager();

            // prepares data
            $data = [
                'title' => $title,
                'id_topic' => $topicId
            ];

            // update topic (data) in database using update() method from 'Manager.php'
            $topicManager->update($topicId, $title); 

            // if the topic has been updated successfully, a success message will be displayed
            Session::addFlash('success', 'Topic has been updated successfully');
            
            // redirect to posts list if updated topic
            $this->redirectTo('forum', 'findAllPostsByTopicId', $topicId);



        }

        /* ==========  POST (ADD/ UPDATE) ======================================================================*/

        // method to display the form to add a post to a topic
        public function addPostForm($topicId){

           // creation of a new instance of the TopicManager class = object creation
            $topicManager = new TopicManager();

            // fetches topic by its ID using findOneById() method from 'Manager.php' 
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

        // method to add a post to a topic (textcontent)
        public function addPostByTopic($id){

            // retrieves Post textcontent from the POST request, sanitize the input
            $textContent = filter_input(INPUT_POST, 'textcontent', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            // creation of a new instance of the PostManager class = object creation
            $postManager = new PostManager();

            // creation of a new instance of the TopicManager class = object creation
            $topicManager = new TopicManager();   

            // fetches topic by its ID using findOneById() method from 'Manager.php' 
            $topic = $topicManager->findOneById($id);
            // use the model layer to retrieve informations from the database ($topicManager, $postManager)
            $posts = $postManager->findAllPostsByTopicId($id);

            // creation of a new instance of DateTime to get the current time when a post was created
            $creationDate = new \DateTime('now');

            //changes date format to display $creationDate like this: year-month-day hours:minutes:seconds (only digits) 
            $creationDateFormated = $creationDate->format('Y-m-d H:i:s');

            // stores the user in session in the variable $user_id
            $user_id = Session::getUser()->getId();

            if($textContent){

                // prepares data for the new post
                $data = [
                    'textcontent' => $textContent,
                    'topic_id' => $id,
                    'creationdate' => $creationDateFormated,
                    'user_id' => $user_id
                ];

                // add new post (data) to database using add() method from 'Manager.php'
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

        // method to display the form to update an existing post
        public function updatePostForm($postId){
            
            // creation of a new instance of the PostManager class = object creation
            $postManager = new PostManager();

            // creation of $post variable : user model layer ($postManager) to retrieve informations from database
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


        // method  to update the textcontent of a post
        public function updatePost($postId){

            // retrieves Post textcontent from the POST request, sanitize the input
            $textContent = filter_input(INPUT_POST, 'textcontent', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            // creation of a new instance of the PostManager class = object creation
            $postManager = new PostManager();
            
            // prepares data
            $data = [
                'textcontent' => $textContent,
                'id_post' => $postId
            ];

            // update post (data) in database using update() method from 'Manager.php'
            $postManager->update($postId, $textContent);
            var_dump($postManager);
            // if the post was successfully updated, a success message will be displayed
            Session::addFlash('success', 'Post has been updated successfully');

            // redirect to Home page (--> must change)
            $this->redirectTo('home');

        }

        // method to close a topic (no post can be added)
        public function closeTopic($id){

            // creation of a new instance of the TopicManager class = object creation
            $topicManager = new TopicManager();

            // creation of $topic variable : user model layer ($postManager) to retrieve informations from database
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
