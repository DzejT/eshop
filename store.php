<?php
session_start();

require_once "config.php";

$sql = "SELECT * FROM fooditems";
$result = mysqli_query($conn, $sql);

$cartItemN = [];
$cartItemQ = [];
$cartItemP = [];
$cartItemPricePerOne = [];
$err = $addr = "";
if($_SERVER['REQUEST_METHOD']=="POST"){
    if(isset($_POST['tocart'])){
        $a = 0;
        while ($row = mysqli_fetch_assoc($result)) {
            $amount = $_POST[$a];
            if($amount>0){
                $cartItemN[] = $row['name'];
                $cartItemQ[] = $amount;
                if($row['discount'] > 0){
                    $cartItemP[] = $amount*$row['discount'];
                    $cartItemPricePerOne[] = $row['discount'];
                }
                else{
                    $cartItemP[] = $amount*$row['price'];
                    $cartItemPricePerOne[] = $row['price'];
                }
            }
            $a = $a + 1;
        }    
    }
}
    
$totPrice = 0;
foreach($cartItemP as $pr){
    $totPrice = $totPrice + $pr;
}
if(($totPrice>0)){
    $_SESSION["netAmount"] = $totPrice;
    
    header("location: cart.php");

    $_SESSION["cartItemN"] = $cartItemN;
    $_SESSION["cartItemQ"] = $cartItemQ;
    $_SESSION["cartItemP"] = $cartItemP;
    $_SESSION["cartItemPricePerOne"] = $cartItemPricePerOne;

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
                <li><a id="active" href="store.php">Store</a></li>
                <li><a href="cart.php">Cart</a></li>
                <li><a href="account.php">Account</a></li>
                <li><a href="logout.php">Logout</a></li>
                
            </ul>
        </ul>
    </nav>
    <div class="container">
        <form action="" method="post">
            <div class="food-items">
                <?php
                    $sql = "SELECT * FROM fooditems";
                    $result = mysqli_query($conn, $sql);
                    $a = 0; 
                    while ($row = mysqli_fetch_assoc($result)) {
                ?>
                        <div class="food">
                            <div class="food-pic">
                                <img src="Assets/Store/<?php echo $row['image']; ?>" alt="wh"> <li><?php echo $row['name']; ?><br>Sudėtis:<br><?php echo $row['ingredients']; ?><br></li>
                            </div>
                            <div class="food-input">
                                <input class="food-quantity" style="border: 2px solid green" type="number" name=<?php echo $a; ?> id=<?php echo $a;?> min="0" max="10" value=
                                    <?php 
                                        if(isset($_SESSION["cartItemQ"][$a])){
                                            echo $_SESSION["cartItemQ"][$a];
                                        }
                                        else{
                                            echo "0";
                                        }  
                                    ?>>
                            </div>
                            <div class="food-details">
                                <h3><?php echo $row['name']; ?></h3>    
                                 <?php if($row['discount']!=0): ?>
                                    <ul>
                                        <li><span style="text-decoration: line-through;">Price(Eur) <?php echo $row['price']; ?></span></li>
                                        <li><span style="color: red;">Sale!</span></li>
                                        <li><span style="color: red;">New Price(Eur) <?php echo $row['discount']; ?></span></li>
                                        <li><span style="color: red;">Valid until <?php echo $row['discount_date']; ?></span></li>
                                    </ul>
                                <?php else:?>
                                    <ul>
                                        <li>Price(Eur) <?php echo $row['price']; ?></li>
                                    </ul> 
                                <?php endif;?>
                            </div>
                        </div>
                <?php
                    $a = $a +1;
                    }
                ?>
                <div class="to-cart">
                    <button name="tocart" type="submit">Add to Cart</button>
                </div>
            </div>
        </form>
    </div>

    <script src="https://kit.fontawesome.com/6f42fc440c.js" crossorigin="anonymous"></script>
    <script src="script.js"></script>
</body>
</html>

                        