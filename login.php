<?php
//Handles login
session_start();

//Check if user is already logged in
if(isset($_SESSION['username'])){
    if($_SESSION["admin"]=='YES'){
        header("location: sales.php");
    }
    else{
        header("location: index.php");
    }
    exit();
}

require_once "config.php";

$username = $password = "";
$uerr = $perr = "";

if($_SERVER['REQUEST_METHOD']=="POST"){
    if(empty(trim($_POST['username'])) || empty(trim($_POST['password']))){
        $uerr = "Please enter both username and password";
    }
    else{
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
        $sql = "SELECT id, fullname, email, username, password, admin FROM loginform WHERE username = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        $q = mysqli_stmt_get_result($stmt);
        if(mysqli_num_rows($q) == 0){
            $uerr = "An account with that username does not exist";
        }
    }
}
if(empty($uerr)){
    $sql = "SELECT id, fullname, email, username, password, admin, created_at FROM loginform WHERE username = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $username);
    //Try to execute this statement
    if(mysqli_stmt_execute($stmt)){
        mysqli_stmt_store_result($stmt);
        if(mysqli_stmt_num_rows($stmt) == 1){
            mysqli_stmt_bind_result($stmt, $id, $fullname, $email, $username, $hashed_password, $admin, $created_at);
            if(mysqli_stmt_fetch($stmt)){
                if(password_verify($password, $hashed_password)){
                    //Password is correct. Allow user to login
                    session_start();
                    $_SESSION["username"] = $username;
                    $_SESSION["fullname"] = $fullname;
                    $_SESSION["email"] = $email;
                    $_SESSION["id"] = $id;
                    $_SESSION["loggedin"] = true;
                    //Redirect the user to the accountInfo page
                    $_SESSION["admin"] = $admin;
                    $_SESSION["created_at"] = $created_at;
                    if($_SESSION["admin"]=='YES'){
                        header("location: sales.php");
                    }
                    else{
                        header("location: index.php");
                    }
                }
                else{
                    $perr = "Incorrect password";
                }
            }
        }
    }
}
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
                <li>
                    <form action="search.php" method="GET">
                        <input type="text" name="q" placeholder="Search...">
                        <button type="submit"><i class="fas fa-search"></i></button>
                    </form>
                </li>
                <li><a href="index.php">Home</a></li>
                <li><a href="news.php">News</a></li>
                <li><a href="restaurants.php">Restaurants</a></li>
                <li><a href="faq.php">FAQ</a></li>
                <li><a href="register.php">Register</a></li>
                <li><a id="active" href="login.php">Login</a></li>
            </ul>
        </ul>
    </nav>
    <div class="container">
        <form action="" method="post">
            <section class="login-page">
                <div class="login-input">
                    <div class="login-details">
                        <label for="username">Username</label> <span style="color:red;"><?php echo $uerr;?></span>
                        <input type="text" name="username" id="username">
                    </div>
                    <div class="login-details"> <span style="color:red;"><?php echo $perr;?></span>
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password">
                    </div>
                </div>
                <div class="login-btn">
                    <button>Login</button>
                </div>
            </section>
        </form>
    </div>
    <script src="https://kit.fontawesome.com/6f42fc440c.js" crossorigin="anonymous"></script>
    <script src="script.js"></script>
</body>
</html>