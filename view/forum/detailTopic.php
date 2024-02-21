<?php

$posts = $result['data']['posts'];


?>

<h1>Posts</h1>

<?php

foreach ($posts as $post){
    ?>
    <small><?=$post->getUser()->getUsername()?></small>
    <small><?=$post->getCreationdate()?></small>
    <p><?=$post->getTextcontent()?></p>

    
    <?php

}