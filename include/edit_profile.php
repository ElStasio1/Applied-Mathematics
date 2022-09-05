<?php require '../include/connect_db.php';
$title = "Редактирование профиля";
require '../include/header_page.php';
if ($_POST["submit"] != "1") {
    header("location: ../index.php");
    exit();
}
$stmt = $mysql->prepare('SELECT * FROM users WHERE id = ?');
$stmt->bind_param('s', $_GET['id']);
$stmt->execute();
$user_info = $stmt->get_result();
$user = $user_info->fetch_assoc();
$stmt->close();

$name = htmlspecialchars($_POST['name']);
$login = htmlspecialchars($_POST['login']);
$email = htmlspecialchars($_POST['email']);
if(empty($name) || empty($login) || empty($email)){
    header("location: ../page/profile.php?error=emptyfield");
    exit();
}
$stmt = $mysql->prepare("UPDATE users SET name = ?, login = ?, email = ? WHERE id = {$_GET['id']}");

$stmt->bind_param('sss', $name, $login, $email);
$stmt->execute();
$stmt->close();
exit("<meta http-equiv='refresh' content='0; url= /page/profile.php?q=profile'>");
