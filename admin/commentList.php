<?php
include_once 'inc/header.php';
include_once 'inc/sidebar.php';
include_once '../lib/Session.php';
include_once '../classes/Comment.php';

$cmt = new Comment();

$userid   = Session::get('user_id');
$adminCmt = $cmt->adminCmt($userid);

if (isset($_GET['active'])) {
    $aId = $_GET['active'];
    $active = $cmt->active($aId);
}
// POST ACTIVE END-------------------

if (isset($_GET['deactive'])) {
    $dId = $_GET['deactive'];
    $deactive = $cmt->deActive($dId);
}
// POST DEACTIVE END-------------------

if (isset($_GET['cmtDlt'])) {
    $delId = $_GET['cmtDlt'];
    $dellCmt = $cmt->dellCmt($delId);
}
?>

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0">Dashboard/Comment/List</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row d-flex justify-content-center">
                <div class="col-lg-12">

                    <!-- Sesiion massage start  -->
                    <?php
                    if (Session::get('cmyDeact') or Session::get('cmyAct') or Session::get('cmyDell') or Session::get('cmyReply')) {
                    ?>
                        <span>
                            <div class="alert alert-border alert-border-info alert-dismissible fade show mb-0" role="alert">
                                <i class="uil uil-question-circle font-size-16 text-info me-2"></i>
                                <strong><?= Session::get('cmyDeact') ?></strong>
                                <strong><?= Session::get('cmyAct') ?></strong>
                                <strong><?= Session::get('cmyDell') ?></strong>
                                <strong><?= Session::get('cmyReply') ?></strong>
                            </div>
                        </span>
                    <?php
                    }
                    unset($_SESSION["cmyDeact"]);
                    unset($_SESSION["cmyAct"]);
                    unset($_SESSION["cmyDell"]);
                    unset($_SESSION["cmyReply"]);
                    ?>
                    <!-- Sesiion massage end  -->

                    <div class="card shadow p-3 mb-5 bg-body-tertiary rounded">

                        <div class="card-header">
                            ALL COMMENT
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="datatable" class="table table-bordered dt-responsive nowrap dataTable no-footer dtr-inline" style="border-collapse: collapse; border-spacing: 0px; width: 100%;" role="grid" aria-describedby="datatable_info">
                                    <thead>
                                        <tr role="row">
                                            <th class="sorting_asc" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 158px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">ID</th>

                                            <th class="sorting_asc" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 158px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">NAME</th>

                                            <th class="sorting_asc" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 158px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">EMAIL</th>

                                            <th class="sorting_asc" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 158px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">MASSAGE</th>

                                            <th class="sorting_asc" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 158px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">POST</th>

                                            <th class="sorting_asc" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 158px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">STATUS</th>

                                            <th class="sorting_asc" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 158px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">ACTION</th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                        <?php
                                        if (isset($adminCmt) && !is_bool($adminCmt)) {
                                            foreach ($adminCmt as $row) {
                                        ?>
                                                <tr role="row" class="odd">

                                                    <td><?= $row['cmtId'] ?></td>

                                                    <td><?= $row['name'] ?></td>

                                                    <td><?= substr($row['email'], 0, 15) . '...' ?></td>

                                                    <td><?= $row['message'] ?></td>

                                                    <td>#<?= $row['postid'] ?> <?= substr($row['title'], 0, 5) . '...' ?></td>

                                                    <td><?= $row['status'] == 0 ? 'Deactive' : 'Active' ?></td>

                                                    <td>
                                                        <!-- comment reply s -->
                                                        <a class="btn btn-sm btn-outline-primary" href="cmntReply.php?cmntReply=<?= $row['cmtId'] ?>">
                                                            <i class="fa-solid fa-reply"></i>
                                                        </a>
                                                        <!-- comment reply e -->

                                                        <!-- comment deactive button s -->
                                                        <?php
                                                        if ($row['status'] == 0) {
                                                        ?>

                                                            <a href="?active=<?= $row['cmtId'] ?>" class="btn btn-sm btn-outline-success">
                                                                <i class="fa-solid fa-arrow-up"></i>
                                                            </a>

                                                        <?php
                                                        } else {
                                                        ?>

                                                            <a href="?deactive=<?= $row['cmtId'] ?>" class="btn btn-sm btn-outline-warning">
                                                                <i class="fa-solid fa-arrow-down"></i>
                                                            </a>
                                                            
                                                        <?php
                                                        }
                                                        ?>
                                                        <!-- comment deactive button e -->

                                                        <!-- comment delete s -->
                                                        <a class="btn btn-sm btn-outline-danger" onclick="return confirm('Are You Sure')" href="?cmtDlt=<?= $row['cmtId'] ?>">
                                                            <i class="fa-solid fa-trash"></i>
                                                        </a>
                                                        <!-- comment delete e -->
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
<?php

if (!isset($_GET['id'])) {
    echo  "<meta http-equiv='refresh' content='1.5;URL=?id=ahr'>";
}

include_once 'inc/footer.php';
?>