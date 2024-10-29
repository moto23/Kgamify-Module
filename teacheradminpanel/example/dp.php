<?php
$conn = new mysqli('localhost', 'u477273611_playquest', 'TEAcher23@#', 'u477273611_teacherpanel');

// Check connection
if (mysqli_connect_errno()) {
    $error = "Failed to connect to MySQL: " . mysqli_connect_error();
    die();
}

date_default_timezone_set('Asia/Karachi');
