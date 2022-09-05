<?php
require "../include/connect_db.php";

$title = "Авторизация";
require "../include/header_page.php";
if (isset($_SESSION["status"])) {
    header("Location: ../index.php");
    exit();
}
?>
<div class="div_regist">
    <h1>Авторизация</h1>
    <form action="../include/login.inc.php" method="post">
        <input type="text" class="form-control mb-2" required name="login" placeholder="Логин или электронная почта">
        <input type="password" class="form-control mb-2" required name="pass" placeholder="Пароль">
        <button type="submit" name="submit" class="btn_regist" value="1">Отправить</button>
    </form>
</div>
<?php
if (isset($_GET['error'])) {
    switch ($_GET['error']) {
        case 'emptyfield':
            echo 'Не заполнены все поля';
            break;

        case 'wrongemail':
            echo 'Неверный формат электронный почты';
            break;

        case 'passworddontmatch':
            echo 'Пароли не совпадают';
            break;
        case 'usernotexists':
            echo 'Логин или почта не существует';
            break;
        case 'sqlerror':
            echo 'Произошла ошибка на сервере';
            break;

        default:
            # code...
            break;
    }
}
require "../include/footer_bottom.php";
