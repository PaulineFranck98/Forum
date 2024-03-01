<?php

$topics = $result['data']['topics'];
$category = $result['data']['category'];

?>
<section id="detail-category">
    <!-- display category Title  -->
    <h1><?=$category->getTitle()?></h1>
    <div class="add-edit">
        <!-- if a User is in Session and if is not banned, display "Add Topic" -->
        <?php if(App\Session::getUser()->getBanned() == 0 ) : ?>
            <a href="index.php?ctrl=forum&action=addTopicForm&id=<?=$category->getId()?>"><i class="fa-solid fa-plus"></i> Add Topic</a>

            <!-- if an Admin is in Session, display "Edit Category" -->
            <!-- Use resolution operator(`::`)to access static properties and methods of Session class -->
            <?php if(App\Session::isAdmin()) : ?>
            <a href="index.php?ctrl=forum&action=updateCategoryForm&id=<?=$category->getId()?>"><i class="fa-solid fa-pen-to-square"></i> Edit</a>
            <?php endif ?>
            
        <?php endif ?>
    </div>
    <?php if (!empty($topics)): ?>
        <section class="category__buttons">

            <div class="category__buttons-container">
                
                <!-- for each topic retrieved from database -->
                <?php foreach ($topics as $topic): ?>
                    <!-- display the topic title within anchor tags-->
                    <!-- href leads to 'detailTopic' of the topic Id  -->
                    <p><a class="category__button" href="index.php?ctrl=forum&action=findAllPostsByTopicId&id=<?=$topic->getId()?>"><?=$topic->getTitle()?></a></p>
                    
                <?php endforeach ?>

            </div>
            
        </section>
    <?php else: ?>
        <p class="empty-page">No Topics in this Category</p>
    <?php endif ?>
</section>

