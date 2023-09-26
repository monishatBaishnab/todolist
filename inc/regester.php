<?php
include('../config/db_conn.php');
$error = [];
if (isset($_POST['registration'])) {
    $fname = filter_input(INPUT_POST, 'fname', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $lname = filter_input(INPUT_POST, 'lname', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $gender = filter_input(INPUT_POST, 'gender', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $cpassword = filter_input(INPUT_POST, 'cpassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    
    if ((!empty($fname) && '' !== $fname) 
    && (!empty($lname) && '' !== $lname) 
    && (!empty($username) && '' !== $username) 
    && (!empty($email) && '' !== $email) 
    && (!empty($gender) && '' !== $gender) 
    && (!empty($password) && '' !== $password)
    && (!empty($cpassword) && '' !== $cpassword)) {
        if ($password === $cpassword) {
            $pass_hash = md5($password);
            $query = "INSERT INTO `users`(`username`,`password`) VALUES('$username','$pass_hash')";
            $stmt = $pdo->prepare($query);
            $stmt->execute();
            $user_id = $pdo->lastInsertId();
            $query = "INSERT INTO `profile`(`user_id`, `first_name`, `last_name`, `email`, `gender`) VALUES ('$user_id','$fname','$lname','$email','$gender')";
            $stmt = $pdo->prepare($query);
            $stmt->execute();
            header('location: ../index.php');
        } else {
            $error = 'Confirm Password not match.';
            header("location: ../index.php?error=$error");
        }
    } else {
        $error = 'Please fill all field.';
        header("location: ../index.php?error=$error");
    }
}
