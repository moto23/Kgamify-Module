<?php
$conn = new mysqli('localhost', 'u477273611_playquest', 'TEAcher23@#', 'u477273611_teacherpanel');

// Check for database connection error
if ($conn->connect_error) {
    die("Connection Failed : " . $conn->connect_error);
}

if (isset($_GET['teacher_id']) && isset($_GET['status'])) {
    $teacher_id = $_GET['teacher_id'];
    $status = $_GET['status'];
    
    // Update the status in the database
    $query = "UPDATE teacher SET status = $status WHERE teacher_id = $teacher_id";
    $result = mysqli_query($conn, $query);

    if ($result) {
        // Get email and name parameters if they are set
        $email = isset($_GET['email']) ? urldecode($_GET['email']) : '';
        $name = isset($_GET['name']) ? urldecode($_GET['name']) : '';
        
        if ($email && $name) {
            if ($status == 1) {
                // Prepare the email for activation
                $subject = "Account Activation Notice";
                $message = "
                <html>
                <head>
                    <title>Account Activated</title>
                </head>
                <body style='font-family: Arial, sans-serif;'>
                    <div style='max-width: 600px; margin: auto; padding: 20px; border: 1px solid #e0e0e0; border-radius: 10px; background-color: #ffffff;'>
                        <h2 style='color: #ff6600;'>Account Activated</h2>
                        <p>Hey $name,</p>
                        <p>Your account has been successfully activated !!!</p>
                        <p>Now you can log in to your account by clicking on the Login button below.</p>
                        <br>
                        <p>
                            <a href='https://kgamify.in/teacheradminpanel/example/index.php' style='background-color: #ff6600; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;'>LOGIN</a>
                        </p>
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
            } else if ($status == 0) {
                // Prepare the email for deactivation
                $subject = "Account Deactivation Notice";
                $message = "
                <html>
                <head>
                    <title>Account Deactivated</title>
                </head>
                <body style='font-family: Arial, sans-serif;'>
                    <div style='max-width: 600px; margin: auto; padding: 20px; border: 1px solid #e0e0e0; border-radius: 10px; background-color: #ffffff;'>
                        <h2 style='color: #da190b;'>Account Deactivated</h2>
                        <p>Hey $name,</p>
                        <p>Your account has been deactivated. If you believe this is a mistake or you need further assistance, please contact our support team.</p>
                        <p>Thanks.</p>
                        <br>
                        <div style='text-align: center;'>
                            <a href='https://kgamify.in/' style='margin: 0 10px;'><img src='https://kgamify.in/images/logo1.png' alt='Company Website' width='24' height='24'></a>
                            <a href='https://www.instagram.com/kgamify/' style='margin: 0 10px;'><img src='https://cdn-icons-png.flaticon.com/128/174/174855.png' alt='Instagram' width='24' height='24'></a>
                            <a href='https://www.linkedin.com/company/kgamify/' style='margin: 0 10px;'><img src='https://cdn-icons-png.flaticon.com/128/2504/2504923.png' alt='LinkedIn' width='24' height='24'></a>
                        </div>
                    </div>
                </body>
                </html>
                ";
            }

            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $headers .= "From: no-reply@kgamify.com";

            // Send the email
            mail($email, $subject, $message, $headers);
        }
        
        header("Location: all_teachers.php"); // Redirect back to the teacher list or desired page
        exit();
    } else {
        echo "Failed to update status.";
    }
} else {
    echo "Invalid request.";
}
$conn->close();
?>
