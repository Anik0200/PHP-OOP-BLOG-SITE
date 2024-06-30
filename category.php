<?php
include_once 'inc/header.php';
include_once 'classes/Post.php';
include_once 'classes/Categoryadd.php';
$cat  = new Categoryadd();
$post = new Post();

if (isset($_GET['catId'])) {
  $catId = $_GET['catId'];
}

$catForcat  = $cat->catForcat($catId);

?>

<section class="site-section pt-5">
  <div class="container">
    <div class="row mb-4">
      <div class="col-md-6">
        <?php
        if (isset($catForcat) && !is_bool($catForcat)) {
          foreach ($catForcat as $cvVal) {
        ?>
            <h2 class="mb-4">Category: <?= $cvVal['cname'] ?></h2>
        <?php
          }
        }
        ?>
      </div>
    </div>

    <div class="row blog-entries">
      <div class="col-md-12 col-lg-12 main-content">
        <div class="row mb-5 mt-5">
          <div class="col-md-12">

            <?php
            $limit = 4;
            if (isset($_GET['page'])) {
              $page = $_GET['page'];
            } else {
              $page = 1;
            }
            $offSet = ($page - 1) * $limit;

            $postForcat = $post->postForcat($catId, $offSet, $limit);

            if (isset($postForcat) && !is_bool($postForcat)) {
              foreach ($postForcat as $pVal) {
            ?>
                <div class="post-entry-horzontal">
                  <a href="blog-single.php?singlePost=<?= $pVal['postid'] ?>">
                    <div class="image element-animate" data-animate-effect="fadeIn" style="background-image: url(upload/<?= $pVal['imgOne'] ?>);"></div>
                    <span class="text">
                      <div class="post-meta">
                        <span class="author mr-2"><img src="images/png-transparent-2.png" alt="Colorlib"> <?= $pVal['name'] ?></span>&bullet;
                        <span class="mr-2"><?= date("M d,Y", strtotime($pVal['create_time'])) ?></span> &bullet;
                        <span class="mr-2"><?= $pVal['cname'] ?></span> &bullet;
                      </div>
                      <h2><?= substr($pVal['title'], 0, 30) ?></h2>
                    </span>
                  </a>
                </div>
            <?php
              }
            }
            ?>
            <!-- END post -->

          </div>
        </div>

        <div class="row mt-5">
          <div class="col-md-12 text-center">
            <nav aria-label="Page navigation" class="text-center">

              <?php
              $num_page = $post->numCatPost($catId);
              if ($num_page) {
                $total_record = mysqli_num_rows($num_page);
                $total_page = ceil($total_record / $limit);
              }
              ?>

              <ul class="pagination">

                <?php
                if ($page > 1) {
                ?>
                  <li class="page-item"><a class="page-link" href="<?= $_SERVER['REQUEST_URI'] ?>&page=<?= $page - 1 ?>">&lt;</a></li>
                <?php
                }
                ?>

                <?php
                for ($i = 1; $i <= $total_page; $i++) {
                  if ($i == $page) {
                    $active = 'active';
                  } else {
                    $active = '';
                  }
                ?>
                  <li class="page-item <?= $active ?>"><a class="page-link" href="<?= $_SERVER['REQUEST_URI'] ?>&page=<?= $i ?>"><?= $i ?></a></li>
                <?php
                }
                ?>

                <?php
                if ($page < $total_page) {
                ?>
                  <li class="page-item"><a class="page-link" href="<?= $_SERVER['REQUEST_URI'] ?>&page=<?= $page + 1 ?>">&gt;</a></li>
                <?php
                }
                ?>

              </ul>
            </nav>
          </div>
        </div>

      </div>
      <!-- END main-content -->

      <?php
      // include_once 'inc/sidebar.php';
      ?>
      <!-- END sidebar -->

    </div>
  </div>
</section>

<?php
include_once 'inc/footer.php';
?>