<?php



class Model_Login extends model {


    public function login_pass($pass)
    {

        $pass1 = $pass;
        $logins = Login::all()->where('pass', '=', $pass1);

        foreach ($logins as $login){}

        $loginElo [] = $login->id;
        $loginElo [] = $login->login;
        $loginElo [] = $login->pass;
        $loginElo [] = $login->user_id;

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

