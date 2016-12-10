<?php
//include dirname(__DIR__) . '\model.php';

class Model_Form extends model {
    public function registrationUser($usernameCon, $ageCon, $infoCon, $ip, $loginCon, $passCon, $imgNameCon) {

//        $sqlUsers = 'insert into `users` (`username`, `age`, `info`) value (?, ?, ?)';
//        $sqlLogin = 'insert into `login` (`login`, `pass`, `user_id`) value (?, ?, ?)';
//        $sqlImages = 'insert into `images` (`img_name`, `user_id`) value (?, ?)';
//
//        $con = $this->connection();
//
//        $stmt = $con->prepare($sqlUsers);

        $user_Reg = [
            'username' => $usernameCon,
            'age' => $ageCon,
            'inform' => $infoCon,
            'ip' => $ip
        ];


//        $login = $loginCon;
//        $pass = $passCon;
//        $imgName = $imgNameCon;

//        $images = Image::find($imgId);
//        $images->delete();


//        $users = new User();
//        $users->username = $user_Reg['username'];
//        $users->age = $user_Reg['age'];
//        $users->inform = $user_Reg['inform'];
//        $users->save;


        $user_id = User::insertGetId($user_Reg);

        $login_Reg = [
            'login' => $loginCon,
            'pass' => $passCon,
            'user_id' => $user_id
        ];



//        $logins = new Login();
//        $logins->login = $loginCon;
//        $logins->pass = $passCon;
//        $logins->user_id = $user_id;
//        $logins->save;

        $logins = Login::insert($login_Reg);

//        $images = new Image();
//        $images->img_name = $imgNameCon;
//        $images->user_id = $user_id;
//        $images->save;
        $image_Reg = [
            'img_name' => $imgNameCon,
            'user_id' => $user_id

        ];

        $images = Image::insert($image_Reg);




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