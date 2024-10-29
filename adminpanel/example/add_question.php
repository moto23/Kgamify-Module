<?php
session_start();
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
  // Capture the form data
  // $label = $_POST['label'];
  // $question_text = $_POST['q_text'];
  $question_text = strip_tags($_POST['q_text']);
  $question_image = $_POST['img0'];
  $option1_text = strip_tags($_POST['option_1']);
  $option2_text = strip_tags($_POST['option_2']);
  $option3_text = strip_tags($_POST['option_3']);
  $option4_text = strip_tags($_POST['option_4']);
  $option1_img = $_POST['img1'];
  $option2_img = $_POST['img2'];
  $option3_img = $_POST['img3'];
  $option4_img = $_POST['img4'];
  $total_coins = $_POST['total_coins'];
  $correct_opts = $_POST['correct_option'];
  $labels = $_POST['labels']; // Updated to handle multiple options

  // Get teacher email from session
  $username = $_SESSION['email'];

  // Initialize $correct_options array
  $correct_options = [];

  foreach ($labels as $label) {
    $label_query = "SELECT label_id FROM label WHERE label_name = ?";
    $category_stmt2 = $conn->prepare($label_query);

    if ($category_stmt2) {
      $category_stmt2->bind_param("s", $label);
      $category_stmt2->execute();
      $category_stmt2->bind_result($label_id);
      $category_stmt2->fetch();
      $category_stmt2->close();
    } else {
      die("Category query preparation failed: " . $conn->error);
    }

    $teacher_query = "SELECT teacher_id FROM teacher WHERE email = ?";
    $teacher_stmt = $conn->prepare($teacher_query);

    if ($teacher_stmt) {
      $teacher_stmt->bind_param("s", $username);
      $teacher_stmt->execute();
      $teacher_stmt->bind_result($teacher_id);
      $teacher_stmt->fetch();
      $teacher_stmt->close();
    } else {
      die("Teacher query preparation failed: " . $conn->error);
    }


    // Insert question into the database
    $insert_query = "INSERT INTO question (label_id, teacher_id, question_text, question_image, option1_text, option2_text, option3_text, option4_text, option1_img, option2_img, option3_img, option4_img, total_coins) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $insert_stmt = $conn->prepare($insert_query);

    if ($insert_stmt) {
      $insert_stmt->bind_param("iisssssssssss", $label_id, $teacher_id, $question_text, $question_image, $option1_text, $option2_text, $option3_text, $option4_text, $option1_img, $option2_img, $option3_img, $option4_img, $total_coins);
      $insert_stmt->execute();
      $insert_stmt->close();
    } else {
      die("Insert query preparation failed: " . $conn->error);
    }

    // Get question_id
    $questionid_query = "SELECT question_id FROM question WHERE label_id = ? AND question_text = ?";
    $questionid_stmt = $conn->prepare($questionid_query);

    if ($questionid_stmt) {
      $questionid_stmt->bind_param("is", $label_id, $question_text);
      $questionid_stmt->execute();
      $questionid_stmt->bind_result($question_id);
      $questionid_stmt->fetch();
      $questionid_stmt->close();
    } else {
      die("Question ID query preparation failed: " . $conn->error);
    }

    // Convert correct options to numeric values
    foreach ($correct_opts as $correct_opt) {
      switch ($correct_opt) {
        case "option_1":
          $correct_options[] = 1;
          break;
        case "option_2":
          $correct_options[] = 2;
          break;
        case "option_3":
          $correct_options[] = 3;
          break;
        case "option_4":
          $correct_options[] = 4;
          break;
      }
    }

    // Insert correct options into the database
    foreach ($correct_options as $correct_opt) {
      $correct_query = "INSERT INTO answer (question_id, correct_answer) VALUES (?, ?)";
      $correct_stmt = $conn->prepare($correct_query);

      if ($correct_stmt) {
        $correct_stmt->bind_param("ii", $question_id, $correct_opt);
        $correct_stmt->execute();
        $correct_stmt->close();
      } else {
        die("Correct answer query preparation failed: " . $conn->error);
      }
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


  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
  <link rel="stylesheet" href="style.css" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20,300,0,0" />



  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.css" integrity="sha512-0nkKORjFgcyxv3HbE4rzFUlENUMNqic/EzDIeYCgsKa/nwqr2B91Vu/tNAu4Q0cBuG4Xe/D1f/freEci/7GDRA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />


  <script data-require="jquery" data-semver="2.1.3" src="http://code.jquery.com/jquery-2.1.3.min.js"></script>
  <script data-require="bootstrap" data-semver="3.3.2" src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
  <script data-require="angular.js@1.3.x" src="https://code.angularjs.org/1.3.14/angular.js" data-semver="1.3.14"></script>
  <script data-require="ui-bootstrap" src="https://cdnjs.cloudflare.com/ajax/libs/angular-ui-bootstrap/0.13.0/ui-bootstrap-tpls.min.js" data-semver="0.13.0"></script>

  <script src="https://cdn.tiny.cloud/1/9au79qa9zvfug4om11srlv68xwit01e8deqplkrzxbecpbj1/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js" integrity="sha512-rMGGF4wg1R73ehtnxXBt5mbUfN9JUJwbk21KMlnLZDJh7BkPmeovBuddZCENJddHYYMkCh9hPFnPmS9sspki8g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.full.min.js"></script>
  <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>


  <!-- Choose multiple options -->



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

    .copyright {
      text-align: center;
    }

    #contact input:focus,
    #contact textarea:focus {
      outline: 0;
      border: 1px solid #aaa;
    }

    #contact #btn {
      display: flex;
    }

    .select_label_popup #close-btn {
      margin-left: auto;
      margin-right: 5px;
    }

    /* .bigdrop {
      min-height: 70px;
      max-height: 100px;
      overflow-y: auto;
      width: max-content;
    } */

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

    /* .select2-selection__arrow {
      height: 30px !important;
    } */

    #submit_btn {
      margin-top: 7px;
      margin-bottom: 10px;
      margin-left: 23.5rem;
      width: 20%;
    }

    .select_label_popup {
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

    /* #label_select{
      cursor:pointer !important;
    } */

    #contact #btn button[type="button"]:hover {
      background-color: #e65100;
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
  <title>ADD NEW QUESTION | PlayQuest</title>

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
          <!--<li>-->
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
              <i class="fas fa-align-justify"></i>
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
          
          
        <li>
            <a href="../example/publish_ad.php">
              <i class="fas fa-bullhorn"></i>
              <p style="font-size: 15px; font-weight: bold">
                Publish Ad
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


              <!-- form start  -->
              <form method="post" action="add_question.php">

                <div class="card-header">
                  <div class="container">
                    <!-- 1st one -->
                    <div id="contact">
                      <fieldset>
                        <p style="text-align: center;color: #ff9d5c; font-size: 30px;font-weight: bold; ">Add New Question</p>

                        <hr style="height:1px; border:none;  background-color:#ff9d5c;">
                        <br>
                        <br>
                      </fieldset>


                      <!-- dsaddsadsasa -->
                      <!-- <fieldset style="display: grid;height:fit-content;"> -->
                      <p style="color: #ff9d5c;font-size: 22px;font-weight: bold; ">Add/Edit Labels</p>
                      <p style="color: #00c800;font-size: 18px">Questions in the Championship will appear from Questions under the label selected from here</p>
                      <!-- <div style="height:15ch;display:flex;"> -->
                      <?php
                      // PHP code to retrieve category names and populate the dropdown
                      $conn = new mysqli('localhost', 'u477273611_playquest', 'TEAcher23@#', 'u477273611_teacherpanel');

                      if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                      }

                      $sql = "SELECT label_name FROM label";
                      $result = $conn->query($sql);
                      ?>
                      <select class="js-example-basic-multiple" id="label_name" name="labels[]" multiple="multiple">
                        <?php
                        if ($result->num_rows > 0) {
                          while ($row = $result->fetch_assoc()) {
                            $cat_name = $row["label_name"];
                            echo "<option value='$cat_name'>$cat_name</option>";
                          }
                        }
                        $result->free(); // Free the result set
                        ?>
                      </select>

                     
                      <br><br>
                      <!-- 3rd one -->
                      <!-- <fieldset id="btn"> -->
                      <p style="color: #ff9d5c;font-size: 22px;font-weight: bold;">Question Text</p>
                      <textarea name="q_text" id="editor" placeholder="Write Question here...."></textarea>
                      <br>

                      <p style="color: #ff9d5c;font-size: 22px;font-weight: bold; ">Add Question image</p>

                      <input type="file" id="img" name="img0" accept="image/*">

                      <!-- ended 3rd one -->
                      <br>
                      <br>

                      <fieldset>
                        <p style="color: #ff9d5c; font-size: 22px;font-weight: bold;margin-bottom:0.7rem;">Option 1</p>
                        <textarea name="option_1" placeholder="Write Text here...."></textarea>
                      </fieldset>
                      <br>
                      <p style="color: #ff9d5c;font-size: 22px;font-weight: bold;">option 1 image</p>

                      <input type="file" id="img" style="margin-bottom:12px;" name="img1" accept="image/*">
                      <br>
                      <br>

                      <fieldset>
                        <p style="color: #ff9d5c; font-size: 22px;font-weight: bold;">Option 2</p>
                        <textarea name="option_2" placeholder="Write Text here...."></textarea>
                        <br>
                        <p style="color: #ff9d5c;font-size: 22px;font-weight: bold; ">option 2 image</p>

                        <input type="file" id="img" style="margin-bottom:12px;" name="img2" accept="image/*">
                      </fieldset>
                      <br>
                      <br>

                      <fieldset>
                        <p style="color: #ff9d5c; font-size: 22px;font-weight: bold;margin-bottom:2px; ">Option 3</p>
                        <textarea name="option_3" placeholder="Write Text here...."></textarea>
                      </fieldset>
                      <br>
                      <p style="color: #ff9d5c;font-size: 22px;font-weight: bold;margin-top:0px ">option 3 image</p>
                      <input type="file" id="img" style="margin-bottom:12px;" name="img3" accept="image/*">
                      <br>
                      <br>

                      <fieldset>
                        <p style="color: #ff9d5c; font-size: 22px;font-weight: bold; ">Option 4</p>
                        <textarea name="option_4" placeholder="Write Text here...."></textarea>
                        <br>
                      </fieldset>
                      <p style="color: #ff9d5c;font-size: 22px;font-weight: bold; ">option 4 image</p>

                      <input type="file" id="img" style="margin-bottom:12px;" name="img4" accept="image/*">
                      <br>
                      <br>

                      <!-- dsaddsadsasa -->
                      <fieldset>
                        <p style="color: #ff9d5c; font-size: 22px; font-weight: bold;">Correct Option</p>
                        <div style="display: grid; grid-template-columns: repeat(2, 1fr); min-width: 89ch; font-size: 16px; grid-column-gap: 5px;" class="select" multiple>
                          <div>
                            <input style="border-color: #ff9d5c;margin-left:7rem" type="checkbox" id="correct_option_1" name="correct_option[]" value="option_1">
                            <label for="correct_option_1" style="color:black;">Option 1</label><br>
                          </div>
                          <div>
                            <input style="border-color: #ff9d5c;margin-left:0rem" type="checkbox" id="correct_option_2" name="correct_option[]" value="option_2">
                            <label for="correct_option_2" style="color:black;">Option 2</label><br>
                          </div>
                          <div style="grid-column: 1;">
                            <input style="border-color: #ff9d5c;margin-left:7rem" type="checkbox" id="correct_option_3" name="correct_option[]" value="option_3">
                            <label for="correct_option_3" style="color:black;">Option 3</label><br>
                          </div>
                          <div style="grid-column: 2;">
                            <input style="border-color: #ff9d5c;margin-left:0rem" type="checkbox" id="correct_option_4" name="correct_option[]" value="option_4">
                            <label for="correct_option_4" style="color:black;">Option 4</label><br>
                          </div>
                        </div>
                      </fieldset>
                      <br>

                      <!-- dsadsadsa -->

                      <fieldset>
                        <p style="color: #ff9d5c; font-size: 22px; width: 100%;font-weight: bold; ">Total Coins</p>
                        <input placeholder="Enter Number of Coins" id="total_coins" type="text" name="total_coins" tabindex="1" required autofocus />
                      </fieldset>

                      <br>
                      <br>
                      <!-- last one -->
                      <fieldset>

                        <input type="submit" onclick="submit()" id="submit" value="Add Question" style=" font-size: 15px; padding: 10px 25px;background-color: #ff9d5c; color: white;border-radius: 8px;border: #ff9d5c;" />

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
  <!--   Core JS Files   -->
  <!-- <script>
    let popup = document.getElementById("select_label_popup");
    let popup_window = document.querySelector(".select_label_popup");

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
        placeholder: 'Select a Label',
        allowClear: true,
        width: '100%'
        // containerCss: {
        //   'height': '30px',
        //   'line-height': '15px'
        // }
      });
    });
  </script>
  <script>
    CKEDITOR.replace( 'q_text' );
    CKEDITOR.replace( 'option_1' );
    CKEDITOR.replace( 'option_2' );
    CKEDITOR.replace( 'option_3' );
    CKEDITOR.replace( 'option_4' );
  </script>


</body>

</html>