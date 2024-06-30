<?php
include_once 'inc/header.php';
include_once 'inc/sidebar.php';
include_once '../lib/Session.php';
include_once '../classes/Categoryadd.php';
$ct = new Categoryadd();
$allCats = $ct->allCat();
// <!-- ---------------------------------------------------- -->

if (isset($_GET['delId'])) {

    $id = $_GET['delId'];
    $catDel = $ct->catDel($id);
}
// <!-- ---------------------------------------------------- -->
?>

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0">Dashboard/Category/List</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row d-flex justify-content-center">
                <div class="col-lg-12">

                    <!-- ---------------------------------------------------- -->
                    <?php
                    if (Session::get('Catcrt') or Session::get('Catedit') or Session::get('CateDel')) {
                    ?>
                        <span>
                            <div class="alert alert-border alert-border-info alert-dismissible fade show mb-0" role="alert">
                                <i class="uil uil-question-circle font-size-16 text-info me-2"></i>
                                <strong><?php echo  Session::get('Catcrt') ?></strong>
                                <strong><?php echo  Session::get('Catedit') ?></strong>
                                <strong><?php echo  Session::get('CateDel') ?></strong>
                            </div>
                        </span>
                    <?php
                    }
                    unset($_SESSION["Catcrt"]);
                    unset($_SESSION["Catedit"]);
                    unset($_SESSION["CateDel"]);
                    ?>
                    <!-- ---------------------------------------------------- -->

                    <div class="card shadow p-3 mb-5 bg-body-tertiary rounded">

                        <div class="card-header">
                            ALL CATEGORY
                        </div>

                        <div class="card-body">
                            <table id="datatable" class="table table-bordered dt-responsive nowrap dataTable no-footer dtr-inline" style="border-collapse: collapse; border-spacing: 0px; width: 100%;" role="grid" aria-describedby="datatable_info">
                                <thead>
                                    <tr role="row">
                                        <th class="sorting_asc" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 158px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">ID</th>

                                        <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 239px;" aria-label="Position: activate to sort column ascending">NAME</th>

                                        <th class="text-end">ACTION</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                    if (isset($allCats) && !is_bool($allCats)) {
                                        foreach ($allCats as $allCat) {
                                    ?>
                                            <tr role="row" class="odd">
                                                <td class="sorting_1 dtr-control" tabindex="0"><?= $allCat['cid'] ?></td>
                                                <td><?= $allCat['cname'] ?></td>
                                                <td class="text-end">
                                                    <a class="btn btn-sm btn-outline-primary" href="categoryEdit.php?catId=<?= $allCat['cid'] ?>">
                                                        <i class="fa-solid fa-pen-to-square"></i>
                                                    </a>
                                                    <a class="btn btn-sm btn-outline-danger" onclick="return confirm('Are You Sure')" href="?delId=<?= $allCat['cid'] ?>">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </a>
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


<?php

if (!isset($_GET['id'])) {
    echo  "<meta http-equiv='refresh' content='1.5;URL=?id=ahr'>";
}


include_once 'inc/footer.php';
?>