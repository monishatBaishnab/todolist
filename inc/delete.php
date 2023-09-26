<?php
require('../config/db_conn.php');
$delete_id = $_GET['delete'];
$query = "DELETE FROM `todos` WHERE `id` = '$delete_id'";
$stmt = $pdo->prepare($query);
$stmt->execute();
header('location: ../../index.php');
