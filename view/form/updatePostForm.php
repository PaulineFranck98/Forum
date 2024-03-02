<?php

$post = $result['data']['post'];
$title = "Edit Post | DiveIn Design - Your Web Design Forum";

?>

<section class="form_section">

    <div class="form_section-container">

        <h2>Edit Post</h2>

        <form action="index.php?ctrl=forum&action=updatePost&id=<?=$post->getId()?>" method="POST">

            <textarea  rows="10" name="textcontent"  placeholder="Content"><?=$post->getTextcontent()?></textarea>
            
            <button type="submit" class="btn">Update</button>

        </form>

    </div>
    
</section>