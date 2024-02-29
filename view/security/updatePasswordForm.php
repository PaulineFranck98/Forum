<section class="form_section">

    <div class="form_section-container">

        <h1>Update Password</h1>

        <form action="index.php?ctrl=security&action=updatePassword" method="POST">


            <input type="password" name="currentPassword" placeholder="Current Password">

            <input type="password" name="newPassword" placeholder="New Password">

            <input type="password" name="repeatNewPassword" placeholder="Repeat New Password">

            <button type="submit" class="btn">Update Password</button>

        </form>

    </div>

</section>
