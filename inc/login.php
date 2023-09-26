<?php
session_start();
require('../config/db_conn.php');
$error = '';

if (isset($_POST['login'])) {
    $user = $_POST['username'];
    $password = $_POST['password'];
    
    $query = "SELECT * FROM `users` WHERE username = '$user'";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $row = $stmt->rowCount();
    if($row > 0){
        $user = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if(md5($password) === $user[0]['password']){
            $_SESSION['logedin'] = true;
            $_SESSION['user_id'] = $user[0]['id'];
            header('location: ../todos.php');
        }else{
            $error = "Password incorrect";
            header("location: ../index.php?error=$error");
        }
    }else{
        $error = "User not valid. Please provide valid username.";
        header("location: ../index.php?error=$error");
    }
}
