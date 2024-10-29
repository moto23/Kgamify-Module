<?php

$servername = "localhost";
$username = "u477273611_playquest";
$password = "TEAcher23@#";
$dbname = "u477273611_teacherpanel";

$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}




?>