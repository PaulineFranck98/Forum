<?php
$categories = $result['data']['categories'];
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
                        <a href="index.php?ctrl=forum&action=manageCategoriesPage" class="active"><i class="fa-solid fa-list"></i>
                            <h5>Manage Categories</h5>
                        </a>
                    </li>
                <?php endif ?>
                <!-- endif -->
            </ul>
        </aside>
        <!-- Main Content -->
        <main>
            <h2>Manage Categories</h2>
            <table>
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Loop through categories and display them -->
                    <?php foreach($categories as $category) : ?>
                        <tr>
                            <td><?=$category->getTitle()?></td>
                            <td><a href="index.php?ctrl=forum&action=updateCategoryForm&id=<?= $category->getId() ?>" class="btn-search">Edit</a></td>
                            <td><a href="index.php?ctrl=forum&action=deleteCategory&id=<?= $category->getId() ?>" class="btn-search" onclick="return confirm('Are you sure you want to delete this category?');">Delete</a></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </main>
    </div>
</section>