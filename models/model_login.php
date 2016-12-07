<?php



class Model_Login extends model {


    public function login_pass($pass)
    {

        $pass1 = $pass;
        $login = Login::all()->where('pass', '=', $pass1);

        $loginElo [] = $login[0]['id'];
        $loginElo [] = $login[0]['login'];
        $loginElo [] = $login[0]['pass'];
        $loginElo [] = $login[0]['user_id'];

//        $connect = $this->connection();
//
//        $sql = 'SELECT * FROM `login` WHERE pass = ?';
//        $stmt = $connect->prepare($sql);
//        $stmt->bind_param('s', $pass1);
//        $stmt->execute();
//        $result = $stmt->get_result();
//        $login = $result->fetch_all(MYSQLI_ASSOC);
        return $loginElo;
    }
}

