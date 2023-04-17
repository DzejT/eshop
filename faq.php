<?php
session_start();
require_once "config.php";
if(!(isset($_SESSION['admin']))){
    $_SESSION['admin'] = "NIL";
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
                <!-- Instagram Icon -->
                <a href="https://www.instagram.com/skanussumustinis/" target="_blank">
                <img src="https://www.instagram.com/static/images/ico/favicon-192.png/68d99ba29cc8.png" alt="Instagram" style="width:25px;height:25px;">
                </a>

                <!-- Facebook Icon -->
                <a href="https://www.facebook.com/profile.php?id=100092045854029" target="_blank">
                <img src="https://cdn-icons-png.flaticon.com/512/1384/1384053.png" alt="Facebook" style="width:25px;height:25px;">
                </a>
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
                <?php if($_SESSION["admin"]=='YES'): ?>
                <li><a href="sales.php">Sales</a></li>
                <li><a href="sandwiches.php">Sandwiches</a></li>
                <li><a href="account.php">Account</a></li>
                <li><a href="logout.php">Logout</a></li>
                <?php elseif ($_SESSION["admin"]=='NIL'):?>
                <li><a href="register.php">Register</a></li>
                <li><a href="login.php">Login</a></li>
                <?php else:?>
                <li><a href="store.php">Store</a></li>
                <li><a href="cart.php">Cart</a></li>
                <li><a href="account.php">Account</a></li>
                <li><a href="logout.php">Logout</a></li>
                <?php endif;?>
            </ul>
        </ul>
    </nav>
    <div class="container">
        <section class="banner">
            <img src="Assets/title.png" alt="1">
        </section>
        <section class="slogan">
            <h1>Frequently asked<br>questions<br></h1>
        
    </div>

    <script src="https://kit.fontawesome.com/6f42fc440c.js" crossorigin="anonymous"></script>
    <script src="script.js"></script>
</body>
</html>