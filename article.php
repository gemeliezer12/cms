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
        <title>Document</title>
    </head>
    <body>
            <a href="index.php" id="logo">CMS</a>
            <h4>
                <?php echo $data["titleArticle"];?>
                <small>
                    posted <?php echo date("l jS", $data["timestampArticle"])?>
                </small>
                <p>
                    <?php echo $data["contentArticle"];?>
                </p>
                <a href="index.php">&larr; Back</a>
            </h4>
            <a href="admin/index.php">admin</a>
    </body>
    </html>
<?php
}
else{
    header("Location: index.php");
    exit;
}