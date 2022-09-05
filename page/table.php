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
$mysql -> query($sql_users);
$mysql -> query($sql_articles);

header("Location: index.php");
exit();