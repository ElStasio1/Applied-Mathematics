<?php
$title = "Поиск";
require '../include/header_page.php'; // подключаем шапку проекта
require "../include/connect_db.php"; // подключаем файл для соединения с БД

$query = $_POST['query'];

$stmt = $mysql->prepare('SELECT * FROM articles Where name like "%' . $query . '%" or descr like "%' . $query . '%" ');
$stmt->execute();
$articles_info = $stmt->get_result();
$art = mysqli_num_rows($articles_info);
if ($art == 0) { ?>
    <h4>По запросу ничего не найдено</h4>
<?php  } ?>


<div class=" container">
    <div class="row">
        <div id="main">
            <div id="content">
                <div class="post ">
                    <?php while ($art = $articles_info->fetch_assoc()) { ?>

                        <h3 class="post-title"><a href="page.php?id=<?= $art['id'] ?>"><?= $art['name'] ?></a></h3>
                        <h3 class="post-meta"><?= $art['data'] ?> / </a>Коментариев: <?php $art['comments'] ?>
                        </h3>
                        <p><?= $art['descr'] ?> <a href="page.php?id=<?= $art['id'] ?>" class="more-link">Читать полность</a></p>
                    <?php                      } ?>
                </div>
            </div>
        </div>


    </div>
</div>