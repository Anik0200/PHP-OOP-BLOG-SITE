<?php
include_once 'inc/header.php';
include_once 'inc/sidebar.php';
include_once '../classes/Categoryadd.php';
$cat = new Categoryadd();

// ----------------------------------------------------

if (isset($_GET['catId'])) {

    $id = $_GET['catId'];
} else {

    header('location:categoryList.php');
}

// ----------------------------------------------------

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $catEdit =  $cat->catEdit($_POST, $id);
}

// ----------------------------------------------------
?>

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0">Dashboard/Category/edit</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row d-flex justify-content-center">
                <div class="col-lg-5">

                    <!-- ---------------------------------------------------- -->
                    <?php
                    if (isset($catEdit)) {
                    ?>
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong><?= $catEdit ?></strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php
                    }
                    ?>
                    <!-- ---------------------------------------------------- -->
                    
                    <div class="card shadow p-3 mb-5 bg-body-tertiary rounded">

                        <div class="card-header">
                            EDIT CATEGORY
                        </div>

                        <div class="card-body">

                            <?php
                            $getData = $cat->getEditcat($id);
                            if (isset($getData)) {
                                foreach ($getData as $row) {
                            ?>
                                    <form method="post">
                                        <div class="mb-3">
                                            <label class="form-label" for="formrow-firstname-input">First name</label>
                                            <input name="catEdit" value="<?= $row['cname'] ?>" type="text" class="form-control" id="formrow-firstname-input">
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