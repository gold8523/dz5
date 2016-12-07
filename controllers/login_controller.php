<?php
session_start();
require dirname(__DIR__) . '/vendor/autoload.php';
//require dirname(__DIR__) . '/controller.php';
require dirname(__DIR__) . '/models/model_login.php';

class login_controller extends Controller
{


    public function action()
    {
        if (!empty($_COOKIE['auth'])) {
            $_SESSION['auth'] = true;
        }
        $isAuth = !empty($_SESSION['auth']);
        if ($isAuth) {
            header('Location: ../lk');
            exit();
        }

        $this->view->generate("login_view.twig");

//        parent::action(); // TODO: Change the autogenerated stub
//        $this->view->render('login_view.php', 'template_view.php');
    }

    public function entry()
    {

        $remoteIp = $_SERVER['REMOTE_ADDR'];
        $gRecaptchaResponse = $_REQUEST['g-recaptcha-response'];
        $secret = '6LfMIQ0UAAAAALN5yv0aY6kYwiNRZpI_yV75FCAB';

        $recaptcha = new \ReCaptcha\ReCaptcha($secret);
        $resp = $recaptcha->verify($gRecaptchaResponse, $remoteIp);
        if ($resp->isSuccess()) {
            // verified!
        } else {
            $errors = $resp->getErrorCodes();
        }

        if (!empty($_POST['log'])) {

            $selLog = new Model_Login();
            $pass = $_POST['password'];
            $logAll = $selLog->login_pass($pass);

            if ($_POST['remem'] == 'on') {
                setcookie('auth', '1', time() + 1800, '/');
            }


            if ($logAll[1] == strip_tags($_POST['log']) && $logAll[2] == strip_tags($_POST['password'])){
                $_SESSION['user_id'] = $logAll[3];
                $_SESSION['login'] = $logAll[1];
                $_SESSION['auth'] = true;
                $isAuth = $_SESSION['auth'];
                header('HTTP/1.1 404 Not Found');
                header('Location: ../lk');
                exit();
            } else {
                echo "Неверный логин или пароль!";
            }

        } else {
            echo 'Введите логин и пароль!';
        }
    }
}