<?php

$categories = $result['data']['categories'];

$meta = "mais c'est super";
?>

<section class="top_container">
    <div class="left_container">
        <h1>Welcome to our vibrant community <strong>forum</strong></h1>
        <p>
            Dive into discussions on art, wildlife, travel, science, music, and food. Share your passions, exchange ideas, and connect with fellow enthusiasts. Start exploring now!
        </p>
        <section class="search_bar">
            <form  class="search_bar-container" action="index.php?ctrl=home&action=search" method="POST">
                <div>
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="search" name="search" placeholder="Search">
                </div>
                <button type="submit"  class="btn-search">Go</button>
            </form>
        </section>
    </div>
    <!-- <aside class="img_container">
        <figure>
            <img src="./public/images/aside-forum.png" alt="Forum illustrations">
        </figure>
    </aside> -->
</section>
<section class="category__buttons">
    <h2>Categories</h2>
    <div class="category__buttons-container">
        <?php foreach($categories as $category) : ?>
            
                <a class="category__button" href="index.php?ctrl=forum&action=findTopicsByCategoryId&id=<?=$category->getId()?>"><?=$category->getTitle()?></a>
            
        <?php endforeach ?>     
    </div>
</section>

<!-- <p>
    <a href="index.php?ctrl=security&action=loginForm">Sign In</a>
    <span>&nbsp;-&nbsp;</span>
    <a href="index.php?ctrl=security&action=registerForm">Sign Up</a>
</p> -->