<?php 
try {
    $pdo = new PDO("mysql:host=localhost;dbname=todolist", 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Successfully Connected";
} catch (Exception $e) {
    echo "Error".$e->getMessage();
}