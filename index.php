<?php
include_once("inc/article.inc.php");
include_once("inc/dbh.inc.php");

$article = new Article;
$articles = $article->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <p class="logo">CMS</p>
        <ol class="list">
        <?php foreach($articles as $article){?>
            <li>
                <a class="title" href="article.php?id=<?php echo $article["idArticle"]?>">
                    <?php
                    echo $article["titleArticle"]
                    ?>
                    <p class="timestamp">
                     - posted <?php echo date("l jS", $article["timestampArticle"]);?>
                    </p>
                </a>
                
            </li>
            <?php }?>
        </ol>
        <a class="admin" href="admin/index.php">admin</a>
    </div>
</body>
</html>