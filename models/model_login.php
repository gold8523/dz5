<?php
//include dirname(__DIR__) . '\core\model.php';


class Model_Login extends model {

//    public function selectLog1() {
//
//        $arrId = [];
//
//        $connect = $this->connection();
//
//        $sql = 'SELECT `user_id` FROM `login` ';
//        $result = $connect->query($sql);
//        $loginAll = $result->fetch_all(MYSQLI_ASSOC);
//        foreach ($loginAll as $value) {
//            foreach ($value as $item) {
//                $arrId [] = $item;
//            }
//        }
//        return $arrId;
//    }
//
//    public function selectLog2() {
//
//        $arrLogin = [];
//
//        $connect = $this->connection();
//
//        $sql = 'SELECT `login` FROM `login` ';
//        $result = $connect->query($sql);
//        $loginAll = $result->fetch_all(MYSQLI_ASSOC);
//        foreach ($loginAll as $value) {
//            foreach ($value as $item) {
//                $arrLogin [] = $item;
//            }
//        }
//        return $arrLogin;
//    }
//
//    public function selectLog3() {
//
//        $arrPass = [];
//
//        $connect = $this->connection();
//
//        $sql = 'SELECT `pass` FROM `login` ';
//        $result = $connect->query($sql);
//        $loginAll = $result->fetch_all(MYSQLI_ASSOC);
//        foreach ($loginAll as $value) {
//            foreach ($value as $item) {
//                $arrPass [] = $item;
//            }
//        }
//        return $arrPass;
//    }

    public function login_pass($pass)
    {

        $pass1 = $pass;

        $connect = $this->connection();

        $sql = 'SELECT * FROM `login` WHERE pass = ?';
        $stmt = $connect->prepare($sql);
        $stmt->bind_param('s', $pass1);
        $stmt->execute();
        $result = $stmt->get_result();
        $login = $result->fetch_all(MYSQLI_ASSOC);
        return $login;
    }
}

