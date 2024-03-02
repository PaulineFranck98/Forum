<?php

$topics = $result["data"]['topics'];
$meta = "Discover a wide range of web design topics on DiveIn Design. Browse, learn, and engage with a community forum passionate about design";    
$title= "Discover All Topics on Web Design Forum | DiveIn Design";
?>

<!------------ SEARCH BAR ------------>
<section class="search_bar">
        <form  class="search_bar-container" action="index.php?ctrl=home&action=search" method="POST">
            <div>
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="search" name="search" placeholder="Search">
            </div>
            <button type="submit"  class="btn-search">Go</button>
        </form>
</section>
<!------------ END SEARCH BAR -------->
<h1>Topics</h1>
<section class="category__buttons">

    <div class="category__buttons-container">

        <!-- for each topic retrieved from database -->
        <?php foreach ($topics as $topic): ?>
            <!-- display the topic title within anchor tags-->
            <!-- href leads to 'detailTopic' of the topic Id  -->    
            <p><a class="category__button" href="index.php?ctrl=forum&action=findAllPostsByTopicId&id=<?=$topic->getId()?>"><?=$topic->getTitle()?></a></p>
            
        <?php endforeach ?>

    </div>
    
</section>
  
