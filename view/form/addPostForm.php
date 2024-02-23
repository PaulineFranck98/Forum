<?php

$topic = $result['data']['topic'];

?>

<section class="form__section">

    <div class="container form__section-container">

        <h2>Add Post</h2>

        <form action="index.php?ctrl=forum&action=addPostByTopic&id=<?=$topic->getId()?>" method="POST">

            <textarea  rows="10" name="textcontent" placeholder="Text">Text Content</textarea>
            
            <button type="submit" class="btn">Add Post</button>
        </form>
    </div>
</section>

