<?php

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
        header("Location: /../loginauth/authenticate.php");
        exit();
    }
}
function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
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

$mail=$_POST["mailauth"];
$pass1=$_POST["passauth"];
$pass2=$_POST["passauth2"];
$nume=$_POST["nameauth"];
$salt=generateRandomString(8);
$saltcopy=$salt;
$codverificare=generateRandomInt(6);
$temppass=$pass1.$saltcopy;
$pass=hash('sha512',$temppass);
include("../config.php");
$result = $conn->query("SELECT `id` FROM `login` WHERE `email` = '$mail'");
if($result->num_rows != 0) {
    $_SESSION["emailexistent"]="yes";
    header("Location: /../loginauth/authenticate.php");
    exit();
}
if(strlen($pass1)<8)
{
    $_SESSION["shortpass"]="yes";
    header("Location: /../index.php");
    exit();
}

if(strcmp($pass1, $pass2))
{
    $_SESSION["diffpass"]="yes";
    header("Location: /../index.php");
    exit();
}

$_SESSION["AUTHTEMPMAIL"] = $mail;
$_SESSION["AUTHTEMPPASS"] = $pass;
$_SESSION["AUTHTEMPSALT"] = $saltcopy;
$_SESSION["AUTHTEMPNAME"] = $nume;
$_SESSION["AUTHTEMPCODE"] = $codverificare;
$_SESSION["LOGINPFP"]="https://iconarchive.com/download/i48697/custom-icon-design/pretty-office-2/man.ico";

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
$phpmail->addAddress($mail, $nume);     // Add a recipient
$phpmail->WordWrap = 50;
$phpmail->Subject = 'Cod verificare Pregatiri Online';
$phpmail->Body    = 'Codul de verificare este <b>'.$codverificare.'</b>';
$phpmail->AltBody = 'Codul de verificare este'.$codverificare;

$phpmail->send();

$_SESSION["slowmode"]=time();
header("Location: /../loginauth/code.php");
exit();



$sql = "INSERT INTO `login` (`id`, `email`, `password`, `name`, `salt`) VALUES (DEFAULT, '$mail', '$pass', '$nume', '$salt')";
//$sql = "INSERT INTO `login` (`id`, `email`, `password`, `name`, `salt`) VALUES (DEFAULT, '$mail', '$pass', '$nume', '$salt')";

function sqlsave()
{
    if ($conn->query($sql) === TRUE) {
        $_SESSION["contcreat"] = "yes";

        $sql2 = "SELECT id, name, email, password FROM login";
        $result = $conn->query($sql2);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc())
                if (!strcmp($row["email"], $mail)) {
                    $_SESSION["LOGINID"] = $row["id"];
                    break 1;
                }
            $_SESSION["LOGINp"] = "yes";
            $_SESSION["LOGINNAME"] = $nume;
            header("Location: /../index.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        header("Location: /../index.php");
        if (isset($_SESSION["auth"]))
            unset($_SESSION["auth"]);
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}


?>