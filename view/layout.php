<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon"  href="favicon.ico" type="image/x-icon">
    <!-- <link rel="manifest" href="/site.webmanifest"> -->
    <script src="https://cdn.tiny.cloud/1/zg3mwraazn1b2ezih16je1tc6z7gwp5yd4pod06ae5uai8pa/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" integrity="sha256-h20CPZ0QyXlBuAw7A+KluUYx/3pK+c7lYEpqLTlxjYQ=" crossorigin="anonymous" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= PUBLIC_DIR ?>/css/style.css">

    <meta name="description" content="<?=$meta?>">
    <title><?=$title?></title>
</head>
<body>
    <div id="wrapper"> 
       
        <div id="mainpage">
            
            <header>
                <nav>
                    <div id="nav-left">
                        <?php if(App\Session::getUser()) : ?>
                        <a href="/forum/"><i class="fa-solid fa-house"></i></a>
                        <a href="/forum/">Home</a>
                        <a href="index.php?ctrl=forum&action=findAllTopics">Topics</a>  
                    </div>
                    
                    <div id="nav-right">
                   
                        <!-- if a user is logged in / in Session -->
                            <!-- display username from the user in Session with a user icon -->
                            <!-- Use resolution operator(`::`)to access static properties and methods of Session class -->
                            <a href="/security/viewProfile.html"><?= App\Session::getUser()->getUsername()?></a>
                            <figure class="avatar">
                                <img src="./public/images/<?= App\Session::getUser()->getAvatar()?>" alt="Avatar">
                            </figure>
                            <ul>
                                <li><a href="index.php?ctrl=forum&action=userProfilePage">Dashboard</a></li>
                                <!-- display Log Out anchor -->
                                <li><a href="index.php?ctrl=security&action=logout">Log Out  &nbsp;<i class="fa-solid fa-right-from-bracket"></i></a></li>
                                
                            </ul>

                        <!-- if no user is logged in / in Session -->
                        <?php else : ?>
                            <!-- display Sign in and Sign Up -->
                            <a href="index.php?ctrl=security&action=loginForm">Sign In</a>
                            <a href="index.php?ctrl=security&action=registerForm">Sign Up</a>
                            
                        <?php endif ?>
                        
                    </div>
                </nav>
                <!-- success and error messages are displayed here -->
            <h3 class="message" style="background:#db0f3f26; color: #da0f3f;"><?= App\Session::getFlash("error") ?></h3>
            <h3 class="message" style="background:#00c27426; color: #00c476;"><?= App\Session::getFlash("success") ?></h3>
            </header>
            
            <main id="forum">

                <?= $page ?>
                
            </main>
        </div>
        <footer>
            <div class="socials">  
                <a href="https://www.facebook.com"><i class="fa-brands fa-facebook-f"></i></a>
                <a href="https://www.instagram.com"><i class="fa-brands fa-instagram"></i></a>
                <a href="https://www.twitter.com"><i class="fa-brands fa-x-twitter"></i></a>
            </div>
            <p>&copy; 2020 - Forum CDA - <a href="public/Privacy_Policy_DiveInDesign.pdf">Privacy Policy</a> - <a href="public/Legal_Notice_DiveInDesign.pdf" target="_blank">Legal Notice</a></p>
            <!--<button id="ajaxbtn">Surprise en Ajax !</button> -> cliqué <span id="nbajax">0</span> fois-->
        </footer>
    </div>
    <script
        src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
        crossorigin="anonymous">
    </script>
    <script src="https://kit.fontawesome.com/d004286c36.js" crossorigin="anonymous"></script>
    <script>

        $(document).ready(function(){
            $(".message").each(function(){
                if($(this).text().length > 0){
                    $(this).slideDown(500, function(){
                        $(this).delay(3000).slideUp(500)
                    })
                }
            })
            $(".delete-btn").on("click", function(){
                return confirm("Etes-vous sûr de vouloir supprimer?")
            })
            tinymce.init({
                selector: '.post',
                menubar: false,
                plugins: [
                    'advlist autolink lists link image charmap print preview anchor',
                    'searchreplace visualblocks code fullscreen',
                    'insertdatetime media table paste code help wordcount'
                ],
                toolbar: 'undo redo | formatselect | ' +
                'bold italic backcolor | alignleft aligncenter ' +
                'alignright alignjustify | bullist numlist outdent indent | ' +
                'removeformat | help',
                content_css: '//www.tiny.cloud/css/codepen.min.css'
            });
        })

        

        /*
        $("#ajaxbtn").on("click", function(){
            $.get(
                "index.php?action=ajax",
                {
                    nb : $("#nbajax").text()
                },
                function(result){
                    $("#nbajax").html(result)
                }
            )
        })*/

    </script>
</body>
</html>