<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

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

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $company_name = $_POST['c_name'];
    $company_address = $_POST['c_address'];
    $company_phone_number = $_POST['c_phonenum'];
    $company_website = $_POST['c_web'];
    $company_description = $_POST['c_des'];
    $contact_person_name = $_POST['c_person_name'];
    $contact_person_email = $_POST['c_person_email'];
    $contact_person_phone = $_POST['c_person_phone'];
    
    // Check if any field is empty
    if (empty($company_name) || empty($company_address) || empty($company_phone_number) || 
        empty($company_website) || empty($company_description) || 
        empty($contact_person_name) || empty($contact_person_email) || 
        empty($contact_person_phone)) {
        echo "<script>alert('Fill all fields'); 
            window.location.href = 'company.php';
            </script>";
        exit();
    }
    
    $stmt = $conn->prepare("SELECT COUNT(*) FROM add_company WHERE company_name = ?");
    if ($stmt) {
        $stmt->bind_param("s", $company_name);
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        $stmt->close();

        if ($count > 0) {
            echo "<script>alert('Company name already exists. Try editing the information for the company on this page.');
            window.location.href = 'all_companies.php';
            </script>";
        } else {
            // Use prepared statement to insert data safely
            $stmt = $conn->prepare("INSERT INTO add_company (company_name, company_address, company_phone_number, company_website, company_description, contact_person_name, contact_person_email, contact_person_phone) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

            // Check if the statement was prepared successfully
            if ($stmt) {
                $stmt->bind_param("ssssssss", $company_name, $company_address, $company_phone_number, $company_website, $company_description, $contact_person_name, $contact_person_email, $contact_person_phone);
                $execval = $stmt->execute();

                // Check if the insert query was successful
                if ($execval) {
                    // echo "Data inserted successfully!";
                    $char_string = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                    $string = '';
                    while (strlen($string) < 4) {
                        $string .= $char_string[random_int(0, strlen($char_string) - 1)];
                    }
                    $last_id = mysqli_insert_id($conn);
                    $code = rand(1, 9999);
                    $unique_id = $string . "_" . $company_name . "_" . $code;
                    $query = "UPDATE add_company SET unique_id='" . $unique_id . "' WHERE company_id='" . $last_id . "'";
                    $res = mysqli_query($conn, $query);

                    if ($res) {
                        echo "<script>alert('Company added successfully!'); window.location.href = 'company.php';</script>";
                    } else {
                        echo "Error updating record: " . $conn->error;
                    }
                } else {
                    echo "Error: " . $stmt->error;
                }

                $stmt->close();
            } else {
                echo "Error: " . $conn->error;
            }
        }
    } else {
        echo "Error: " . $conn->error;
    }

    // Close the statement
    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <link rel="icon" href="../assets/img/PlayQuest Logo.png" type="image/icon type" />

  <!-- fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed&display=swap" rel="stylesheet" />
  <!-- fonts -->
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/title.png" />
  <link rel="icon" type="image/png" href="../assets/img/KLOGO.png" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

  <title>Add Company | KGAMIFY</title>
  <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no" name="viewport" />
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet" />
   <script data-require="jquery" data-semver="2.1.3" src="http://code.jquery.com/jquery-2.1.3.min.js"></script>
  <script data-require="bootstrap" data-semver="3.3.2" src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
  <script data-require="angular.js@1.3.x" src="https://code.angularjs.org/1.3.14/angular.js" data-semver="1.3.14"></script>
  <!--<script src="https://cdn.ckeditor.com/4.24.0/standard/ckeditor.js"></script>-->
  <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
  <script data-require="ui-bootstrap" src="https://cdnjs.cloudflare.com/ajax/libs/angular-ui-bootstrap/0.13.0/ui-bootstrap-tpls.min.js" data-semver="0.13.0"></script>
  <!-- CSS Files -->
  <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="../assets/css/paper-dashboard.css?v=2.0.1" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="../assets/demo/demo.css" rel="stylesheet" />

  <!-- CSS FontAwesome -->
  <script src="https://kit.fontawesome.com/52f3e32cf9.js" crossorigin="anonymous"></script>
</head>

<body class="">
  <div class="wrapper">
    <div class="sidebar" data-color="white" data-active-color="danger">
      <div style="display: flex; flex-direction: column; align-items: center" class="logo">
        <!-- logo -->
        <a href="#" class="">
          <div style="width: 234px; height: 83px" class="logo-image-small">
            <img src="../assets/img/kgamify admin D.png" />
          </div>
        </a>
        <!-- logo -->
      </div>

      <div class="sidebar-wrapper">
        <ul class="nav">
          <!-- First Section   -->

          <!-- Main Menu -->
          <li class="active">
            <a href="#">
              <p style="color: rgb(255, 81, 0); font-size: 15px">Main Menu</p>
            </a>
          </li>

          <!-- Dashboard -->
          <li>
            <a href="./dashboard.php">
              <i class="fas fa-th-large"></i>
              <p style="font-size: 15px; font-weight: bold">Dashboard</p>
            </a>
          </li>

          <!-- User Insights -->
          <li>
            <a href="./insights.php">
              <i class="fas fa-desktop"></i>
              <p style="font-size: 15px; font-weight: bold">User Insights</p>
            </a>
          </li>

          <!-- Manage Logins -->


          <!-- End First Section   -->

          <!-- Start Second Section -->

          <!--Add Information-->
          <li>
            <a href="#">
              <p style="color: rgb(255, 81, 0); font-size: 15px">
                Add Information
              </p>
            </a>
          </li>

        

          <!-- New Category   -->
          <li>
            <a href="../example/new_category.php">
              <i class="fas fa-align-justify"></i>
              <p style="font-size: 15px; font-weight: bold">New Category</p>
            </a>
          </li>

         

          <li>
            <a href="../example/add_institute.php">
              <i class="fas fa-solid fa-institution"></i>
              <p style="font-size: 15px; font-weight: bold">New Institute</p>
            </a>
          </li>

          <li>
            <a href="../example/add_department.php">
              <i class="fas fa-regular fa-building"></i>
              <p style="font-size: 15px; font-weight: bold">New Department</p>
            </a>
          </li>

          <li>
            <a href="../example/add_new_teacher.php">
              <i class="fas fa-solid fa-user-plus"></i>
              <p style="font-size: 15px; font-weight: bold">New Teacher</p>
            </a>
          </li>
          
          <li>
            <a href="../example/new_qualification.php">
              <i class="fas fa-medal"></i>
              <p style="font-size: 15px; font-weight: bold">New Qualification</p>
            </a>
          </li>
          
          <li>
            <a href="../example/add_gift.php">
              <i class="fas fa-gift"></i>
              <p style="font-size: 15px; font-weight: bold">New Gift</p>
            </a>
          </li>

           <!--Add Help-->
          
          <li class="active">
            <a href="#">
              <p style="color: rgb(255, 81, 0); font-size: 15px">Add Help</p>
            </a>
          </li>
          
           <li>
            <a href="../example/help_teacher.php">
              <i class="fas fa-user"></i>
              <p style="font-size: 15px; font-weight: bold">
                For Teacher
              </p>
            </a>
          </li>

          <li>
            <a href="../example/help_user.php">
              <i class="fas fa-desktop"></i>
              <p style="font-size: 15px; font-weight: bold">
                For Users
              </p>
            </a>
          </li>
          
          
           <!--Add Adv-->
          <li class="active">
            <a href="#">
              <p style="color: rgb(255, 81, 0); font-size: 15px">Advertisment Managment</p>
            </a>
          </li>
          
          
           <li class="active">
            <a href="../example/company.php">
              <i class="fas fa-city"></i>
              <p style="font-size: 15px; font-weight: bold">
                Add Company
              </p>
            </a>
          </li>
          
           <li>
            <a href="../example/advertisment.php">
              <i class="fas fa-mobile-alt"></i>
              <p style="font-size: 15px; font-weight: bold">
                Add Advertisment
              </p>
            </a>
          </li>
          
          
           <li>
            <a href="../example/publish_ad.php">
              <i class="fas fa-bullhorn"></i>
              <p style="font-size: 15px; font-weight: bold">
                Publish Ad
              </p>
            </a>
          </li>
          
          

         
         
          <li>
            <a href="#">
              <p style="color: rgb(255, 81, 0); font-size: 15px">
                All Information
              </p>
            </a>
          </li>
            
            <li>
            <a href="../example/question_bank.php">
              <i class="fas fa-question-circle"></i>
              <p style="font-size: 15px; font-weight: bold">Question Bank</p>
            </a>
          </li>
            
          <li>
            <a href="../example/all_teachers.php">
              <i class="fas fa-user"></i>
              <p style="font-size: 15px; font-weight: bold">
                All Teachers
              </p>
            </a>
          </li>

          <li>
            <a href="../example/all_institutes.php">
              <i class="fas fa-building"></i>
              <p style="font-size: 15px; font-weight: bold">
                All Institutes
              </p>
            </a>
          </li>

          <li>
            <a href="../example/all_departments.php">
              <i class="fas fa-tags"></i>
              <p style="font-size: 15px; font-weight: bold">
                All Departments
              </p>
            </a>
          </li>

          <!-- All Championships -->
          <li>
            <a href="../example/all_championships.php">
              <i class="fas fa-trophy"></i>
              <p style="font-size: 15px; font-weight: bold">
                All Championships
              </p>
            </a>
          </li>

          <!-- All Categories -->

          <li>
            <a href="../example/all_category.php">
              <i class="fas fa-th"></i>
              <p style="font-size: 15px; font-weight: bold">All Categories</p>
            </a>
          </li>

            <li>
            <a href="../example/all_game_modes.php">
              <i class="fas fa-coins"></i>
              <p style="font-size: 15px; font-weight: bold">All Game Modes</p>
            </a>
          </li>

          <!-- All Labels -->
          <li>
            <a href="../example/all_labels.php">
              <i class="fas fa-plus-square"></i>
              <p style="font-size: 15px; font-weight: bold">All Labels</p>
            </a>
          </li>
          
          <li>
            <a href="../example/all_qualifications.php">
              <i class="fas fa-check"></i>
              <p style="font-size: 15px; font-weight: bold">All Qualifications</p>
            </a>
          </li>
          
          <li>
            <a href="../example/all_gifts.php">
              <i class="fas fa-gifts"></i>
              <p style="font-size: 15px; font-weight: bold">All Gifts</p>
            </a>
          </li>
          
          
           <!--All Adv-->
            <li>
            <a href="../example/all_companies.php">
              <i class="fas fa-city"></i>
              <p style="font-size: 15px; font-weight: bold">
                All Company
              </p>
            </a>
          </li>
          
           <li>
            <a href="../example/all_advertisments.php">
              <i class="fas fa-mobile-alt"></i>
              <p style="font-size: 15px; font-weight: bold">
                All Advertisment
              </p>
            </a>
          </li>
          
          

          <!-- Wrong Questions -->
          <li>
            <a href="../example/wrong_questions.php">
              <i class="fas fa-times-circle"></i>
              <p style="font-size: 15px; font-weight: bold">
                Wrong Questions
              </p>
            </a>
          </li>
          
          <li class="active">
            <a href="#">
              <p style="color: rgb(255, 81, 0); font-size: 15px">Analytics</p>
            </a>
          </li>
          
          <li>
            <a href="../example/analytics_championship.php">
              <i class="fas fa-chart-line"></i>
              <p style="font-size: 15px; font-weight: bold">Championship</p>
            </a>
          </li>
          
          <li class="active">
            <a href="#">
              <p style="color: rgb(255, 81, 0); font-size: 15px">Configuration</p>
            </a>
          </li>
          
          <li>
            <a href="../example/champ_config.php">
              <i class="fas fa-wrench"></i>
              <p style="font-size: 15px; font-weight: bold">Champ Config</p>
            </a>
          </li>
          
          <li>
            <a href="../example/coin_value.php">
              <i class="fas fa-coins"></i>
              <p style="font-size: 15px; font-weight: bold">Coin Value</p>
            </a>
          </li>
          
          <li>
            <a href="../example/complexity.php">
              <i class="fas fa-list"></i>
              <p style="font-size: 15px; font-weight: bold">Complexity</p>
            </a>
          </li>
          
          <li>
            <a href="../example/grace_percentage.php">
              <i class="fas fa-percent"></i>
              <p style="font-size: 15px; font-weight: bold">Grace Percentage</p>
            </a>
          </li>
          
          <li >
            <a href="../example/all_configs.php">
              <i class="fas fa-gears"></i>
              <p style="font-size: 15px; font-weight: bold">All Configs</p>
            </a>
          </li>
          
          <li>
            <a href="../example/all_coin_values.php">
              <i class="fas fa-list"></i>
              <p style="font-size: 15px; font-weight: bold">All Coin Values</p>
            </a>
          </li>
          
          <li>
            <a href="../example/all_complexities.php">
              <i class="fas fa-bars"></i>
              <p style="font-size: 15px; font-weight: bold">All Complexities</p>
            </a>
          </li>
          
          <li>
            <a href="../example/all_grace_percentage.php">
              <i class="fas fa-chart-line"></i>
              <p style="font-size: 15px; font-weight: bold">All Grace Percent</p>
            </a>
          </li>
          <!-- End Fourth Section   -->
        </ul>
      </div>
    </div>
    <div class="main-panel">
      <!-- Navbar -->
      <nav class="
            navbar navbar-expand-lg navbar-absolute
            fixed-top
            navbar-transparent
          ">
        <div class="container-fluid" style="margin-bottom: 22px">
          <div class="navbar-wrapper">
            <div class="navbar-toggle">
              <button type="button" class="navbar-toggler">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </button>
            </div>
            <a style="color: orange; font-size: 25px" class="navbar-brand" href="javascript:;"></a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end" id="navigation">
            <ul class="navbar-nav">
              <li class="nav-item btn-rotate dropdown">
                <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fas fa-user-circle"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                  <a class="dropdown-item" style="text-align: center" href="logout.php">
                    <i class="fas fa-sign-out-alt"></i> Logout</a>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <!-- End Navbar -->
      
       <div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card demo-icons">

              <!-- form start  -->
              
                <div class="card-header">
                  <div class="container">
                    <!-- 1st one -->

                    <div id="contact">
                      <fieldset>
                        <p style="text-align: center;color: #ff9d5c; font-size: 30px;font-weight: bold; ">Add details of Company</p>

                        <hr style="height:1px; border:none;  background-color:#ff9d5c;">
                        <br>
                      </fieldset>
               
                      <form action="company.php" method="post" enctype="multipart/form-data">
    <fieldset>
        
        
        
        
         <div class="adv" id="adv"> 
        <p style="color: #ff9d5c; font-size: 22px; font-weight: bold;">Company Name</p>
        <input style="border-color: #ff9d5c; width: 100%;" placeholder="Enter Comapny Name" name="c_name" id="c_name" type="text" tabindex="1" autofocus />
        <br><br>
        
        <div class="adv" id="adv"> 
        <p style="color: #ff9d5c; font-size: 22px; font-weight: bold;">Company Address</p>
        <input style="border-color: #ff9d5c; width: 100%;" placeholder="Enter Company Address" name="c_address" id="c_address" type="text" tabindex="1" autofocus />
        <br><br>
        
        
         <div class="adv" id="adv"> 
        <p style="color: #ff9d5c; font-size: 22px; font-weight: bold;">Company Phone Number</p>
        <input style="border-color: #ff9d5c; width: 100%;" placeholder="Enter Company Phone Number" name="c_phonenum" id="c_phonenum" type="text" tabindex="1" autofocus />
        <br><br>
        
        
         <div class="adv" id="adv"> 
        <p style="color: #ff9d5c; font-size: 22px; font-weight: bold;">Company Website</p>
        <input style="border-color: #ff9d5c; width: 100%;" placeholder="Enter Company Website" name="c_web" id="c_web" type="text" tabindex="1" autofocus />
        <br><br>
        
       
    <fieldset>
        <p style="color: #ff9d5c; font-size: 22px; font-weight: bold;">Company Description</p>
        <textarea name="c_des" id="editor" placeholder="Write Description here...."></textarea>
    </fieldset>
    <br />
    <br>

    
      <div> 
        <p style="color: #ff9d5c; font-size: 22px; font-weight: bold;">Contact Person Name</p>
        <input style="border-color: #ff9d5c; width: 100%;" placeholder="Enter Person's Name" name="c_person_name" id="p_name" type="text" tabindex="1" autofocus />
        </div>
        <br>
        
        <div> 
        <p style="color: #ff9d5c; font-size: 22px; font-weight: bold;">Contact Person Email</p>
        <input style="border-color: #ff9d5c; width: 100%;" placeholder="Enter Person's Email" name="c_person_email" id="p_email" type="text" tabindex="1" autofocus />
        </div>
        <br>

        <div> 
        <p style="color: #ff9d5c; font-size: 22px; font-weight: bold;">Contact Person Phone</p>
        <input style="border-color: #ff9d5c; width: 100%;" placeholder="Enter Person's Mobile Number" name="c_person_phone" id="p_phone" type="text" tabindex="1" autofocus />
        </div>
        <br><br>
  
   
    <input type="submit" id="submit" value="Submit Company Details" style="font-size: 15px;font-weight:bold;margin-bottom:1rem; padding: 10px 25px; background-color: #ff9d5c; color: white; border-radius: 8px; border: #ff9d5c;" />
</form>

                    </div>
                  </div>
              
              <!-- form end  -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <script>
    document.getElementById("submit").addEventListener("click", function(event) {
    var c_name = document.getElementById("c_name").value;
    var c_phonenum = document.getElementById("c_phonenum").value;
    var p_name = document.getElementById("p_name").value;
    var p_email = document.getElementById("p_email").value;
    var p_phone = document.getElementById("p_phone").value;
    var pattern = /[!@#$%^&*()+\=\[\]{};':"\\|,.<>\/?0-9]+/;
    var emailpattern = /[!#$%^&*()+\=\[\]{};':"\\|,<>\/?]+/;
    var alphapattern = /[!@#$%^&*()+\=\[\]{};':"\\|,.<>\/?a-zA-Z]+/;
    
    if (c_name.trim() === "" || c_phonenum.trim() === "" || p_name.trim() === "" || p_email.trim() === "" || p_phone.trim() === "") {
        event.preventDefault();
        alert("Please fill all fields");
    }
    else{
    
    if (c_phonenum.length < 8 || c_phonenum.length > 12) {
        event.preventDefault();
        alert("Invalid Company Mobile Number ");
    }
    
    if (p_phone.length < 8 || p_phone.length > 12) {
        event.preventDefault();
        alert("Invalid Contact Person Mobile Number ");
    }

    if (pattern.test(c_name)) {
        event.preventDefault(); // Prevent form submission
        alert("Company Name should not contain any special characters or numbers");
    }
    else if (alphapattern.test(c_phonenum)) {
        event.preventDefault(); // Prevent form submission
        alert("Company Phone Number should not contain any special characters or alphabets");
    }
    else if (pattern.test(p_name)) {
        event.preventDefault(); // Prevent form submission
        alert("Contact Person Name should not contain any special characters or numbers");
    }
    else if (emailpattern.test(p_email)) {
        event.preventDefault(); // Prevent form submission
        alert("Contact Person Email should not contain any special characters");
    }
    else if (alphapattern.test(p_phone)) {
        event.preventDefault(); // Prevent form submission
        alert("Contact Person Phone Number should not contain any special characters or alphabets");
    }
    }
});
</script>

<script>
  CKEDITOR.replace('c_des');
  </script>
     

</body>

</html>