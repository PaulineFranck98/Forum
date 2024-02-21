<?php

$categories = $result['data']['categories'];
// var_dump($categories);die('ici');
?>

<h1>Welcome to our vibrant community forum!</h1>

<p>Dive into discussions on art, wildlife, travel, science, music, and food. Share your passions, exchange ideas, and connect with fellow enthusiasts. Start exploring now!</p>

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
    <a href="/security/login.html">Sign In</a>
    <span>&nbsp;-&nbsp;</span>
    <a href="/security/register.php">Sign Up</a>
</p>