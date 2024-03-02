<?php

$category = $result['data']['category'];
$title = "Add Topic | DiveIn Design - Your Web Design Forum";
?>


<section class="form_section">

    <div class="form_section-container">

        <h2>Add Topic</h2>

        <form action="index.php?ctrl=forum&action=addTopicByCategory&id=<?=$category->getId()?>" method="POST">

            <input type="text" name="title" placeholder="Title">

            <textarea  rows="10" name="textcontent" placeholder="Content"></textarea>
            
            <button type="submit" class="btn">Add Topic</button>
            
        </form>

    </div>

</section>