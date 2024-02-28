<?php


$posts = $result['data']['posts'];
$topic = $result['data']['topic'];



?>
<!-- display topic title  -->
<h1><?=$topic->getTitle()?></h1>

<!-- if topic is not closed and if User in Session is not banned / or if is Admin, display "Add Post" and "Edit Post"  -->
<!-- Use resolution operator(`::`)to access static properties and methods of Session class -->
<?php if ($topic->getClosed() == 0 && (App\Session::getUser()->getBanned() == 0 ) || (App\Session::isAdmin())): ?>
    
    <!-- show 'add post' -->
    <a href="index.php?ctrl=forum&action=addPostForm&id=<?=$topic->getId()?>">Add Post</a>
    <a href="index.php?ctrl=forum&action=updateTopicForm&id=<?=$topic->getId()?>">Edit Topic</a>

<?php endif ?>


<!-- if topic is not closed and if user in session created the topic  -->
<!-- Use resolution operator(`::`)to access static properties and methods of Session class -->
<?php if($topic->getClosed() == 0 && ((App\Session::getUser()->getBanned() == 0) == $topic->getUser())) : ?>

    <!-- show button to close the topic  -->
    <a href="index.php?ctrl=forum&action=closeTopic&id=<?=$topic->getId()?>">Close Topic</a>

<?php endif ?>

<section class="category__buttons">

    <div class="topic__post-container">
        <!-- for each post retrieved from database -->
        <?php foreach ($posts as $post) :?>
            
            <div class="topic__post">
                <div>
                    <!-- display username, creationdate and textcontent of the post -->
                    <small><?=$post->getUser()->getUsername()?></small>
                    <small><?=$post->getCreationdate()?></small>
                </div>
                <p><?=$post->getTextcontent()?></p>

                <!-- Use resolution operator(`::`)to access static properties and methods of Session class -->
                <!-- if user in session is not banned and created the post -->
                <?php if((App\Session::getUser()->getBanned() == 0) == $post->getUser()) : ?>

                    <!-- show button to edit the post -->
                    <small><a href="index.php?ctrl=forum&action=updatePostForm&id=<?=$post->getId()?>">Edit Post</a></small>

                <?php endif ?>
            </div>
        <?php endforeach ?>
    </div>
</section>

