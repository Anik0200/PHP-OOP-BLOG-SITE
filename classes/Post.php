<?php
$filePath = realpath(dirname(__FILE__));

include_once($filePath . '/../lib/Database.php');
include_once($filePath . '/../helpers/Format.php');
include_once($filePath . '/../lib/Session.php');

class Post
{

    public $db;
    public $fr;
    public $error;
    public $success;
    public $ss;

    public function __construct()
    {
        $this->db = new Database();
        $this->fr = new Format();
    }

    public function allCat()
    {
        $select    = "SELECT * FROM `category_table`";
        $select_row = $this->db->select($select);

        if ($select_row) {

            return $select_row;
        } else {

            return false;
        }
    }
    // SELECT CATEGORY LIST END

    public function addPost($data, $file)
    {
        $title      = $this->fr->validation($data['title']);
        $tags       = $this->fr->validation($data['tags']);
        $descOne    = $this->fr->validation($data['descOne']);
        $descTwo    = $this->fr->validation($data['descTwo']);
        $descTwo    = $this->fr->validation($data['descTwo']);
        $descTwo    = $this->fr->validation($data['descTwo']);
        $userid     = $data['userid'];

        if (empty($title)) {

            $this->error = "TITLE IS REQURIED";
            return $this->error;
        } elseif (strlen($title) > 50) {

            $this->error = "TITLE IS TO LONG";
            return $this->error;
        }

        if (empty($tags)) {

            $this->error = "TAGS IS REQURIED";
            return $this->error;
        } elseif (strlen($tags) > 50) {

            $this->error = "TAGS IS TO LONG";
            return $this->error;
        }

        if (isset($data['postType'])) {
            $postType   = $data['postType'];
        } else {

            $this->error = "CHOSE POST TYPE";
            return $this->error;
        }

        if (isset($data['catId'])) {
            $catId      = $data['catId'];
        } else {

            $this->error = "CHOSE CATEGORY";
            return $this->error;
        }

        if (empty($descOne)) {

            $this->error = "DESCRIPTION IS REQURIED";
            return $this->error;
        }

        if (empty($descTwo)) {

            $this->error = "DESCRIPTION IS REQURIED";
            return $this->error;
        }
        // VALIDATION END =======================

        $permit    = array('jpg', 'jpeg', 'png');
        $file_name = $file['imgOne']['name'];
        $file_size = $file['imgOne']['size'];
        $file_temp = $file['imgOne']['tmp_name'];

        $div          = explode('.', $file_name);
        $file_ext     = strtolower(end($div));
        $uni_image    = substr(md5(time()), 0, 10) . '.' . $file_ext;
        $upload_image = "../upload/" . $uni_image;
        // IMAGE ONE END____

        $permitTwo     = array('jpg', 'jpeg', 'png');
        $file_name_two = $file['imgTwo']['name'];
        $file_size_two = $file['imgTwo']['size'];
        $file_temp_two = $file['imgTwo']['tmp_name'];

        $div_two          = explode('.', $file_name_two);
        $file_ext_two     = strtolower(end($div_two));
        $uni_image_two    = substr(md5(rand() . time()), 0, 10) . '.' . $file_ext_two;
        $upload_image_two = "../upload/" . $uni_image_two;
        // IMAGE TWO END____

        if (empty($this->error)) {
            if ($file_name && $file_name_two) {
                if (in_array($file_ext, $permit) && in_array($file_ext_two, $permitTwo)) {
                    // insert code

                    $one = move_uploaded_file($file_temp, $upload_image);
                    $two = move_uploaded_file($file_temp_two, $upload_image_two);

                    if ($one && $two) {

                        $insert    = "INSERT INTO `post_table`(`userid`, `title`, `catId`, `imgOne`, `descOne`, `imgTwo`, `descTwo`, `postType`, `tags`) VALUES ($userid, '$title','$catId','$uni_image','$descOne','$uni_image_two','$descTwo','$postType','$tags');";

                        $insert_row = $this->db->insert($insert);
                        if ($insert_row) {

                            Session::init();
                            Session::set('postCrtMsg', true);
                            Session::set('postCrtMsg', "POST CREATED!");
                            header('location:postList.php');
                        } else {

                            $this->error = "SOMTHING WRONG PLEASE CHECK";
                            return $this->error;
                        }
                    }

                    // insert code
                } else {

                    $this->error = "CHOSE VALID IMAGE";
                    return $this->error;
                }
            } else {

                $this->error = "CHOSE IMAGES";
                return $this->error;
            }
        }
        // IMAGE END =======================
    }
    // POST ADD END


    public function getPostForEdit($id)
    {
        $getPost = "SELECT * FROM post_table WHERE postid='$id'";
        $getRes = $this->db->selectWithOutNumRows($getPost);

        return $getRes;
    }
    // GET POST FOR EDIT END

    public function editPost($data, $file, $id)
    {
        $title      = $this->fr->validation($data['title']);
        $tags       = $this->fr->validation($data['tags']);
        $descOne    = $this->fr->validation($data['descOne']);
        $descTwo    = $this->fr->validation($data['descTwo']);
        $descTwo    = $this->fr->validation($data['descTwo']);
        $descTwo    = $this->fr->validation($data['descTwo']);

        if (empty($title)) {

            $this->error = "TITLE IS REQURIED";
            return $this->error;
        } elseif (strlen($title) > 50) {

            $this->error = "TITLE IS TO LONG";
            return $this->error;
        }

        if (empty($tags)) {

            $this->error = "TAGS IS REQURIED";
            return $this->error;
        } elseif (strlen($tags) > 50) {

            $this->error = "TAGS IS TO LONG";
            return $this->error;
        }

        if (isset($data['postType'])) {
            $postType   = $data['postType'];
        } else {

            $this->error = "CHOSE POST TYPE";
            return $this->error;
        }

        if (isset($data['catId'])) {
            $catId      = $data['catId'];
        } else {

            $this->error = "CHOSE CATEGORY";
            return $this->error;
        }

        if (empty($descOne)) {

            $this->error = "DESCRIPTION IS REQURIED";
            return $this->error;
        }

        if (empty($descTwo)) {

            $this->error = "DESCRIPTION IS REQURIED";
            return $this->error;
        }
        // VALIDATION END =======================

        $getPost = "SELECT * FROM post_table WHERE postid='$id'";
        $getRes = $this->db->select($getPost);
        $oldImg =  mysqli_fetch_assoc($getRes);

        if ($file['imgOne']['tmp_name'] == !0) {

            $permit    = ['jpg', 'jpeg', 'png'];
            $file_name = $file['imgOne']['name'];
            $file_size = $file['imgOne']['size'];
            $fileTemp = $file['imgOne']['tmp_name'];

            $div          = explode('.', $file_name);
            $file_ext     = strtolower(end($div));
            $uni_image    = substr(md5(time()), 0, 10) . '.' . $file_ext;
            $uploadImage  = "../upload/" . $uni_image;

            $up1 =   move_uploaded_file($fileTemp, $uploadImage);

            if ($up1) {
                unlink('../upload/' . $oldImg['imgOne']);
            }
        } else {

            $uni_image    = $oldImg['imgOne'];
        }
        // IMAGE ONE END____

        if ($file['imgTwo']['tmp_name'] == !0) {

            $permitTwo   = ['jpg', 'jpeg', 'png'];
            $fileNameTwo = $file['imgTwo']['name'];
            $fileSizeTwo = $file['imgTwo']['size'];
            $fileTempTwo = $file['imgTwo']['tmp_name'];

            $divTwo       = explode(',', $fileNameTwo);
            $fileExtTwo   = strtolower(end($divTwo));
            $uniImgTwo    = substr(md5(rand() . time()), 0, 10) . '.' . $fileExtTwo;
            $uploadimgtwo = "../upload/" . $uniImgTwo;

            $up2 =  move_uploaded_file($fileTempTwo, $uploadimgtwo);

            if ($up2) {
                unlink('../upload/' . $oldImg['imgTwo']);
            }
        } else {

            $uniImgTwo    = $oldImg['imgTwo'];
        }
        // IMAGE TWO END____

        if (empty($this->error)) {

            $update    = "UPDATE `post_table` SET `title`='$title',
            `catId`='$catId', `imgOne`='$uni_image',
            `descOne`='$descOne', `imgTwo`='$uniImgTwo',
            `descTwo`='$descTwo', `postType`='$postType',
            `tags`='$tags' WHERE postid='$id'";

            $update_row = $this->db->insert($update);

            if ($update_row) {

                Session::init();
                Session::set('postEditMsg', true);
                Session::set('postEditMsg', "POST EDITED!");
                header('location:postList.php');
            } else {

                $this->error = "SOMTHING WRONG PLEASE CHECK";
                return $this->error;
            }
        }
    }
    // POST EDIT END

    public function allPost($userid)
    {

        $select    = "SELECT *, category_table.cname, user_table.id FROM post_table INNER JOIN category_table ON post_table.catId = category_table.cid
        
        INNER JOIN user_table ON post_table.userid = user_table.id WHERE user_table.id='$userid'";

        $select_row = $this->db->select($select);

        if ($select_row) {

            return $select_row;
        }
    }
    // SELECT POST LIST END

    public function modelData()
    {
        $model    = "SELECT *, category_table.cname, user_table.id, user_table.name FROM post_table INNER JOIN category_table ON post_table.catId = category_table.cid
        
        INNER JOIN user_table ON post_table.userid = user_table.id";

        $model_row = $this->db->select($model);

        if ($model_row) {

            return $model_row;
        }
    }
    // SELECT ALL MODEL

    public function active($aId)
    {
        $deactive_q = "UPDATE post_table SET status = '1' WHERE postid = '$aId'";
        $deactive   = $this->db->update($deactive_q);

        if ($deactive) {

            Session::set('postAct', true);
            Session::set('postAct', "POST ACTIVATED!");
        }
    }
    // POST DEACTIVE END

    public function deActive($dId)
    {
        $deactive_q = "UPDATE post_table SET status = '0' WHERE postid = '$dId'";
        $deactive   = $this->db->update($deactive_q);

        if ($deactive) {

            Session::set('postDeact', true);
            Session::set('postDeact', "POST DEACTIVATED!");
        }
    }
    // POST DEACTIVE END

    public function postDel($id)
    {
        $getPost = "SELECT * FROM post_table WHERE postid='$id'";
        $getRes = $this->db->select($getPost);
        $oldImg =  mysqli_fetch_assoc($getRes);

        if ($oldImg) {
            unlink('../upload/' . $oldImg['imgOne']);
            unlink('../upload/' . $oldImg['imgTwo']);
        }

        $dltPost = "DELETE FROM `post_table` WHERE postid='$id'";
        $dlPostRes = $this->db->delete($dltPost);


        if ($dlPostRes) {

            Session::init();
            Session::set('postDltMsg', true);
            Session::set('postDltMsg', "POST DELETED!");
        } else {

            $this->error = "SOMTHING WRONG PLEASE CHECK";
            return $this->error;
        }
    }
    // POST DELETE END
    // ================================================ BACKEND END =====================================================

    public function latestpost($offSet, $limit)
    {
        $postQ = "SELECT *, user_table.id, user_table.name FROM post_table 
        INNER JOIN user_table ON post_table.userid = user_table.id 
        WHERE post_table.status=1 
        ORDER BY post_table.postid ASC LIMIT $limit OFFSET $offSet";

        $postQ_res = $this->db->select($postQ);

        if ($postQ_res) {
            return $postQ_res;
        }
    }
    // POST FOR FRONT END

    public function singlePost($id)
    {
        $single_postQ = "SELECT *, user_table.id, user_table.name, category_table.cid, category_table.cname FROM post_table 
      INNER JOIN user_table ON post_table.userid = user_table.id  
      INNER JOIN category_table ON post_table.catId = category_table.cid 
      WHERE post_table.postid = '$id'";

        $single_postQ_res = $this->db->select($single_postQ);

        if ($single_postQ_res) {
            return $single_postQ_res;
        }
    }

    public function latestPostSide()
    {
        $postQ = "SELECT * FROM post_table ORDER BY post_table.postid ASC LIMIT 6";

        $postQ_res = $this->db->select($postQ);

        if ($postQ_res) {
            return $postQ_res;
        }
    }

    public function allCatSides()
    {
        $select    = "SELECT * FROM `category_table` LIMIT 6";
        $select_row = $this->db->select($select);

        if ($select_row) {

            return $select_row;
        }
    }

    public function bannerPosts()
    {
        $bannerPost_postQ = "SELECT post_table.*, user_table.name, category_table.cname FROM post_table 
        INNER JOIN user_table ON post_table.userid = user_table.id  
        INNER JOIN category_table ON post_table.catId = category_table.cid 
        WHERE post_table.postType = 1";

        $bannerPost_row = $this->db->select($bannerPost_postQ);

        if ($bannerPost_row) {

            return $bannerPost_row;
        }
    }

    public function numPost()
    {
        $select    = "SELECT * FROM `post_table` WHERE status = 1";
        $select_row = $this->db->selectWithOutNumRows($select);

        if ($select_row) {

            return $select_row;
        }
    }

    public function postForcat($id, $offSet, $limit)
    {
        $postForcat_Q = "SELECT post_table.*, user_table.id, user_table.name, category_table.cid, category_table.cname FROM post_table 
        INNER JOIN user_table ON post_table.userid = user_table.id  
        INNER JOIN category_table ON post_table.catId = category_table.cid 
        WHERE post_table.catId = '$id' AND post_table.status = 1 LIMIT $limit OFFSET $offSet";

        $postForcat_Q_res = $this->db->select($postForcat_Q);

        if ($postForcat_Q_res) {
            return $postForcat_Q_res;
        }
    }

    public function numCatPost($catId)
    {
        $select    = "SELECT * FROM `post_table` WHERE status = 1 AND catId = $catId";
        $select_row = $this->db->selectWithOutNumRows($select);

        if ($select_row) {

            return $select_row;
        }
    }

    public function searchPost($search, $offSet, $limit)
    {
        $postQ = "SELECT *, user_table.id, user_table.name FROM post_table 
        INNER JOIN user_table ON post_table.userid = user_table.id 
        WHERE post_table.status=1 AND post_table.title LIKE '%$search%'
        ORDER BY post_table.postid ASC LIMIT $limit OFFSET $offSet";

        $postQ_res = $this->db->select($postQ);

        if ($postQ_res) {
            return $postQ_res;
        }
    }

    // all user index

    public function allUser()
    {
        $select    = "SELECT * FROM `user_table`";
        $select_rows = $this->db->selectWithOutNumRows($select);

        if ($select_rows) {
            return $select_rows;
        }
    }

    public function totalActivePost($userid)
    {
        $activePost = "SELECT * FROM post_table WHERE userid = $userid AND status = 1";
        $activeRes = $this->db->selectWithOutNumRows($activePost);

        return $activeRes;
    }
}
