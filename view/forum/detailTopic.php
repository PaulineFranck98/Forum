<?php

$posts = $result['data']['posts'];
$topic = $result['data']['topic'];


?>

<h1>Posts</h1>

<a href="index.php?ctrl=forum&action=addPostForm&id=<?=$topic>getId()?>">Add Post</a>

<section class="category__buttons">

    <div class="topic__post-container">
        <?php foreach ($posts as $post) :?>
            
            <div class="topic__post">
                <div>
                    <small><?=$post->getUser()->getUsername()?></small>
                    <small><?=$post->getCreationdate()?></small>
                </div>
                <p><?=$post->getTextcontent()?></p>
            </div>

        <?php endforeach ?>

    </div>

</section>

