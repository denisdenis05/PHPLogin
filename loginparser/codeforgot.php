<?php


include("../config.php");
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if(isset($_SESSION["slowmode"])) {
    $timp=time();
    $timp2=$_SESSION["slowmode"];
    if($timp-$timp2>=30)
        unset($_SESSION["slowmode"]);
    else {
        $_SESSION["slowmodeactiv"]=$timp2;
        header("Location: /../loginauth/forgotpass.php");
        exit();
    }
}
function generateRandomInt($length = 6) {
    $characters = '0123456789';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
$codverificare=generateRandomInt(6);
$mail=$_POST["mailforgot"];
$_SESSION["FORGOTTEMPMAIL"] = $mail;
$_SESSION["FORGOTTEMPCODE"] = $codverificare;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


require_once "../vendor/autoload.php";

//PHPMailer Object
$phpmail = new PHPMailer;
$phpmail->isSMTP();

$phpmail->Host = 'mail.server.eu';
$phpmail->Port       = 587;
$phpmail->SMTPAuth = true;                               // Enable SMTP authentication
$phpmail->Username = 'no-reply@mail.ro';                 // SMTP username
$phpmail->Password = 'pass';                           // SMTP password
$phpmail->SMTPSecure = 'tls';
$phpmail->From = 'no-reply@mail.ro';
$phpmail->FromName = 'Pregatiri Online';
$phpmail->addAddress($mail, "Utilizator");     // Add a recipient
$phpmail->WordWrap = 50;
$phpmail->Subject = 'Cod verificare Pregatiri Online';
$phpmail->Body    = 'Codul de verificare pentru schimbarea parolei este <b>'.$codverificare.'</b>';
$phpmail->AltBody = 'Codul de verificare pentru schimbarea parolei este'.$codverificare;

$phpmail->send();
$_SESSION["slowmode"]=time();
header("Location: /../loginauth/codeforgotpage.php");
exit();

?>
