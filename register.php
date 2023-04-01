<?php
session_start();
//require_once "config.php";
if(isset($_SESSION['username'])){
    if($_SESSION["admin"]=='YES'){
        header("location: sales.php");
    }
    else{
        header("location: index.php");
    }
    exit();
}

$fullname = $email = $username = $password = $confirm_password = "";
$fullname_err = $email_err = $username_err = $password_err = $confirm_password_err = $err = "";


?>

<!DOCTYPE html>
<html lang="en">
<style>
  <?php include "style.css" ?>
</style>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sandwiches E-shop</title>
    <link rel="icon" href="Assets/logo5.png">
</head>
<body>
    <nav class="nav-container">
        <ul>
            <ul>
                <li class="brand"><img src="Assets/logo5.png" alt="Music">Sandwich World</li>
            </ul>
            <ul class="right-ul">
                <li><a href="index.php">Home</a></li>
                <li><a href="store.php">Store</a></li>
                <li><a id="active" href="register.php">Register</a></li>
                <li><a href="login.php">Login</a></li>
            </ul>
        </ul>
    </nav>
    <div class="container">
        <form action="" method="post">
            <section class="register-page">
                <div class="register-input">
                    <div class="register-details">
                        <label for="fullname">Full Name</label> <span style="color:red;"><?php echo $fullname_err;?></span>
                        <input type="text" class="form-control" name="fullname" id="fullname" placeholder="Bob Ross">
                    </div>
                    <div class="register-details">
                        <label for="email">Email</label> <span style="color:red;"><?php echo $email_err;?></span>
                        <input type="email" class="form-control" name="email" id="email" placeholder="PainterBob@gmail.com">
                    </div>
                    <div class="register-details">
                        <label for="username">Username</label> <span style="color:red;"><?php echo $username_err;?></span>
                        <input type="text" class="form-control" name="username" id="username" placeholder="BobRoss420">
                    </div>
                    <div class="register-details">
                        <label for="password">Password</label> <span style="color:red;"><?php echo $password_err;?></span>
                        <input type="password" class="form-control" name="password" id="password">
                    </div>
                </div>
                <div class="register-btn">
                    <button onclick="location.href='login.php';">Register</button>
                    <br>
                    <span style="color:red;"><?php echo $err;?></span>
                </div>
            </section>
        </form>
    </div>
    <script src="https://kit.fontawesome.com/6f42fc440c.js" crossorigin="anonymous"></script>
    <script src="script.js"></script>
</body>
</html>