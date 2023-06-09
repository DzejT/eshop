<?php
session_start();
require_once "config.php";
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


if($_SERVER['REQUEST_METHOD']=="POST"){
    //Check if first name is empty
    if(empty(trim($_POST['fullname']))){
        $fullname_err = "First Name cannot be blank";
    }
    else{
        $sql = "SELECT id FROM loginform WHERE fullname = ?";
        $stmt = mysqli_prepare($conn, $sql);
        if($stmt){
            mysqli_stmt_bind_param($stmt, "s", $param_fullname);

            //Set the value of param fullname
            $param_fullname = trim($_POST['fullname']);
            //Try to execute the statement
            if(mysqli_execute($stmt)){
                mysqli_stmt_store_result($stmt);
                $fullname = trim($_POST['fullname']);
            }
            else{
                $err = "Something went wrong";
            }
        }
    }
    
    //Check if email is empty
    if(empty(trim($_POST['email']))){
        $email_err = "Email cannot be blank";
    }
    else{
        $sql = "SELECT id FROM loginform WHERE email = ?";
        $stmt = mysqli_prepare($conn, $sql);
        if($stmt){
            mysqli_stmt_bind_param($stmt, "s", $param_email);

            //Set the value of param email
            $param_email = trim($_POST['email']);
            //Try to execute the statement
            if(mysqli_execute($stmt)){
                mysqli_stmt_store_result($stmt);
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $email_err = "This email is already taken";
                }
                else{
                    $email = trim($_POST['email']);
                }
            }
            else{
                $err = "Something went wrong";
            }
        }
    }

    //Check if username is empty
    if(empty(trim($_POST['username']))){
        $username_err = "Username cannot be blank";
    }
    else{
        $sql = "SELECT id FROM loginform WHERE username = ?";
        $stmt = mysqli_prepare($conn, $sql);
        if($stmt){
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            //Set the value of param username
            $param_username = trim($_POST['username']);
            //Try to execute the statement
            if(mysqli_execute($stmt)){
                mysqli_stmt_store_result($stmt);
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "This username is already taken";
                }
                else{
                    $username = trim($_POST['username']);
                }
            }
            else{
                $err = "Something went wrong";
            }
        }
    }
    

    //Password validation
    if(empty(trim($_POST['password']))){
        $password_err = "Password cannot be blank";
    }
    elseif(strlen(trim($_POST['password'])) < 8){
        $password_err = "Password cannot be less than 8 characters";
    }
    else{
        $password = trim($_POST['password']);
    }

    //If there were no errors then insert the values into the database
    // if(empty($username_err) && empty($password_err) && empty($confirm_password_err) && empty($email_err) && empty($fullname_err)){
    //     $sql = "INSERT INTO loginform (fullname, email, username, password) VALUES (?, ?, ?, ?)";
    //     $stmt = mysqli_prepare($conn, $sql);

    //     if($stmt){
    //         mysqli_stmt_bind_param($stmt, "ssss", $param_fullname, $param_email, $param_username, $param_password);

    //         //Set these parameters
    //         $param_fullname = $fullname;
    //         $param_email = $email;
    //         $param_username = $username;
    //         $param_password = password_hash($password, PASSWORD_DEFAULT);

    //         //Try to execute the query
    //         if(mysqli_stmt_execute($stmt)){
    //             header("location: login.php");
    //         }
    //         else{
    //             $err = "Something went wrong";
    //         }
    //     }
    //     mysqli_stmt_close($stmt);
    // }
    // mysqli_close($conn);


    if(empty($username_err) && empty($password_err) && empty($confirm_password_err) && empty($email_err) && empty($fullname_err)){

        // Validate email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $email_err = "Invalid email format";
        }
    
        // Validate password
        if(!preg_match("/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/", $password)){
            $password_err = "Password must be at least 8 characters long and contain at least one letter and one number";
        } 
    
        // If no errors, insert data into the loginform table
        // if(empty($email_err) && empty($password_err)){
        //     $sql = "INSERT INTO loginform (fullname, email, username, password) VALUES (?, ?, ?, ?)";
        //     $stmt = mysqli_prepare($conn, $sql);
    
        //     if($stmt){
        //         mysqli_stmt_bind_param($stmt, "ssss", $param_fullname, $param_email, $param_username, $param_password);
    
        //         //Set these parameters
        //         $param_fullname = $fullname;
        //         $param_email = $email;
        //         $param_username = $username;
        //         $param_password = password_hash($password, PASSWORD_DEFAULT);
    
        //         //Try to execute the query
        //         if(mysqli_stmt_execute($stmt)){
        //             header("location: login.php");
        //         }
        //         else{
        //             $err = "Something went wrong";
        //         }
        //     }
        //     mysqli_stmt_close($stmt);
        // }
        // mysqli_close($conn);

        // Generate a unique primary key value
$result = mysqli_query($conn, "SELECT MAX(id) AS max_id FROM loginform");
$row = mysqli_fetch_assoc($result);
$new_id = $row['max_id'] + 1;

// If no errors, insert data into the loginform table
if(empty($email_err) && empty($password_err)){
    $sql = "INSERT INTO loginform (id, fullname, email, username, password) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);

    if($stmt){
        mysqli_stmt_bind_param($stmt, "issss", $new_id, $param_fullname, $param_email, $param_username, $param_password);

        //Set these parameters
        $param_fullname = $fullname;
        $param_email = $email;
        $param_username = $username;
        $param_password = password_hash($password, PASSWORD_DEFAULT);

        //Try to execute the query
        if(mysqli_stmt_execute($stmt)){
            header("location: login.php");
        }
        else{
            $err = "Something went wrong";
        }
    }
    mysqli_stmt_close($stmt);
}
mysqli_close($conn);
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
                <li><a href="register.php">Register</a></li>
                <li><a id="active" href="login.php">Login</a></li>
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