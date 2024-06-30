<?php
include_once '../lib/Database.php';
include_once '../helpers/Format.php';
include_once '../lib/Session.php';

class Register
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
        $this->ss = new Session();
    }

    public function addUser($data)
    {
        $name     = $this->fr->validation($data['name']);
        $phone    = $this->fr->validation($data['phone']);
        $email    = $this->fr->validation($data['email']);
        $password = $this->fr->validation($data['password']);

        if (empty($name) || empty($phone) || empty($email) || empty($password)) {

            $this->error     = 'All Field Is Required!';
            return $this->error;
        }

        //Input Validation End 

        if (empty($this->error)) {

            $email_query = "SELECT * FROM user_table WHERE email = '$email'";
            $check_email = $this->db->selectWithOutNumRows($email_query);

            if (mysqli_num_rows($check_email) > 0) {

                $this->error     = 'Email Already Exist!';
                return $this->error;
            } //Email Validation End 
            else {

                if (strlen($phone) > 10) {

                    $this->error     = 'Phone Number To Long!';
                    return $this->error;
                } else {

                    $insert    = "INSERT INTO `user_table`(`name`, `phone`, `email`, `password`) VALUES ('$name','$phone','$email','$password')";
                    $inser_row = $this->db->insert($insert);
                }

                if ($inser_row) {

                    Session::init();
                    Session::set('successRe', true);
                    Session::set('successRe', 'Registered Please Login');
                    $this->ss->rgisCheck();
                } else {

                    $this->error     = 'Register Error!';
                    return $this->error;
                }
            }
            //User Insert End 
        }
        //User Insert And Email Validation End
    }
}
