<?php
require 'include/connect_db.php';
$keywords = "прикладная математика для школьников и студентов, математика";
$description = "Сайт посвящен прикладной математике для школьников и студентов";
require 'include/header.php';
$stmt = $mysql->prepare('SELECT * FROM users WHERE id = ?');
$stmt->bind_param('s', $_SESSION['id']);
$stmt->execute();
$user_info = $stmt->get_result();
$user = $user_info->fetch_assoc();

$stmt = $mysql->prepare('SELECT * FROM articles ORDER BY id DESC LIMIT 5');
if (!$stmt) {
  header('Location: index.php?error=sqlerorr');
  exit();
}
$stmt->execute();
$articles_info = $stmt->get_result();
?>
<div id="featured-section">
  <div id="circles">
     <h1>Прикладная математика для школьников и студентов</h1>
    <img class="first" src="images/circle-red.png" />
    <img src="images/circle-pink.png" />
    <img src="images/circle-orange.png" />
    <img src="images/circle-yellow.png" />
  </div>

  <!--end circles-->
</div>
<div id="frontpage-main">

  <div id="frontpage-sidebar">
    <h3>Последние 5 статей</h3>
    <div class="container-xxl">
      <div class="row">

        <?php while ($art = $articles_info->fetch_assoc()) { ?>
          <div class="col-sm-4 ">
            <div class="me-5 mb-5">
              <a class="blog-title" href="page/page.php?id=<?= $art['id'] ?>"><?= $art['name'] ?> </a>
              <p class="meta"><?= $art['data'] ?> / Категория: <?= translate_category($art['category']);?></p>
              <p class="lengt"><?= $art['descr'] ?>
              </p>
              <div class="d-flex">
                <a href="page/page.php?id=<?= $art['id'] ?>" class="more-link me-2">Читать полность</a>
                <?php if (isset($_SESSION['status']) ?? NULL) { ?>
                  <a href="include/follow_art.php?article_id=<?= $art['id'] ?>&user_id=<?= $user['id'] ?>" class="more-link">Добавить в избранное</a>
                <?php } else { ?>
                  <a href="page/register.php" class="more-link">Добавить в избранное</a>
                <?php } ?>

              </div>
            </div>


          </div>
        <?php                      } ?>

      </div>
    </div>

  </div>
  <!--end frontpage-sidebar-->
</div>

<!--end frontpage-main-->
<?php require 'include/footer.php'; ?>