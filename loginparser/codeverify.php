<?php


include("../config.php");
session_start();

$cod2=$_POST["codver"];
$mail=$_SESSION["AUTHTEMPMAIL"];
$pass=$_SESSION["AUTHTEMPPASS"];
$salt=$_SESSION["AUTHTEMPSALT"];
$nume=$_SESSION["AUTHTEMPNAME"];
$codverificare=$_SESSION["AUTHTEMPCODE"];

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
        header("Location: /../loginauth/authenticate.php");
        exit();
    }
    header("Location: /../loginauth/code.php");
    exit();
}
else
{
    $sql = "INSERT INTO `login` (`id`, `email`, `password`, `name`, `salt`) VALUES (DEFAULT, '$mail', '$pass', '$nume', '$salt')";
//$sql = "INSERT INTO `login` (`id`, `email`, `password`, `name`, `salt`) VALUES (DEFAULT, '$mail', '$pass', '$nume', '$salt')";

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
                $_SESSION["LOGINPFP"]="https://iconarchive.com/download/i48697/custom-icon-design/pretty-office-2/man.ico";
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
