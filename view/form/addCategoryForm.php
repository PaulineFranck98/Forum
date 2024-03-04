<?php
$title = "Add Category| DiveIn Design - Your Web Design Forum";
?>

<section class="form_section">

    <div class="form_section-container">

        <h1>Add Category</h1>
        
        <form action="index.php?ctrl=forum&action=addCategory" method="POST">

            <input type="text" name="title" placeholder="Title">

            
            <button type="submit" class="btn">Add Category</button>
            
        </form>

    </div>

</section>