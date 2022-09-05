<?php session_start();
require "functions.php";
?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <title><?= $title ?></title>
    <meta charset="utf-8">
    <link type="text/css" rel="stylesheet" href="../styles/bootstrap.min.css">
    <link type="text/css" rel="stylesheet" href="../styles/style.css" />
    <link type="text/css" rel="stylesheet" href="../styles/skin.css" />
    <link type="text/css" rel="stylesheet" href="../styles/profile.css" />
    <meta name="keywords" content="<?= $keywords ?? NULL ?>">
    <meta name="description" content="<?= $description ?? NULL ?>">
    <link rel="icon" href="../images/favicon.ico" type="image/x-icon">
</head>

<body class="home">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a href="../index.php"><img src="../images/logo.png" /></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item ms-auto">
                        <a class="nav-link active" aria-current="page" href="../index.php">Главная </a>
                    </li>

                    <li class="nav-item ms-auto">
                        <a class="nav-link" href="articles.php">Статьи</a>
                    </li>
                    <li class="nav-item ms-auto">
                        <a class="nav-link" href="contact.php">Контакты</a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item ms-auto">
                        <form action="search.php" class="d-flex me-auto" method="post">
                            <input class="form-control mr-2" type="search" required placeholder="Поиск" name="query" aria-label="Search">
                            <button class="btn btn-outline-success" name="do_query" type="submit">Найти</button>
                        </form>
                    </li>
                    <?php if ($_SESSION['status'] ?? NULL == '1') { ?>
                        <li class="nav-item ms-auto"><a class="nav-link" href="admin_panel.php">Админ панель</a></li>
                    <?php  } ?>
                    <?php if (!isset($_SESSION['status']) ?? NULL) { ?>

                        <li class="nav-item ms-auto"><a class="nav-link" href="login.php">Войти</a></li>
                        <li class="nav-item ms-auto"><a class="nav-link" href="register.php">Зарегистрироваться</a></li>
                    <?php }
                    ?>

                    <?php ?>
                    <?php if (isset($_SESSION['status']) ?? NULL) { ?>
                        <li class="nav-item ms-auto"><a class="nav-link"><?= $_SESSION['login'] ?></a></li>
                        <li class="nav-item ms-auto"><a class="nav-link" href="profile.php">Личный кабинет</a></li>
                        <li class="nav-item ms-auto"><a class="nav-link" href="../include/logout.php">Выйти</a></li>
                    <?php  } ?>

                </ul>

            </div>
        </div>
    </nav>

    <div class="post-line"></div>