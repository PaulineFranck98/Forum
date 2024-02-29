<?php

$users = $result['data']['users'];
   
?>

<section class="dashboard">
    <div class="dashboard__container">
        <aside>
            <ul>
                <li>
                    <a href="#"><i class="fa-regular fa-user"></i>
                        <h5>Profile</h5>
                    </a>
                </li>
                <li>
                    <a href="#"><i class="fa-solid fa-envelopes-bulk"></i>
                        <h5>Topics</h5>
                    </a>
                </li>
                <li>
                    <a href="#"><i class="fa-regular fa-comments"></i>
                        <h5>Posts</h5>
                    </a>
                </li>
                <!-- if admin session is set, then display add/manage user/category -->
                <li>
                    <a href="#" class="active"><i class="fa-solid fa-users"></i></i>
                        <h5>Manage Users</h5>
                    </a>
                </li>
                <li>
                    <a href="#"><i class="fa-solid fa-list"></i>
                        <h5>Manage Categories</h5>
                    </a>
                </li>
                <!-- endif -->
            </ul>
        </aside>
        <main>
            <h2>Manage Users</h2>
            <table>
                <thead>
                    <tr>
                        <!-- <th>Avatar</th> -->
                        <th>Username</th>
                        <th>Edit</th>
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
                                <td><a href="index.php?ctrl=security&action=banUser&id=<?=$user->getId()?>" class="btn-search user-ban">Ban User</td>
                            <!-- if user is already banned -->
                            <?php else : ?>
                                <!-- display "Unban User" -->
                                <td><a href="index.php?ctrl=security&action=unBanUser&id=<?=$user->getId()?>" class="btn user-ban ">Unban User</td>
                            <?php endif ?>
                        </tr>
                    <?php endforeach ?>
                    
                </tbody>
            </table>

        </main>
    </div>
</section>