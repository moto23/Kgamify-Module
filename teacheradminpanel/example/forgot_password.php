<?php
require 'vendor/autoload.php'; // Path to your PHPMailer autoload.php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];

    // Check if the email exists in your database
    $stmt = $conn->prepare("SELECT teacher_id FROM teacher WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();

    if ($result->num_rows > 0) {
        // Generate a unique token
        $token = bin2hex(random_bytes(32));

        // Store the token in your database with the user's email
        $stmt = $conn->prepare("UPDATE teacher SET verify_token = ? WHERE email = ?");
        $stmt->bind_param("ss", $token, $email);
        $stmt->execute();
        $stmt->close();

        // Send the password reset link to the user's email
        $mail = new PHPMailer(true);
        try {
            // Server settings
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = 'prasadnathe2018@gmail.com';               // SMTP username
            $mail->Password   = 'REDmi23@#';                 // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

            // Recipients
            $mail->setFrom('prasadnathe2018@gmail.com', 'Prasad Nathe');
            $mail->addAddress($email);                                  // Add a recipient

            // Content
            $mail->isHTML(true);                                       // Set email format to HTML
            $mail->Subject = 'Verify Your Email';
            $mail->Body    = 'Click the following link to verify your email: <a href="https://kgamify.in/teacheradminpanel/example/comfirmpassword.php?token=' . $token . '">Verify Email</a>';

            $mail->send();
            echo 'Verification link sent successfully!';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        echo "Email not found";
    }
}
