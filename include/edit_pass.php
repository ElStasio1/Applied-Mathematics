<?php require '../include/connect_db.php';
$title = "Редактирование пароля";
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

$oldpass = htmlspecialchars($_POST['oldpass']);
$pass = htmlspecialchars($_POST['pass']);
$pass_rep = htmlspecialchars($_POST['pass_repeat']);

if(empty($oldpass) || empty($pass) || empty($pass_rep)){
    header("location: ../page/profile.php?error=emptyfield");
    exit();
}
if(!password_verify($oldpass, $user['pass'])){
    header("Location: ../page/profile.php?passdontmatch1");
    exit();
}
if($pass != $pass_rep){
    header("Location: ../page/profile.php?passdontmatch2");
    exit();
}
$pass = password_hash($pass, PASSWORD_DEFAULT);
$stmt = $mysql->prepare("UPDATE users SET pass = ? WHERE id = {$_GET['id']}");

$stmt->bind_param('s', $pass);
$stmt->execute();
$stmt->close();
exit("<meta http-equiv='refresh' content='0; url= /page/profile.php?q=profile&succes'>");
