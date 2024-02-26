<?php

$post = $result['data']['post'];
// var_dump($post); die();
?>

<section class="form__section">

    <div class="container form__section-container">

        <h2>Edit Post</h2>

        <form action="index.php?ctrl=forum&action=updatePost&id=<?=$post->getId()?>" method="POST">

            <textarea  rows="10" name="textcontent"  placeholder="Text"><?=$post->getTextcontent()?></textarea>
            
            <button type="submit" class="btn">Update Post</button>

        </form>

    </div>
    
</section>