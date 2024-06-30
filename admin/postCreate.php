<?php
include_once 'inc/header.php';
include_once 'inc/sidebar.php';
include_once '../classes/Post.php';
$post = new Post();
$allCats = $post->allCat();
// <!-- ---------------------------------------------------- -->

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $postData = $post->addPost($_POST, $_FILES);
}

// <!-- ---------------------------------------------------- -->
?>

<!-- ---------------------------------------------------- -->
<style>
    .error {
        margin-top: 2px;
        color: #FD6F6F;
    }
</style>
<!-- ---------------------------------------------------- -->

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0">Dashboard/Post/Create</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row d-flex justify-content-center">
                <div class="col-lg-12">
                    <div class="card shadow p-3 mb-5 bg-body-tertiary rounded">

                        <!-- ---------------------------------------------------- -->
                        <?php
                        if (isset($postData)) {
                        ?>
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong><?= $postData ?></strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php
                        }
                        ?>
                        <!-- ---------------------------------------------------- -->

                        <div class="card-header">
                            ADD POST
                        </div>

                        <div class="card-body">
                            <form method="post" enctype="multipart/form-data">

                                <div class="mb-3">
                                    <label class="form-label" for="formrow-firstname-input">Title</label>
                                    <input name="title" type="text" class="form-control" id="formrow-firstname-input">
                                    <input value="<?= Session::get('user_id') ?>" name="userid" type="text" hidden>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="formrow-firstname-input">Tags</label>
                                    <input name="tags" type="text" class="form-control" id="formrow-firstname-input">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="formrow-firstname-input">Post Type</label>
                                    <select class="form-select" name="postType">
                                        <option selected disabled>Select</option>
                                        <option value="1">Slider</option>
                                        <option value="0">Post</option>
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
                                                <option value="<?= $allCat['cid'] ?>"><?= $allCat['cname'] ?></option>
                                        <?php
                                            }
                                        }
                                        ?>

                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="formrow-firstname-input">First Image</label>
                                    <input name="imgOne" type="file" class="form-control" id="formrow-firstname-input">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="formrow-firstname-input">Second Imaage</label>
                                    <input name="imgTwo" type="file" class="form-control" id="formrow-firstname-input">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="formrow-firstname-input">First Description</label>
                                    <textarea name="descOne" class="form-control" rows="5"></textarea>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="formrow-firstname-input">Second Description</label>
                                    <textarea name="descTwo" class="form-control" rows="5"></textarea>
                                </div>

                                <div class="mt-4">
                                    <button type="submit" class="btn btn-primary w-md">Submit</button>
                                </div>

                            </form>
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