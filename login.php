<?php
   require 'function.php';
   if(isset($_SESSION["email"])){
      header("Location: index.php");
   }
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <!-- CSS only -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
   <!-- Ajax and jquery -->
   <script 
      src="https://code.jquery.com/jquery-3.3.1.js" 
      integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" 
      crossorigin="anonymous">
   </script>
   <link rel="stylesheet" href="./css/style.css">
   <title>Login page</title>
</head>
<body>
   <div class="container">
      <form class="row g-3" autocomplete="off" method="post">
         <h1>Login</h1>
         <input type="hidden" id="action" value="login">
         <div class="row mb-3">
            <label for="inputEmail3" class="col-sm-2 col-form-label">Email: </label>
            <input type="email" class="form-control" id="email">
         </div>
         <div class="row mb-3">
            <label for="" class="col-sm-2 col-form-label">Password: </label>
            <input type="password" class="form-control" id="password">
         </div>
         <button type="button" onclick="submitData()" class="btn btn-primary" id="login" >Login</button>
      </form>
      <?php 
         require 'script.php';
      ?>
   </div>   
</body>
</html>