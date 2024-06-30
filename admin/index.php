<?php
include_once 'inc/header.php';
include_once 'inc/sidebar.php';

include_once '../classes/Post.php';
$post = new Post();

include_once '../classes/Categoryadd.php';
$category = new Categoryadd();

include_once '../classes/Comment.php';
$comment = new Comment();

$allUsers = $post->allUser();
$totalCats = $category->totalCat();

if (Session::get('user_id')) {
    $userId = Session::get('user_id');
    $activePosts = $post->totalActivePost($userId);
    $activeCmnts = $comment->totalActiveCmnt($userId);
}

?>

<!-- Start main content-->

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0">Dashboard</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">

                <div class="col-md-6 col-xl-3">
                    <?php
                    if (isset($allUsers) && !is_bool($allUsers)) {
                        $totalUser = mysqli_num_rows($allUsers);
                    ?>
                        <div class="card">
                            <div class="card-body">
                                <div class="float-end mt-2">
                                    <div id="total-revenue-chart"></div>
                                </div>
                                <div>
                                    <h4 class="mb-1 mt-1"><span data-plugin="counterup"><?= $totalUser ?></span></h4>
                                    <p class="text-muted mb-0">Total User</p>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>
                <!-- end col-->

                <div class="col-md-6 col-xl-3">
                    <?php
                    if (isset($totalCats) && !is_bool($totalCats)) {
                        $totalcat = mysqli_num_rows($totalCats);
                    ?>
                        <div class="card">
                            <div class="card-body">
                                <div class="float-end mt-2">
                                    <div id="orders-chart"></div>
                                </div>
                                <div>
                                    <h4 class="mb-1 mt-1"><span data-plugin="counterup"><?= $totalcat ?></span></h4>
                                    <p class="text-muted mb-0">Total Category</p>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>
                <!-- end col-->

                <div class="col-md-6 col-xl-3">
                    <?php
                    if (isset($activePosts) && !is_bool($activePosts)) {
                        $activePost = mysqli_num_rows($activePosts);
                    ?>
                        <div class="card">
                            <div class="card-body">
                                <div class="float-end mt-2">
                                    <div id="customers-chart"></div>
                                </div>
                                <div>
                                    <h4 class="mb-1 mt-1"><span data-plugin="counterup"><?= $activePost ?></span></h4>
                                    <p class="text-muted mb-0">Total Active Post</p>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>
                <!-- end col-->

                <div class="col-md-6 col-xl-3">
                    <?php
                    if (isset($activeCmnts) && !is_bool($activeCmnts)) {
                        $activeCmnt = mysqli_num_rows($activeCmnts);
                    ?>
                        <div class="card">
                            <div class="card-body">
                                <div class="float-end mt-2">
                                    <div id="growth-chart"></div>
                                </div>
                                <div>
                                    <h4 class="mb-1 mt-1"><span data-plugin="counterup"><?= $activeCmnt ?></span></h4>
                                    <p class="text-muted mb-0">Total Comment</p>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>
                <!-- end col-->
            </div>
            <!-- end row-->


        </div>
        <!-- container-fluid -->
    </div>
    <!-- End Page-content -->

    <?php
    include_once 'inc/footer.php';
    ?>