<?php
include_once 'inc/header.php';
include_once 'inc/banner.php';
include_once 'classes/Post.php';
$posts = new Post();

if (!isset($_GET['search']) || $_GET['search'] == null) {
    echo "<h2 class='text-danger text-center'>NO DATA FOUND</h2>";
} else {
    $search = $_GET['search'];
}
?>
<section class="site-section py-sm">
    <div class="container">

        <div class="row">
            <div class="col-md-6">
                <h2 class="mb-4">Search Posts</h2>
            </div>
        </div>

        <div class="row blog-entries">

            <div class="col-md-12 col-lg-12 main-content">
                <div class="row">

                    <?php
                    $limit = 4;
                    if (isset($_GET['page'])) {
                        $page = $_GET['page'];
                    } else {
                        $page = 1;
                    }
                    $offSet = ($page - 1) * $limit;

                    $latestPosts = $posts->searchPost($search, $offSet, $limit);
                    if (isset($latestPosts) && !is_bool($latestPosts)) {
                        foreach ($latestPosts as $latestPost) {
                    ?>

                            <div class="col-md-6">
                                <a href="blog-single.php?singlePost=<?= $latestPost['postid'] ?>" class="blog-entry element-animate" data-animate-effect="fadeIn">
                                    <img src="<?= "upload/" . $latestPost['imgOne'] ?>" alt="Image placeholder">
                                    <div class="blog-content-body">
                                        <div class="post-meta">

                                            <span class="author mr-2">
                                                <img src="images/png-transparent-2.png" alt="Colorlib" style="width: 25px;">
                                                <?= $latestPost['name'] ?>
                                            </span>&bullet;

                                            <span class="mr-2"><?= date("M d,Y", strtotime($latestPost['create_time'])) ?></span> &bullet;
                                        </div>
                                        <h2><?= substr($latestPost['title'], 0, 30) ?></h2>
                                    </div>
                                </a>
                            </div>

                    <?php
                        }
                    } else {
                        echo "<h2 class='text-danger text-center'>NO DATA FOUND</h2>";
                    }
                    ?>
                </div>

                <div class="row mt-5">
                    <div class="col-md-12 text-center">
                        <nav aria-label="Page navigation" class="text-center">

                            <?php
                            $num_page = $post->numPost();
                            if ($num_page) {
                                $total_record = mysqli_num_rows($num_page);
                                $total_page = ceil($total_record / $limit);
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

                            <?php
                            }
                            ?>

                        </nav>
                    </div>
                </div>

            </div>
            <!-- END main-content -->

        </div>
    </div>
</section>

<?php
include_once 'inc/footer.php';
?>