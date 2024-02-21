<?php

$categories = $result['data']['categories'];
// var_dump($categories);die('ici');
?>

<h1>BIENVENUE SUR LE FORUM</h1>

<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit ut nemo quia voluptas numquam, itaque ipsa soluta ratione eum temporibus aliquid, facere rerum in laborum debitis labore aliquam ullam cumque.</p>

<h2>liste catégories</h2>

<?php
foreach($categories as $category){

    ?>
    <p><a href="index.php?ctrl=forum&action=findTopicsByCategoryId&id=<?=$category->getId()?>"><?=$category->getTitle()?></a></p>
    <?php
}

?>
<p>
    <a href="/security/login.html">Se connecter</a>
    <span>&nbsp;-&nbsp;</span>
    <a href="/security/register.html">S'inscrire</a>
</p>