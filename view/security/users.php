<?php

$users = $result['data']['users'];
   
?>

<h1>Users</h1>
<table>
    <thead>
        <tr>
            <th>Username</th>
            <th>Edit</th>
        </tr>
    </thead>
    <tbody>
        <!-- for each user retrieved from database -->
        <?php foreach($users as $user) : ?>
            <tr>
                <!-- display the username -->
                <td><?= $user->getUsername()?></td>
                
                <!-- if user is not banned  -->
                <?php if($user->getBanned() == 0) : ?>
                    <!-- display "Ban User" -->
                    <td><a href="index.php?ctrl=security&action=banUser&id=<?=$user->getId()?>" class="btn sm danger">Ban User</td>
                <!-- if user is already banned -->
                <?php else : ?>
                    <!-- display "Unban User" -->
                    <td><a href="index.php?ctrl=security&action=unBanUser&id=<?=$user->getId()?>" class="btn sm ">Unban User</td>
                <?php endif ?>
            </tr>
        <?php endforeach ?>
        
    </tbody>
</table>