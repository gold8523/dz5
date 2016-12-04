<?php
require dirname(__DIR__) . '/vendor/autoload.php';
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
    $mail->Body    = $_POST['email'];
    $mail->AltBody = $_POST['email'];

    if(!$mail->send()) {
        echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
        echo 'Message has been sent';
    }
}