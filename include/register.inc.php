<?php
if ($_POST["submit"] != "1") {
    header("location: ../index.php");
    exit();
}
$name = htmlspecialchars($_POST["name"]);
$login = htmlspecialchars($_POST["login"]);
$email = htmlspecialchars($_POST["email"]);
$pass = htmlspecialchars($_POST["pass"]);
$pass_rep = htmlspecialchars($_POST["pass_repeat"]);

if (empty($name) || empty($login) || empty($email) || empty($pass) || empty($pass_rep)) {
    header("location: ../page/register.php?error=emptyfield");
    exit();
}

if ($pass != $pass_rep) {
    header("location: ../page/register.php?error=passdontmatch");
    exit();
}
if (!preg_match('/[а-яА-Я]+/ui', $name)) {
    header("location: ../page/register.php?error=wrongname");
    exit();
}

if (!preg_match('/^[a-zA-Z0-9-_]*$/', $login)) {
    header("location: ../page/register.php?error=wronglogin");
    exit();
}
if (!preg_match('/^[a-zA-Z0-9-_]*$/', $pass)) {
    header("location: ../page/register.php?error=wrongpass");
    exit();
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header("location: ../page/register.php?error=wrongemail");
    exit();
}
require "connect_db.php";

$stmt = $mysql->prepare("SELECT * FROM users WHERE login = ? OR email = ?");
if (!$stmt) {
    header("location: ../page/register.php?error=sqlerror");
    exit();
}
$stmt->bind_param("ss", $login, $email);
$stmt->execute();
$stmt->store_result();
if ($stmt->num_rows() > 0) {
    header("location: ../page/register.php?error=userisexists");
    exit();
}
$status = "0";
$stmt = $mysql->prepare("INSERT INTO users( name, login, email, pass, status) VALUES(?, ?, ?, ?, ?)");
if (!$stmt) {
    header("location: ../page/register.php?error=sqlerror");
    exit();
}
$password = password_hash($pass, PASSWORD_DEFAULT);
$stmt->bind_param("sssss", $name, $login, $email, $password, $status);
$stmt->execute();
$stmt->store_result();
session_start();
session_reset();
$_SESSION["id"] = $stmt->insert_id;
$_SESSION["name"] = $name;
$_SESSION["login"] = $login;
$_SESSION["status"] = $status;
$_SESSION["pass"] = $password;
$stmt->close();
$mysql->close();
header("location: ../index.php?register=success");
exit();
