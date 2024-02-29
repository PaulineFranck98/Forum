<section class="form_section">

    <div class="form_section-container">

        <h1>Sign Up</h1>

        <form action="index.php?ctrl=security&action=register" enctype="multipart/form-data" method="POST">

            <input type="text" name="username" placeholder="Username">

            <input type="password" name="createPassword" placeholder="Password">

            <input type="password" name="repeatPassword" placeholder="Repeat Password">

            <div class="form_control">
                <label for="avatar">User Avatar</label>
                <input type="file"name="avatar" id="avatar">
            </div>

            <button type="submit" class="btn">Sign Up</button>

            <small>Already have an account? <a href="index.php?ctrl=security&action=loginForm">Sign In</a></small>

        </form>

    </div>

</section>

