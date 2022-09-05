<?php

if($_POST["submit"] != "1"){
    header("location: ../index.php");
    exit();
}

$login = htmlspecialchars($_POST["login"]);
$email = htmlspecialchars($_POST["login"]);
$pass = htmlspecialchars($_POST["pass"]);

if(empty($login) || empty($pass)){
    header("location: ../page/login.php?error=emptyfield");
    exit();
}

require "connect_db.php";

$sql = "SELECT * FROM users WHERE login=? OR email=?";
$stmt = $mysql->stmt_init();
if (!$stmt->prepare($sql)) {
    header("location: ../page/login.php?error=sqlerror");
    exit();
};
$stmt->bind_param("ss", $login, $email);
$stmt->execute();
$result= $stmt->get_result();
$user_info = $result->fetch_assoc();
$stmt->close();

if(empty($user_info)){
    header("location: ../page/login.php?error=passworddontmatch");
    exit(); 
}
if(!password_verify($pass, $user_info['pass'])){
    header("location: ../page/login.php?error=passworddontmatch");
    exit(); 
}
session_start();
session_reset();
$_SESSION["id"] = $user_info["id"];
$_SESSION["name"] = $user_info["name"];
$_SESSION["login"] = $user_info["login"];
$_SESSION["status"] = $user_info["status"];
header("location: ../index.php?login=success");
exit(); 

