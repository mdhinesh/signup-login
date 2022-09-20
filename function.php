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

        $stmt = $conn->prepare("SELECT * FROM userdb WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if(empty($name) || empty($email) || empty($password)){
            echo "Please fill out the Form";
            exit();
        }
        if($stmt->num_rows > 0){
            echo "Account already registered";
            exit();
        }else{
            $stmt_1 = $conn->prepare("INSERT INTO userdb (name, email, password, '', '') VALUES (?, ?, ?)");
            $stmt_1->bind_param("sss", $name, $email, $password);
            $stmt_1->execute();
            echo 'registration_success';
            $stmt_1->close();
        }
        $stmt->free_result();
        $stmt->close();
        
//-------------without prepared statement------------

        // $query = "INSERT INTO userdb VALUES ('$name', '$email', '$password', '', '') ";
        // mysqli_query($conn, $query);
        // echo "Register Successful";
    }

    function login(){
        global $conn;

        $email = $_POST["email"];
        $password = $_POST['password'];

        $stmt = $conn->prepare("SELECT * FROM userdb WHERE email=?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            $stmt->bind_result($name, $pass);
            $stmt->fetch();
            if (password_verify($password, $pass)) { // Verifying Password
                session_regenerate_id();
                $_SESSION['login'] = TRUE;
                $_SESSION['email'] = $email;
                echo 'login_success';
            }
            else {
                echo 'wrong_password';
            }
        }
        else{
            echo 'wrong_password';
        }
        $stmt->close();

//-------------without prepared statement------------

        // $user = mysqli_query($conn, "SELECT * FROM userdb WHERE email = '$email' ");

        // if(mysqli_num_rows($user) > 0){
        //     $row = mysqli_fetch_assoc($user);
        //     if($password == $row["password"]){
        //         echo "Login Successful";
        //         $_SESSION["login"] = true;
        //     }
        //     else{
        //         echo "Wrong password";
        //         exit;
        //     }
        // }
        // else{
        //     echo "User not registered";
        //     exit;
        // }
    }
?>