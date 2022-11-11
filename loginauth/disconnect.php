<?php

include("../config.php");
session_start();

$sql = "SELECT id, name, email, password FROM login";
$result = $conn->query($sql);

unset($_SESSION["LOGINp"]);
unset($_SESSION["LOGINNAME"]);
unset($_SESSION["LOGINID"]);
unset($_SESSION["LOGINPFP"]);
unset($_SESSION["LOGINADMIN"]);
    header("Location: /../index.php");
    exit();
?>