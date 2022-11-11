<?php

if (session_status() === PHP_SESSION_NONE)
    session_start();

require_once 'vendor/autoload.php';
include("config.php");

// init configuration
$clientID = '165923026983-n1fe70qbdrbh0t2aahc7b5v85pl3pumk.apps.googleusercontent.com';
$clientSecret = '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';
$redirectUri = 'http://localhost/redirect.php';

// create Client Request to access Google API
$client = new Google_Client();
$client->setClientId($clientID);
$client->setClientSecret($clientSecret);
$client->setRedirectUri($redirectUri);
$client->addScope("email");
$client->addScope("profile");

// authenticate code from Google OAuth Flow
if (isset($_GET['code'])) {
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    $client->setAccessToken($token['access_token']);

    // get profile info
    $google_oauth = new Google_Service_Oauth2($client);
    $google_account_info = $google_oauth->userinfo->get();
    $email =  $google_account_info->email;
    $name =  $google_account_info->name;

    $result = $conn->query("SELECT `id`,`name`, `admin`, `pfp` FROM `login` WHERE `email` = '$email'");
    if($result->num_rows != 0) {
        $_SESSION["LOGINp"]="yes";
        while ($row = $result->fetch_assoc())
        {
            $_SESSION["LOGINID"]=$row["id"];
            $_SESSION["LOGINNAME"]=$row["name"];
            if(!empty($row["admin"]))
                $_SESSION["LOGINADMIN"]="DA";
            if(!empty($row["pfp"]))
                $_SESSION["LOGINPFP"]=$row["pfp"];
            else
                $_SESSION["LOGINPFP"]="https://iconarchive.com/download/i48697/custom-icon-design/pretty-office-2/man.ico";
        }
        header('Location: index.php');
        exit();
    }
    else {
        $sql = "INSERT INTO `login` (`id`, `email`, `password`, `name`, `salt`) VALUES (DEFAULT, '$email', 'GOOGLELOGIN', '$name', 'GOOGLELOGIN')";
        $_SESSION["LOGINp"] = "yes";
        $_SESSION["LOGINNAME"] = $name;
        $result = $conn->query("SELECT `id` FROM `login` WHERE `email` = '$email'");
        if($result->num_rows != 0)
            while ($row = $result->fetch_assoc())
                $_SESSION["LOGINID"] = $row["id"];
        header('Location: index.php');
        exit();
    }
    // now you can use this profile info to create account in your website and make user logged in.
} else {
    header("Location: ".$client->createAuthUrl());
    exit();
}
?>