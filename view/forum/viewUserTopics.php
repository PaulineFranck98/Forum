<?php
$topics = $result['data']['topics'];
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
                    <a href="index.php?ctrl=forum&action=viewUserTopics"class="active"><i class="fa-solid fa-envelopes-bulk"></i>
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
        <section>
            <h2>Your Topics</h2>
            <?php if (!empty($topics)): ?>
                <table>
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Edit</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Loop through topics and display them -->
                        <?php foreach($topics as $topic) : ?>
                            <tr>
                                <td><?= ($topic->getTitle()) ?></td>
                                <td><a href="index.php?ctrl=forum&action=updateTopicForm&id=<?= $topic->getId() ?>" class="btn-search small">Edit</a></td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>You have not created any topics yet.</p>
            <?php endif ?>
        </section>
    </div>
</section>
