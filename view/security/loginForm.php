<section class="form_section">

    <div class="form_section-container">

        <h2>Sign In</h2>

        <form action="index.php?ctrl=security&action=login" method="POST">

            <input type="text" name="username" placeholder="Username">

            <input type="password" name="password" placeholder="Password">

            <button type="submit" class="btn">Sign In</button>

            <small>Don't have an account? <a href="index.php?ctrl=security&action=registerForm">Sign Up</a></small>

        </form>

    </div>

</section>