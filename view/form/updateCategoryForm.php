<?php

$category = $result['data']['category'];
$title = "Edit Category | DiveIn Design - Your Web Design Forum";

?>

<section class="form_section">

    <div class="container form_section-container">

        <h2>Edit Category</h2>

        <form action="index.php?ctrl=forum&action=updateCategory&id=<?=$category->getId()?>" method="POST">

            <input type="text" name="title" value="<?= $category->getTitle()?>" placeholder="Title">

            
            <button type="submit" class="btn">Update</button>
            
        </form>

    </div>

</section>