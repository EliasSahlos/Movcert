<?php
session_start();
require('config.php');
$username = $_POST["username"];
$password = $_POST["password"];

    $query = mysqli_query($sql, 'SELECT * FROM users WHERE username="'. $username .'"');
    $row = mysqli_fetch_assoc($query);
    if(password_verify($password, $row["password"])){
        $_SESSION["id"] = $row["id"];
        header("Location: ../../admin-panel/admin.php");
    } else {
        header("Location: ../login.php?error=true");
    }

