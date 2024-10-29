<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" href="../assets/img/title.png" type="image/icon type" />

    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/title.png" />
     <link rel="icon" href="../assets/img/KLOGO.png" type="image/icon type" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Forgot Password| PlayQuest</title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no" name="viewport" />
    <link rel="stylesheet" href="../assets/css/index.css" />
    <style>
        .signup {
            float: right;
        }

        .signin {
            /* Other styles remain the same */
            padding: 10px 30px;
            /* Adjust padding for button size */
            font-size: 18px;
            /* Adjust font size for button text */
            text-align: center;
            /* Center the text within the button */
            display: inline-block;
            /* Ensure button size adjusts to content */
            width: auto;
            /* Allow button to adjust width based on content */
        }

        .form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .form input[type="submit"],
        .form input[type="button"] {
            margin-top: 10px;
        }

        .form .button-container {
            display: flex;
            justify-content: space-between;
            width: 100%;
        }

        #email {
            width: 300px;
            /* Set the width of the email input */
            padding: 9px;
            /* Add padding to the email input */
            margin-bottom: 10px;
            /* Add space below the email input */
        }

        .forgot-password-text {
            width: 300px;
            margin-bottom: 10px;
            /* Add space below the "Forgot Password" text */
        }
    </style>
</head>

<body>



    <div class="form-container sign-in-container">
        <div class="form" id="signup-form">
            <form action="#" method="POST" name="forgot_password_form">
                <div class="form" id="forgot-password-form">
                    <h1>Forgot Password</h1>
                    <br />
                    <input id="email" type="email" placeholder="Enter Your Email" name="email" required>
                    <span id="email_error" style="color: red; float: right"></span> <!-- Error message for email validation -->
                    <br />
                    <div class="button-container">
                        <input type="button" class="signin" value="Back" onclick="window.location.href='index.php'">
                        <input type="submit" class="signin" value="Continue">
                    </div>
                </div>
            </form>
        </div>
    </div>

   <div class="overlay-container">
    <div class="overlay">
        <div class="overlay-panel overlay-right">
            <img src="../assets/img/KLOGO.png" alt="" height="40%"/>
        </div>
    </div>
</div>



    <script src="index.js"></script>
    <script src="../javaScript/template.js"></script>
</body>

</html>


<?php
if (isset($_POST["email"])) {
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

    $email = $_POST["email"];

    // Prepare and execute the SQL statement
    $stmt = $conn->prepare("SELECT * FROM teacher WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows <= 0) {
?>
        <script>
            alert("Sorry, no emails exist");
        </script>
        <?php
    } else {
        $fetch = $result->fetch_assoc();

        // generate token by binaryhexa
        $token = bin2hex(random_bytes(50));

        $_SESSION['token'] = $token;
        $_SESSION['email'] = $email;

        require "Mail/phpmailer/PHPMailerAutoload.php";
        $mail = new PHPMailer;

        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 587;
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'tls';

        $mail->Username = 'prasadnathe2018@gmail.com';
        $mail->Password = 'xemh pdvc xybh phos';

        $mail->setFrom('prasadnathe2018@gmail.com', 'Password Reset');
        $mail->addAddress($email); // Use the email fetched from the POST data

        $mail->isHTML(true);
        $mail->Subject = "Recover your password";
        $mail->Body = "<b>Dear User</b>
        <h3>We received a request to reset your password.</h3>
        <p>Kindly click the below button to reset your password</p>
        <form method='GET' action='https://kgamify.in/teacheradminpanel/example/comfirmpassword.php'>
        <input type='hidden' name='email' value='$email'>
        <input type='hidden' name='token' value='$token'>
        <button type='submit'>Reset Password</button>
        </form>
        <br><br>
        <p>With regards,</p>
        <b>Prasad Nathe</b>";

        if (!$mail->send()) {
        ?>
            <script>
                alert("Failed to send email: <?php echo $mail->ErrorInfo; ?>");
            </script>
        <?php
        } else {
        ?>
            <script>
                window.location.replace("notification.html");
            </script>
<?php
        }
    }
}
?>






</body>

</html>