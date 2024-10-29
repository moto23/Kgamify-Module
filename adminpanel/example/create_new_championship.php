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
  $champ_name =  $_POST['champ_name'];
  $categories =  $_POST['categories'];
  $start_date = $_POST['start_date'];
  $end_date =   $_POST['end_date'];
  $start_time = $_POST['start_time'];
  $end_time = $_POST['end_time'];
  $status=0;

  foreach ($categories as $category) {
    // First, query the category table to get the category_id based on champ_name
    $category_query = "SELECT category_id FROM category WHERE category_name = ?";
    $category_stmt = $conn->prepare($category_query);

    if ($category_stmt) {
      $category_stmt->bind_param("s", $category);
      $category_stmt->execute();
      $category_stmt->bind_result($category_id);
      $category_stmt->fetch();
      $category_stmt->close();
    } else {
      die("Category query preparation failed: " . $conn->error);
    }

    // Now that you have the category_id, you can insert the data into the championship table
    $insert_query = "INSERT INTO championship (champ_name, category_id, start_date, end_date, start_time, end_time,status) VALUES (?, ?, ?, ?, ?, ?,?)";
    $insert_stmt = $conn->prepare($insert_query);

    if ($insert_stmt) {
      $insert_stmt->bind_param("sssssss", $champ_name, $category_id, $start_date, $end_date, $start_time, $end_time,$status);
      $insert_stmt->execute();
      $insert_stmt->close();
      // echo "Data inserted successfully!";
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

  <link rel="icon" href="../assets/img/title.png" type="image/icon type" />

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
  </style>

  <!-- CSS FontAwesome -->
  <script src="https://kit.fontawesome.com/52f3e32cf9.js" crossorigin="anonymous"></script>

  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/title.png" />
  <link rel="icon" type="image/png" href="../assets/img/title.png" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>CREATE NEW CHAMPIONSHIP | PlayQuest</title>

  <!-- tiny mce -->
  <!-- <script
      src="https://cdn.tiny.cloud/1/6x2lct5ci3repi2zerjxkto4t9ju86wfyyzn6x448cijg7g8/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    ></script> -->

  <!-- <script>
    tinymce.init({
      selector: "#mytextarea",
    });
  </script> -->

  <!-- tiny mce -->

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

<body>
  <div class="wrapper">
    <div class="sidebar" data-color="white" data-active-color="danger">
      <div style="display: flex; flex-direction: column; align-items: center" class="logo">
        <!-- logo -->
        <a href="#" class="">
          <div style="width: 234px; height: 73px" class="logo-image-small">
            <img src="../assets/img/logo-small1.png" />
          </div>
        </a>
        <!-- logo -->
      </div>

      <div class="sidebar-wrapper">
        <ul class="nav">
          <!-- First Section   -->

          <!-- Main Menu -->
          <li>
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
          <li class="active">
            <a href="#">
              <p style="color: rgb(255, 81, 0); font-size: 15px">
                Add Information
              </p>
            </a>
          </li>

          <!-- Create New Championship -->
          <!--<li class="active">-->
          <!--  <a href="./create_new_championship.php">-->
          <!--    <i class="far fa-plus-square"></i>-->
          <!--    <p style="font-size: 15px; font-weight: bold">-->
          <!--      New Championship-->
          <!--    </p>-->
          <!--  </a>-->
          <!--</li>-->

          <!-- New Category   -->
          <li>
            <a href="../example/new_category.php">
              <i class="fas fa-trophy"></i>
              <p style="font-size: 15px; font-weight: bold">New Category</p>
            </a>
          </li>

          <!-- New Game Mode   -->
          <!--<li>-->
          <!--  <a href="../example/add_new_mode.php">-->
          <!--    <i class="fas fa-crosshairs"></i>-->
          <!--    <p style="font-size: 15px; font-weight: bold">New Game Mode</p>-->
          <!--  </a>-->
          <!--</li>-->

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
          <li class>
            <a href="#">
              <p style="color: rgb(255, 81, 0); font-size: 15px">Advertisment Managment</p>
            </a>
          </li>
          
          
           <li class>
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
          
          

          <!--All Information-->
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
              <i class="fas fa-info-circle"></i>
              <p style="font-size: 15px; font-weight: bold">
                All Championships
              </p>
            </a>
          </li>

          <!-- All category -->

          <li>
            <a href="../example/all_category.php">
              <i class="fas fa-th"></i>
              <p style="font-size: 15px; font-weight: bold">All Categories</p>
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

          <!-- Wrong Questions -->
          <li>
            <a href="../example/wrong_questions.php">
              <i class="fas fa-times-circle"></i>
              <p style="font-size: 15px; font-weight: bold">Wrong Questions</p>
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
          <!-- End Fourth Section   -->
        </ul>
      </div>
    </div>


    <div class="main-panel" style="height: 70px;">
      <!-- Navbar -->
      <nav class="
            navbar navbar-expand-lg navbar-absolute
            fixed-top
            navbar-transparent
          " style="height: 70px;">
        <div class="container-fluid" style="margin-bottom: 15px">
          <div class="navbar-wrapper">
            <div class="navbar-toggle">
              <button type="button" class="navbar-toggler">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </button>
            </div>

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

      <!-- form code starts         -->

      <div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card demo-icons">

              <!-- <div class="select_category_popup" id="select_category_popup" style="z-index:999;box-shadow:2px 2px 3px 3px rgba(0,0,0,0.15);border-radius:5px;background-color:#fff;">
                <div onclick="closePopup()" id="close-btn" style="cursor:pointer;margin-top:5px;margin-bottom:8px;width:20px;text-align:center;height:20px;background:#000;color:#eee;line-height:20px;border-radius:17px;">&times;</div>
                <form action="add_question.php" method="post"> -->
              <!-- <div style=" display: grid; width:74.5ch;margin-left:6px;margin-right:5px;font-size: 16px;" class="select"> -->
              <?php
              // PHP code to retrieve category names and populate the dropdown
              // $conn = new mysqli('localhost', 'root', 'root123', 'playquest');

              // if ($conn->connect_error) {
              //   die("Connection failed: " . $conn->connect_error);
              // }

              // $sql = "SELECT category_name FROM category";
              // $result = $conn->query($sql);
              ?>
              <!-- <select class="js-example-basic-multiple" style="cursor:pointer;" id="category_name" name="categories[]" multiple="multiple">
                    <?php
                    // if ($result->num_rows > 0) {
                    //   while ($row = $result->fetch_assoc()) {
                    //     $cat_name = $row["category_name"];
                    //     echo "<option value='$cat_name'>$cat_name</option>";
                    //   }
                    // }
                    // $result->free(); // Free the result set -->
                    ?>
                  </select>

                  <?php
                  // if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                  //   // Access the selected category from the dropdown using $_POST
                  //   $selected_category = $_POST['category_name'];

                  //   // Process the selected category as needed
                  // }
                  ?>

                  <span class="focus"></span>
                  <button id="submit_btn" onclick="closePopup();display_category_onScreen()" style="align-items:center;font-size: 20px; padding: 2px 5px;background-color: #ff9d5c; color: white;border-radius: 5px;border: #ff9d5c;" name="select">Select</button>
                </div>
              </div> -->

              <!-- form start  -->
              <form action="create_new_championship.php" method="post">
                <div class="card-header">
                  <div class="container">
                    <!-- 1st one -->
                    <div id="contact">
                      <fieldset>
                        <p style="text-align: center;color: #ff9d5c; font-size: 30px;font-weight: bold; ">Create New Championship</p>

                        <hr style="height:1px; border:none;  background-color:#ff9d5c;">
                        <br>
                        <br>
                      </fieldset>

                      <fieldset>
                        <p style="color: #ff9d5c; font-size: 22px;font-weight: bold; ">Championship Name</p>
                        <input placeholder="Enter Championship Name" id="championship_name" name="champ_name" type="text" tabindex="1" required autofocus />
                      </fieldset>
                      <br />
                      <!-- ended 1st one -->

                      <!-- 2nd one -->
                      <p style="color: #ff9d5c;font-size: 22px;font-weight: bold; ">Championship Category</p>
                      <?php
                      // PHP code to retrieve category names and populate the dropdown
                      $conn = new mysqli('localhost', 'u477273611_playquest', 'TEAcher23@#', 'u477273611_teacherpanel');

                      if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                      }

                      $sql = "SELECT category_name FROM category";
                      $result = $conn->query($sql);
                      ?>
                      <select class="js-example-basic-multiple" id="category_name" name="categories[]" multiple="multiple">
                        <?php
                        if ($result->num_rows > 0) {
                          while ($row = $result->fetch_assoc()) {
                            $cat_name = $row["category_name"];
                            echo "<option value='$cat_name'>$cat_name</option>";
                          }
                        }
                        $result->free(); // Free the result set
                        ?>
                      </select>
                      <!-- <button onclick="openPopup()" style=" font-size: 15px;font-weight:bold; padding: 10px 12px;background-color: #ff9d5c; color: white;border-radius: 8px;border: #ff9d5c;" type="button">Select Categories</button> -->
                      <!-- <br>
                      <main></main> -->
                      <br><br>

                      <!-- </div> -->
                      <!-- ended 2nd one -->
                      <label style="color: #ff9d5c;font-size: 22px;font-weight: bold;" for="start_date">Start Date:</label>
                      <input style=" display: flex; min-width: 89ch; font-size: 16px" type="date" id="start_date" name="start_date" required><br>

                      <label style="color: #ff9d5c;font-size: 22px;font-weight: bold;" for="start_time">Start Time:</label>
                      <input style=" display: flex; min-width: 89ch; font-size: 16px" type="time" id="start_time" name="start_time" required><br>

                      <label style="color: #ff9d5c;font-size: 22px;font-weight: bold;" for="end_date">End Date:</label>
                      <input style=" display: flex; min-width: 89ch; font-size: 16px" type="date" id="end_date" name="end_date" required><br>

                      <label style="color: #ff9d5c;font-size: 22px;font-weight: bold;" for="end_time">End Time:</label>
                      <input style=" display: flex; min-width: 89ch; font-size: 16px" type="time" id="end_time" name="end_time" required><br>

                      <!-- last one -->
                      <fieldset>

                        <input type="submit" onclick="submit()" id="submit" value="Create Championship" style=" font-size: 15px; padding: 10px 25px;background-color: #ff9d5c; color: white;border-radius: 8px;border: #ff9d5c;" />

                      </fieldset>
                      <!-- ended last one -->
                    </div>

                  </div>
              </form>
              <!-- form end  -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- <script>
    let popup = document.getElementById("select_category_popup");
    let popup_window = document.querySelector(".select_category_popup");

    function openPopup() {
      popup.classList.add("open-popup");
    }

    function closePopup() {
      popup.classList.remove("open-popup");
    }

    function onDrag({
      movementX,
      movementY
    }) {
      let getStyle = window.getComputedStyle(popup_window);
      let leftValue = parseInt(getStyle.left);
      let topValue = parseInt(getStyle.top);
      console.log(leftValue);

      popup_window.style.left = `${leftValue+movementX}px`;
      popup_window.style.top = `${topValue+movementY}px`;
    }

    popup_window.addEventListener('mousedown', () => {
      popup_window.classList.add("active");
      popup_window.addEventListener('mousemove', onDrag);
    })

    document.addEventListener('mouseup', () => {
      popup_window.classList.remove("active");
      popup_window.removeEventListener('mousemove', onDrag);
    })
  </script> -->
  <script>
    $(document).ready(function() {
      $('.js-example-basic-multiple').select2({
        placeholder: 'Select a Category',
        allowClear: true,
        scrollAfterSelect: true,
        width: '100%'
      });
    });
  </script>

  <!-- <script type="text/javascript">
    function display_category_onScreen() {
      var selectedValues = [];
      for (var option of document.getElementById('category_name').options) {
        if (option.selected) {
          selectedValues.push(option.value)
        }
      }
      console.log(selectedValues)

      function generatelistItems(arg) {
        let items = ""
        for (let i = 0; i < arg.length; i++) {
          items += `<li>${arg[i]}</li>`
        }
        return items;
      }

      document.querySelector("main").innerHTML = `<div style="color:#888;font-size:14px;font-weight:bold;">
      <p style="color: #ff9d5c; font-size: 18px; width: 100%;font-weight: bold;margin-top:10px; ">Selected Categories</p>
      ${generatelistItems(selectedValues)}</div>`
    }
  </script> -->

</body>

</html>