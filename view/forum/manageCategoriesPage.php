<?php
$categories = $result['data']['categories'];
$meta = "Admin categories on DiveIn Design. Oversee, edit, or delete to maintain a structured and relevant web design forum";
$title = "Administrate Web Design Forum Categories | DiveIn Design";
?>

<section class="dashboard">
    <!-- Dashboard Container -->
    <div class="dashboard_container">
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
        <section>
            <div class="manage-categories">
                <h2>Manage Categories</h2>
                <a href="index.php?ctrl=forum&action=addCategoryForm"><i class="fa-solid fa-plus"></i> Add Category</a>
            </div>
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
                            <td><a href="index.php?ctrl=forum&action=updateCategoryForm&id=<?= $category->getId() ?>" class="btn-search small">Edit</a></td>
                            <td><a href="index.php?ctrl=forum&action=deleteCategory&id=<?= $category->getId() ?>" class="btn-search small">Delete</a></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </section>
    </div>
</section>
