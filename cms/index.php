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
    <link rel="stylesheet" href="assets/style.css">
    <title>Document</title>
</head>
<body>
    <p>CMS</p>
    <?php foreach($articles as $article){?>
    <li>
        <a href="article.php?id=<?php echo $article["idArticle"]?>">
            <?php echo $article["titleArticle"]?>
        </a>
            - <small>
            posted <?php echo date("l jS", $article["timestampArticle"]);?>
        </small>
    </li>
    <?php }?>
    <a href="admin/index.php">admin</a>
</body>
</html>