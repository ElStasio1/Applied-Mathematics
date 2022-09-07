<?php
$title = "Статьи";
require '../include/header_page.php';
require '../include/connect_db.php';
$stmt = $mysql->prepare("SELECT * FROM users WHERE id = ?");
$stmt->bind_param("s", $_SESSION['id']);
$stmt->execute();
$user_info = $stmt->get_result();
$user = $user_info->fetch_assoc();

$stmt = $mysql->prepare('SELECT * FROM articles');
if (isset($_GET['get']) ?? NULL) {
  if (($_GET['get'] ?? NULL) == 'math') {
    $stmt = $mysql->prepare('SELECT * FROM articles WHERE category = "math" ORDER BY id DESC ');
  }
  if (($_GET['get'] ?? NULL) == 'mechanics') {
    $stmt = $mysql->prepare('SELECT * FROM articles WHERE category = "mechanics" ORDER BY id DESC ');
  }
  if (($_GET['get'] ?? NULL) == 'electromechanics') {
    $stmt = $mysql->prepare('SELECT * FROM articles WHERE category = "electromechanics" ORDER BY id DESC ');
  }
}



$stmt->execute();
$articles_info = $stmt->get_result();

?>
<div id="main">
  <div id="content">
    <div class="mb-3">
      <h1>Категории</h1>
      <div class="d-flex">
        <a class="nav-link" href="articles.php">Все статьи</a>
        <a class="nav-link" href="articles.php?get=math">Математика</a>
        <a class="nav-link" href="articles.php?get=mechanics">Механика</a>
        <a class="nav-link" href="articles.php?get=electromechanics">Электромеханика</a>

      </div>
    </div>
    <div class="post ">
      <div class="container-xxl">
        <div class="row">
      <?php while ($art = $articles_info->fetch_assoc()) {
         ?>
            <div class="col-sm-6">

        <h3 class="post-title"><a href="page.php?id=<?= $art['id'] ?>"><?= $art['name'] ?></a></h3>
        <h3 class="post-meta">Дата: <?= $art['data'] ?> / Категория: <?= translate_category($art['category']); ?>
        </h3>
        <p class="text-just post-lendth"><?= $art['descr'] ?></p>
        <div class="d-flex mb-5">
          <a href="page.php?id=<?= $art['id'] ?>" class="more-link me-2">Читать полность</a>

          <?php if (empty($_SESSION['id'])) { ?>
            <a href="register.php" class="more-link">Добавить в избранное</a>
          <?php } else { ?>
            <a href="../include/follow_art.php?article_id=<?= $art['id'] ?>&user_id=<?= $user['id'] ?>" class="more-link">Добавить в избранное</a>

          <?php } ?>

        </div>
          </div>
      <?php
      } ?>
    </div>
              </div>
      </div>
    <div class="post-line"></div>
  </div>

  <div id="sidebar">
    <div id="hire">
      <h3 class="sidebar-title">Остались вопросы?</h3>
      <p>Если у вас остались вопросы вы можете связаться с нами</p>
      <a class="sidebar-button" href="contact.php">Контакты</a>
    </div>
  </div>
</div>
<script id="dsq-count-scr" src="//prikladnaia-matematika.disqus.com/count.js" async></script>
<?php require '../include/footer.php'; ?>