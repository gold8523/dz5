<?php
session_start();
//require dirname(__DIR__) . '/controller.php';
require dirname(__DIR__) . '/models/model_lk.php';
require dirname(__DIR__) . '/vendor/autoload.php';
use Intervention\Image\ImageManagerStatic as Image;

class lk extends Controller {

    public function action() {

        $selUser = new Model_Lk();

        if (!empty($_COOKIE['auth'])) {
            $_SESSION['auth'] = true;
        }

        $isAuth = !empty($_SESSION['auth']);

        if ($isAuth) {
            $userId = $_SESSION['user_id'];

            $sel = $selUser->selectUser($userId);

            $resMod = [];
            foreach ($sel as $item) {
                $resMod [] = $item;
            }

            foreach ($resMod[1] as $item) {
                $arrAge [] = $item;
            }

            foreach ($resMod[0] as $item) {
                $arrImg [] = $item;
            }

//
            $img = [];
            $id = [];
            $len = count($arrImg);
            while ($len > -1) {
                if (!empty($arrImg[$len])) {
                    $gt = gettype($arrImg[$len]);
                    if ($gt == 'integer') {
                        $id [] = $arrImg[$len];
                    } else {
                        $img [] = $arrImg[$len];
                    }
                }
                $len--;
            }

            $len = count($arrAge);
            while ($len > 0) {
                if (($arrAge[$len - 1]) > 18) {
                    $ageUsers [] = $arrAge[$len - 2] . ' ' . $arrAge[$len - 1] . ' - совершеннолетний';
                } else {
                    $ageUsers [] = $arrAge[$len - 2] . ' ' . $arrAge[$len - 1] . ' - не совершеннолетний';
                }
                $len = $len - 2;
            }

            $data[0] = $img;
            $data[1] = $ageUsers;
            $data[2] = $resMod[2][0];
            $data[3] = $resMod[2][1];
            $data[4] = $resMod[2][2];
            $data[5] = $id;


            $this->view->generate("lk_view.twig",
                array(
                    'data' => $data
                ));

//            parent::action(); // TODO: Change the autogenerated stub
//            $this->view->render('lk_view.php', 'template_view.php', $data);



        } else {
            header("Location: ../login");
            exit();
        }

    }

    public function send_mail () {

        $mail = new PHPMailer;

        if (isset($_POST) && $_POST['action'] == 'Отправить') {
//    var_dump($_POST);
//    $mail->SMTPDebug = 3;
            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = 'smtp.yandex.ru';  // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = 'senior.phpovich2016@yandex.ru';                 // SMTP username
            $mail->Password = '20pHp16';                           // SMTP password
            $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 465;

            $mail->setFrom('senior.phpovich2016@yandex.ru');
            $mail->addAddress($_POST['address'], 'Денис');

            $mail->Subject = $_POST['title'];
            $mail->Body = $_POST['email'];
            $mail->AltBody = $_POST['email'];

            if (!$mail->send()) {
                echo 'Message could not be sent.';
                echo 'Mailer Error: ' . $mail->ErrorInfo;
            } else {
                echo 'Message has been sent';
            }
        }
    }

    public function rename_image() {
        $selUser = new Model_Lk();
//        $userId = $_SESSION['user_id'];
//        $sel = $selUser->selectUser($userId);

        if (isset($_POST['action']) && $_POST['action'] == 'Переименовать') {

            $img_id = $_POST['id'];
            $imgName = strip_tags($_POST['edit']);

            $ren = $selUser->renameImg($imgName, $img_id);

//            $oldName = $_POST['old'];
//            $newName = $_POST['edit'];
//            $dir = dirname(__DIR__) . '/uploads';
//            $dirSmall = dirname(__DIR__) . '/images';
//            $ren = rename("$dir/$oldName" , "$dir/$newName" );
//            $renSmall = rename("$dirSmall/$oldName" , "$dirSmall/$newName" );
//            if ($renSmall == true) {
//                header('Location: ../lk');
//            } else {
//                echo 'Что-то пошло не так!';
//            }

        }
        if (isset($_POST) && $_POST['action'] == 'Удалить') {

            $imageId = $_POST['id'];

            $ren = $selUser->deleteImg($imageId);

            $imgName = $_POST['edit'];
            $dir = dirname(__DIR__) . '/uploads';
            $dirSmall = dirname(__DIR__) . '/images';
            $del = unlink("$dir/$imgName");
            $delSmall = unlink("$dirSmall/$imgName");
            if ($del == true) {
                header('Location: ../lk');
            } else {
                echo 'Что-то пошло не так!';
            }

        }
    }

    public function add_image() {

        $selUser = new Model_Lk();
        $userId = $_SESSION['user_id'];
        $sel = $selUser->selectUser($userId);

        if (isset($_POST['action']) && $_POST['action'] == 'Добавить') {
            if ($_FILES['newPic']['type'] != "image/gif" && $_FILES['newPic']['type'] != "image/jpeg"
                && $_FILES['newPic']['type'] != "image/png")
            {
                echo 'Выберете изображение формата jpeg, png или gif.';
            } else {
                $imgNameCon = strip_tags($_SESSION['login']) . '_' . $_FILES['newPic']['name'];
                $dirUpload = dirname(__DIR__);
                $uploads_dir = $dirUpload . '\uploads';
                $tmp_name = $_FILES['newPic']['tmp_name'];
                move_uploaded_file($tmp_name, "$uploads_dir/$imgNameCon");

                $image = Image::make("uploads/$imgNameCon")
                    ->resize(300, null, function ($constraint) {
                        $constraint->aspectRatio();
                    })
                    ->save("images/$imgNameCon", 100);

                $add = $selUser->addImg($imgNameCon, $userId);
                header('Location: ../lk');
            }
        }
    }

    public function out() {

        session_unset();
        header('Location: ../');
    }

}


