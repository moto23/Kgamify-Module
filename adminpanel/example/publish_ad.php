<?php
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
  // Capture the start date and end date from the HTML form
  $title = $_POST['title'];
//   $championships = $_POST['championships'];
  $start_date = $_POST['start_date'];
  $end_date = $_POST['end_date'];
  $start_time = $_POST['start_time'];
  $end_time = $_POST['end_time'];
  $championships=$_POST['championships'];
  
  foreach ($championships as $championship) {
    
    // Now that you have the category_id, you can insert the data into the championship table
    $insert_query = "INSERT INTO publish_ad (title, champ_name, start_date, end_date, start_time, end_time) VALUES (?, ?, ?, ?, ?, ?)";
    $insert_stmt = $conn->prepare($insert_query);

    if ($insert_stmt) {
      $insert_stmt->bind_param("ssssss", $title, $championship, $start_date, $end_date, $start_time, $end_time);
      if ($insert_stmt->execute()) {
        echo "New advertisement Published.\n";
      } else {
        echo "Error: " . $insert_stmt->error . "\n";
      }
      $insert_stmt->close();
    } else {
      die("Insert query preparation failed: " . $conn->error);
    }
  }
}

// Close the database connection
$conn->close();
?>



<!DOCTYPE html>
<html lang="en">

<head>

   <link rel="icon" href="../assets/img/KLOGO.png" type="image/icon type" />

  <!-- fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed&display=swap" rel="stylesheet" />
  <!-- fonts -->

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.css" integrity="sha512-0nkKORjFgcyxv3HbE4rzFUlENUMNqic/EzDIeYCgsKa/nwqr2B91Vu/tNAu4Q0cBuG4Xe/D1f/freEci/7GDRA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
  <link rel="stylesheet" href="style.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  
  <!--Newly added-->
  
   <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    
    

  <script data-require="jquery" data-semver="2.1.3" src="http://code.jquery.com/jquery-2.1.3.min.js"></script>
  <script data-require="bootstrap" data-semver="3.3.2" src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
  <script data-require="angular.js@1.3.x" src="https://code.angularjs.org/1.3.14/angular.js" data-semver="1.3.14"></script>
  <script data-require="ui-bootstrap" src="https://cdnjs.cloudflare.com/ajax/libs/angular-ui-bootstrap/0.13.0/ui-bootstrap-tpls.min.js" data-semver="0.13.0"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js" integrity="sha512-rMGGF4wg1R73ehtnxXBt5mbUfN9JUJwbk21KMlnLZDJh7BkPmeovBuddZCENJddHYYMkCh9hPFnPmS9sspki8g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.full.min.js"></script>

  <style>
    body {
      /* font-family: "Roboto", Helvetica, Arial, sans-serif; */
      font-weight: 100;
      font-size: 12px;
      line-height: 30px;
      color: #777;
      background: #4caf50;
    }

    .container {
      max-width: 400px;
      width: 100%;
      margin: 0 auto;
      position: relative;
    }


    #contact {
      background: #f9f9f9;
      padding: 25px;
      margin: 35px 0;
      box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2),
        0 5px 5px 0 rgba(0, 0, 0, 0.24);


    }


    #contact h3 {
      display: block;
      font-size: 30px;
      font-weight: 300;
      margin-bottom: 10px;
    }

    #contact h4 {
      margin: 5px 0 15px;
      display: block;
      font-size: 13px;
      font-weight: 400;
    }

    fieldset {
      border: medium none !important;
      margin: 0 0 10px;
      min-width: 100%;
      padding: 0;
      width: 100%;
    }

    #contact input[type="text"] {
      width: 100%;
      border: 1px solid #ff9d5c;
      background: #fff;
      margin: 0 0 5px;
      padding: 10px;
    }

    #contact input[type="text"]:hover {
      border: 1px solid #ff9d5c;
    }

    #contact textarea {
      height: 100px;
      max-width: 100%;
      resize: none;
    }

    #contact button[type="submit"] {
      cursor: pointer;
      width: 50;
      border: none;
      background: #ff9d5c;
      color: #f8f9fa;
      margin: 22px 209px 46px;
      padding: 3px 30px;
      font-size: 17px;
      border-radius: 8px;
    }

    #contact button[type="submit"]:hover {
      background: #43a047;
      -webkit-transition: background 0.3s ease-in-out;
      -moz-transition: background 0.3s ease-in-out;
      transition: background-color 0.3s ease-in-out;
    }

    #contact button[type="submit"]:active {
      box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.5);
    }

    .select2-results {
      min-height: 50px !important;
      max-height: 150px !important;
      overflow-y: scroll !important;
    }

    .select2-selection__rendered {
      line-height: 23px !important;
    }

    .select2-container .select2-selection--multiple {
      height: 37px !important;
      /* width: 100% !important; */
    }

    .copyright {
      text-align: center;
    }

    .select_category_popup #close-btn {
      margin-left: auto;
      margin-right: 5px;
    }

    #submit_btn {
      margin-top: 7px;
      margin-bottom: 10px;
      margin-left: 23.5rem;
      width: 20%;
    }

    .select_category_popup {
      overflow: hidden;
      clear: both;
      position: absolute;
      top: 0;
      /* left:50%; */
      transform: translate(-50%, -50%) scale(0.1);
      transition: transform 0.4s, top 0.4s;
      visibility: hidden;
    }

    .open-popup {
      margin-top: 50px;
      position: fixed;
      z-index: 2;
      top: 30%;
      left: 60%;
      visibility: visible;
      width: 600px;
      transform: translate(-50%, -50%) scale(1);
    }

    .active {
      cursor: move;
      user-select: none;
    }

    #search_label {
      width: 100%;
      border: 1px solid #ff9d5c;
      background: #fff;
      margin: 0 0 5px;
      padding: 10px;
    }

    #contact input:focus,
    #contact textarea:focus {
      outline: 0;
      border: 1px solid #aaa;
    }

    ::-webkit-input-placeholder {
      color: #888;
    }

    :-moz-placeholder {
      color: #888;
    }

    ::-moz-placeholder {
      color: #888;
    }

    :-ms-input-placeholder {
      color: #888;
    }
    
    
    
    
        /*.select2-container--default .select2-selection--multiple .select2-selection__choice {*/
        /*    color: #333;*/
        /*}*/
        /*.select2-dropdown {*/
        /*    z-index: 10000;*/
        /*}*/
        
        
        
        
        
        /*  .select2-selection__choice {*/
            color: #000; /* Adjust the color as needed */
        /*}*/
        /*.select2-results__option {*/
        /*    display: flex;*/
        /*    align-items: center;*/
        /*}*/
        /*.select2-results__option input {*/
        /*    margin-right: 8px;*/
        /*}*/
        
        
        
        
         .select2-selection__choice {
            color: #000; /* Adjust the color as needed */
        }
        .select2-results__option {
            display: flex;
            align-items: center;
        }
        .select2-results__option input {
            margin-right: 8px;
        }
        
        
  </style>

  <!-- CSS FontAwesome -->
  <script src="https://kit.fontawesome.com/52f3e32cf9.js" crossorigin="anonymous"></script>
  
  
  
    <!-- jQuery (required for Select2) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    
    

  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/title.png" />
  <link rel="icon" type="image/png" href="../assets/img/title.png" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>Publish Ad | Kgamify</title>


  <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no" name="viewport" />
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="../assets/css/paper-dashboard.css?v=2.0.1" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="../assets/demo/demo.css" rel="stylesheet" />
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
          
          
           <li>
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
          
           <li class="active">
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
          
          <li >
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


      <!-- End Navbar -->

      <!-- End Navbar -->

      <!-- form code starts         -->

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
                        <p style="text-align: center;color: #ff9d5c; font-size: 30px;font-weight: bold; ">Publish Advertisment</p>

                       <hr style="height:1px; border:none;  background-color:#ff9d5c;">
                        <br>
                      </fieldset>
                      
                        <form action="publish_ad.php" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
    <fieldset>
        <p style="color: #ff9d5c; font-size: 22px; font-weight: bold;">Select Advertisment</p>
        <div style="display: grid; min-width: 89ch; font-size: 16px" class="select">
            <?php
            // PHP code to retrieve company names and populate the dropdown
            $conn = new mysqli('localhost', 'u477273611_playquest', 'TEAcher23@#', 'u477273611_teacherpanel');
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            $sql = "SELECT title FROM add_advertisment";
            $result = $conn->query($sql);
            ?>
            <select style="border-color: #ff9d5c;" id="ad_title" name="title">
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $title = $row["title"];
                        echo "<option value='$title'>$title</option>";
                    }
                }
                $result->free(); // Free the result set
                ?>
            </select>
            <span class="focus"></span>
        </div>
        <br><br>
                      <!-- ended 1st one -->

                      <!-- 2nd one -->
                     <p style="color: #ff9d5c; font-size: 22px; font-weight: bold;">Select Championship</p>
    <?php
    $conn = new mysqli('localhost', 'u477273611_playquest', 'TEAcher23@#', 'u477273611_teacherpanel');

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT champ_name FROM championship";
    $result = $conn->query($sql);
    ?>
    <select class="js-example-basic-multiple" id="champ_name" name="championships[]" multiple="multiple">
        <option value="select_all">Select All</option>
        <option value="select_none">Select None</option>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $champ_name = $row["champ_name"];
                echo "<option value='$champ_name'>$champ_name</option>";
            }
        }
        $result->free(); // Free the result set
        ?>
    </select>

    <br><br>
                      

                      <!-- </div> -->
                      <!-- ended 2nd one -->
                      <label style="color: #ff9d5c;font-size: 22px;font-weight: bold;" for="start_date">Publish Date:</label>
                      <input style=" display: flex; min-width: 89ch; font-size: 16px" type="date" id="start_date" name="start_date" required><br>

                      <label style="color: #ff9d5c;font-size: 22px;font-weight: bold;" for="start_time">Publish Time:</label>
                      <input style=" display: flex; min-width: 89ch; font-size: 16px" type="time" id="start_time" name="start_time" required><br>

                      <label style="color: #ff9d5c;font-size: 22px;font-weight: bold;" for="end_date">End Publish Date:</label>
                      <input style=" display: flex; min-width: 89ch; font-size: 16px" type="date" id="end_date" name="end_date" required><br>

                      <label style="color: #ff9d5c;font-size: 22px;font-weight: bold;" for="end_time">End Publish Time:</label>
                      <input style=" display: flex; min-width: 89ch; font-size: 16px" type="time" id="end_time" name="end_time" required><br>

                      <!-- last one -->
                      <fieldset>

                        <input type="submit" onclick="submit()" id="submit" value="Publish Advertisment" style=" font-size: 15px; padding: 10px 25px;background-color: #ff9d5c; color: white;border-radius: 8px;border: #ff9d5c;" />

                      </fieldset>
                      </form>
                      <!-- ended last one -->
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
        $(document).ready(function() {
            function formatOption(option) {
                if (!option.id) {
                    return option.text;
                }
                var isChecked = $('#champ_name').find('option[value="' + option.id + '"]').is(':selected');
                var checkbox = $('<input type="checkbox" style="margin-right: 8px;">').prop('checked', isChecked);
                var $option = $('<span></span>').text(option.text);
                return $('<span></span>').append(checkbox).append($option);
            }

            $('.js-example-basic-multiple').select2({
                placeholder: 'Select a Championship',
                allowClear: true,
                width: '100%',
                templateResult: formatOption,
                templateSelection: function (option) {
                    var isChecked = $('#champ_name').find('option[value="' + option.id + '"]').is(':selected');
                    var checkbox = $('<input type="checkbox" style="margin-right: 8px;">').prop('checked', isChecked);
                    var $option = $('<span></span>').text(option.text);
                    return $('<span></span>').append(checkbox).append($option);
                }
            });

            $('.js-example-basic-multiple').on('select2:select', function(e) {
                var data = e.params.data;
                if (data.id === 'select_all') {
                    $('#champ_name > option').prop("selected", "selected");
                    $('#champ_name > option[value="select_all"]').prop("selected", false);
                    $('#champ_name > option[value="select_none"]').prop("selected", false);
                    $('#champ_name').trigger("change");
                } else if (data.id === 'select_none') {
                    $('#champ_name > option').prop("selected", false);
                    $('#champ_name').trigger("change");
                }
            });

            // Prevent Select All and Select None from being selected
            $('.js-example-basic-multiple').on('select2:unselect', function(e) {
                var data = e.params.data;
                if (data.id === 'select_all' || data.id === 'select_none') {
                    e.preventDefault();
                }
            });

            // Update checkboxes when options change
            $('.js-example-basic-multiple').on('change', function() {
                $(this).find('option').each(function() {
                    var isChecked = $(this).is(':selected');
                    var $checkbox = $('input[type="checkbox"][value="' + $(this).val() + '"]');
                    $checkbox.prop('checked', isChecked);
                });
            });
        });
    </script>

  

</body>

</html>