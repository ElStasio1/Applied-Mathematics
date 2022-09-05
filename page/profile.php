<?php
require '../include/connect_db.php';
$title = 'Личный кабинет';
require '../include/header_page.php';

?>

<div id="frontpage-main m-auto">

  <div id="frontpage-sidebar">
    <div class="container-xxl">
      <div class="row ">
        <ul class="nav">
          <li class="nav-item me-5 mb-2 m-auto"><a class="btn more-link-profile  <?php echo ($_GET["q"] ?? null) == "" ? "active" : ""; ?>" href="profile.php">Избранные статьи</a></li>
          <li class="nav-item ms-5 mb-2 m-auto"><a class="btn more-link-profile  <?php echo ($_GET["q"] ?? null) == "profile" ? "active" : ""; ?>" href="?q=profile">Информация о себе</a></li>
        </ul>
        <?php if (($_GET['q'] ?? NULL) == "") {
          $stmt = $mysql->prepare('SELECT * FROM liked_articles WHERE user_id = ?');
          $stmt->bind_param('s', $_SESSION['id']);
          $stmt->execute();
          $follow_info = $stmt->get_result(); ?>
          <h3>Избранные статьи</h3>
          <?php
          while ($follow = $follow_info->fetch_assoc()) { ?>

            <div class="col-sm-4 ">
              <div class="me-4 mb-5">
                <a class="blog-title" href="page/page.php?id=<?= $follow['id'] ?>"><?= $follow['name'] ?> </a>
                <p class="meta"><?= $follow['data'] ?> / <a href="#">Коментариев: <?= $follow['comments'] ?></a></p>
                <p class="lengt"><?= $follow['descr'] ?>
                </p>
                <a class="read-more" href="page/page.php?id=<?= $follow['id'] ?>">Читать полностью</a>
              </div>
            </div>
          <?php                      }
  require '../include/footer.php';
        }

        if (($_GET['q'] ?? NULL) == "profile") {
          $stmt = $mysql->prepare("SELECT * FROM users WHERE id = ?");
          $stmt->bind_param("s", $_SESSION['id']);
          $stmt->execute();
          $user_info = $stmt->get_result();
          $user = $user_info->fetch_assoc(); ?>
          <div class="block-profile m-auto">
            <div class="profile-items ">
              <h3 class="me-5">Имя: <?= $user['name'] ?></h3>
              <h3>Логин: <?= $user['login'] ?></h3>
              <h3>Почта: <?= $user['email'] ?></h3>
              <a class="btn more-link-profile mb-2" href="?q=editprofile">Изменить</a>
              <a class="btn more-link-profile mb-2" href="?q=editpass">Изменить пароль</a>

            </div>
          </div>

        <?php require '../include/footer_bottom.php'; }
        if (($_GET['q'] ?? NULL) == "editprofile") {
          $stmt = $mysql->prepare("SELECT * FROM users WHERE id = ?");
          $stmt->bind_param("s", $_SESSION['id']);
          $stmt->execute();
          $user_info = $stmt->get_result();
          $user = $user_info->fetch_assoc(); ?>


          <div class="div_regist">
            <h1>Изменение данных</h1>
            <form action="../include/edit_profile.php?id=<?= $user['id'] ?>" method="post">
              <input type="text" class="form-control mb-2" required name="name" value="<?= $user['name'] ?>" placeholder="Имя">
              <input type="text" class="form-control mb-2" required name="login" value="<?= $user['login'] ?>" placeholder="Логин">
              <input type="email" class="form-control mb-2" required name="email" value="<?= $user['email'] ?>" placeholder="Электронная почта">
              <button type="submit" name="submit" class="btn_regist" value="1">Отправить</button>
              <?php require '../include/footer_bottom.php';
          if (isset($_GET['error'])) {
                switch ($_GET['error']) {
                  case 'emptyfield':
                    echo 'Не заполнены все поля';
                    break;

                  default:
                    # code...
                    break;
                }
              } ?>
            </form>
          </div>
        <?php require '../include/footer_bottom.php'; }
        if (($_GET['q'] ?? NULL) == "editpass") {
          $stmt = $mysql->prepare("SELECT * FROM users WHERE id = ?");
          $stmt->bind_param("s", $_SESSION['id']);
          $stmt->execute();
          $user_info = $stmt->get_result();
          $user = $user_info->fetch_assoc(); ?>


          <div class="div_regist">
            <h1>Изменение Пароля</h1>
            <form action="../include/edit_pass.php?id=<?= $user['id'] ?>" method="post">
              <input type="password" class="form-control mb-2" required name="oldpass" placeholder="Старый пароль">
              <input type="password" class="form-control mb-2" required name="pass" placeholder="Пароль">
              <input type="password" class="form-control" required name="pass_repeat" placeholder="Повтор пароля">
              <button type="submit" name="submit" class="btn_regist" value="1">Отправить</button>
              <?php  if (isset($_GET['error'])) {
              switch ($_GET['error']) {
                case 'emptyfield':
                  echo 'Не заполнены все поля';
                  break;

                case 'passdontmatch1':
                  echo 'Пароли не совпадают';
                  break;

                default:
                  # code...
                  break;
              }
            } 
        } require '../include/footer_bottom.php';?>
            </form>
          </div>
      </div>
    </div>
  </div>
  <!--end frontpage-sidebar-->
</div>


