<?php


$posts = $result['data']['posts'];
$topic = $result['data']['topic'];



?>

<h1><?=$topic->getTitle()?></h1>

<!-- if topic is not closed -->
<?php if ($topic->getClosed() == 0 && (App\Session::getUser()->getBanned() == 0 ) && (App\Session::isAdmin())): ?>
    
    <!-- show 'add post' -->
    <a href="index.php?ctrl=forum&action=addPostForm&id=<?=$topic->getId()?>">Add Post</a>
    <a href="index.php?ctrl=forum&action=updateTopicForm&id=<?=$topic->getId()?>">Edit Topic</a>

<?php endif ?>


<!-- if user in session created the topic & if topic is not closed -->
<?php if($topic->getClosed() == 0 && ((App\Session::getUser()->getBanned() == 0) == $topic->getUser())) : ?>

    <!-- show button to close the topic  -->
    <a href="index.php?ctrl=forum&action=closeTopic&id=<?=$topic->getId()?>">Close Topic</a>

<?php endif ?>

<section class="category__buttons">

    <div class="topic__post-container">
        <?php foreach ($posts as $post) :?>
            
            <div class="topic__post">
                <div>
                    <small><?=$post->getUser()->getUsername()?></small>
                    <small><?=$post->getCreationdate()?></small>
                </div>
                <p><?=$post->getTextcontent()?></p>

                <!-- if user in session created the post -->
    
                <?php if((App\Session::getUser()->getBanned() == 0) == $post->getUser()) : ?>

                    <!-- show button to edit the post -->
                    <small><a href="index.php?ctrl=forum&action=updatePostForm&id=<?=$post->getId()?>">Edit Post</a></small>

                <?php endif ?>
            </div>

        <?php endforeach ?>

    </div>

</section>

