<?php
$posts = $result['data']['posts'];
?>

<section class="dashboard">
    <!-- Dashboard Container -->
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
                    <a href="index.php?ctrl=forum&action=viewUserPosts" class="active"><i class="fa-regular fa-comments"></i>
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
        <section>
            <h2>Your Posts</h2>
            <?php if (!empty($posts)): ?>
                <table>
                    <thead>
                        <tr>
                            <th>Content</th>
                            <th>Edit</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Loop through posts and display them -->
                        <?php foreach($posts as $post) : ?>
                            <tr>
                                <td><?= ($post->getTextcontent()) ?></td>
                                <td><a href="index.php?ctrl=forum&action=updatePostForm&id=<?= $post->getId() ?>" class="btn-search small">Edit</a></td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>You have not created any posts yet.</p>
            <?php endif ?>
        </section>
    </div>
</section>
