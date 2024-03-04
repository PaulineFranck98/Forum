<?php

$topic = $result['data']['topic'];
$title = "Add Post | DiveIn Design - Your Web Design Forum";

?>

<section class="form_section">

    <div class="form_section-container">

        <h1>Add Post</h1>

        <form action="index.php?ctrl=forum&action=addPostByTopic&id=<?=$topic->getId()?>" method="POST">

            <textarea  rows="10" name="textcontent" placeholder="Content"></textarea>
            
            <button type="submit" class="btn">Add Post</button>
        </form>
    </div>
</section>

