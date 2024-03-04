<?php

$topic = $result['data']['topic'];
$title = "Edit Topic | DiveIn Design - Your Web Design Forum";

?>

<section class="form_section">

    <div class="form_section-container">

        <h1>Edit Topic</h1>

        <form action="index.php?ctrl=forum&action=updateTopic&id=<?=$topic->getId()?>" method="POST">

            <input type="text" name="title" value="<?=$topic->getTitle()?>"placeholder="Title">
        
            <button type="submit" class="btn">Update</button>
        </form>
    </div>
</section>