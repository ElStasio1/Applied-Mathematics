<?php
require "../include/connect_db.php";

$sql_users = "CREATE TABLE IF NOT EXISTS users(
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    login VARCHAR(100),
    email VARCHAR(100),
    pass VARCHAR(100),
    status VARCHAR(100) 
);";
$sql_articles = "CREATE TABLE IF NOT EXISTS articles(
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    descr TEXT,
    text TEXT,
    text_compl TEXT,
    comments INT,
    data DATETIME
);";
$sql_liked_articles = "CREATE TABLE IF NOT EXISTS liked_articles(
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    descr TEXT,
    text TEXT,
    text_compl TEXT,
    comments INT,
    data VARCHAR(255),
    art_id INT,
    user_id INT
);";
$mysql -> query($sql_users);
$mysql -> query($sql_articles);
$mysql -> query($sql_liked_articles);

header("Location: ../index.php");
exit();