<?php
include_once 'classes/Post.php';

$post = new Post();
$bannerPosts = $post->bannerPosts();
?>

<section class="site-section pt-5 pb-5">

    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <div class="owl-carousel owl-theme home-slider">

                    <?php
                    if ($bannerPosts) {
                        foreach ($bannerPosts as $value) {
                    ?>
                            <div>
                                <a href="blog-single.php?singlePost=<?= $value['postid'] ?>" class="a-block d-flex align-items-center height-lg" style="background-image: url(upload/<?= $value['imgOne'] ?>)">
                                    <div class="text half-to-full">
                                        <span class="category mb-5"><?= $value['cname'] ?></span>
                                        <div class="post-meta">

                                            <span class="author mr-2">
                                                <?= $value['name'] ?></span>&bullet;
                                            <span class="mr-2"><?= date("M d,Y", strtotime($value['create_time'])) ?></span> &bullet;

                                        </div>
                                        <h3><?= $value['title'] ?></h3>
                                    </div>
                                </a>
                            </div>
                    <?php
                        }
                    }
                    ?>

                </div>

            </div>
        </div>
    </div>

</section>
<!-- END Banner -->