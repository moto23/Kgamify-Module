<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" href="../assets/img/KLOGO.png" type="image/icon type" />

    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/title.png" />
    <link rel="icon" href="../assets/img/KLOGO.png" type="image/icon type" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Login | PlayQuest</title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no" name="viewport" />
    <link rel="stylesheet" href="../assets/css/index.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        .signup {
            float: right;
        }

        .button-container {
            display: flex;
            justify-content: space-between;
        }
        
        .password-container {
            position: relative;
            margin-bottom: 10px;
            width: 100%;
        }

        .show-password {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #333;
        }

        .button-container input {
            flex: 1;
            margin-right: 10px;
        }

        .forgot-password {
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>

<body>

     <div class="container" id="container">
        <div class="form-container sign-in-container">
            <div class="form" id="login-form">
                <h1>Login to Kgamify Faculty Portal</h1>
                <br />
                <input id="username" type="email" placeholder="Your Email" value="" required/>
                <span id="email_error" style="color: red; float: right"></span>
                <div class="password-container">
                    <input id="password" type="password" placeholder="Password" value="" required />
                    <span class="show-password" onclick="togglePassword('password')"><i class="fas fa-eye"></i></span>
                </div>
                <span id="password_error" style="color: red; float: right"></span>
                <br />
                <div class="button-container">
                    <input type="submit" onclick="login()" id="login-form-submit" class="signin" value="Login" />
                    <input type="button" onclick="window.location.href='signup.php'" class="signin signup" value="SignUp" />
                </div>
                <div class="forgot-password">
                    <a href="forgotpassword.php">Forgot Password?</a>
                </div>
            </div>
        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-right">
                    <img src="../assets/img/KLOGO.png" alt="" height="40%" />
                </div>
            </div>
        </div>
    </div>

    <script src="index.js"></script>
    <script src="../javaScript/template.js"></script>
    <script>
        function togglePassword(fieldId) {
        var field = document.getElementById(fieldId);
        if (field.type === "password") {
            field.type = "text";
        } else {
            field.type = "password";
        }
    }
    </script>
    <script>
        function login() {
            var username = document.getElementById("username").value;
            var password = document.getElementById("password").value;

            if (username.trim() === "" || password.trim() === "") {
                alert("Please enter the Credentials");
                return;
            }

            // console.log("Username:", username);
            // console.log("Password:", password);

            // Send the login data to the server-side script (e.g., login.php) using AJAX
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    console.log("Response:", this.responseText);
                    if (this.responseText === "success") {
                        // Redirect to the dashboard page if login is successful
                        window.location.href = "dashboard.php";
                    }
                    else if(this.responseText === "status"){
                        alert("Your Account has not been activated yet. If you have registered recently it can take approx. 24 hrs for the activation, pls try logging in tomorrow.");
                    }
                    else {
                        alert("Incorrect username or password");
                    }
                }
            };
            xhr.open("POST", "login.php", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.send("username=" + username + "&password=" + password);
        }
    </script>