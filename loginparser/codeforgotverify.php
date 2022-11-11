<?php


include("../config.php");
session_start();

$cod2=$_POST["codver"];
$mail=$_SESSION["FORGOTTEMPMAIL"];
$codverificare=$_SESSION["FORGOTTEMPCODE"];

if(strcmp($codverificare, $cod2))
{
    $_SESSION["diffcode"]="yes";
    if(!isset($_SESSION["diffcodecounter"]))
        $_SESSION["diffcodecounter"]= 1;
    else
        $_SESSION["diffcodecounter"]=$_SESSION["diffcodecounter"]+ 1;
    if($_SESSION["diffcodecounter"]==3)
    {
        unset($_SESSION["FORGOTTEMPMAIL"]);
        unset($_SESSION["FORGOTTEMPCODE"]);
        unset($_SESSION["diffcodecounter"]);
        $_SESSION["slowmode"]=time();
        $_SESSION["slowmodeactiv"]=time();
        header("Location: /../loginauth/forgotpass.php");
        exit();
    }
    header("Location: /../loginauth/codeforgotpage.php");
    exit();
}
else
{
    $_SESSION["changepassauthorizat"]="yes";
    header("Location: /../loginauth/changepass.php");
    exit();

}

?>
