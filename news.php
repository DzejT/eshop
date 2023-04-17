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
            </ul>
            <ul class="right-ul">
                <li>
                    <form action="search.php" method="GET">
                        <input type="text" name="q" placeholder="Search...">
                        <button type="submit"><i class="fas fa-search"></i></button>
                    </form>
                </li>
                <li><a href="index.php">Home</a></li>
                <li><a id="active" href="news.php">News</a></li>
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
            <h1>Latest news in Sandwich World!</h1>
        </section>
        <section class="speciality">
            <div class="speciality-content">
                <div class="speciality-pic">
                    <img src="Assets/newshop.png" alt="b">
                </div>
                <div class="speciality-head">
                    <h2>Our new shop was opened!<br>You can find it at:<br>Kaunas, Savanoriu pr. 462<br></h2>
                </div>
            </div>
            <div class="speciality-content">
                <div class="speciality-pic">
                    <img src="Assets/wallet.png" alt="w">
                </div>
                <div class="speciality-head">
                    <h2>Best Price</h2>
                </div>
            </div>
            <div class="speciality-content">
                <div class="speciality-pic">
                    <img src="Assets/delivery.png" alt="d">
                </div>
                <div class="speciality-head">
                    <h2>Door2Door Delivery</h2>
                </div>
            </div>
        </section>
    </div>

    <script src="https://kit.fontawesome.com/6f42fc440c.js" crossorigin="anonymous"></script>
    <script src="script.js"></script>
</body>
</html>