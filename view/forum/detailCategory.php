<?php

$topics = $result['data']['topics'];
$category = $result['data']['category'];
$meta = "Explore various topics within a specific category on DiveIn Design, the go-to forum for web design enthusiasts and professionals."; 
$title = "Explore Web Design Topics in Specific Categories | DiveIn Design";
?>
<section id="detail-category">
    
    <!------------ SEARCH BAR ------------>
    <section class="search_bar">
            <form  class="search_bar-container" action="index.php?ctrl=home&action=search" method="POST">
                <div>
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="search" name="search" placeholder="Search">
                </div>
                <button type="submit"  class="btn-search">Go</button>
            </form>
    </section>
    <!------------ END SEARCH BAR -------->
    
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

