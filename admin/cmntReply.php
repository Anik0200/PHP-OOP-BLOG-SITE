<?php
include_once 'inc/header.php';
include_once 'inc/sidebar.php';
include_once '../classes/Comment.php';
$cmt = new Comment();


if (isset($_GET['cmntReply'])) {
    $cmtId = $_GET['cmntReply'];
    $cmntForform = $cmt->cmntForform($cmtId);
}

// -----------------------------------------

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $replyCmt = $cmt->replyCmt($_POST, $cmtId);
}
// COMMENT REPLY REQUEST END
?>

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0">Dashboard/Comment/Reply</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row d-flex justify-content-center">
                <div class="col-lg-5">

                    <!-- massage start -->
                    <?php
                    if (isset($replyCmt)) {
                    ?>
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong><?= $replyCmt ?></strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php
                    }
                    ?>
                    <!-- massage end -->

                    <div class="card shadow p-3 mb-5 bg-body-tertiary rounded">

                        <div class="card-header">
                            COMMENT REPLY
                        </div>

                        <div class="card-body">
                            <?php
                            if ($cmntForform) {
                                foreach ($cmntForform as $val) {
                            ?>
                                    <form method="post">
                                        <div class="mb-3">
                                            <label class="form-label" for="formrow-firstname-input">Message Here*</label>
                                            <textarea class="form-control" name="admin_reply" cols="10" rows="5"><?= $val['admin_reply'] ?></textarea>
                                        </div>

                                        <div class="mt-4">
                                            <button type="submit" class="btn btn-primary w-md">Submit</button>
                                        </div>
                                    </form>
                            <?php
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<?php
include_once 'inc/footer.php';
?>