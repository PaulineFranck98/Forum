<?php

    $users = $result['data']['users'];

?>

<h1>Users</h1>
<table>
    <thead>
        <tr>
            <th>Username</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($users as $user) : ?>
            <tr>
                <td><?= $user->getUsername()?></td>
                <td><a href="edit-user.php" class="btn sm">Edit</a></td>
                <td><a href="delete-user.php" class="btn sm danger">Delete</td>
            </tr>
        <?php endforeach ?>
        
    </tbody>
</table>