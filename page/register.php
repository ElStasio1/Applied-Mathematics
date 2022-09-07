<?php
require "../include/connect_db.php";
$title = "Регистрация";
require "../include/header_page.php";
if (isset($_SESSION["status"])) {
    header("location: ../index.php");
    exit();
}
?>
<div class="div_regist">
    <h1>Регистрация</h1>
    <form action="../include/register.inc.php" method="post">
        <input type="text" class="form-control mb-2" required name="name" placeholder="Имя">
        <input type="text" class="form-control mb-2" required name="login" placeholder="Логин">
        <input type="email" class="form-control mb-2" required name="email" placeholder="Электронная почта">
        <input type="password" class="form-control mb-2" required name="pass" placeholder="Пароль">
        <input type="password" class="form-control" required name="pass_repeat" placeholder="Повтор пароля">
        <button type="submit" name="submit" class="btn_regist" value="1">Отправить</button>
    </form>
</div>
<?php
if (isset($_GET['error'])) {
    switch ($_GET['error']) {
        case 'emptyfield':
            echo 'Не заполнены все поля';
            break;

        case 'passdontmatch':
            echo 'Пароли не совпадают';
            break;

        case 'wrongemail':
            echo 'Неверный формат электронный почты';
            break;

        case 'sqlerror':
            echo 'Произошла ошибка на сервере';
            break;

        case 'userisexists':
            echo 'Электронаня почта или логин уже заняты';
            break;

        case 'wrongname':
            echo 'В имени должны быть такие символы как: весь русский алфавит с маленькой и большой буквы';
            break;

        case 'wronglogin':
            echo 'В логине должны быть такие символы как: весь латинский алфавит с маленькой и большой буквы, цифры от 0 до 9, тире и дефис';
            break;

        case 'wrongpass':
            echo 'В пароле должны быть такие символы как: весь латинский алфавит с маленькой и большой буквы, цифры от 0 до 9, тире и дефис';
            break;
        default:
            # code...
            break;
    }
}
if (isset($_GET['register'])) {
    echo 'Вы успешно зарегистрировались';
}
require "../include/footer_bottom.php";
