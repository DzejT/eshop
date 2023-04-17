<?php
session_start();

require_once "config.php";
$vwhp = $nvwhp = $vwpj = $nvwpj = $vkng = $nvkng = 0;
//$Pvwhp = $Pnvwhp = $Pvwpj = $Pnvwpj = $Pvkng = $Pnvkng = 0;
$Pvwhp = 1000;
$Pnvwhp = 1000;
$Pvwpj = 1000;
$Pnvwpj = 1000;
$Pvkng = 1000;
$Pnvkng = 1000;


$cartItemN = [];
$cartItemQ = [];
$cartItemP = [];
$err = $addr = "";
if($_SERVER['REQUEST_METHOD']=="POST"){
    if(isset($_POST['tocart'])){
        $vwhp = $_POST['vwhp'];
        $nvwhp = $_POST['nvwhp'];
        $vwpj = $_POST['vwpj'];
        $nvwpj = $_POST['nvwpj'];
        $vkng = $_POST['vkng'];
        $nvkng = $_POST['nvkng'];
        if($vwhp>0){
            $cartItemN[] = "Whopper Veg";
            $cartItemQ[] = $vwhp;
            $cartItemP[] = $vwhp*$Pvwhp;
        }
        if($nvwhp>0){
            $cartItemN[] = "Whopper Non-Veg";
            $cartItemQ[] = $nvwhp;
            $cartItemP[] = $nvwhp*$Pnvwhp;
        }
        if($vwpj>0){
            $cartItemN[] = "Whopper Jr. Veg";
            $cartItemQ[] = $vwpj;
            $cartItemP[] = $vwpj*$Pvwpj;
        }
        if($nvwpj>0){
            $cartItemN[] = "Whopper Jr. Non-Veg";
            $cartItemQ[] = $nvwpj;
            $cartItemP[] = $nvwpj*$Pnvwpj;
    
        }
        if($vkng>0){
            $cartItemN[] = "King Veg";
            $cartItemQ[] = $vkng;
            $cartItemP[] = $vkng*$Pvkng;
        }
        if($nvkng>0){
            $cartItemN[] = "King Non-Veg";
            $cartItemQ[] = $nvkng;
            $cartItemP[] = $nvkng*$Pnvkng;
        }
    }
}
    
$totPrice = $tax = 0;
foreach($cartItemP as $pr){
    $totPrice = $totPrice + $pr;
}
if(($totPrice>0)){
    $tax = $totPrice*(8/100);
    $_SESSION["tax"] = $tax;
    $totPrice = $totPrice + $tax;
    $_SESSION["netAmount"] = $totPrice;
    if(empty(trim($_POST['addr']))){
        $err = "*Please enter Delivery Address";
    }
    else{
        $_SESSION["addr"] = $_POST['addr'];
        header("location: cart.php");
    }
    
    $_SESSION["cartItemN"] = $cartItemN;
    $_SESSION["cartItemQ"] = $cartItemQ;
    $_SESSION["cartItemP"] = $cartItemP;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sandwich E-shop</title>
    <link rel="icon" href="Assets/logo5.png">
    <link rel="stylesheet" href="style.css">
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
                <li><a id="active" href="store.php">Store</a></li>
                <li><a href="restaurants.php">Restaurants</a></li>
                <li><a href="news.php">News</a></li>
                <li><a href="faq.php">FAQ</a></li>
                <li><a href="register.php">Register</a></li>
                <li><a href="login.php">Login</a></li>
                
            </ul>
        </ul>
    </nav>
    <div class="container">
        <form action="" method="post">
            <div class="food-items">
                <div class="food">
                    <div class="food-pic">
                        <img src="Assets/Store/turkey-sub.png" alt="wh"> <li> Turkey sub <br>Sudėtis:<br>Prancūziška bandelė, kumpis, pomidorai,<br> iceberg salota, pikantiškas padažas, marinuoti agurkeliai<br></li>
                    </div>
                    <div class="food-input">
                        <input class="food-quantity" style="border: 2px solid green" type="number" name="vwhp" id="vwhp" min="0" max="10" value="0">
                    </div>
                    <div class="food-details">
                        <h3>Turkey sub</h3>
                        <ul>
                            <li>Price(Eur) 6.99</li>
                        </ul>
                    </div>
                </div>
                <div class="food">
                    <div class="food-pic">
                        <img src="Assets/Store/meatball-sub.png" alt="whj"> <li> Meatball sub <br>Sudėtis:<br>Prancūziška bandelė, mėsos kukuliai, mocarelos sūris, BBQ padažas</li>
                    </div>
                    <div class="food-input">
                        <input class="food-quantity" style="border: 2px solid green" type="number" name="vwpj" id="vwpj" min="0" max="10" value="0">
                    </div>
                    <div class="food-details">
                        <h3>Meatball sub</h3>
                        <ul>
                            <li>Price(Eur) 7.99</li>
                        </ul>
                    </div>
                </div>
                <div class="food">
                    <div class="food-pic">
                        <img src="Assets/Store/pastrami-sub.png" alt="kn"> <li> Pastrami sub <br>Sudėtis:<br>Prancūziška bandelė, kumpis, pomidorai,<br> iceberg salota, česnakinis padažas, adžika padažas, svogūnai,<br> raudonoji paprika, marinuoti agurkeliai<br></li>
                    </div>
                    <div class="food-input">
                        <input class="food-quantity" style="border: 2px solid green" type="number" name="vkng" id="vkng" min="0" max="10" value="0">
                    </div>
                    <div class="food-details">
                        <h3>Pastrami sub</h3>
                        <ul>
                            <li>Price(Eur) 6.99</li>
                        </ul>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script src="https://kit.fontawesome.com/6f42fc440c.js" crossorigin="anonymous"></script>
    <script src="script.js"></script>
</body>
</html>