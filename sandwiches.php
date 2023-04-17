<?php
    session_start();
    if(!isset($_SESSION['username'])){
        header("location: login.php");
        exit();
    }
    if($_SESSION["admin"]=='NO'){
        header("location: index.php");
        exit();
    }

    require_once "config.php";


    $sql = "SELECT * FROM fooditems";
    $result = mysqli_query($conn, $sql);

    if($_SERVER['REQUEST_METHOD']=="POST"){
        if(isset($_POST['submit'])){
            $a = 0;
            while ($row = mysqli_fetch_assoc($result)){
                $price = $_POST["price$a"];
                $dprice = $_POST["discount$a"];

                $sql = "UPDATE fooditems SET price = ? WHERE name = ?";
                $stmt = mysqli_prepare($conn, $sql);
                mysqli_stmt_bind_param($stmt, 'ds', $price, $row["name"]);
                mysqli_stmt_execute($stmt);

                $sql = "UPDATE fooditems SET discount = ? WHERE name = ?";
                $stmt = mysqli_prepare($conn, $sql);
                mysqli_stmt_bind_param($stmt, 'ds', $dprice, $row["name"]);
                mysqli_stmt_execute($stmt);
                
                // $sql = "UPDATE fooditems SET price={$price} WHERE name=Meatball sub";
                // $response = mysqli_query($conn, $sql);

                // echo $response;
           
                // $sql = "UPDATE fooditems SET price={$dprice} WHERE name={$row['name']}";
                // $result = mysqli_query($conn, $sql);

                $a = $a + 1;
            }

           
            header("location: sandwiches.php");
        }
    }
    

?>



<!DOCTYPE html>
<html lang="en">
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
                <li><a href="index.php">Home</a></li>
                <li><a href="news.php">News</a></li>
                <li><a href="restaurants.php">Restaurants</a></li>
                <li><a href="faq.php">FAQ</a></li>
                <li><a href="sales.php">Sales</a></li>
                <li><a id="active" href="sandwiches.php">Sandwiches</a></li>
                <li><a href="account.php">Account</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </ul>
    </nav>
    <div class="container">
        <form action="" method="post">
            <div class="food-items">

                <?php 
                    $a = 0;
                    while ($row = mysqli_fetch_assoc($result)) 
                    {
                ?>
                    <div class="food">
                        <div class="food-pic">
                        <img src="Assets/Store/<?php echo $row['image']; ?>" alt="wh">
                        </div>
                        <div class="food-input">
                            <input class="food-price" step="0.01" style="margin-top: 10px; width: 100px;" type="number" name=price<?php echo $a; ?> id=price<?php echo $a; ?> min="0"  value= <?php echo $row['price']; ?> >
                            <!-- <?php$a = $a + 1;?> -->
                            <input class="food-discount" step="0.01" style="margin-top: 10px; border: 2px solid red; width: 100px;" type="number" name=discount<?php echo $a; ?> id=discount<?php echo $a; ?> min="0"  value=<?php echo $row['discount']; ?>>
                        </div>
                        <div class="food-details">
                            <h3><?php echo $row['name']?></h3>
                        </div>
                    </div>
                <?php
                $a = $a + 1;
                }
                ?>
                <div class="to-cart">
                    <form action="" method="post">
                        <button type="submit" name="submit" id="submit" type="submit">Update</button>
                    </form>
                </div>
            </div>
        </form>
    </div>

    <script src="https://kit.fontawesome.com/6f42fc440c.js" crossorigin="anonymous"></script>
    <script src="script.js"></script>
</body>
</html>