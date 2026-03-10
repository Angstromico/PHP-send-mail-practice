<?php
require_once 'components/lang.php';

if($_POST) {
 $subject = $_POST['subject'];
 $description = $_POST['description'];
}


//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader (created by composer, not included with PHPMailer)
require 'libs/vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'manuesteban1990@gmail.com';                     //SMTP username
    $mail->Password   = 'ipwvkliwipobedeh';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('mailer1990@gmail.com', 'Mailer');
    $mail->addAddress('manuesteban1990@gmail.com', 'Manuel User');     //Add a recipient

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = $subject;
    $mail->Body    = $description;
    $mail->AltBody = 'This is just a test message. <b>in bold!</b>';

    $mail->send();
    header("Location: index.php");
    echo t('message_sent');
} catch (Exception $e) {
    echo t('message_error') . $mail->ErrorInfo;
}