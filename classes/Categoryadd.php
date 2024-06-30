<?php
$filePath = realpath(dirname(__FILE__));

include_once($filePath . '/../lib/Database.php');
include_once($filePath . '/../helpers/Format.php');
include_once($filePath . '/../lib/Session.php');

class Categoryadd
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

    //ADD CATEGORY 
    public function addCat($data)
    {
        $catName    = $this->fr->validation($data['catName']);

        if (empty($catName)) {

            $this->error     = 'Category Is Required!';
            return $this->error;
        } elseif (strlen($catName) >= 20) {

            $this->error     = 'To Long!';
            return $this->error;
        }

        if (empty($this->error)) {
            $select    = "SELECT * FROM `category_table` WHERE cname = '$catName'";
            $select_row = $this->db->selectWithOutNumRows($select);
            $row = mysqli_fetch_assoc($select_row);

            if ($row) {
                $this->error     = 'Category Already Exist!';
                return $this->error;
            } elseif (!$row) {

                $insert    = "INSERT INTO `category_table`(`cname`) VALUES ('$catName')";
                $insert_row = $this->db->insert($insert);

                if ($insert_row) {

                    Session::init();
                    Session::set('Catcrt', true);
                    Session::set('Catcrt', "Category Created!");
                    header('location:categoryList.php');
                }
            } else {

                $this->error     = 'Something Went Wrong!';
                return $this->error;
            }
        }
    }

    //CATEGORY LIST
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

    //GET EDIT CATEGORY
    public function getEditcat($id)
    {
        $select    = "SELECT * FROM `category_table` WHERE cid=$id";
        $select_row = $this->db->select($select);

        if ($select_row) {
            return $select_row;
        }
    }

    //Edit EDIT CATEGORY
    public function catEdit($data, $id)
    {
        $catEdit    = $this->fr->validation($data['catEdit']);

        if (empty($catEdit)) {

            $this->error     = 'Category Is Required!';
            return $this->error;
        } elseif (strlen($catEdit) >= 20) {

            $this->error     = 'To Long!';
            return $this->error;
        }

        if (empty($this->error)) {
            $update    = "UPDATE `category_table` SET cname = '$catEdit' WHERE cid=$id";
            $update_row = $this->db->update($update);

            if ($update_row) {

                Session::init();
                Session::set('Catedit', true);
                Session::set('Catedit', "Category Edited!");
                header('location:categoryList.php');
            } else {

                $this->error     = 'Something Wrong Try Agnain!';
                return $this->error;
            }
        }
    }

    //DELETE CATEGORY
    public function catDel($id)
    {
        $delete    = "DELETE FROM `category_table` WHERE cid=$id";
        $delete_row = $this->db->delete($delete);

        if ($delete_row) {

            Session::init();
            Session::set('CateDel', true);
            Session::set('CateDel', "Category Deleted!");
        }
    }
    // ================================================ BACKEND END =====================================================


    public function catForcat($id)
    {
        $select     = "SELECT * FROM `category_table` WHERE cid=$id";
        $select_row = $this->db->select($select);

        if ($select_row) {
            return $select_row;
        }
    }

    public function totalCat()
    {
        $select     = "SELECT * FROM `category_table`";
        $select_row = $this->db->selectWithOutNumRows($select);

        if ($select_row) {
            return $select_row;
        }
    }
}
