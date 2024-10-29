<?php
session_start();

// Database credentials
$servername = "localhost";
$username = "u477273611_playquest";
$password = "TEAcher23@#";
$database = "u477273611_teacherpanel";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die(json_encode(["status" => "error", "message" => "Connection failed: " . $conn->connect_error]));
}

// Fetching data from POST request
$name = $_POST['name'];
$username = $_POST['username'];
$email = $_POST['email'];
$institute = $_POST['institute'];
$password = $_POST['password'];
$phone = $_POST['phone'];
$department = $_POST['department'];
$status=$_POST['status'];

// Encrypting password (Note: md5 should not be used for secure password hashing, consider using password_hash() and password_verify() instead)
$encrypted_password = md5($password);

// Prepare statement to check if email already exists
$stmt = $conn->prepare("SELECT * FROM teacher WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

// Check if email already registered
if ($result->num_rows > 0) {
    echo json_encode(["status" => "error", "message" => "Email already registered. Please use a different email address."]);
} else {
    // Generate verification token
    $verify_token = md5(uniqid(rand(), true));

    // Prepare statement to insert new teacher data into pending_verifications
    $stmt = $conn->prepare("INSERT INTO pending_verifications (status,teacher_name, username, email, password, phone, institute, department, verify_token) VALUES (?,?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("issssssss",$status, $name, $username, $email, $encrypted_password, $phone, $institute, $department, $verify_token);

    // Execute statement to insert new teacher record
    if ($stmt->execute()) {
        // Send email to user for account activation
        $subject = "Email Confirmation Notice";
        $message = "
        <html>
        <head>
            <title>Confirm Your Email</title>
        </head>
        <body style='font-family: Arial, sans-serif;'>
            <div style='max-width: 600px; margin: auto; padding: 20px; border: 1px solid #e0e0e0; border-radius: 10px; background-color: #ffffff;'>
                <div style='text-align: center;'>
                    <img src='https://kgamify.in/images/kgamify_banner.png' alt='kGamify Banner' style='max-width: 100%; height: auto;'>
                </div>
                <p>Dear $name,</p>
                <p>You have requested to be 'Knowledge Championship Creator' on kGamify platform with the following information:</p>
                <p>Name: $name<br>
                User Name: $username<br>
                Mobile Number: $phone</p>
                <p>Account activation process includes:</p>
                <ol>
                    <li>Confirmation of email account of Knowledge Championship Creator</li>
                    <li>Scanning of Knowledge Championship Creator identity by kGamify team. It could take 2-3 working days for this process.</li>
                    <li>Approval of your account as Knowledge Championship Creator will be informed on your registered email.</li>
                </ol>
                <br>
                <p>Please click below to confirm your email for requesting to open an account on kGamify platform.</p>
                <p>
                    <a href='https://kgamify.in/teacheradminpanel/example/verify.php?token=$verify_token' style='background-color: #ff6600; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;'>Confirm Email</a>
                </p>
                <br>
                <p>If clicking the button doesn't seem to work then you can copy and paste the following link into your browser.<br>
                <a href='https://kgamify.in/teacheradminpanel/example/verify.php?token=$verify_token'>https://kgamify.in/teacheradminpanel/example/verify.php?token=$verify_token</a></p>
                <p>On sign up you have accepted our <a href='https://kgamify.in/privacy-policy'>Privacy Policy</a> and <a href='https://kgamify.in/terms'>Terms</a>.</p>
                <br>
                <p>Thanks,</p>
                <p>Team kGamify</p>
                <br>
                <p>Please do not reply to this email. <a href='https://kgamify.in/contact'>Contact Us here</a>.</p>
                <p>kGamify is an AI enabled gamified knowledge championship platform. Please visit <a href='https://kgamify.in'>www.kgamify.in</a> to know more.</p>
                <br>
                <div style='text-align: center;'>
                    <a href='https://kgamify.in/' style='margin: 0 10px;'><img src='https://kgamify.in/images/favicon.png' alt='Company Website' width='24' height='24'></a>
                    <a href='https://www.instagram.com/kgamify/' style='margin: 0 10px;'><img src='https://cdn-icons-png.flaticon.com/128/174/174855.png' alt='Instagram' width='24' height='24'></a>
                    <a href='https://www.linkedin.com/company/kgamify/' style='margin: 0 10px;'><img src='https://cdn-icons-png.flaticon.com/128/2504/2504923.png' alt='LinkedIn' width='24' height='24'></a>
                </div>
                <br>
                <p>If you want to participate in knowledge championship kindly download our kGamify App from below stores.</p>
                <p>
                    <a href='https://play.google.com/store/apps/details?id=com.kgamify.app' style='margin-right: 15px;border-radius:5px'><img src='https://kgamify.in/images/google_playstore.png' alt='Google Play Store Button' width='135' height='40'></a>
                    <a href='https://apps.apple.com/us/app/kgamify/id123456789'><img src='https://developer.apple.com/app-store/marketing/guidelines/images/badge-example-preferred_2x.png' alt='Apple Store Button' width='135' height='40'></a>
                </p>
                <p style='font-size: 12px; color: #888888;'>Disclaimer:<br>
                This automated email is sent by kGamify platform because you have requested to sign up. In case you have not requested to sign up then please ignore email and do not confirm your email.</p>
                <p style='font-size: 12px; color: #888888;'>&copy; 2024 Yantriksoft Pvt. Ltd. All rights reserved</p>
            </div>
        </body>
        </html>
        ";
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= "From: no-reply@kgamify.com";

        // Sending email
        mail($email, $subject, $message, $headers);

        echo json_encode(["status" => "success", "message" => "Teacher registered successfully. Please check your mail for activating your account."]);
    } else {
        // Error message if registration fails
        echo json_encode(["status" => "error", "message" => "Error: " . $conn->error]);
    }
}

// Close prepared statement and database connection
$stmt->close();
$conn->close();
?>
