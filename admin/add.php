<?php
session_start();
include_once("../inc/dbh.inc.php");
if(isset($_SESSION["loggedIn"])){
    if(isset($_POST["add-submit"])){
        $title = $_POST["title"];
        $content = $_POST["content"];

        if(empty($title) || empty($content)){
            $error = "All fields are required!";
        }
        else{
            $query = $pdo->prepare("INSERT INTO articles(titleArticle,contentArticle,timestampArticle) VALUES(?,?,?)");

            $query->bindValue(1, $title);
            $query->bindValue(2, $content);
            $query->bindValue(3, time());

            $query->execute();

            header("Location: index.php");
        }
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
        <a href="../index.php" class="logo">CMS</a>
        <?php if(isset($error)){?>
        <small style="color: #aa0000;"><?php echo $error?></small>
        <?php }?>
        <form class="add-form" action="add.php" method="POST" autocomplete="off">
            <input class="button" type="text" name="title" placeholder="Title">
            <textarea class="button content-input" name="content" placeholder="Content"></textarea>
            <input class="button add-article-btn" type="submit" name="add-submit" value="Add Article">
        </form>
        <a class="admin" href="index.php">admin</a>
    </div>
</body>
</html>
<?php
}