<?php
include_once '../lib/Database.php';
include_once '../helpers/Format.php';
include_once '../lib/Session.php';

Session::loginCheck();

class Login
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

    public function loginUser($data)
    {
        $email    = $this->fr->validation($data['email']);
        $password = $this->fr->validation($data['password']);

        if (empty($email) || empty($password)) {

            $this->error     = 'All Field Is Required!';
            return $this->error;
        }

        if (empty($this->error)) {

            $select    = "SELECT * FROM `user_table` WHERE email = '$email' AND  password = '$password'";
            $select_row = $this->db->selectWithOutNumRows($select);
            $row = mysqli_fetch_assoc($select_row);

            if ($row) {

                Session::set('login', true);
                Session::set('login', "LOGED IN!");
                Session::set('user_name', $row['name']);
                Session::set('user_id', $row['id']);
                header('location:index.php');
            } else if (!$row) {

                $this->error     = 'Wrong Credential!';
                return $this->error;
            }
        }
    }
}
