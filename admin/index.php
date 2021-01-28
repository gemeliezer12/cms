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
        <title>Document</title>
    </head>
    <body>
        <div class="container">
            <a href="../index.php" id="logo">CMS</a>
            <ol>
                <li><a href="add.php">Add Article</a></li>
                <li><a href="delete.php">Delete/Edit Article</a></li>
                <li><a href="logout.php">Logout</a></li>
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
    <title>Document</title>
</head>
<body>
    <div class="container">
        <a href="../index.php" id="logo">CMS</a>
        <?php if(isset($error)){?>
        <small style="color: #aa0000;"><?php echo $error?></small>
        <?php }?>
        <form action="index.php" method="POST" autocomplete="off">
            <input type="text" name="username" placeholder="Username">
            <input type="password" name="pwd" placeholder="Password">
            <input type="submit" name="login-submit" value="Login">
        </form>
    </div>
</body>
</html>
<?php 
}