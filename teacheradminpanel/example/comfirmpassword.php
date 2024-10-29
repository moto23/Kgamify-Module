

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" href="../assets/img/title.png" type="image/icon type" />

    <meta charset="utf-8" />
    <link
            rel="apple-touch-icon"
            sizes="76x76"
            href="../assets/img/title.png"
    />
    <link rel="icon" type="image/png" href="../assets/img/title.png" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Comfirm Password | PlayQuest</title>
    <meta
            content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no"
            name="viewport"
    />
    <link rel="stylesheet" href="../assets/css/index.css" />
    <style>
        .signup {
            float: right;
        }
    </style>
</head>
<body>
<div class="container" id="container">
    <div class="form-container sign-in-container">
        <div class="form" id="forgot-password-form">
            <h1>New Password</h1>
            <br/>
            <label for="new-password">New Password:</label>
            <input type="password" id="new-password" name="new-password" required>
            <br/>
            <label for="confirm-password">Confirm Password:</label>
            <input type="password" id="confirm-password" name="confirm-password" required>
            <br/>
            <input type="button" value="Reset" class="signin" onclick="resetPassword()">
        </div>
    </div>
   


    </div>
    <div class="overlay-container">
        <div class="overlay">
            <div class="overlay-panel overlay-right">
                <img src="../assets/img/PlayQuest Logo.png" alt="" height="40%"/>
            </div>
        </div>
    </div>
</div>


</body>
</html>
<!-- Your existing HTML code -->

<script>
function resetPassword() {
    var newPassword = document.getElementById('new-password').value;
    var confirmPassword = document.getElementById('confirm-password').value;

    if (newPassword !== confirmPassword) {
        alert("Passwords do not match");
        return;
    }

    var formData = new FormData();
    formData.append('newPassword', newPassword);

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "reset_password.php", true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            alert(xhr.responseText); // Display the response from the server
            if (xhr.responseText === "Password updated successfully!") {
                window.location.replace("index.php");
            }
        }
    };
    xhr.send(formData);
}
</script>

