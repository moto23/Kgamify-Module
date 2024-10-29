<?php
session_start();
?>
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

     <link rel="icon" href="../assets/img/KLOGO.png" type="image/icon type" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Signup | PlayQuest</title>
    <meta
            content="width=device-width, initial-scale=1.0, maximum-scale=2.0, user-scalable=0, shrink-to-fit=no"
            name="viewport"
    />
    <link rel="stylesheet" href="../assets/css/index.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.5.0/css/flag-icon.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
    <script data-require="jquery" data-semver="2.1.3" src="http://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script data-require="bootstrap" data-semver="3.3.2" src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
    <script data-require="angular.js@1.3.x" src="https://code.angularjs.org/1.3.14/angular.js" data-semver="1.3.14"></script>
    <script data-require="ui-bootstrap" src="https://cdnjs.cloudflare.com/ajax/libs/angular-ui-bootstrap/0.13.0/ui-bootstrap-tpls.min.js" data-semver="0.13.0"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
   <style>
     
     
        .signup {
            float: right;
        }

        .form {
            display: flex;
            flex-direction: column;
            align-items: center;
            
        }

        .form input[type="text"],
        .form input[type="email"],
        .form input[type="password"],
        .form input[type="tel"],
        .form input[type="button"] {
            margin-top: 5px;
        }

        .form input[type="button"].signup {
            margin-left: 5px; /* Reduced margin */
        }

        .form .button-container {
            display: flex;
            justify-content: space-between;
            width: 100%;
            margin-top: 2px;
        }

        .password-container {
            position: relative;
            margin-bottom: 10px;
            width: 100%;
        }

        .show-password {
            position: absolute;
            right: 5px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #333;
        }

        .form .form-heading {
            margin-top: 100px; /* Add margin to the top of the heading */
        }

        #phone {
            width: calc(102% - 5px); /* Subtract the width of the flag icon */
            padding-right: 190px; /* Space for the flag icon */
        }
        
        select option {
    color: orange;
}

select.js-example-basic option {
    color: orange;
}

 .required::after {
    content: "*";
    color: red;
    position: absolute;
    right: 5px;
    top: 50%;
    transform: translateY(-50%);
}




   .popup {
            position: fixed;
            top: 10px;
            right: 10px;
            padding: 20px;
            background-color: green;
            color: white;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            display: none;
        }

        .popup .close-btn {
            position: absolute;
            top: 5px;
            right: 10px;
            cursor: pointer;
            color: white;
            font-weight: bold;
        }
        
        
   /* Privacy policy styling */
.privacy-policy-container {
    display: flex;
    align-items: center;
    margin-top: 5px;
    justify-content: flex-start; /* Align to the left */
}

.privacy-policy-container label {
    font-size: 14px;
    margin-left: 5px; /* Bring the label closer to the checkbox */
    font-weight: normal; 
    color: #333; 
    white-space: nowrap; /* Ensure the text stays in one line */
    line-height: 1; /* Adjust line height if needed */
    cursor: pointer; /* Pointer cursor on the text as well */
}

#privacy-policy-checkbox {
    margin: 0; /* Remove extra margins to keep it close to the label */
    padding: 0; /* Remove padding to decrease the clickable area */
    cursor: pointer; /* Pointer cursor for the checkbox */
    width: auto; /* Remove any extra width */
}

.privacy-policy-container a {
    color: orange; 
    text-decoration: none; 
}

.privacy-policy-container a:hover {
    text-decoration: underline; 
}

#privacy-policy-error {
    margin-top: 5px;
    font-size: 12px;
}




        
        
    </style>
</head>
<body>
    
 <div style="height: 200vh; background-color: #f0f0f0;">
    <div class="container" id="container">
        <div class="form-container sign-in-container">
            <div class="form" id="signup-form">
                <h1 class="form-heading">Sign Up for Kgamify Faculty Portal</h1>
                <br/>
                <input id="name" type="text" placeholder="* Faculty Name" required>
                <input id="username" type="text" placeholder="* Username" required>
                
                <input id="email" type="email" placeholder="* Enter Your Email" required>
                <span id="email-error" style="color: red;"></span>
                
                <div class="password-container">
                    <input id="password" type="password" placeholder="* Password" required>
                    <span class="show-password" onclick="togglePassword('password')"><i class="fas fa-eye"></i></span>
                </div>

                <div class="password-container">
                    <input id="confirm-password" type="password" placeholder="* Confirm Password" required>
                    <span class="show-password" onclick="togglePassword('confirm-password')"><i class="fas fa-eye"></i></span>
                </div>
                <div id="password-match-message"></div>

                <input id="phone" type="tel" placeholder="* Mobile Number" required>
                <span id="phone-error" style="color: red;"></span>
                
                <div id="otp-container" style="display: none;">
                    <input id="otp" type="text" placeholder="* Enter OTP" required>
                    <span id="otp-error" style="color: red;"></span>
                    <button id="send-otp-button" onclick="sendOTP()">Send OTP</button>
                </div>

            </br> 
            <fieldset style="display: inline-block; width: 100%;">
    <select class="js-example-basic" name="institute" id="institute" style="width: 100%;">
        <option value="" selected disabled>Select Institute</option>
        <!-- Options will be populated by PHP -->
        <?php
        $conn = new mysqli('localhost', 'u477273611_playquest', 'TEAcher23@#', 'u477273611_teacherpanel');

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT institute_name FROM institute";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $cat_name = $row["institute_name"];
                echo "<option value='$cat_name'>$cat_name</option>";
            }
        }
        $result->free(); // Free the result set
        ?>
    </select>
    <span class="focus"></span>
</fieldset>

<br/>

<fieldset style="display: inline-block; width: 100%;">
    <select class="js-example-basic-single" name="department" id="department" style="width: 100%;">
        <option value="" selected disabled>Select Department</option>
        <!-- Options will be populated based on selected institute -->
    </select>
    <span class="focus"></span>
</fieldset>

                      <br />
                      
                      
<!-- Privacy Policy Checkbox -->
<div class="privacy-policy-container">
    <input type="checkbox" id="privacy-policy-checkbox">
    <label for="privacy-policy-checkbox">
        By signing up you agree to our 
        <a href="https://kgamify.in/teacheradminpanel/example/privacy_page.php" target="_blank">Terms and Conditions & Privacy Policy</a>
    </label>
</div>






<span id="privacy-policy-error" style="color: red;"></span>

<br />
<div class="button-container" style="display: flex; justify-content: space-between;">
    <input type="button" onclick="window.location.href='index.php'" class="signin signup" value="Login" style="margin-right: px; margin-left: 7px;">
    <input type="button" onclick="registerUser()" class="signin" value="Sign Up">
</div>
<div id="fill-form-message" style="color: red;"></div>
            </div>
            <br/>

        </div>
    </div>
</div>
</div>

<div class="overlay-container">
    <div class="overlay">
        <div class="overlay-panel overlay-right">
            <img src="../assets/img/KLOGO.png" alt="" height="40%"/>
        </div>
    </div>
</div>


<!-- Pop-up message div -->
<!--<div id="popup-message" style="display:none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: green; color: white; padding: 20px; border-radius: 5px; z-index: 1000;">-->
<!--    Faculty Registered Successfully. Please check your E-Mail for comfirming your Account.-->
<!--    <button onclick="closePopup()" style="background-color: red; color: white; border: none; padding: 5px 10px; margin-top: 10px;">Close</button>-->
<!--</div>-->

<div id="popup-message" style="display:none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: green; color: white; padding: 20px; border-radius: 5px; z-index: 1000;">
    <p id="popup-text"></p>
    <button onclick="closePopup()" style="background-color: red; color: white; border: none; padding: 5px 10px; margin-top: 10px;">Close</button>
</div>



    
    

<script src="index.js"></script>
<script src="../javaScript/template.js"></script>
<script>

    var input = document.querySelector("#phone");
    var iti = window.intlTelInput(input, {
    separateDialCode: true,
    initialCountry: "in" // Default country code for India
});



    function togglePassword(fieldId) {
        var field = document.getElementById(fieldId);
        if (field.type === "password") {
            field.type = "text";
        } else {
            field.type = "password";
        }
    }

    document.getElementById("confirm-password").addEventListener("input", function() {
        var password = document.getElementById("password").value;
        var confirmPassword = document.getElementById("confirm-password").value;
        var messageElement = document.getElementById("password-match-message");
        
        if(password.trim()=="" && confirmPassword.trim()==""){
            messageElement.textContent = "";
        }
        
        else if(password === confirmPassword) {
            messageElement.textContent = "Passwords match!";
            messageElement.style.color = "green";
        } else {
            messageElement.textContent = "Passwords do not match.";
            messageElement.style.color = "red";
        }
        
    });
    
    document.getElementById("password").addEventListener("input", function() {
        var password = document.getElementById("password").value;
        var confirmPassword = document.getElementById("confirm-password").value;
        var messageElement = document.getElementById("password-match-message");
        if(password.trim()=="" && confirmPassword.trim()==""){
            messageElement.textContent = "";
        }
        
        else if(password === confirmPassword) {
            messageElement.textContent = "Passwords match!";
            messageElement.style.color = "green";
        } else {
            messageElement.textContent = "Passwords do not match.";
            messageElement.style.color = "red";
        }
    });
    
    // Phone number validation
// Phone number validation
document.getElementById("phone").addEventListener("input", function() {
    var phone = document.getElementById("phone").value;
    var messageElement = document.getElementById("phone-error");

    if (phone.length < 10 || phone.length > 12) {
        messageElement.textContent = "Please enter a valid mobile number";
    } else {
        messageElement.textContent = "";
    }
});



document.getElementById("email").addEventListener("input", function() {
    var email = document.getElementById("email").value;
    var messageElement = document.getElementById("email-error");
    var emailPattern = /@/;

    if (!emailPattern.test(email)) {
        messageElement.textContent = "Please enter a valid email";
    } else {
        messageElement.textContent = "";
    }
});






    document.getElementById("department").value = "<?php echo $department; ?>";
</script>


<script>
function closePopup() {
    document.getElementById('popup-message').style.display = 'none';
    
    location.reload(); // Reload the page
}

function clearForm() {
    document.getElementById("name").value = "";
    document.getElementById("username").value = "";
    document.getElementById("email").value = "";
    document.getElementById("password").value = "";
    document.getElementById("confirm-password").value = "";
    document.getElementById("phone").value = "";
    document.getElementById("institute").selectedIndex = 0; // Set to default option
    document.getElementById("department").selectedIndex = 0; // Set to default option
}

// function showPopup(message) {
//     var popup = document.getElementById('popup-message');
//     popup.innerHTML = message + '<button onclick="closePopup()" style="background-color: red; color: white; border: none; padding: 5px 10px; margin-top: 10px;">Close</button>';
//     popup.style.display = 'block';
// }

function showPopup(email) {
    var message = `Thanks for applying to be Knowledge Championship Creator in the kGamify platform. We have sent a confirmation email for you to confirm the application request. Please check your inbox or spam folder.`;
    document.getElementById('popup-text').innerHTML = message;
    document.getElementById('popup-message').style.display = 'block';
}

function registerUser() {
    var name = document.getElementById("name").value;
    var username = document.getElementById("username").value;
    var email = document.getElementById("email").value;
    var password = document.getElementById("password").value;
    var confirmPassword = document.getElementById("confirm-password").value;
    var phone = document.getElementById("phone").value;
    var institute = document.getElementById("institute").value;
    var department = document.getElementById("department").value;
    var status = 0;
    var privacyPolicyChecked = document.getElementById("privacy-policy-checkbox").checked;

    // Validation
    if (name.trim() === "" || username.trim() === "" || email.trim() === "" || password.trim() === "" || confirmPassword.trim() === "" || phone.trim() === "" || institute.trim() === "" || department.trim() === "") {
        alert("Please fill all * fields");
        return;
    }

    if (password !== confirmPassword) {
        alert("Passwords do not match");
        return;
    }

    if (!/@/.test(email)) {
        alert("Please enter a valid email");
        return;
    }

    if (phone.length < 10 || phone.length > 12) {
        alert("Invalid Mobile Number");
        return;
    }

    var pattern = /[!@#$%^&*()+\=\[\]{};':"\\|,.<>\/?]+/;
    var alphapattern = /[!@#$%^&*()+\=\[\]{};':"\\|,.<>\/?a-zA-Z]+/;
    var numberpattern = /[!@#$%^&*()+\=\[\]{};':"\\|,.<>\/?0-9]+/;
    var emailpattern = /[!#$%^&*()+\=\[\]{};':"\\|,<>\/?]+/;

    if (numberpattern.test(name)) {
        alert("Name should not contain any special characters or numbers");
        return;
    } else if (pattern.test(username)) {
        alert("Username should not contain any special characters");
        return;
    } else if (emailpattern.test(email)) {
        alert("Email should not contain any special characters");
        return;
    } else if (alphapattern.test(phone)) {
        alert("Phone number should not contain any alphabets or special characters");
        return;
    }

    if (!privacyPolicyChecked) {
        document.getElementById("privacy-policy-error").textContent = "Please accept privacy policy";
        return;
    } else {
        document.getElementById("privacy-policy-error").textContent = "";
    }

    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var response = JSON.parse(this.responseText);
            if (response.status === "success") {
                showPopup(response.message);
                clearForm(); // Clear form fields after successful registration
            } else {
                alert(response.message);
            }
        }
    };
    xhr.open("POST", "register.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("name=" + name + "&username=" + username + "&email=" + email + "&password=" + password + "&phone=" + phone + "&institute=" + institute + "&department=" + department + "&status=" + status);
}



</script>


<script>
$(document).ready(function() {
    $('.js-example-basic').select2({
        placeholder: 'Select Institute',
        allowClear: true
    });

    $('.js-example-basic-single').select2({
        placeholder: 'Select Department',
        allowClear: true
    });

    $('#institute').change(function() {
        var institute = $(this).val();

        if (institute) {
            $.ajax({
                url: 'get_departments.php',
                type: 'POST',
                data: {institute: institute},
                success: function(data) {
                    $('#department').html(data);
                }
            });
        } else {
            $('#department').html('<option value="" selected disabled>Select Department</option>');
        }
    });
});
</script>
</body>

</html>