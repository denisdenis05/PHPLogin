<?php

$servername = "localhost";
//$servername = "146.190.19.215";
$username = "root";
//$username = "epic";
$password = "";
//$password = "!1Samsungtv";
$database = "login";
//$database = "login";
$table = "login";
//$table = "login";

global $conn;
$conn = mysqli_connect($servername, $username, $password, $database);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

//$sql = "INSERT INTO $table (email, password) VALUES ('afjhdf@gmail.com', 'ndihwiuhef')";

//$conn->query($sql);

?>