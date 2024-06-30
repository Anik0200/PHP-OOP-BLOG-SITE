<?php
include_once 'inc/header.php';
include_once 'classes/Post.php';
include_once 'classes/Comment.php';
$post = new Post();
$cmt = new Comment();

$latestPostSide = $post->latestPostSide();
$allCatSides = $post->allCatSides();

if (isset($_GET['singlePost'])) {
  $posId = $_GET['singlePost'];
  $single_post = $post->singlePost($posId);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $comment =  $cmt->addCmt($_POST);
}
?>

<section class="site-section py-lg">
  <div class="container">
    <div class="row blog-entries element-animate">
      <?php
      if (isset($single_post)) {
        foreach ($single_post as $post) {
      ?>
          <div class="col-md-12 col-lg-8 main-content">
            <img src="<?= "upload/" . $post['imgOne'] ?>" alt="Image" class="img-fluid mb-5">
            <div class="post-meta">
              <span class="author mr-2"><img src="images/png-transparent-2.png" alt="Colorlib" style="width: 30px;"></span>&bullet;
              <span class="mr-2"><?= date("M d,Y", strtotime($post['create_time'])) ?></span> &bullet;
              <span class="ml-2"><span class="fa fa-comments"></span> 3</span>
            </div>

            <h1 class="mb-4"><?= $post['title'] ?></h1>
            <a class="category mb-5" href="#"><?= $post['cname'] ?></a>

            <div class="post-content-body">

              <p><?= $post['descOne'] ?></p>

              <div class="row mb-5">
                <div class="col-md-12 mb-4">
                  <img src="<?= "upload/" . $post['imgTwo'] ?>" alt="Image placeholder" class="img-fluid">
                </div>
              </div>

              <p><?= $post['descTwo'] ?></p>

            </div>

            <div class="pt-5">
              <p>Tags: <a href="#"><?= $post['tags'] ?></a></p>
            </div>
            <!-- END Post -->

            <div class="pt-5">
              <?php
              $postId = $post['postid'];
              $allCmt = $cmt->allCmt($posId);

              if ($allCmt) {
                $count = mysqli_num_rows($allCmt);
              }
              ?>
              <h3 class="mb-5"><?= $count ?? '' ?> Comments</h3>
              <?php

              if ($allCmt) {
                foreach ($allCmt as $cRow) {
              ?>
                  <ul class="comment-list">
                    <li class="comment">

                      <div class="vcard">
                        <img class="mb-5" src="images/png-transparent-2.png" width="10px" alt="Image placeholder">
                      </div>

                      <div class="comment-body">
                        <h3><?= $cRow['name'] ?></h3>
                        <div class="meta"><?= date("M d,Y", strtotime($cRow['create_time'])) ?></div>
                        <p><?= $cRow['message'] ?></p>
                      </div>

                      <?php
                      if ($cRow['admin_reply']) {
                      ?>
                        <ul class="children">
                          <li class="comment">
                            <div class="vcard">
                              <img src="images/png-transparent-2.png" style="width: 15;" alt="Image placeholder">
                            </div>
                            <div class="comment-body">
                              <h3>Admin</h3>
                              <p><?= $cRow['admin_reply'] ?></p>
                            </div>
                          </li>
                        </ul>
                      <?php
                      }
                      ?>
                    </li>
                  </ul>
              <?php
                }
              }
              ?>

              <!-- END comment-list -->

              <div class="comment-form-wrap pt-5">
                <h3 class="mb-5">Leave a comment</h3>

                <!-- massage start -->
                <?php
                if (isset($comment)) {
                ?>
                  <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong><?= $comment ?>
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                <?php
                }
                ?>
                <!-- massage end -->

                <form method="post" class="p-5 bg-light">

                  <input type="hidden" name="userId" value="<?= $post['userid'] ?>">

                  <input type="hidden" name="postId" value="<?= $post['postid'] ?>">

                  <div class="form-group">
                    <label for="name">Name *</label>
                    <input type="text" class="form-control" name="name" id="name">
                  </div>

                  <div class="form-group">
                    <label for="email">Email *</label>
                    <input type="email" class="form-control" name="email">
                  </div>


                  <div class="form-group">
                    <label for="message">Message</label>
                    <textarea name="massage" id="message" cols="30" rows="10" class="form-control"></textarea>
                  </div>

                  <div class="form-group">
                    <input type="submit" value="Post Comment" class="btn btn-primary">
                  </div>

                </form>

              </div>
            </div>

          </div>
      <?php
        }
      }
      ?>
      <!-- END main-content -->

      <div class="col-md-12 col-lg-4 sidebar">

        <?php
        if (isset($single_post)) {
          foreach ($single_post as $post) {
        ?>
            <div class="sidebar-box">
              <div class="bio text-center">
                <img src="images/png-transparent-2.png" alt="Image Placeholder" class="img-fluid">
                <div class="bio-body">
                  <h2><?= $post['name'] ?></h2>
                  <p class="social">
                    <a href="#" class="p-2"><span class="fa fa-facebook"></span></a>
                    <a href="#" class="p-2"><span class="fa fa-twitter"></span></a>
                    <a href="#" class="p-2"><span class="fa fa-instagram"></span></a>
                    <a href="#" class="p-2"><span class="fa fa-youtube-play"></span></a>
                  </p>
                </div>
              </div>
            </div>
        <?php
          }
        }
        ?>
        <!-- END sidebar-Profile -->

        <div class="sidebar-box">
          <h3 class="heading">Popular Posts</h3>
          <div class="post-entry-sidebar">

            <ul>
              <?php
              if ($latestPostSide) {
                foreach ($latestPostSide as $latestPost) {
              ?>
                  <li>
                    <a href="blog-single.php?singlePost=<?= $latestPost['postid'] ?>">
                      <img src="<?= "upload/" . $latestPost['imgOne'] ?>" alt="Image placeholder" class="mr-4">
                      <div class="text">
                        <h4><?= $latestPost['title'] ?></h4>
                        <div class="post-meta">
                          <span class="mr-2"><?= date("M d,Y", strtotime($latestPost['create_time'])) ?></span>
                        </div>
                      </div>
                    </a>
                  </li>
              <?php
                }
              }
              ?>
            </ul>

          </div>
        </div>
        <!-- END sidebar-post -->

        <div class="sidebar-box">
          <h3 class="heading">Categories</h3>
          <ul class="categories">
            <?php
            if ($allCatSides) {
              foreach ($allCatSides as $allCatSide) {
            ?>
                <li><a href="category.php?catId=<?= $allCatSide['cid'] ?>"> <?= $allCatSide['cname'] ?></a></li>
            <?php
              }
            }
            ?>
          </ul>
        </div>

        <!-- END sidebar-Categories -->
      </div>

      <!-- END sidebar -->
    </div>
  </div>
</section>

<?php
include_once 'inc/footer.php';
?>