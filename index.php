<?php
    require 'function.php';
    if(isset($_SESSION["email"])){
        $email = $_SESSION["email"];
        $user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM userdb WHERE email = $email"));
    }
    else{
        session_destroy();
        header("Location: login.php");
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <title>home page</title>
</head>
<body>
    <h1>Welcome <?php echo $user["name"]; ?></h1>
    <a href="logout.php">Logout</a>
</body>
</html>