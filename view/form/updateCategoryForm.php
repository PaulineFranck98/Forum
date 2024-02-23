<?php

$category = $result['data']['category'];

?>

<section class="form__section">

    <div class="container form__section-container">

        <h2>Edit Category</h2>

        <form action="index.php?ctrl=forum&action=updateCategory&id=<?=$category->getId()?>" method="POST">

            <input type="text" name="title" value="<?= $category->getTitle()?>" placeholder="Title">

            
            <button type="submit" class="btn">Update Category</button>
            
        </form>

    </div>

</section>