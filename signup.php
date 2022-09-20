<?php
   require 'function.php';
   if(isset($_SESSION["email"])){
      header("Location: index.php");
   }
?>

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
   <title>Register page</title>
</head>
<body>
   <div class="container">
      <form class="row g-3" autocomplete="off" id="myform" method="post">
         <h1>SignUp</h1>
         <input type="hidden" id="action" value="signup">
         <div class="row mb-3">
            <label for="" class="col-sm-2 col-form-label">Name: </label>
            <input type="name" class="form-control" id="name">
         </div>
         <div class="row mb-3">
            <label for="" class="col-sm-2 col-form-label">Email: </label>
            <input type="email" class="form-control" id="email">
         </div>
         <div class="row mb-3">
            <label for="" class="col-sm-2 col-form-label">Password: </label>
            <input type="password" class="form-control" id="password">
         </div>
         <button type="button" onclick="submitData();" id="signup" class="btn btn-primary">Sign in</button>
      </form>
      <br>
      <?php 
         require 'script.php'; 
      ?>
   </div>   
</body>
</html>