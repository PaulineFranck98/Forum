<?php

$users = $result['data']['users'];

?>

<h1>Users</h1>

<?php foreach($users as $user) : ?>
<p><?= $users->getUsername()?></p>
<?php endforeach ?>