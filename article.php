<?php
include_once("inc/article.inc.php");
include_once("inc/dbh.inc.php");

$article = new Article;



if(isset($_GET["id"])){
    $id = $_GET["id"];
    $data = $article->fetchData($id);
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
            <a href="index.php" class="logo">CMS</a>
            <p class="title">
                <?php echo $data["titleArticle"];?>
                <span class="timestamp">
                - posted <?php echo date("l jS", $data["timestampArticle"]);?>
                </span>
            </p>
            <p class="content">
                <?php echo $data["contentArticle"];?>
            </p>
            <a href="index.php">&larr; Back</a>
            
            <a href="admin/index.php">admin</a>
        </div>
    </body>
    </html>
<?php
}
else{
    header("Location: index.php");
    exit;
}