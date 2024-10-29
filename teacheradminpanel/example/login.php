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
    // Get the login data from the POST request
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare and execute an SQL statement to retrieve the user from the database
    $stmt = $conn->prepare("SELECT * FROM teacher WHERE email = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // User found, verify the password
        $user = $result->fetch_assoc();
        $stored_password = $user['password'];
        $status=$user['status'];
        $hashed_input_password = md5($password);

        if ($hashed_input_password === $stored_password && $status==1) {
            // Password is correct, set session variables
            $_SESSION['email'] = $username;
            $_SESSION['phone'] = $user['phone'];
            $_SESSION['loggedin'] = true;
            echo "success";
        } 
        else if($status==0){
            echo "status";
        }
        else {
            // Password is incorrect
            echo "Incorrect password. Please try again.";
        }
    } else {
        // User not found
        echo "User not found. Please check your username.";
    }

    $stmt->close();
}

$conn->close();
?>
