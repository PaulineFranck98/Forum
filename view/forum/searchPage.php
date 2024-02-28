<?php

$users = $result['data']['users'];
$categories = $result['data']['categories'];
$topics = $result['data']['topics'];
$posts = $result['data']['posts'];

?>


<section class ="search_results">

    <h1>Search Results</h1>
    <!-- section that contains the form to search for users, categories, topics and posts -->
    <section class="search_bar-results">
        <!-- form with the action=search  -->
        <form  class="search_bar-container" action="index.php?ctrl=home&action=search" method="POST">
            <div>
                <!-- search icon -->
                <i class="fa-solid fa-magnifying-glass"></i>
                <!-- input where the user enter search queries into -->
                <input type="search" name="search" placeholder="Search">
            </div>
            <!-- button type=submit run the form's action -->
            <button type="submit"  class="btn">Go</button>
        </form>
    </section>

    <!-- If a user is found -->
    <?php if (!empty($users)): ?>
        <h2>Users</h2>
        <ul>
            <!-- for each user retrieved from database -->
            <?php foreach ($users as $user): ?>
                <!-- display the username of the user -->
                <li><?= $user->getUsername()?></li>
                
            <?php endforeach ?>
        </ul>
    <?php endif ?>

    <!-- If a category is found -->
    <?php if (!empty($categories)): ?>
        <h2>Categories</h2>
        <ul>
            <!-- for each category retrieved from database -->
            <?php foreach ($categories as $category): ?>
                <!-- display the category title within anchor tags-->
                <!-- href leads to 'detailCategory' of the category Id  -->
                <li><a href="index.php?ctrl=forum&action=findTopicsByCategoryId&id=<?=$category->getId()?>"><?=$category->getTitle()?></a></li>

            <?php endforeach ?>
        </ul>
    <?php endif ?>

    <!-- if a topic is found -->
    <?php if (!empty($topics)): ?>
        <h2>Topics</h2>
        <ul>
            <!-- for each topic retrieved from database -->
            <?php foreach ($topics as $topic): ?>
                <!-- display the topic title within anchor tags-->
                <!-- href leads to 'detailTopic' of the topic Id  -->
                <li><a href="index.php?ctrl=forum&action=findAllPostsByTopicId&id=<?=$topic->getId()?>"><?=$topic->getTitle()?></a></li> 
            <?php endforeach ?>
        </ul>
    <?php endif ?>

    <!-- if a post is found -->
    <?php if (!empty($posts)): ?>
        <h2>Posts</h2>
        <ul>
            <!-- for each post retrieved from database -->
            <?php foreach ($posts as $post): ?>
                <!-- display the textcontent of the post -->
                <li><?=$post->getTextcontent() ?></li>
            <?php endforeach ?>
        </ul>
    <?php endif ?>
</section>

