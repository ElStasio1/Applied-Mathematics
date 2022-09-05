<?php
session_start();
require 'connect_db.php';
$stmt = $mysql->prepare('SELECT * FROM users WHERE id = ?');
$stmt->bind_param('s', $_GET['user_id']);
$stmt->execute();
$user_info = $stmt->get_result();
$user = $user_info->fetch_assoc();

$stmt = $mysql->prepare('SELECT * FROM articles WHERE id = ?');
$stmt->bind_param('s', $_GET['article_id']);
$stmt->execute();
$articles_info = $stmt->get_result();
$articles = $articles_info->fetch_assoc();


$stmt = $mysql->prepare('INSERT INTO liked_articles(name, descr, text, text_compl, comments,data, art_id, user_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?)');
if(!$stmt){
    header('location: ../page/catalog.php?sqlerorr');
    exit();
}
$stmt->bind_param('ssssssss', $articles['name'], $articles['descr'], $articles['text'], $articles['text_compl'], $articles['comments'], $articles['data'], $_GET['article_id'], $_GET['user_id']);
$stmt->execute();

header('location: ../page/profile.php?success');
