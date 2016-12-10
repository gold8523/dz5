<?php
require dirname(__DIR__) . '/vendor/autoload.php';
//require dirname(__DIR__) . '/controller.php';
require dirname(__DIR__) . '/models/model_form.php';
use Intervention\Image\ImageManagerStatic as Image;


class form extends Controller  {

    public function action()
    {
        $this->view->generate("form_view.twig");

//        parent::action(); // TODO: Change the autogenerated stub
//        $this->view->render('form_view.php', 'template_view.php');
    }

    public function registration() {

        $mail = new PHPMailer;
        $reg = new Model_Form();

        if (!empty($_POST) && $_POST['action'] == 'Зарегистрироваться') {

          $remoteIp = $_SERVER['REMOTE_ADDR'];
          $gRecaptchaResponse = $_REQUEST['g-recaptcha-response'];
          $secret ='6LfMIQ0UAAAAALN5yv0aY6kYwiNRZpI_yV75FCAB';

          $recaptcha = new \ReCaptcha\ReCaptcha($secret);
          $resp = $recaptcha->verify($gRecaptchaResponse, $remoteIp);
          if ($resp->isSuccess()) {
              // verified!
          } else {
              $errors = $resp->getErrorCodes();
          }

            $arrValid = [
                'name' => strip_tags($_POST['name']),
                'age' => strip_tags($_POST['age']),
                'inform' => strip_tags($_POST['information']),
                'login' => strip_tags($_POST['loginUser']),
                'pass' => strip_tags($_POST['pass']),
                'ip' => $_SERVER['REMOTE_ADDR']
            ];

            if($arrValid['age'] > 10 && $arrValid['age'] < 100) {

                $validated = GUMP::is_valid($arrValid, [
                    'name' => 'required|min_len,5|valid_name',
                    'age' => 'required|numeric',
                    'inform' => 'required|min_len,50',
                    'login' => 'required|alpha_numeric|min_len,5',
                    'pass' => 'required|min_len,8|alpha_dash',
                    'ip' => 'required|valid_ip',
                ]);
            } else {
                echo "Возраст должен быть от "
            }

            if ($validated === true) {
                $usernameCon = $arrValid['name'];
                $ageCon = $arrValid['age'];
                $infoCon = $arrValid['inform'];
                $loginCon = $arrValid['login'];
                $passCon = $arrValid['pass'];
                $imgNameCon = strip_tags($_POST['loginUser']) . '_' . $_FILES['picture']['name'];
                $ip = $arrValid['ip'];

                $insReg = $reg->registrationUser($usernameCon, $ageCon, $infoCon, $ip, $loginCon, $passCon, $imgNameCon);


                //            $mail->SMTPDebug = 3;
                $mail->isSMTP();                                      // Set mailer to use SMTP
                $mail->Host = 'smtp.yandex.ru';  // Specify main and backup SMTP servers
                $mail->SMTPAuth = true;                               // Enable SMTP authentication
                $mail->Username = 'senior.phpovich2016@yandex.ru';                 // SMTP username
                $mail->Password = '20pHp16';                           // SMTP password
                $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
                $mail->Port = 465;

                $mail->setFrom('senior.phpovich2016@yandex.ru');
                $mail->addAddress('champ2013@yandex.ru', 'Петр');

                $mail->Subject = 'Новый пользователь';
                $mail->Body = 'Зарегистрирован новый пользователь на сайте!';
                $mail->AltBody = 'Зарегистрирован новый пользователь на сайте!';

                if(!$mail->send()) {
                    echo 'Message could not be sent.';
                    echo 'Mailer Error: ' . $mail->ErrorInfo;
                }

                if (!empty($_FILES['picture']['name'])) {

                    if ($_FILES['picture']['type'] != "image/gif" && $_FILES['picture']['type'] != "image/jpeg"
                        && $_FILES['picture']['type'] != "image/png"
                    ) {
                        echo 'Выберете изображение формата jpeg, png или gif.';
                    } else {
                        $dirUpload = dirname(__DIR__);
                        $uploads_dir = $dirUpload . '\uploads';
                        $tmp_name = $_FILES['picture']['tmp_name'];
                        move_uploaded_file($tmp_name, "$uploads_dir/$imgNameCon");
                    }

                    $image = Image::make("uploads/$imgNameCon")
                        ->resize(300, null, function ($constraint) {
                            $constraint->aspectRatio();
                        })
                        ->save("images/$imgNameCon", 100);

                }
                header('Location: ../login_controller');

            }
        }
    }
}

