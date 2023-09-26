<?php 
require('../config/db_conn.php');
if(isset($_POST['add_task'])){
    $task = filter_input(INPUT_POST, 'task', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $user_id = filter_input(INPUT_POST, 'user_id', FILTER_SANITIZE_SPECIAL_CHARS);
    if(!empty($task)) {
        $query = "INSERT INTO `todos`(`user_id`, `task`) VALUES ('$user_id','$task')";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        header('location: ../todos.php');
    }else{
        $error = "Please fill task Field.";
        header("location: ../todos.php?error=$error");
    }
}