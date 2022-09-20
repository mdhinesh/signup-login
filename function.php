<?php

    session_start();
    $conn = mysqli_connect("localhost", "root", "", "guvi");


    if(isset($_POST["action"])){
        if($_POST["action"] == "signup"){
            register();
        }
        else if($_POST["action"] == "login"){
            login();
        }
    }

    function register()   {
        global $conn;
        
        $name = $_POST["name"];
        $email = $_POST["email"];
        $password = $_POST["password"];

        if(empty($name) || empty($email) || empty($password)){
            echo "Please fill out the Form";
            exit();
        }

        $query = "INSERT INTO userdb VALUES ('$name', '$email', '$password', '', '') ";
        mysqli_query($conn, $query);
        echo "Register Successful";
    }

    function login(){
        global $conn;

        $email = $_POST["email"];
        $password = $_POST['password'];

        $user = mysqli_query($conn, "SELECT * FROM userdb WHERE email = '$email' ");

        if(mysqli_num_rows($user) > 0){
            $row = mysqli_fetch_assoc($user);
            if($password == $row["password"]){
                echo "Login Successful";
                $_SESSION["login"] = true;
            }
            else{
                echo "Wrong password";
                exit;
            }
        }
        else{
            echo "User not registered";
            exit;
        }
    }
?>