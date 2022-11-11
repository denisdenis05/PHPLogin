<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


require_once "vendor/autoload.php";

//PHPMailer Object
$mail = new PHPMailer;
$mail->isSMTP();

$mail->Host = 'mail.host.eu';
$mail->Port       = 587;
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'no-reply@pregatirionline.ro';                 // SMTP username
$mail->Password = 'pass';                           // SMTP password
$mail->SMTPSecure = 'tls';
$mail->From = 'no-reply@mail.ro';
$mail->FromName = 'Cod';
$mail->addAddress('denis@gmail.com', 'Denis');     // Add a recipient
$mail->WordWrap = 50;  
$mail->Subject = 'TESTTESTTEST';
$mail->Body    = 'mesaj <b>finalizat sau cv</b>';
$mail->AltBody = 'mesaj finalizat sau cv';

$mail->send();

?>