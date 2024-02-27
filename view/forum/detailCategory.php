<?php

$topics = $result['data']['topics'];
$category = $result['data']['category'];

?>

<h1><?=$category->getTitle()?></h1>

<?php if(App\Session::getUser()->getBanned() == 0 ) : ?>
    <a href="index.php?ctrl=forum&action=addTopicForm&id=<?=$category->getId()?>">Add Topic</a>

    <?php if(App\Session::isAdmin()) : ?>
        <a href="index.php?ctrl=forum&action=updateCategoryForm&id=<?=$category->getId()?>">Edit Category</a>
    <?php endif ?>
    
<?php endif ?>


<section class="category__buttons">

    <div class="category__buttons-container">
        
        
        <?php foreach ($topics as $topic): ?>
                
                <p><a class="category__button" href="index.php?ctrl=forum&action=findAllPostsByTopicId&id=<?=$topic->getId()?>"><?=$topic->getTitle()?></a></p>
            
        <?php endforeach ?>

    </div>
    
</section>

