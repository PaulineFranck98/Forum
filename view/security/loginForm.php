<?php
$title = "Sign In | DiveIn Design - Your Web Design Forum";
?>

<section class="form_section">

    <div class="form_section-container">

        <h1>Sign In</h1>

        <form action="index.php?ctrl=security&action=login" method="POST">

            <input type="text" name="username" placeholder="Username">

            <input type="password" name="password" placeholder="Password">

            <button type="submit" class="btn">Sign In</button>

            <small>Don't have an account? <a href="index.php?ctrl=security&action=registerForm">Sign Up</a></small>

        </form>

    </div>

</section>