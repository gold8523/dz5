<?php
session_start();
$selUser = new Model_Lk();
$userId = $_SESSION['user_id'];
$sel = $selUser->selectUser($userId);

if (isset($_POST['action']) && $_POST['action'] == 'Добавить') {
    if ($_FILES['newPic']['type'] != "image/gif" && $_FILES['newPic']['type'] != "image/jpeg"
        && $_FILES['newPic']['type'] != "image/png"
    ) {
        echo 'Выберете изображение формата jpeg, png или gif.';
    } else {
        $imgNameCon = strip_tags($_SESSION['login']) . '_' . $_FILES['newPic']['name'];
        $dirUpload = dirname(__DIR__);
        $uploads_dir = $dirUpload . '\uploads';
        $tmp_name = $_FILES['newPic']['tmp_name'];
        move_uploaded_file($tmp_name, "$uploads_dir/$imgNameCon");

        $add = $selUser->addImg($imgNameCon, $userId);
        header('Location: .');
    }
}