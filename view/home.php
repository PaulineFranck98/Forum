<?php

$categories = $result['data']['categories'];

$meta = "Join DiveIn Design, a vibrant forum for web design enthusiasts. Share, learn, and connect through topics and posts about web design.";
$title = "Welcome to DiveIn Design - Your Web Design Forum";
?>

<section class="top_container">
    <h1>Welcome to our vibrant community <strong>forum</strong><br><strong>DiveIn Design</strong></h1>
    <p>
        Join the conversation on web design, UX/UI, coding, graphic design, SEO, and more. Share your expertise, brainstorm ideas, and network with like-minded professionals. Let's dive into the world of web design together – start exploring now
    </p>
    <?php if(App\Session::getUser()) : ?>
    <!------------ SEARCH BAR ------------>
    <section class="search_bar">
            <form  class="search_bar-container" action="index.php?ctrl=home&action=search" method="POST">
                <div>
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="search" name="search" placeholder="Search">
                </div>
                <button type="submit"  class="btn-search">Go</button>
            </form>
    </section>
    <!------------ END SEARCH BAR -------->
</section>
<div class="explore">
    <a href="#categories" class="down">Let's explore<i class="fa-solid fa-chevron-down"></i></a>
</div>
<section id="categories" class="category__buttons">
    <h2>Categories</h2>
    <div  class="category__buttons-container">
        <?php foreach($categories as $category) : ?>
            
                <a class="category__button" href="index.php?ctrl=forum&action=findTopicsByCategoryId&id=<?=$category->getId()?>"><?=$category->getTitle()?></a>
            
        <?php endforeach ?>     
    </div>

    <div id="up">
        <a href="#"><i class="fa-solid fa-chevron-up"></i></a>
    </div>
</section>
 <!-- if no user is logged in / in Session -->
 <?php else : ?>
    <!-- display Sign in and Sign Up -->
    
<div class="wrapper">
    <div class="box">
        <div class="box-content">
            <a href="index.php?ctrl=security&action=loginForm">Sign In</a>
        </div>
    </div>
    <div class="box">
        <div class="box-content">
            <a href="index.php?ctrl=security&action=registerForm">Sign Up</a>
        </div>
    </div>
</div>
<?php endif ?>