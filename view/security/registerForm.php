<section class="form_section">

    <div class="form_section-container">

        <h2>Sign Up</h2>

        <form action="index.php?ctrl=security&action=register" method="POST">

            <input type="text" name="username" placeholder="Username">

            <input type="password" name="createPassword" placeholder="Password">

            <input type="password" name="repeatPassword" placeholder="Repeat Password">

            <button type="submit" class="btn">Sign Up</button>

            <small>Already have an account? <a href="index.php?ctrl=security&action=loginForm">Sign In</a></small>

        </form>

    </div>

</section>