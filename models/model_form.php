<?php
//include dirname(__DIR__) . '\model.php';

class Model_Form extends model {
    public function registrationUser($usernameCon, $ageCon, $infoCon, $loginCon, $passCon, $imgNameCon) {

//        $sqlUsers = 'insert into `users` (`username`, `age`, `info`) value (?, ?, ?)';
//        $sqlLogin = 'insert into `login` (`login`, `pass`, `user_id`) value (?, ?, ?)';
//        $sqlImages = 'insert into `images` (`img_name`, `user_id`) value (?, ?)';
//
//        $con = $this->connection();
//
//        $stmt = $con->prepare($sqlUsers);

        $username = $usernameCon;
        $age = $ageCon;
        $info = $infoCon;
        $login = $loginCon;
        $pass = $passCon;
        $imgName = $imgNameCon;

        $users =new User;
        $users->username = $username;
        $users->age = $age;
        $users->username = $info;
//        $users->save;
        $con = $users->getConnection();
        $user_id = $con->insert_id;
        var_dump($user_id);

//        $logins =new Login;
//        $logins->login = $login;
//        $logins->pass = $pass;
//        $logins->user_id ;
//        $logins->save;
//
//        $images =new Image;
//        $images->img_name = $imgName;
//        $images->user_id = ;
//        $images->save;


//        $stmt->bind_param('sis', $username, $age, $info);
//        $stmt->execute();
//
//        $user_id = $con->insert_id;
//        $stmt = $con->prepare($sqlLogin);
//
//        $stmt->bind_param('ssi', $login, $pass, $user_id);
//        $stmt->execute();
//
//
//        $stmt = $con->prepare($sqlImages);
//
//        $stmt->bind_param('si', $imgName, $user_id);
//        $stmt->execute();
    }

}