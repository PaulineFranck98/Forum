<?php
$title = "Sign Up | DiveIn Design - Your Web Design Forum";
?>
<section class="form_section">

    <div class="form_section-container">

        <h1>Sign Up</h1>

        <form action="index.php?ctrl=security&action=register" enctype="multipart/form-data" method="POST">

            <!-- honeypot : trap for bots. Style sets to display none to only be visible by bots (invisible for users) -->
            <input type="email" name="email_honeypot" placeholder="Email" id="email" value="" autocomplete="off">
            <!-- bots scanning for emails fields will find and fill this one out  -->

            <input type="text" name="username" placeholder="Username">

            <input type="password" name="createPassword" placeholder="Password">

            <input type="password" name="repeatPassword" placeholder="Repeat Password">

            <div class="form_control">
                <label for="avatar">User Avatar</label>
                <input type="file"name="avatar" id="avatar">
            </div>
            <div class="cgu_input">
                <input type="checkbox" id="cgu" name="cgu"/>
                <label for="cgu">I acknowledge having read and understood the <a href="public/CGU_DiveInDesign.pdf" style="color:#ab3bff" target="_blank">GTCU</a> and I accept them</label>
            </div>

            <button type="submit" class="btn">Sign Up</button>

            <small>Already have an account? <a href="index.php?ctrl=security&action=loginForm">Sign In</a></small>

        </form>

    </div>

</section>

