<?php
    require './vendor/autoload.php';

    $server = "localhost";
    $user = "root";
    $password = "";
    $dbname = "guvi";

    $conn = mysqli_connect($server, $user, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }       

    $errors = [];
    $data = [];

    if($_POST["action"] == "signup"){
        register();
    }else if($_POST["action"] == "login"){
        login();
    }

    function register(){
        if (empty($_POST['name'])) {
            $errors['name'] = 'Name is required.';
        }
    
        if (empty($_POST['email'])) {
            $errors['email'] = 'Email is required.';
        }
    
        if (empty($_POST['password'])) {
            $errors['password'] = 'password is required.';
        }

        if (!empty($errors)) {
            $data['success'] = false;
            $data['errors'] = $errors;
            echo json_encode($data);
        }else{
            global $conn;

            $name = $_POST["name"];
            $email = $_POST["email"];
            $password = $_POST["password"];
    
            $stmt = $conn->prepare("SELECT * FROM userdb WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->store_result();
    
            if($stmt->num_rows > 0){
                $errors['verify'] = 'Account already registered';
                $data['success'] = false;
                $data['errors'] = $errors;
                echo json_encode($data);
            }else{
                $stmt_1 = $conn->prepare("INSERT INTO userdb (name, email, password) VALUES (?, ?, ?)");
                $stmt_1->bind_param("sss", $name, $email, $password);
                $stmt_1->execute();
                // echo 'registration_success';
                $stmt_1->close();
                
                if (empty($errors)) {
                    $data['success'] = true;
                    $data['message'] = 'User registered successfully';
                    echo json_encode($data);
                }
            }
            $stmt->free_result();
            $stmt->close();
        }
    }

    function login(){    
        if (empty($_POST['email'])) {
            $errors['email'] = 'Email is required.';
        }
    
        if (empty($_POST['password'])) {
            $errors['password'] = 'password is required.';
        }

        if (!empty($errors)) {
            $data['success'] = false;
            $data['errors'] = $errors;
            echo json_encode($data);
        }else{
            global $conn;
            
            $email = $_POST["email"];
            $password = $_POST['password'];

    
            $stmt = $conn->prepare("SELECT name,password FROM userdb WHERE email=?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->store_result();
            if ($stmt->num_rows > 0) {
                $stmt->bind_result($name,$pass);
                $stmt->fetch();
                if ($pass == $password) {
                    // login_success
                    if (empty($errors)) {
                        // require './redis.php';
                        $session_token = bin2hex(openssl_random_pseudo_bytes(16));
                        $data['token'] = $session_token;
                        $data['name'] = $name;
                        $data['email'] = $email;
    
                        $redis = new Predis\Client();
                        $redis->connect('127.0.0.1', 6379);

                        $redis_key =  $data['name'];
                    
                        // $redis->set($redis_key, $data['name']);
                        $redis->set($redis_key, serialize($data)); 
                        // $redis->expire($redis_key, 360);   
                        $data['redis_key'] = $redis_key;               

                        $data['success'] = true;
                        $data['message'] = 'Login successful';
                        echo json_encode($data);
                    }
                }else {
                    $errors['verify'] = 'email or password is incorrect';
                    $data['success'] = false;
                    $data['errors'] = $errors;
                    echo json_encode($data);
                    // echo 'wrong_password';
                }
            }
            else{
                $errors['verify'] = 'email or password is incorrect';
                $data['success'] = false;
                $data['errors'] = $errors;
                echo json_encode($data);
                // echo 'wrong_password';
            }
            $stmt->close();

        }

        
    }
?>