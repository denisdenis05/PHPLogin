<?php

include("../config.php");
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$img=$_POST["mydata"];
$id=$_SESSION["LOGINID"];

if(strlen($img)>800000)
{
    $_SESSION["filetoolarge"]="dap";
    header("Location: /../cont.php");
    exit();
}

$result = $conn->query("UPDATE `login` SET `pfp`='$img' WHERE `id`='$id'");
$_SESSION["LOGINPFP"]=$img;

header("Location: /../cont.php");
exit();

?>