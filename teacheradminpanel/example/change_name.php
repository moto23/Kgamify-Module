<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // Redirect to the login page
    echo "<script>alert('You need to LOGIN to view this page.'); window.location.href = 'index.php';</script>";
    exit();
}
?>
<?php

// Database connection parameters
$servername = "localhost";
$username = "u477273611_playquest";
$password = "TEAcher23@#";
$database = "u477273611_teacherpanel";

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the new name from the POST request
$newName = $_POST['new_name'];

// Update the teacher's name in the database
$email = $_SESSION['email'];
$phone = $_SESSION['phone'];
$sql = "UPDATE teacher SET teacher_name='$newName' WHERE email='$email' AND phone='$phone'";
if ($conn->query($sql) === TRUE) {
    echo "Name changed successfully";
} else {
    echo "Error updating record: " . $conn->error;
}

$conn->close();