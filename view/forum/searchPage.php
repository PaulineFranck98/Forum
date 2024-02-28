<?php

$users = $result['data']['users'];
$categories = $result['data']['categories'];
$topics = $result['data']['topics'];
$posts = $result['data']['posts'];


?>
<section class ="search_results">

    <h1>Search Results</h1>

    <section class="search_bar-results">
        <form  class="search_bar-container" action="index.php?ctrl=home&action=search" method="POST">
            <div>
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="search" name="search" placeholder="Search">
            </div>
            <button type="submit"  class="btn">Go</button>
        </form>
    </section>

    <!-- If a user is found -->
    <?php if (!empty($users)): ?>
        <h2>Users</h2>
        <ul>
            <?php foreach ($users as $user): ?>
                <!-- Some characters have special meanings in HTML, and must be replaced with HTML entities to retain their meanings
                htmlsepcialchars() : returns a string with these modifications -->
                <li><?= $user->getUsername()?></li>
                
            <?php endforeach ?>
        </ul>
    <?php endif ?>

    <!-- If a cateory is found -->
    <?php if (!empty($categories)): ?>
        <h2>Categories</h2>
        <ul>
            <?php foreach ($categories as $category): ?>

                <li><a href="index.php?ctrl=forum&action=findTopicsByCategoryId&id=<?=$category->getId()?>"><?=$category->getTitle()?></a></li>

            <?php endforeach ?>
        </ul>
    <?php endif ?>

    <!-- if a topic is found -->
    <?php if (!empty($topics)): ?>
        <h2>Topics</h2>
        <ul>
            <?php foreach ($topics as $topic): ?>
                <li><a href="index.php?ctrl=forum&action=findAllPostsByTopicId&id=<?=$topic->getId()?>"><?=$topic->getTitle()?></a></li> 
            <?php endforeach ?>
        </ul>
    <?php endif ?>

    <!-- if a post is found -->
    <?php if (!empty($posts)): ?>
        <h2>Posts</h2>
        <ul>
            <?php foreach ($posts as $post): ?>
                <li><?=$post->getTextcontent() ?></li>
            <?php endforeach ?>
        </ul>
    <?php endif ?>
</section>

