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
        <title>Document</title>
    </head>
    <body>
        <a href="../index.php" id="logo">CMS</a>
        <form action="delete.php" method="get">
            <p>Choose an article to delete</p>
            <select name="id">
                <?php foreach($articles as $article){?>
                <option value="<?php echo $article["idArticle"];?>">
                    <?php echo $article["titleArticle"];?>
                </option>
                <?php }?>
            </select>
            <input type="submit" name="delete-submit" value="Delete Article">
            <input type="submit" name="edit-page" value="Edit Article">
            <?php
            if(isset($_GET["delete-submit"])){
                $id = $_GET["id"];
                $query = $pdo->prepare("DELETE FROM articles WHERE idArticle = ?");
                $query->bindValue(1, $id);
                $query->execute();

                header("Location: delete.php");
            }
            if(isset($_GET["edit-page"])){
                $id = $_GET["id"];

                header("Location: edit.php?id=".$id);
            }
            ?>
        </form>
    </body>
    </html>
    <?php
}