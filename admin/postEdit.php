<?php
include_once 'inc/header.php';
include_once 'inc/sidebar.php';
include_once '../classes/Post.php';
$post = new Post();
$allCats = $post->allCat();

// <!------------------ -->
if (isset($_GET['editPost'])) {
    $id = $_GET['editPost'];
    $getPost = $post->getPostForEdit($id);
}

// <!------------------ -->

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $postEdit = $post->editPost($_POST, $_FILES, $id);
    var_dump($_FILES) ;
}

// <!------------------ -->
?>

<!------------------ -->
<style>
    .error {
        margin-top: 2px;
        color: #FD6F6F;
    }
</style>
<!------------------ -->

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0">Dashboard/Post/Edit</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row d-flex justify-content-center">
                <div class="col-lg-12">
                    <div class="card shadow p-3 mb-5 bg-body-tertiary rounded">

                        <!------------------ -->
                        <?php
                        if (isset($postEdit)) {
                        ?>
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong><?= $postEdit ?></strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php
                        }
                        ?>
                        <!------------------ -->

                        <div class="card-header">
                            EDIT POST
                        </div>

                        <div class="card-body">
                            <?php
                            if ($getPost) {
                                foreach ($getPost as $gRow) {
                                    # code...

                            ?>
                                    <form method="post" enctype="multipart/form-data">

                                        <div class="mb-3">
                                            <label class="form-label" for="formrow-firstname-input">Title</label>
                                            <input value="<?= $gRow['title'] ?>" name="title" type="text" class="form-control" id="formrow-firstname-input">
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label" for="formrow-firstname-input">Tags</label>
                                            <input value="<?= $gRow['tags'] ?>" name="tags" type="text" class="form-control" id="formrow-firstname-input">
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label" for="formrow-firstname-input">Post Type</label>
                                            <select class="form-select" name="postType">
                                                <option selected disabled>Select</option>
                                                <option <?= $gRow['postType'] == 1 ? 'selected' : '' ?> value="1">Slider</option>
                                                <option <?= $gRow['postType'] == 0 ? 'selected' : '' ?> value="0">Post</option>
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label" for="formrow-firstname-input">Select Category</label>
                                            <select class="form-select" name="catId">
                                                <option selected disabled>Select</option>

                                                <?php
                                                if (isset($allCats) && !is_bool($allCats)) {
                                                    foreach ($allCats as $allCat) {
                                                ?>
                                                        <option <?= $gRow['catId'] == $allCat['cid'] ? 'selected' : '' ?> value="<?= $allCat['cid'] ?>">
                                                            <?= $allCat['cname'] ?>
                                                        </option>
                                                <?php
                                                    }
                                                }
                                                ?>

                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label" for="formrow-firstname-input">First Image</label>
                                            <input value="<?= $gRow['imgOne'] ?>" name="imgOne" type="file" class="form-control" id="formrow-firstname-input">
                                            <img class="rounded mt-2" src="../upload/<?= $gRow['imgOne'] ?>" alt="" width="50">
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label" for="formrow-firstname-input">Second Imaage</label>
                                            <input value="<?= $gRow['imgTwo'] ?>" name="imgTwo" type="file" class="form-control" id="formrow-firstname-input">
                                            <img class="rounded mt-2" src="../upload/<?= $gRow['imgTwo'] ?>" alt="" width="50">
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label" for="formrow-firstname-input">First Description</label>
                                            <textarea name="descOne" class="form-control" rows="5"><?= $gRow['descOne'] ?></textarea>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label" for="formrow-firstname-input">Second Description</label>
                                            <textarea name="descTwo" class="form-control" rows="5"><?= $gRow['descTwo'] ?></textarea>
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