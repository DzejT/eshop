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
                <li><a id="active" href="index.php">Home</a></li>
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
            <h1>All you need<br>is a<br>SANDWICH!!</h1>
        </section>
        <section class="speciality">
            <div class="speciality-content">
                <div class="speciality-pic">
                    <img src="Assets/sandwich.png" alt="b">
                </div>
                <div class="speciality-head">
                    <h2>Tasty Sandwiches</h2>
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
            <footer class="footerF">
                <div class="footerf-display">
                    <h2>Kontaktinė informacija</h2>
                </div>
                <div class="footerf-display">
                    <p>sumustiniai@skanu.lt</p>
                    <p>+37060867158</p>
                </div>
            </footer>
        </section>
    </div>

    <script src="https://kit.fontawesome.com/6f42fc440c.js" crossorigin="anonymous"></script>
    <script src="script.js"></script>
</body>
</html>