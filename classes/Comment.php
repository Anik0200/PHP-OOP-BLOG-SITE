<?php
$filePath = realpath(dirname(__FILE__));

include_once($filePath . '/../lib/Database.php');
include_once($filePath . '/../helpers/Format.php');
include_once($filePath . '/../lib/Session.php');

class Comment
{

    public $db;
    public $fr;
    public $msg;

    public function __construct()
    {
        $this->db = new Database();
        $this->fr = new Format();
    }

    public function addCmt($data)
    {
        $userId  = $this->fr->validation($data['userId']);
        $postId  = $this->fr->validation($data['postId']);
        $name    = $this->fr->validation($data['name']);
        $email   = $this->fr->validation($data['email']);
        $massage = $this->fr->validation($data['massage']);

        if (empty($name)) {

            $this->msg = "NAME IS REQUIRED";
            return $this->msg;
        } elseif (strlen($name) > 20) {
            $this->msg = "NAME IS LONG";
            return $this->msg;
        }

        if (empty($email)) {

            $this->msg = "EMAIL IS REQUIRED";
            return $this->msg;
        } elseif (strlen($email) > 100) {
            $this->msg = "EMAIL IS LONG";
            return $this->msg;
        }

        if (empty($massage)) {

            $this->msg = "MASSAGE IS REQUIRED";
            return $this->msg;
        }

        if (empty($this->msg)) {
            $inser_q = "INSERT INTO `comment_table`(`userId`, `postId`, `name`, `email`, `message`) VALUES ( $userId, $postId, '$name', '$email', '$massage')";
            $inser_r = $this->db->insert($inser_q);

            if ($inser_r) {
                $this->msg = "COMMENT SUCCESS";
                return $this->msg;
            }
        }
    }

    public function allCmt($id)
    {
        $select_q = "SELECT *, post_table.postid
        FROM comment_table 
        INNER JOIN post_table 
        ON comment_table.postId = post_table.postid
        WHERE comment_table.postId = '$id' AND comment_table.status = 1";

        $select_r = $this->db->select($select_q);

        if ($select_r) {
            return $select_r;
        }
    }

    public function adminCmt($userId)
    {
        $select_q = "SELECT comment_table.*, user_table.id, post_table.postid, post_table.title
        FROM comment_table 
        INNER JOIN user_table 
        ON user_table.id = comment_table.userId
        INNER JOIN post_table
        ON post_table.postid = comment_table.postId
        WHERE comment_table.userId = '$userId'";

        $select_r = $this->db->select($select_q);

        if ($select_r) {
            return $select_r;
        }
    }

    public function active($aId)
    {
        $active_q = "UPDATE comment_table SET status = 1 WHERE cmtId = $aId";
        $active   = $this->db->update($active_q);

        if ($active) {

            Session::set('cmyAct', true);
            Session::set('cmyAct', "COMMENT ACTIVATED!");
        }
    }
    // POST AEACTIVE END

    public function deActive($dId)
    {
        $deactive_q = "UPDATE comment_table SET status = 0 WHERE cmtId = '$dId'";
        $deactive   = $this->db->update($deactive_q);

        if ($deactive) {

            Session::set('cmyDeact', true);
            Session::set('cmyDeact', "COMMENT DEACTIVATED!");
        }
    }
    // POST DEACTIVE END

    public function dellCmt($delID)
    {
        $dell_q = "DELETE FROM comment_table WHERE cmtId = '$delID'";
        $dell   = $this->db->update($dell_q);

        if ($dell) {

            Session::set('cmyDeact', true);
            Session::set('cmyDeact', "COMMENT DELETED!");
        }
    }

    public function cmntForform($cmntID)
    {
        $select_q = "SELECT admin_reply FROM comment_table WHERE cmtId = '$cmntID'";
        $select_r = $this->db->select($select_q);

        if ($select_r) {
            return $select_r;
        }
    }
    // SELECT COMMENT FOR SHOW IN FROM END

    public function replyCmt($data, $id)
    {
        $admin_reply  =  $this->fr->validation($data['admin_reply']);

        if (empty($admin_reply)) {
            $this->msg = "MUST REPLY COMMENT";
            return $this->msg;
        }

        $update_q = "UPDATE `comment_table` SET `admin_reply`='$admin_reply' WHERE cmtId = $id";
        $update_r = $this->db->update($update_q);

        if ($update_r) {

            Session::set('cmyReply', true);
            Session::set('cmyReply', "COMMENT REPLYED!");
            header('location:commentList.php');
        }
    }

    public function totalActiveCmnt($userId)
    {
        $activeCmnt = "SELECT * FROM comment_table WHERE userId = $userId AND status = 1";
        $activeRes = $this->db->selectWithOutNumRows($activeCmnt);

        return $activeRes;
    }
}
