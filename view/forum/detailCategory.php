<?php

$topics = $result['data']['topics'];
// $posts = $result['data']['posts'];
// var_dump($posts);

foreach ($topics as $topic) {
    ?>
    <p><a href="index.php?ctrl=forum&action=findAllPostsByTopicId&id=<?=$topic->getId()?>"><?=$topic->getTitle()?></a></p>
    
    <?php
    // var_dump($topics); die();
   

}
