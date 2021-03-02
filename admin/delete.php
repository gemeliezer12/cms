<?php
session_start();

include "../inc/dbh.inc.php";
include "../inc/article.inc.php";

$article = new Article;

if(isset($_SESSION["loggedIn"])){
    $articles = $article->fetchAll();
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../style.css">
        <title>Document</title>
    </head>
    <body>
        <div class="container">
            <div>
                <a href="../index.php" style="display: block;" class="logo">CMS</a>
            </div>
            <p class="title">Choose an article to delete</p>
            <form class="delete-form" action="delete.php" method="get">
                <select class="button" name="id">
                    <?php foreach($articles as $article){?>
                    <option value="<?php echo $article["idArticle"];?>">
                        <?php echo $article["titleArticle"];?>
                    </option>
                    <?php }?>
                </select>
                <input class="button" type="submit" name="delete-submit" value="Delete Article">
                <input class="button" type="submit" name="edit-submit" value="Edit Article">
                
                <?php
                if(isset($_GET["delete-submit"])){
                    $id = $_GET["id"];
                    $query = $pdo->prepare("DELETE FROM articles WHERE idArticle = ?");
                    $query->bindValue(1, $id);
                    $query->execute();

                    header("Location: delete.php");
                }
                if(isset($_GET["edit-submit"])){
                    $id = $_GET["id"];

                    header("Location: edit.php?id=$id");
                }

                ?>
            </form>
            <div class="admin">
                <a href="index.php">admin</a>
            </div>
        </div>
    </body>
    </html>
    <?php
}