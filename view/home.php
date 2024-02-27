<?php

$categories = $result['data']['categories'];
// var_dump($categories);die('ici');
?>

<h1>Welcome to our vibrant community forum!</h1>

<p>Dive into discussions on art, wildlife, travel, science, music, and food. Share your passions, exchange ideas, and connect with fellow enthusiasts. Start exploring now!</p>

<section class="search__bar">
        <form action="" class="search__bar-container">
            <div>
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="search" name="" placeholder="Search">
            </div>
            <button type="submit" class="btn">Go</button>
        </form>
</section>
<h2>Categories</h2>

<section class="category__buttons">
    <div class="category__buttons-container">
        <?php

            foreach($categories as $category){

                ?>
                <p><a class="category__button" href="index.php?ctrl=forum&action=findTopicsByCategoryId&id=<?=$category->getId()?>"><?=$category->getTitle()?></a></p>
                <?php
            }

        ?>
    </div>
</section>
<p>
    <a href="index.php?ctrl=security&action=loginForm">Sign In</a>
    <span>&nbsp;-&nbsp;</span>
    <a href="index.php?ctrl=security&action=registerForm">Sign Up</a>
</p>