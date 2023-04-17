<?php
if(isset($_POST['submit'])){
    $searchValue = $_POST['searchValue'];
    if(!empty($searchValue)){
        switch(strtolower($searchValue)){
            case "restaurants":
                header("Location: restaurants.php");
                break;
            case "store":
                header("Location: store.php");
                break;
            case "news":
                header("Location: news.php");
                break;
            case "faq":
                header("Location: faq.php");
                break;
            case "home":
                header("Location: index.php");
                break;
            case "sandwiches":
                header("Location: store.php");
                break;
            default:
                echo "No results found.";
        }
        exit();
    } else {
        echo "Please enter a search term.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Search Page</title>
</head>
<body>
    <form method="POST">
        <input type="text" name="searchValue" placeholder="Search...">
        <button type="submit" name="submit">Search</button>
    </form>
</body>
</html>
