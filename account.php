<?php
session_start();
if(!isset($_SESSION['username'])){
    header("location: login.php");
    exit();
}
require_once "config.php";
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
                <li>
                    <form action="search.php" method="GET">
                        <input type="text" name="q" placeholder="Search...">
                        <button type="submit"><i class="fas fa-search"></i></button>
                    </form>
                </li>
                <li><a id="active" href="index.php">Home</a></li>
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
        <form action="" method="post">
        <section class="account-page">
            <div class="account-details">
                <div class="account" style="margin-left: 0.7%;">
                    <h3 style="font-size: 25px;">Account</h3 style="color: grey;">
                    <hr style="margin-right: 5%">
                </div>
                <div class="account-info">
                    <table>
                        <tr>
                            <th>Name</th>
                            <td><?php echo $_SESSION["fullname"];?></td>
                        </tr>
                        <tr>
                            <th>Username</th>
                            <td><?php echo $_SESSION["username"];?></td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td><?php echo $_SESSION["email"];?></td>
                        </tr>
                    </table>
                </div>
            </div>
            <br>
            <?php if($_SESSION["admin"] == "NO"){?>
            <div class="account-details" style="margin-left: 0.7%; margin-top 4%;">
                <div class="orders">
                    <h3 style="font-size: 25px;">Orders</h3>
                    <hr style="margin-right: 5%">
                </div>
                <div class="sales-table" style="margin-top: 1%;">
                    <table style="justify-content: left;">
                        
                        <?php 
                            $sql = "SELECT * FROM orders WHERE username='".$_SESSION["username"]."'";
                            $results = mysqli_query($conn, $sql);
                            if(mysqli_num_rows($results)==0): ?>
                                <h4 style='color: grey; font-size: 20px;'>No Orders!</h4>
                            <?php 
                            else: ?>
                                <tr>
                                <th style="border: 1px solid black; padding: 10px;">ID</th>
                                <th style="border: 1px solid black; padding: 10px;">Order ID</th>
                                <th style="border: 1px solid black; padding: 10px;">Username</th>
                                <th style="border: 1px solid black; padding: 10px;">Full Name</th>
                                <th style="border: 1px solid black; padding: 10px;">Item</th>
                                <th style="border: 1px solid black; padding: 10px;">Quantity</th>
                                <th style="border: 1px solid black; padding: 10px;">Email</th>
                                <th style="border: 1px solid black; padding: 10px;">Address</th>
                                <th style="border: 1px solid black; padding: 10px;">Details</th>
                            <?php
                                $oid = ''; $f=0;
                                while($ord = mysqli_fetch_assoc($results)): 
                                    if($oid!=$ord['order_id']): 
                                        if($f==1): $f=0;?>
                                            </tr>
                                        <?php 
                                        endif;
                                        $oid=$ord['order_id']; $f=1;
                                    endif;
                                    ?>
                                    <tr>
                                        <td style="border: 1px solid black; padding: 10px;"><?php echo $ord["id"];?></td>
                                        <td style="border: 1px solid black; padding: 10px;"><?php echo $ord["order_id"];?></td>
                                        <td style="border: 1px solid black; padding: 10px;"><?php echo $ord["username"];?></td>
                                        <td style="border: 1px solid black; padding: 10px;"><?php echo $ord["fullname"];?></td>
                                        <td style="border: 1px solid black; padding: 10px;"><?php echo $ord["item"];?></td>
                                        <td style="border: 1px solid black; padding: 10px;"><?php echo $ord["quantity"];?></td>
                                        <td style="border: 1px solid black; padding: 10px;"><?php echo $ord["email"];?></td>
                                        <td style="border: 1px solid black; padding: 10px;"><?php echo $ord["address"];?></td>
                                        <td style="border: 1px solid black; padding: 10px;"><?php echo $ord["details"];?></td>
                            <?php 
                                endwhile; 
                            endif; ?>
                            </tr>
                    </table>
                </div>
            </div>
            <?php }?>
        </section>
        </form>
    </div>
    <script src="https://kit.fontawesome.com/6f42fc440c.js" crossorigin="anonymous"></script>
    <script src="script.js"></script>
</body>
</html>