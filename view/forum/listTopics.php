<?php

$topics = $result["data"]['topics'];
    

?>


<h1>Topics</h1>

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
  
