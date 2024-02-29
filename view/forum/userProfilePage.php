<?php 

$topicCount = $result['data']['topicCount'];
$postCount = $result['data']['postCount'];

?>



<section class="dashboard">
    <div class="dashboard__container">
        <aside>
            <ul>
                <li>
                    <a href="index.php?ctrl=forum&action=userProfilePage"><i class="fa-regular fa-user"></i>
                        <h5>Profile</h5>
                    </a>
                </li>
                <li>
                    <a href="index.php?ctrl=forum&action=viewUserTopics"><i class="fa-solid fa-envelopes-bulk"></i>
                        <h5>Topics</h5>
                    </a>
                </li>
                <li>
                    <a href="index.php?ctrl=forum&action=viewUserPosts"><i class="fa-regular fa-comments"></i>
                        <h5>Posts</h5>
                    </a>
                </li>
                <!-- if admin session is set, then display add/manage user/category -->
                <?php if(App\Session::isAdmin()) : ?>
                    <li>
                        <a href="index.php?ctrl=home&action=users"><i class="fa-solid fa-users"></i></i>
                            <h5>Manage Users</h5>
                        </a>
                    </li>
                    <li>
                        <a href="index.php?ctrl=forum&action=manageCategoriesPage"><i class="fa-solid fa-list"></i>
                            <h5>Manage Categories</h5>
                        </a>
                    </li>
                <?php endif ?>
                <!-- endif -->
            </ul>
        </aside>
        <main>
            <a href="index.php?ctrl=security&action=updatePasswordForm">Update Password</a>
            <h2>Manage Categories</h2>
            <div class="profile-stats">
                <p>Number of Topics Created: <?=(isset($topicCount)) ? $topicCount : ''  ?></p>
                <p>Number of Posts Created: <?= (isset($postCount)) ? $postCount : '' ?></p>
            </div>
        </main>
    </div>
</section>