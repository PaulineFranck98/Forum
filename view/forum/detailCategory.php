<?php

$topics = $result['data']['topics'];
$category = $result['data']['category'];

?>

<h1>Topics</h1>

<a href="index.php?ctrl=forum&action=addTopicForm&id=<?=$category->getId()?>">Add Topic</a>

<section class="category__buttons">

    <div class="category__buttons-container">
        
        
        <?php foreach ($topics as $topic): ?>
                
                <p><a class="category__button" href="index.php?ctrl=forum&action=findAllPostsByTopicId&id=<?=$topic->getId()?>"><?=$topic->getTitle()?></a></p>
            
        <?php endforeach ?>

    </div>
    
</section>

