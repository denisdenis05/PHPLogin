<?php


include("../config.php");
session_start();

$pass1=$_POST["pass"];
$mail=$_SESSION["FORGOTTEMPMAIL"];

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
$salt=generateRandomString(8);
$saltcopy=$salt;
$temppass=$pass1.$saltcopy;
$pass=hash('sha512',$temppass);


$sql = "UPDATE `login` SET `password`='$pass' WHERE `email`='$mail'";
$sql2 = "UPDATE `login` SET `salt`='$salt' WHERE `email`='$mail'";

//$sql = "INSERT INTO `login` (`id`, `email`, `password`, `name`, `salt`) VALUES (DEFAULT, '$mail', '$pass', '$nume', '$salt')";
$conn->query($sql);
    if ($conn->query($sql2) === TRUE) {
        $_SESSION["contschimbat"] = "yes";

        $sql2 = "SELECT id, name, email, password,admin,pfp FROM login";
        $result = $conn->query($sql2);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc())
                if (!strcmp($row["email"], $mail)) {
                    $_SESSION["LOGINID"] = $row["id"];
                    $_SESSION["LOGINNAME"] = $row["name"];
                    if(is_null($row["admin"])!=1)
                        $_SESSION["LOGINADMIN"]="DA";
                    if(!empty($row["pfp"]))
                        $_SESSION["LOGINPFP"]=$row["pfp"];
                    else
                        $_SESSION["LOGINPFP"]="https://iconarchive.com/download/i48697/custom-icon-design/pretty-office-2/man.ico";
                    break 1;
                }
            $_SESSION["LOGINp"] = "yes";
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


?>
