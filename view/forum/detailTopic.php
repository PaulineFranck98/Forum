<?php

$posts = $result['data']['posts'];

foreach ($posts as $post){
    ?>
    <p><?=$post->getTextcontent()?></a></p>
    
    <?php

}