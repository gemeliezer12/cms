<?php
session_start();
include_once("../inc/dbh.inc.php");
include_once("../inc/article.inc.php");
$article = new Article;

$id = $_GET["id"];
$data = $article->fetchData($id);

if(isset($_SESSION["loggedIn"])){
    if(isset($_POST["edit-submit"])){
        echo "dddd";
    }
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
        <p>
            <a href="../index.php" class="logo">CMS</a>
        </p>
        
        <?php
        if(isset($error)){?>
        <small style="color: #aa0000;"><?php echo $error?></small>
        <?php }?>
        <form class="edit-form" action="edit.php" method="POST" autocomplete="off">
            <textarea class="button" name="title" placeholder="Title"><?php echo $data["titleArticle"]?></textarea>
            <textarea class="button content-input" name="content" placeholder="Content"><?php echo $data["contentArticle"]?></textarea>
            <input class="button edit-article-btn" type="submit" name="edit-submit" value="Edit Article">
        </form>
        <div class="admin">
            <a href="index.php">admin</a>
        </div>
    </div>
</body>
</html>
<?php
}