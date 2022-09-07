<?php
require '../include/connect_db.php';
$title = "Админ панель";
require '../include/header_page.php';
if($_SESSION["status"] != "1"){
    header("location: ../index.php");
    exit();
}
$stmt = $mysql->prepare("SELECT * FROM articles");
$stmt->execute();
$articles_info = $stmt->get_result();
if (isset($_GET['del_id'])) { //проверка наличия id статьи для удаления
    $stmt = $mysql->prepare("DELETE  FROM articles WHERE id = {$_GET['del_id']}"); //удаляем строку
    $stmt->execute();
    header("location: admin_panel.php");
}

?>

<div class="container">
    <table class="table">
        <thead>
            <tr>
                <h1 class="text-center">Статьи</h1>

                <td>Номер статьи</td>
                <td>Название статьи</td>
                <td>Описание статьи</td>
            </tr>
        </thead>
        <tbody>
            <?php while ($art = $articles_info->fetch_assoc()) {
            ?>
                <tr>

                    <td><?= $art['id'] ?></td>
                    <td><?= $art['name'] ?></td>
                    <td><?= $art['descr'] ?></td>
                    <td><a href='?del_id=<?= $art['id'] ?>'>Удалить</a></td>
                    <td><a href='edit_art.php?id=<?= $art['id'] ?>'>Изменить</a></td>

                </tr>
            <?php }  ?>

        </tbody>

    </table>
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
    <form action="../include/constructor.inc.php" method="POST" enctype="multipart/form-data">
        <input type="text" name="name" placeholder="Название статьи"><br>
        <input type="text" name="descr" placeholder="Описание статьи"><br>
        <input type="text" name="keywords" placeholder="Ключевые слова статьи"><br>
        <select name="category" id="">
            <option value="math">Математика</option>
            <option value="mechanics">Механика</option>
            <option value="electromechanics">Электромеханика</option>
        </select>

        <div>
            <label for="">Текст поста</label><br>
            <textarea class="admin-text" name="text" id="textarea" rows="30" cols="150">
[content]
[b]Жирный[/b]
[i]Наклон[/i]
[u]Подчеркнивание[/u]
[b][/b][i]Всё вместе[/i][u][/u]
[left]Слева[/left]
[right]Справа[/right]
[center]Центр[/center]
[quote]Динннннная цитата[/quote]
[img url='https://avatarfiles.alphacoders.com/124/124420.jpg']кот[/img]
[imgcaption]Это кот, да[/imgcaption]
Список
[list]
[*]1[/*]
[*]2[/*]
[*]3[/*]
[*]4[/*]
[*]5[/*]
[/list]
[table]
[tablerow][tableelem]1[/tableelem][tableelem]2[/tableelem][tableelem]3[/tableelem][/tablerow]
[tablerow][tableelem]Элемент 1[/tableelem][tableelem]Элемент 2[/tableelem][tableelem]Элемент 3[/tableelem][/tablerow]
[tablerow][tableelem]Элемент 1[/tableelem][tableelem]Элемент 2[/tableelem][tableelem]Элемент 3[/tableelem][/tablerow]
[/table]

[h1]h1[/h1]
[h2]h2[/h2]
[h3]h3[/h3]
[link url='https://youtu.be/hTLz5k-3R9s?t=88'|]Ссылка на что угодно[/link]
[/content]
                </textarea>
        </div>
        <button class="btn btn-success" type="submit" name="submit" value="submit">Создать статью</button>
    </form><br>

    <button class="btn btn-info" id="compile" onclick="compile()" style="color: white;">Компиляция</button>
    <div id="compiled"></div>

    <script src="js/main.js"></script>
</div>
<?php require '../include/footer.php' ?>