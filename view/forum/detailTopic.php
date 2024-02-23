<?php

$posts = $result['data']['posts'];
$topic = $result['data']['topic'];


?>

<h1><?=$topic->getTitle()?></h1>

<a href="index.php?ctrl=forum&action=addPostForm&id=<?=$topic->getId()?>">Add Post</a>
<a href="index.php?ctrl=forum&action=updateTopicForm&id=<?=$topic->getId()?>">Edit Topic</a>

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

