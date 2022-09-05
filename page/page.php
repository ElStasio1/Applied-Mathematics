<?php
require '../include/connect_db.php';

$stmt = $mysql->prepare('SELECT * FROM articles WHERE id = ?');
$stmt->bind_param('s', $_GET['id']);
$stmt->execute();
$articles_info = $stmt->get_result();
$art = $articles_info->fetch_assoc();
$keywords  = $art['keywords'];
$description = $art['descr'];
$title = $art['name'];
require '../include/header_page.php';

?>

<div id="main">
  <div class="container">
    <div class="post">
      <h3 class="page-title"><a href="page.php?id=<?= $art['id'] ?>"><?= $art['name'] ?></a></h3>
      <div class="d-flex">
        <h3 class="post-meta"><?= $art['data'] ?> / <span class="disqus-comment-count ms-2 me-4" data-disqus-url="http://prikladnayamatematika.ru/page/page.php?id=<?= $art['id'] ?>">First article</span>
        </h3>
        <?php if (empty($_SESSION['id'])) { ?>
          <a href="register.php" class="more-link-page">Добавить в избранное</a>
        <?php } else { ?>
          <a href="../include/follow_art.php?article_id=<?= $art['id'] ?>&user_id=<?= $user['id'] ?>" class="more-link-page">Добавить в избранное</a>

        <?php } ?>
      </div>
      
      <?= $art['text_compl'] ?>
    </div>
    <!--end post-->
    <div class="post-line"></div>
  <div id="disqus_thread"></div>
<script>
    /**
    *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
    *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables    */
    
    var disqus_config = function () {
    this.page.url = 'http://prikladnayamatematika.ru/page/page.php?id=<?= $art['id'] ?>';  // Replace PAGE_URL with your page's canonical URL variable
    this.page.identifier = 'page/page.php?id=<?= $art['id'] ?>'; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
    };
    
    (function() { // DON'T EDIT BELOW THIS LINE
    var d = document, s = d.createElement('script');
    s.src = 'https://prikladnaia-matematika.disqus.com/embed.js';
    s.setAttribute('data-timestamp', +new Date());
    (d.head || d.body).appendChild(s);
    })();
</script>
<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
  </div>
</div>

<script id="dsq-count-scr" src="//prikladnaia-matematika.disqus.com/count.js" async></script>
<?php
require '../include/footer.php';
