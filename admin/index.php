<?php
session_start();
include_once("../inc/dbh.inc.php");

if(isset($_SESSION["loggedIn"])){
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
            <a href="../index.php" style="display: block;" class="logo">CMS</a>
            <ol class="list">
                <li><a href="add.php">1. Add Article</a></li>
                <li><a href="delete.php">2. Delete/Edit Article</a></li>
                <li><a href="logout.php">3. Logout</a></li>
            </ol>
        </div>
    </body>
    </html>
    <?php
    exit();
}
else{
    if(isset($_POST["login-submit"])){
        $username = $_POST["username"];
        $password = $_POST["pwd"];
        
        if(empty($username) || empty($password)){
            $error = "All fields are required";
        }
        else{
            $query = $pdo->prepare("SELECT * FROM users WHERE nameUser = ? AND passwordUser = ?");
            $md5Pwd = md5($password);

            $query->bindValue(1, $username);
            $query->bindValue(2, $md5Pwd);
            $query->execute();

            $num = $query->rowCount();

            if($num == 1){
                $_SESSION["loggedIn"] = true;
                header("index.php");
                
            }
            else{
                $error = "Incorrect details";
            }
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
        <form action="index.php" method="POST" autocomplete="off">
            <input class="button" type="text" name="username" placeholder="Username">
            <input class="button" type="password" name="pwd" placeholder="Password">
            <input class="button" type="submit" name="login-submit" value="Login">
        </form>
    </div>
</body>
</html>
<?php 
}