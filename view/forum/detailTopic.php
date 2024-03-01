<?php


$posts = $result['data']['posts'];
$topic = $result['data']['topic'];



?>
<!-- display topic title  -->
<h1><?=$topic->getTitle()?><?php if ($topic->getClosed() == 1):?> <i style="font-size:2.5rem;" class="fa-solid fa-lock"></i><?php endif?></h1>

<!-- if topic is not closed and if User in Session is not banned / or if is Admin, display "Add Post"   -->
<!-- Use resolution operator(`::`)to access static properties and methods of Session class -->



<!-- if topic is not closed and if user in session created the topic  -->
<!-- Use resolution operator(`::`)to access static properties and methods of Session class -->
<?php if($topic->getClosed() == 0 && App\Session::getUser() == $topic->getUser() && App\Session::getUser()->getBanned() == 0) : ?>
    <div class="add-edit">
        <!-- show button to close the topic  -->
        <a href="index.php?ctrl=forum&action=closeTopic&id=<?=$topic->getId()?>" class="btn "><i class="fa-solid fa-lock"></i> Close Topic</a>
        <a href="index.php?ctrl=forum&action=updateTopicForm&id=<?=$topic->getId()?>"class="btn"><i class="fa-solid fa-pen-to-square"></i> Edit Topic</a>
        
    </div>
    <?php elseif ($topic->getClosed() == 0 && (App\Session::getUser()->getBanned() == 0 )) : ?>
    <div class="add-edit">
        <!-- show 'add post' -->
        <a href="index.php?ctrl=forum&action=addPostForm&id=<?=$topic->getId()?>"class="btn"><i class="fa-solid fa-plus"></i> Add Post</a>
    </div>

<?php endif ?>
<?php if (!empty($posts)): ?>
    <section class="category__buttons">

        <div class="topic__post-container">
            <!-- for each post retrieved from database -->
            <?php foreach ($posts as $post) :?>
                
                <div class="topic__post">
                    <!-- Use resolution operator(`::`)to access static properties and methods of Session class -->
                    <!-- if user in session is not banned and created the post -->
                    <?php if(App\Session::getUser() == $post->getUser() && App\Session::getUser()->getBanned() == 0) : ?>
                        <!-- show button to edit the post -->
                        <small><a href="index.php?ctrl=forum&action=updatePostForm&id=<?=$post->getId()?>">Edit <i class="fa-solid fa-pen-to-square"></i></a></small>
                    <?php endif ?>
                    <p><?=$post->getTextcontent()?></p>
                    <div class="post_author">
                        <!-- display username, creationdate and textcontent of the post -->
                        <figure class="avatar-author">
                            <img src="./public/images/<?=$post->getUser()->getAvatar()?>" alt="Avatar">
                        </figure>
                        <div class="post_author-info">
                            <small><?=$post->getUser()->getUsername()?></small>
                            <small><?=$post->getCreationdate()?></small>
                        </div>
                    </div>
                    
                </div>
            <?php endforeach ?>
        </div>
    </section>
    <?php else: ?>
        <p class="empty-page">No Posts in this Topic</p>
    <?php endif ?>
