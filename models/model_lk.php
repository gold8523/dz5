<?php
//include dirname(__DIR__) . '\model.php';

class Model_Lk extends model {


    public function selectUser($userId)
    {
//        $con = $this->connection();
        $user_Id = $userId;

        $users = User::all();
        foreach ($users as $user) {
            $userAge [] = $user->username;
            $userAge [] = $user->age;
        }

        $users = $users->where('id', '=', $user_Id);
        foreach ($users as $user){}


        $userElo [] = $user->username;
        $userElo [] = $user->age;
        $userElo [] = $user->inform;


        $images = Image::all()->where('user_id', '=', $user_Id);
        foreach ($images as $image){
            $imagesElo [] = $image->img_name;
            $imagesElo [] = $image->id;
        }

//
//        $sql = 'SELECT `username` FROM `users` WHERE id = ?';
//        $stmt = $con->prepare($sql);
//        $stmt->bind_param('i', $user_id);
//        $stmt->execute();
//        $stmt->bind_result($userName);
//        $stmt->fetch();
//        $stmt->close();

//        $sql = 'SELECT `age` FROM `users` WHERE id = ?';
//        $stmt = $con->prepare($sql);
//        $stmt->bind_param('i', $user_id);
//        $stmt->execute();
//        $stmt->bind_result($userAge);
//        $stmt->fetch();
//        $stmt->close();

//        $sql = 'SELECT `info` FROM `users` WHERE id = ?';
//        $stmt = $con->prepare($sql);
//        $stmt->bind_param('i', $user_id);
//        $stmt->execute();
//        $stmt->bind_result($userInfo);
//        $stmt->fetch();
//        $stmt->close();

//        $sql = 'SELECT `img_name`, `id` FROM `images` WHERE user_id = ?';
//        $stmt = $con->prepare($sql);
//        $stmt->bind_param('i', $user_id);
//        $stmt->execute();
//        $result = $stmt->get_result();
//        $userImage = $result->fetch_all(MYSQLI_ASSOC);

//        $images = [];
//        foreach ($userImage as $value) {
//            foreach ($value as $item) {
//                $images [] = $item;
//            }
//        }


//        $sql = 'SELECT `username`, `age` FROM `users`';
//        $result = $con->query($sql);
//        $usersAge = $result->fetch_all(MYSQLI_ASSOC);

//        $arrAge = [];
//        foreach ($usersAge as $value) {
//            foreach ($value as $item) {
//                $arrAge [] = $item;
//            }
//        }

        $resModLk = [$imagesElo, $userAge, $userElo];

        return $resModLk;
    }

    public function addImg($imgNameCon, $userId) {
        $sqlImages = 'insert into `images` (`img_name`, `user_id`) value (?, ?)';

        $con = $this->connection();

        $stmt = $con->prepare($sqlImages);

        $imgName = $imgNameCon;
        $user_id = $userId;

        $stmt->bind_param('si', $imgName, $user_id);
        $stmt->execute();
    }

    public function renameImg ($imgName, $img_id) {
//        $con = $this->connection();
//
//        $sqlImgEdit = 'UPDATE  `images` SET `img_name` = ? WHERE `id` = ?';
//        $stmt = $con->prepare($sqlImgEdit);


        $newName = $imgName;
        $imgId = $img_id;

        $images = Image::find($imgId);
        $images->img_name = $newName;
        $images->save();

//        $stmt->bind_param('si', $newName, $imgId);
//        $stmt->execute();
    }

    public function deleteImg ($imageId) {
        $con = $this->connection();

        $sqlImgDel = 'DELETE  FROM `images` WHERE `id` = ?';
        $stmt = $con->prepare($sqlImgDel);

        $imgId = $imageId;

        $stmt->bind_param('i', $imgId);
        $stmt->execute();
    }
}