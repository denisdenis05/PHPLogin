<?php

include("../config.php");
session_start();

$sql = "SELECT id, name, email, password, salt, admin, pfp FROM login";
//$sql = "SELECT id, name, email, password, salt FROM login";
$result = $conn->query($sql);

$mail=$_POST["maillogin"];
$pass1=$_POST["passlogin"];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        if(!strcmp($row["email"], $mail)) {
            $salt=$row["salt"];
            $temppass=$pass1.$salt;
            $pass=hash('sha512',$temppass);
            if (!strcmp($row["password"], $pass)) {
                $_SESSION["LOGINp"]="yes";
                $_SESSION["LOGINNAME"]=$row["name"];
                $_SESSION["LOGINID"]=$row["id"];
                if(is_null($row["admin"])!=1)
                    $_SESSION["LOGINADMIN"]="DA";
                if(!empty($row["pfp"]))
                    $_SESSION["LOGINPFP"]=$row["pfp"];
                else
                    $_SESSION["LOGINPFP"]="https://iconarchive.com/download/i48697/custom-icon-design/pretty-office-2/man.ico";
                header("Location: /../index.php");
                exit();
            }
            else
                echo "wrong password. Mail: ".$row["email"]. " compared to ".$mail. ". Pass: " .$row["password"]. " compared to ".$pass;
            break 1;

        }
    }
    $_SESSION["wrongpass"]="yes";
    header("Location: /../index.php");
    if(isset($_SESSION["auth"]))
        unset($_SESSION["auth"]);
    exit();
} else {
    echo "0 results";
}


?>

