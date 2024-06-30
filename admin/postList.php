<?php
include_once 'inc/header.php';
include_once 'inc/sidebar.php';
include_once '../lib/Session.php';
include_once '../classes/Post.php';
$post = new Post();

$userid = Session::get('user_id');

$allPost = $post->allPost($userid);

// -----------------------------------------

if (isset($_GET['active'])) {

    $aId = $_GET['active'];
    $active = $post->active($aId);
}
// POST DEACTIVE END-------------------

if (isset($_GET['deactive'])) {

    $dId = $_GET['deactive'];
    $deactive = $post->deActive($dId);
}
// POST DEACTIVE END-------------------

if (isset($_GET['postDlt'])) {

    $id = $_GET['postDlt'];
    $postDel = $post->postDel($id);
}
?>

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0">Dashboard/Post/List</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row d-flex justify-content-center">
                <div class="col-lg-12">

                    <!-- Sesiion massage start  -->
                    <?php
                    if (Session::get('postCrtMsg') or Session::get('postDeact') or Session::get('postAct') or Session::get('postEditMsg') or Session::get('postDltMsg')) {
                    ?>
                        <span>
                            <div class="alert alert-border alert-border-info alert-dismissible fade show mb-0" role="alert">
                                <i class="uil uil-question-circle font-size-16 text-info me-2"></i>
                                <strong><?= Session::get('postCrtMsg') ?></strong>
                                <strong><?= Session::get('postDeact') ?></strong>
                                <strong><?= Session::get('postAct') ?></strong>
                                <strong><?= Session::get('postEditMsg') ?></strong>
                                <strong><?= Session::get('postDltMsg') ?></strong>
                            </div>
                        </span>
                    <?php
                    }
                    unset($_SESSION["postCrtMsg"]);
                    unset($_SESSION["postDeact"]);
                    unset($_SESSION["postAct"]);
                    unset($_SESSION["postEditMsg"]);
                    unset($_SESSION["postDltMsg"]);
                    ?>
                    <!-- Sesiion massage end  -->

                    <div class="card shadow p-3 mb-5 bg-body-tertiary rounded">

                        <div class="card-header">
                            ALL POST
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="datatable" class="table table-bordered dt-responsive nowrap dataTable no-footer dtr-inline" style="border-collapse: collapse; border-spacing: 0px; width: 100%;" role="grid" aria-describedby="datatable_info">
                                    <thead>
                                        <tr role="row">
                                            <th class="sorting_asc" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 158px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">ID</th>

                                            <th class="sorting_asc" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 158px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">IMAGE</th>

                                            <th class="sorting_asc" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 158px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">TITLE</th>

                                            <th class="sorting_asc" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 158px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">CATEGORY</th>

                                            <th class="sorting_asc" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 158px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">DESCRIPTION</th>

                                            <th class="sorting_asc" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 158px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">POST TYPE</th>

                                            <th class="sorting_asc" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 158px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">STATUS</th>

                                            <th class="sorting_asc" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 158px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">ACTION</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        if (isset($allPost) && !is_bool($allPost)) {
                                            foreach ($allPost as $row) {
                                        ?>

                                                <tr role="row" class="odd">
                                                    <td class="sorting_1 dtr-control" tabindex="0"><?= $row['postid'] ?></td>

                                                    <td>
                                                        <img src="../upload/<?= $row['imgOne'] ?>" alt="" width="50">
                                                    </td>

                                                    <td><?= substr($row['title'], 0, 10) . '...' ?></td>

                                                    <td><?= $row['cname'] ?></td>

                                                    <td><?= substr($row['descOne'], 0, 15) . '...' ?></td>

                                                    <td><?= $row['postType'] == 0 ? 'Post' : 'Slider' ?></td>

                                                    <td><?= $row['status'] == 0 ? 'Deactive' : 'Active' ?></td>

                                                    <td>
                                                        <!-- post modal single view s -->
                                                        <a type="button" class="btn btn-sm btn-info waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#firstmodal-<?= $row['postid'] ?>" href="">
                                                            <i class="fa-solid fa-eye"></i>
                                                        </a>
                                                        <!-- post modal single view e -->

                                                        <!-- post edit s -->
                                                        <a class="btn btn-sm btn-outline-primary" href="postEdit.php?editPost=<?= $row['postid'] ?>">
                                                            <i class="fa-solid fa-pen-to-square"></i>
                                                        </a>
                                                        <!-- post edit e -->

                                                        <!-- active deactive button s -->
                                                        <?php
                                                        if ($row['status'] == 0) {
                                                        ?>

                                                            <a href="?active=<?= $row['postid'] ?>" class="btn btn-sm btn-outline-success">
                                                                <i class="fa-solid fa-arrow-up"></i>
                                                            </a>

                                                        <?php
                                                        } else {
                                                        ?>

                                                            <a href="?deactive=<?= $row['postid'] ?>" class="btn btn-sm btn-outline-warning">
                                                                <i class="fa-solid fa-arrow-down"></i>
                                                            </a>

                                                        <?php
                                                        }
                                                        ?>
                                                        <!-- active deactive button e -->

                                                        <!-- post delete s -->
                                                        <a class="btn btn-sm btn-outline-danger" onclick="return confirm('Are You Sure')" href="?postDlt=<?= $row['postid'] ?>">
                                                            <i class="fa-solid fa-trash"></i>
                                                        </a>
                                                        <!-- post delete e -->
                                                    </td>
                                                </tr>

                                        <?php
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<style>
    .post_image h2 {
        font-size: 20px;
    }

    .post_image .img {
        align-items: center;
        margin-left: 25px;
    }

    .post_title {
        margin-top: 20px;
    }

    .post_title h2 {
        font-size: 20px;
    }

    .description {
        margin-top: 20px;
    }

    .description h2 {
        font-size: 20px;
    }

    .description p {
        margin-left: 25px;
    }

    .tags {
        margin-top: 20px;
    }

    .tags h2 {
        font-size: 20px;
    }

    .tags p {
        margin-left: 25px;
    }
</style>

<?php

$modelData = $post->modelData();

if ($modelData) {
    foreach ($modelData as $mrow) {
?>
        <div class="modal fade" id="firstmodal-<?= $mrow['postid'] ?>" aria-hidden="true" aria-labelledby="..." tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Post Creator - <?= $mrow['name'] ?></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">

                        <div class="post_image">
                            <h2>Post images - </h2>
                            <div class="img">
                                <img class="rounded" src="../upload/<?= $mrow['imgOne'] ?>" alt="" width="200">
                                <img class="rounded" src="../upload/<?= $mrow['imgTwo'] ?>" alt="" width="200">
                            </div>
                        </div>

                        <div class="post_title">
                            <h2>Post Title - <?= $mrow['title'] ?></h2>
                        </div>

                        <div class="description">
                            <h2>Post Descriptions -</h2>
                            <div class="desc">
                                <p><?= $mrow['descOne'] ?></p>
                                <p><?= $mrow['descTwo'] ?></p>
                            </div>
                        </div>

                        <div class="tags">
                            <h2>Post Descriptions -</h2>
                            <div class="tag">
                                <p><?= $mrow['tags'] ?></p>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
<?php
    }
}

?>

<?php

if (!isset($_GET['id'])) {
    echo  "<meta http-equiv='refresh' content='1.5;URL=?id=ahr'>";
}

include_once 'inc/footer.php';
?>