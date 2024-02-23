<?php

$topic = $result['data']['topic'];

?>

<section class="form__section">

    <div class="container form__section-container">

        <h2>Edit Topic</h2>

        <form action="index.php?ctrl=forum&action=updateTopic&id=<?=$topic->getId()?>" method="POST">

            <input type="text" name="title" value="<?=$topic->getTitle()?>"placeholder="Title">
        
            <button type="submit" class="btn">Update Topic</button>
        </form>
    </div>
</section>