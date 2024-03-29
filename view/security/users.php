<?php

$users = $result['data']['users'];
$meta = "Manage and view all users on DiveIn Design. As an admin, ensure a vibrant and respectful community by moderating user activity";
$title = "Manage Users on Web Design Forum | DiveIn Design";
?>

<section class="dashboard">
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
                <li>
                    <a href="index.php?ctrl=home&action=users" class="active"><i class="fa-solid fa-users"></i></i>
                        <h5>Manage Users</h5>
                    </a>
                </li>
                <li>
                    <a href="index.php?ctrl=forum&action=manageCategoriesPage"><i class="fa-solid fa-list"></i>
                        <h5>Manage Categories</h5>
                    </a>
                </li>
                <!-- endif -->
            </ul>
        </aside>
        <section>
            <h2>Manage Users</h2>
            <table>
                <thead>
                    <tr>
                        <!-- <th>Avatar</th> -->
                        <th>Username</th>
                        <th>User Status</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- for each user retrieved from database -->
                    <?php foreach($users as $user) : ?>
                        <tr>
                            <!-- <td>
                                <figure class="avatar-author">
                                    <img src="./public/images/<?=$user->getAvatar()?>" alt="Avatar">
                                </figure>
                            </td> -->
                            <!-- display the username -->
                            <td><?= $user->getUsername()?></td>
                            
                            <!-- if user is not banned  -->
                            <?php if($user->getBanned() == 0) : ?>
                                <!-- display "Ban User" -->
                                <td><a href="index.php?ctrl=security&action=banUser&id=<?=$user->getId()?>" class="btn-search user-ban small">Ban User</td>
                            <!-- if user is already banned -->
                            <?php else : ?>
                                <!-- display "Unban User" -->
                                <td><a href="index.php?ctrl=security&action=unBanUser&id=<?=$user->getId()?>" class="btn user-ban small ">Unban User</td>
                            <?php endif ?>
                        </tr>
                    <?php endforeach ?>
                    
                </tbody>
            </table>

        </section>
    </div>
</section>