<?php

$category = $result['data']['category'];

?>


<section class="form__section">

    <div class="container form__section-container">

        <h2>Add Topic</h2>

        <form action="index.php?ctrl=forum&action=addTopicByCategory&id=<?=$category->getId()?>" method="POST">

            <input type="text" name="title" placeholder="Title">
            
            <button type="submit" class="btn">Add Topic</button>
            
        </form>

    </div>

</section>