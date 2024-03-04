<?php

    namespace Controller;

    use App\Session;
    use App\AbstractController;
    use App\ControllerInterface;
    use Model\Managers\TopicManager;
    use Model\Managers\PostManager;
    use Model\Managers\CategoryManager;
    use Model\Managers\UserManager;
    
    class SecurityController extends AbstractController implements ControllerInterface{

        // method to display the form to register a new user
        public function registerForm(){

            // return a view in HTML format
            return [
                "view" => VIEW_DIR."security/registerForm.php"
            
            ];

        }

        // method to register as a new User
        public function register() {

            /*----------- HONEYPOT CHECK ---------------------------------------*/

            // Creation of a variable to store the email from the POST request, sanitize it
            $honeypot = filter_input(INPUT_POST, 'email_honeypot', FILTER_SANITIZE_EMAIL);

            // Check if the honeypot input contains any value. --> if yes, don't proceed with registration.
            if (!empty($honeypot)) {

                // Possibly a bot, stop processing : no registration 
                return;
            }


            /*----------- END HONEYPOT CHECK -----------------------------------*/

            // retrieves User username from the POST request, sanitize the input
            $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            // retrieves User password created from the POST request, sanitize the input
            $createPassword = filter_input(INPUT_POST, 'createPassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            // retrieves User password repeated from the POST request
            // FILTER_VALIDATE_REGEXP : validates password against a regular expression to enforce password strenght requirement (here : uppercase, lowercase, digit, min 8, max 32 characters)
            $repeatPassword = filter_input(INPUT_POST, 'repeatPassword', FILTER_VALIDATE_REGEXP, ["options" => ["regexp" => "/[A-Za-z0-9].{8,32}/"]] );
            
            // Initialize $avatar to an empty string
            

            // check if a file was uploaded and there are no errors
            if(isset($_FILES['avatar']) && $_FILES['avatar']['error'] == 0) {
                $avatar = $_FILES['avatar'];
                // rename avatar
                $time = time();
                // make each name unique with the current timestamp time()
                $avatar_name = $time . $avatar['name'];
                $avatar_tmp_name = $avatar['tmp_name'];
                $avatar_destination_path = 'public/images/' . $avatar_name;

                // make sure file is an image
                $allowed_files = ['png', 'jpg', 'jpeg'];

                // explode returns an array
                // $extension = explode('.', $avatar_name);
                // $extension = end($extension);
                $extension = strtolower(pathinfo($avatar_name, PATHINFO_EXTENSION)); // Get file extension

                // check if extension is inside the array $allowed_files
                if(in_array($extension, $allowed_files)){

                    // controle image size (max 1mb)
                    if($avatar['size'] < 3000000){

                        // upload avatar
                        move_uploaded_file($avatar_tmp_name, $avatar_destination_path);

                    } else {
                        // if the file uploaded is too big, an error message will be displayed
                        Session::addFlash('error', 'File size too big. Should be less than 1mb');
                    
                        // redirect to the Register form page
                        return $this->redirectTo("security", "registerForm");
                    }

                } else {
                    // if the extension is not allowed, an error message will be displayed
                    Session::addFlash('error', 'File should be png, jpg or jpeg');
                    
                    // redirect to the Register form page
                    return $this->redirectTo("security", "registerForm");
                }
                
            }

            if(isset($_POST['cgu'])){
         
                // check if passwords match and meet regex criteria
                if($createPassword == $repeatPassword){

                    //creation of a new instance of the UserManager class => object creation
                    $userManager = new UserManager();

                    // creation of a $userExisting variable, and use model layer ($userManager) to retrieve informations from db
                    $userExisting = $userManager->findOneByPseudo($username);

                    // check if user is not already registered before hashing password and  adding user's data to database
                    if(!$userExisting){

                        // creation of $hashedPassword variable to store the password hashed with native function password_hash()
                        // password_hash() : hashes the user password using secure algorithm (currently bcrypt) before it's stored in the database
                        // PASSWORD_DEFAULT: means php will choose the best algorithm at the time of execution (brcrypt or Argon2i) : ensure user's password is not exposed if a problem occurs in db
                        $hashedPassword = password_hash($createPassword, PASSWORD_DEFAULT);

                        // prepare User's data 
                        $data = [
                            'username' => $username,
                            // store hashed password in database to secure the user's account 
                            'password' => $hashedPassword,
                            // not banned by default
                            'banned' => 0,
                            // role set to user by default 
                            // (json_encode() returns a string containing the JSON representation of the supplied value)
                            'role' => json_encode(['ROLE_USER']),
                            'avatar' => $avatar_name 
                        ];
                        
                        // var_dump($data);die();
                        // add the data to the database
                        $result = $userManager->add($data);
                        
                        // var_dump($result);die();
                        // check if user's data have been added to database
                        if($result){
                            // if the data has been added successfully to the db, a success message will be displayed
                            Session::addFlash('success', 'Registration Successful! Please Sign In');
                            // redirect to the Home page 
                            $this->redirectTo("home");

                        } 
                            // if the data has not been added successfully to the db, an error message will be displayed
                            Session::addFlash('error', 'Something went wrong');
                        
                            // redirect to the Register form page
                            return $this->redirectTo("security", "registerForm");

                    

                    } else {

                        // If the username is the same as another username, an error message will be displayed
                        Session::addFlash('error', 'Username already taken');

                        // redirect to the Register form page
                        return $this->redirectTo("security", "registerForm");
                    }  
                    
                } else {
                    // if the passwords are not the same or if the conditions are not respected
                    Session::addFlash('error', 'Incorrect Password or Not Strong Enough');

                    // redirect to the Register form page
                    return $this->redirectTo("security", "registerForm");    
                }  
            } else {        
    
                // if checkbox isn't checked, an error message will be displayed
                Session::addFlash('error', 'You must accept the GTCU');
        
                // redirect to the Register form page
                return $this->redirectTo("security", "registerForm");
            
            }
        }

        // method to display the form to log in as a User or as an Admin
        public function loginForm(){

            // Return a view in HTML format
            return [
                "view" => VIEW_DIR."security/loginForm.php"
            
            ];
        }


        // method to login as a User or as an Admin
        public function login(){

            // retrieves User username from the POST request, sanitize the input
            $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            // retrieves User password from the POST request, sanitize the input
            $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

             // creation of a new instance of the UserManager class => object creation
            $userManager = new UserManager();

            $userExisting = $userManager->findOneByPseudo($username);

            // var_dump($userExisting); die();

            // if the user already exists in the database 
            if($userExisting){

                // get user's password from db
                $bddPassword = $userExisting->getPassword();
                

                // password_verify : compares the plaintext password provided by user during login against the hashed password stored in db (native function)
                if(password_verify($password, $bddPassword )){

                    // set user in session
                    Session::setUser($userExisting);
                    
                    // redirect to Home page
                    return $this->redirectTo("home");

                } else{
                // if the user is found in the database, but the password is incorrect, an error message will be displayed
                Session::addFlash('error', 'Incorrect password');
                // redirect to the Login form page
                return $this->redirectTo("security", "loginForm"); 

                }

            }  else {

                // if the user is not found in the database, an error message will be displayed
                Session::addFlash('error', 'User not found');
                // redirect to the Login form page
                return $this->redirectTo("security", "loginForm"); 
            }
        }

        // method to log out as a User or an Admin (unset the user/admin session)
        public function logout(){

            Session::unsetUser();

            // if the user has been successfully unset from the session / logged out 
            Session::addFlash('success', 'Log Out Successful');

            // redirect to the Home page 
            return $this->redirectTo("home");

        }

        // method to ban a User : the user will not be able to add/update a topic/post
        public function banUser($id){

            // creation of a new instance of the UserManager class => object creation
            $userManager = new UserManager();

            // creation of a variable "$user" 
            $user = $userManager->findOneById($id);

            // create a variable '$users' which will take the form of an array of objects
            $users = $userManager->findAll(['username', 'DESC']);
            // and use the model layer to retrieve informations from the database.

            if($user) {
                // use model layer to change the user's status in the database
                $userManager->banUser($id);

                // if success : display a success message in the session
                Session::addFlash('success', 'User has been banned successfully');
                
                // return a view in HTML format
                return [
                    "view" => VIEW_DIR."security/users.php",
                    // send to the VIEW layer an array of data (variables)
                    "data" => [
                        "users" => $users
                    ]
                ];

            } else {
                // if error : display an error message in the session
                Session::addFlash('error', 'User has not been banned');

                // redirect to the Users list (only accessible by Admin)
                return $this->redirectTo("security", "users");
            }
        }

        // method to unban a User : the user will again be able to add/update a topic/post
        public function unBanUser($id){

            // creation of a new instance of the UserManager class => object creation
            $userManager = new UserManager();

            // creation of a variable "$user"
            $user = $userManager->findOneById($id);

             // create a variable '$users' which will take the form of an array of objects
            $users = $userManager->findAll(['username', 'DESC']);

            if($user) {

                // use model layer to change the user's status in the database
                $userManager->unBanUser($id);

                // if success : display a success message in the session
                Session::addFlash('success', 'User has been unbanned successfully');
                
                //return a view in HTML format
                return [
                    "view" => VIEW_DIR."security/users.php",
                      //send to the VIEW layer an array of data (variables)
                    "data" => [
                        "users" => $users
                    ]
                ];

            } else {

                // if error : display an error message in the session
                Session::addFlash('error', 'User has not been unbanned');
                
                // redirect to the Users list (only accessible by Admin)
                return $this->redirectTo("security", "users");
            }
        }


        // Method to display the form for changing password
        public function updatePasswordForm() {

            return [

                "view" => VIEW_DIR . "security/updatePasswordForm.php",
            ];
        }


        // Method to change the user's password
        public function updatePassword() {

            // creation of a variable that stores the user currently in the session
            $userId = Session::getUser()->getId();

            
            // retrieves User's current password from the POST request, sanitize the input
            $currentPassword = filter_input(INPUT_POST, 'currentPassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            // retrieves User's new password from the POST request, sanitize the input
            $newPassword = filter_input(INPUT_POST, 'newPassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            // retrieves User username from the POST request, sanitize the input
            $repeatNewPassword = filter_input(INPUT_POST, 'repeatNewPassword', FILTER_VALIDATE_REGEXP, ["options" => ["regexp" => "/[A-Za-z0-9].{8,32}/"]] );

            // Validate new password

            if ($newPassword !== $repeatNewPassword) {
                Session::addFlash('error', 'New passwords do not match.');
                return $this->redirectTo("security", "updatePasswordForm");
            }

            //creation of a new instance of the UserManager class => object creation
            $userManager = new UserManager();

            $userExisting = $userManager->findOneById($userId);

            if (!password_verify($currentPassword, $userExisting->getPassword())) {
                Session::addFlash('error', 'Current password is incorrect.');
                return $this->redirectTo("security", "updatePasswordForm");
            }

            // Hash new password
            $hashedNewPassword = password_hash($newPassword, PASSWORD_DEFAULT);

            // prepare data
            $data = [
                // store new hashed password in database to secure the user's account 
                'password' => $hashedNewPassword,
                'id_user' => $userId
            ];

            
            // Update password in database
            $result = $userManager->updatePassword($userId, $hashedNewPassword);
            
            // var_dump($result); die();
            
            if ($result) {

                Session::addFlash('success', 'Password changed successfully.');
                return $this->redirectTo("home");
            } else {
                Session::addFlash('error', 'An error occurred while changing your password.');
                return $this->redirectTo("security", "updatePasswordForm");
            }
        }

         
    }


    


        // tout commenter :GLOSSAIRE en parallèle 
        // page d'accueil : sign up (checkbox RGPD)
        // page d'accueil : SEO  
        // accessibilité  
       
    