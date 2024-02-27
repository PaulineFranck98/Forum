<?php

$categories = $result['data']['categories'];

// var_dump($categories);die('ici');
?>
<section class="top_container">
    <section class="left_container">
        <h1>Welcome to our vibrant community <strong>forum</strong></h1>

        <p>Dive into discussions on art, wildlife, travel, science, music, and food. Share your passions, exchange ideas, and connect with fellow enthusiasts. Start exploring now!</p>

        <section class="search__bar">
                <form  class="search__bar-container" action="index.php?ctrl=home&action=search" method="GET">
                    <div>
                        <i class="fa-solid fa-magnifying-glass"></i>
                        <input type="search" name="search" placeholder="Search">
                    </div>
                    <button type="submit"  class="btn">Go</button>
                </form>
        </section>
    </section>

    <aside class="img_container">
        <figure><img src="aside-forum1.png" alt=""></figure>

    </aside>
</section>

<h2>Categories</h2>

<section class="category__buttons">
    <div class="category__buttons-container">
       

            <?php foreach($categories as $category) : ?>

                
                <p><a class="category__button" href="index.php?ctrl=forum&action=findTopicsByCategoryId&id=<?=$category->getId()?>"><?=$category->getTitle()?></a></p>
            <?php endforeach ?>
            
        
    </div>
</section>
<p>
    <a href="index.php?ctrl=security&action=loginForm">Sign In</a>
    <span>&nbsp;-&nbsp;</span>
    <a href="index.php?ctrl=security&action=registerForm">Sign Up</a>
</p>