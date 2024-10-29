<?php
session_start();

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

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the current user's email from the session
    $email = $_SESSION['email'];

    // Get the new password from the form
    $newPassword = $_POST['newPassword'];

    // Prepare and execute an SQL statement to update the password for the user
    $stmt = $conn->prepare("UPDATE teacher SET password = ? WHERE email = ?");
    $stmt->bind_param("ss", $newPassword, $email);
    if ($stmt->execute()) {
        echo "Password updated successfully!";
    } else {
        echo "Error updating password: " . $conn->error;
    }

    $stmt->close();
}

$conn->close();
