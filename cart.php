<?php
session_start();


if(!isset($_SESSION['username'])){
    header("location: login.php");
    exit();
}
if($_SESSION["admin"]=='YES'){
    header("location: sales.php");
    exit();
}
require_once "config.php";
if(isset($_SESSION['cartItemN'])){
    $cartItemN = $_SESSION["cartItemN"];
    $cartItemQ = $_SESSION["cartItemQ"];
    $cartItemP = $_SESSION["cartItemP"];
}
$fl = "Yes";
if(empty($cartItemN)){
    $cartItemN[] = "";
    $cartItemP[] = "";
    $cartItemQ[] = "";
    $fl = "No";
    $addr = "";
}
$tax = $netAmount = "";
if(isset($_SESSION["netAmount"])){
    $netAmount = $_SESSION["netAmount"];
}
if($_SERVER['REQUEST_METHOD']=="POST"){
    if(isset($_POST['topay'])){
        header("location: payment.php");
    }
}

if($_SERVER['REQUEST_METHOD']=="POST"){
    if(isset($_POST['tocart'])){
        $a = 0;
        foreach($_SESSION["cartItemQ"] as $q){
            $amount = $_POST[$a];
            $q = $amount;
            if($q == 0){
                array_splice($_SESSION["cartItemQ"], $a, 1);
                array_splice($_SESSION["cartItemP"], $a, 1);
                array_splice($_SESSION["cartItemN"], $a, 1);
                array_splice($_SESSION["cartItemPricePerOne"], $a, 1);
            }
            else{
                $_SESSION["cartItemP"][$a] = $q * $_SESSION["cartItemPricePerOne"][$a];
                $_SESSION["cartItemQ"][$a] = $amount;
                $totPrice = $totPrice +  $_SESSION["cartItemP"][$a];
            }
            $a = $a + 1;
        }
        if(isset($totPrice)){
            $_SESSION["netAmount"] = $totPrice;
        }
        else{
            $_SESSION["netAmount"] = 0;
        }
        header("location: cart.php");
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
    <link rel="stylesheet" href="style.css">
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
                <li><a href="store.php">Store</a></li>
                <li><a id="active" href="cart.php">Cart</a></li>
                <li><a href="account.php">Account</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </ul>
    </nav>
    <div class="container">
        <form action="" method="post">
            <section class="cart-details">
                <?php $i=0;
                        $a = 0;
                        foreach($cartItemN as $cn){?>
                            <div class="cart-items">
                                <div>
                                    <ul>
                                        <?php if($i==0){?>
                                            <li style="font-weight: bold;">Name</li>
                                        <?php } ?>
                                        <li><?php echo $cn;?></li>
                                    </ul>
                                </div>
                                <div>
                                    <ul>
                                        <?php if($i==0){?>
                                            <li style="font-weight: bold;">Quantity</li>
                                        <?php } ?>
                                        <div class="food-input">
                                            <input class="food-quantity" style="border: 2px solid green" type="number" name=<?php echo $a; ?> id=<?php echo $a;?> min="0" max="10" value=
                                            <?php
                                                $key = array_search($cn, $cartItemN);
                                                if(isset($_SESSION["cartItemQ"][$key])){
                                                    echo $_SESSION["cartItemQ"][$key];
                                                }  
                                            ?>>
                                        </div>
                                    </ul>
                                </div>
                                <div>
                                    <ul>
                                        <?php if($i==0){?>
                                            <li style="font-weight: bold;">Price (Eur)</li>
                                        <?php } ?>
                                        <li><?php echo $cartItemP[$i]; $i++;?></li>
                                    </ul>
                                </div>
                            </div>
                <?php
                    $a++;
                    }
                ?>
                <br><br>
                <div style="margin-left: 78.5%">
                    <div class="cart-refresh">
                        <button name="tocart" type="submit">Refresh cart</button>
                    </div>
                    <br>
                    <span style="font-weight: bold;">Total Amount: </span><?php echo round($netAmount,2);?>
                </div style="margin-left=20px;">
                <div>
                    <label for="address">Deliver to:</label>
                    <input type="text" id="address" name="address"><br><br>
                </div>
                <?php if ($fl == "Yes"){?>
                    <div class="checkout">
                        <button name="topay" type="submit">Proceed to Checkout</button>
                    </div>
                <?php }?>
            </section>
        </form>
    </div>

    <script src="https://kit.fontawesome.com/6f42fc440c.js" crossorigin="anonymous"></script>
    <script src="script.js"></script>
</body>
</html>