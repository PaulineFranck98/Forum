<?php

    $users = $result['data']['users'];
   
?>

<h1>Users</h1>
<table>
    <thead>
        <tr>
            <th>Username</th>
            <th>Edit</th>
            <!-- <th>Delete</th> -->
        </tr>
    </thead>
    <tbody>
        <?php foreach($users as $user) : ?>
            <tr>
                <td><?= $user->getUsername()?></td>
                
                <!-- <td><a href="edit-user.php" class="btn sm">Edit</a></td> -->
                <?php if($user->getBanned() == 0) : ?>
                    <td><a href="index.php?ctrl=security&action=banUser&id=<?=$user->getId()?>" class="btn sm danger">Ban User</td>
                <?php else : ?>
                    <td><a href="index.php?ctrl=security&action=unBanUser&id=<?=$user->getId()?>" class="btn sm ">Unban User</td>
                <?php endif ?>
            </tr>
        <?php endforeach ?>
        
    </tbody>
</table>