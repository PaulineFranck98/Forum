<?php

$users = $result['data']['users'];
$categories = $result['data']['categories'];
$topics = $result['data']['topics'];
$posts = $result['data']['posts'];
$search= $result['data']['search'];

?>

<h1>Search Results</h1>

<!-- Users Section -->
<?php if (!empty($users)): ?>
    <h2>Users</h2>
    <ul>
        <?php foreach ($users as $user): ?>
            <!-- Some characters have special meanings in HTML, and must be replaced with HTML entities to retain their meanings : returns a string with these modifications -->
            <li><?= htmlspecialchars($user->getUsername()) ?></li>
        <?php endforeach ?>
    </ul>
<?php endif ?>

<!-- Categories Section -->
<?php if (!empty($categories)): ?>
    <h2>Categories</h2>
    <ul>
        <?php foreach ($categories as $category): ?>
            <li><?= htmlspecialchars($category->getTitle()) ?></li> 
        <?php endforeach ?>
    </ul>
<?php endif ?>

<!-- Topics Section -->
<?php if (!empty($topics)): ?>
    <h2>Topics</h2>
    <ul>
        <?php foreach ($topics as $topic): ?>
            <li><?= htmlspecialchars($topic->getTitle()) ?></li> 
        <?php endforeach ?>
    </ul>
<?php endif ?>

<!-- Posts Section -->
<?php if (!empty($posts)): ?>
    <h2>Posts</h2>
    <ul>
        <?php foreach ($posts as $post): ?>
            <li><?= htmlspecialchars($post->getTextcontent()) ?></li>
        <?php endforeach ?>
    </ul>
<?php endif ?>

