<?php require '../include/connect_db.php';

$title = "Редактирование статей";
require '../include/header_page.php';
if ($_SESSION["status"] != "1") {
    header("location: ../index.php");
    exit();
}
$stmt = $mysql->prepare('SELECT * FROM articles WHERE id = ?');
$stmt->bind_param('s', $_GET['id']);
$stmt->execute();
$art_info = $stmt->get_result();
$art = $art_info->fetch_assoc();
$stmt->close();
if ($_POST['submit'] ?? NULL == 'submit') {
    $name = htmlspecialchars($_POST['name']);
    $descr = htmlspecialchars($_POST['descr']);
    $keywords = htmlspecialchars($_POST['keywords']);
    $text = htmlspecialchars($_POST["text"]);
    $text_comp = compile_text($text);
    $category = htmlspecialchars($_POST["category"]);
    $stmt = $mysql->prepare("UPDATE articles SET name = ?, descr = ?, text = ?, text_compl = ?, keywords = ?, category = ? WHERE id = {$_GET['id']}");

    $stmt->bind_param('ssssss', $name, $descr, $text, $text_comp, $keywords, $category);
    $stmt->execute();
    $stmt->close();
    exit("<meta http-equiv='refresh' content='0; url= /page/page.php?id={$_GET['id']}'>");
}
?>
<div class="container">
    <div class="admin-buttons">
        <button class="admin-button add-button" value="b">Жирный</button>
        <button class="admin-button add-button" value="i">Курсив</button>
        <button class="admin-button add-button" value="u">Подчеркивание</button>
        <button class="admin-button add-button" value="content">Содержание</button>
        <button class="admin-button add-button" value="left">Слева</button>
        <button class="admin-button add-button" value="right">Справа</button>
        <button class="admin-button add-button" value="center">В центре</button>
        <button class="admin-button add-button" value="quote">Цитата</button>
        <button class="admin-button add-button" value="img">Картинка</button>
        <button class="admin-button add-button" value="imgcaption">Подпись к картинке</button>
        <button class="admin-button add-button" value="list">Список</button>
        <button class="admin-button add-button" value="listelement">Элемент списка</button>
        <button class="admin-button add-button" value="table">Таблица</button>
        <button class="admin-button add-button" value="tablerow">Строка таблицы</button>
        <button class="admin-button add-button" value="tableelem">Ячейка таблицы</button>
        <button class="admin-button add-button" value="link">Ссылка</button>
        <button class="admin-button add-button" value="h1">Заголовок 1</button>
        <button class="admin-button add-button" value="h2">Заголовок 2</button>
        <button class="admin-button add-button" value="h3">Заголовок 3</button>
        <button class="admin-button add-button" value="p">Абзац</button>

    </div>
    <form method="POST" enctype="multipart/form-data">
        <input type="text" name="name" placeholder="Название статьи" value="<?= $art['name'] ?>"><br>
        <input type="text" name="descr" placeholder="Описание статьи" value="<?= $art['descr'] ?>"><br>
        <input type="text" name="keywords" value="<?= $art['keywords'] ?>" placeholder="Ключевые слова статьи"><br>
        <select name="category" id="">
            <option value="math">Математика</option>
            <option value="mechanics">Механика</option>
            <option value="electromechanics">Электромеханика</option>
        </select>

        <div>
            <label for="">Текст поста</label><br>
            <textarea class="admin-text" name="text" id="textarea" rows="30" cols="150">
                <?= $art['text'] ?>
                </textarea>
        </div>
        <button class="btn btn-success" type="submit" name="submit" value="submit">Изменить статью</button>
    </form><br>

    <button class="btn btn-info" id="compile" onclick="compile()" style="color: white">Компиляция</button>
    <div id="compiled"></div>

    <script src="../js/main.js"></script>
</div>

<?php

require '../include/footer.php' ?>