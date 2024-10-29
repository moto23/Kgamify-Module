<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // Redirect to the login page
    echo "<script>alert('You need to LOGIN to view this page.'); window.location.href = 'index.php';</script>";
    exit();
}
?>
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

$teacher_query = "SELECT teacher_id FROM teacher WHERE email = ?";
$teacher_stmt = $conn->prepare($teacher_query);

if ($teacher_stmt) {
    $teacher_stmt->bind_param("s", $_SESSION['email']);
    $teacher_stmt->execute();
    $teacher_stmt->bind_result($teacher_id);
    $teacher_stmt->fetch();
    $teacher_stmt->close();
} else {
    die("Teacher query preparation failed: " . $conn->error);
}

// Check for labels
$label_sql = "SELECT label_name FROM label WHERE teacher_id = $teacher_id";
$label_result = $conn->query($label_sql);
$label_count = $label_result->num_rows;

// Check for championships
$champ_sql = "SELECT champ_name FROM championship WHERE teacher_id = $teacher_id";
$champ_result = $conn->query($champ_sql);
$champ_count = $champ_result->num_rows;

// Redirect if either labels or championships are missing
if ($label_count == 0) {
    header("Location: no_labels_or_championships.php?labels=0");
    exit();
}

// Redirect if championships are missing
if ($champ_count == 0) {
    header("Location: no_labels_or_championships.php?champs=0");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Capture the mode name and other from the HTML form
  $mode_name = $_POST['mode_name'];
  $champ_name = $_POST['champ_name'];
  $qualification = $_POST['qualification'];
  $gift_type = $_POST['gift_type'];
  $no_of_questions = $_POST['no_of_questions'];
  $time_required = $_POST['time_required'];
  $description=$_POST['description'];
  $label = $_POST['label'];
  $username = $_SESSION['email'];
  $gift_name = $_POST['gift_name'];
  $gift_image = $_POST['timg'];
  
  if(isset($mode_name)){
  
  $championship_query = "SELECT champ_id FROM championship WHERE champ_name = ?";
  $category_stmt1 = $conn->prepare($championship_query);

  if ($category_stmt1) {
    $category_stmt1->bind_param("s", $champ_name);
    $category_stmt1->execute();
    $category_stmt1->bind_result($champ_id);
    $category_stmt1->fetch();
    $category_stmt1->close();
  } else {
    die("Category query preparation failed: " . $conn->error);
  }
  
  $check_query = "SELECT mode_name FROM game_mode WHERE champ_id = ?";
$check_stmt = $conn->prepare($check_query);

if ($check_stmt) {
    $check_stmt->bind_param("s", $champ_id);
    $check_stmt->execute();
    $result = $check_stmt->get_result();

    $existing_modes = [];
    while ($row = $result->fetch_assoc()) {
        $existing_modes[] = $row['mode_name'];
    }
    $check_stmt->close();
    
    if ((in_array('quick_hit', $existing_modes) && $mode_name === 'play_win_gift') ||
        (in_array('play_win_gift', $existing_modes) && $mode_name === 'quick_hit')) {
        echo "<script>alert('A Game Mode already exists for the selected Championship. You can make only 1 type of game mode for a Championship'); window.history.back();</script>";
        exit();
    }
        if (isset($_POST['gift_card_text']) && !empty($_POST['gift_card_text'])) {
    $gift_description = $_POST['gift_card_text'];
  } elseif (isset($_POST['coupon_text']) && !empty($_POST['coupon_text'])) {
    $gift_description = $_POST['coupon_text'];
  } elseif (isset($_POST['product_text']) && !empty($_POST['product_text'])) {
    $gift_description = $_POST['product_text'];
  } else {
    $gift_description = ""; // Or any default value you want to assign
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

  // Now that you have the category_id, you can insert the data into the championship table
  $insert_query = "INSERT INTO game_mode (teacher_id,mode_name,tot_coins,description,no_of_question,time_minutes,champ_id,user_qualification) VALUES (?,?, ?,?, ?, ?, ?, ?)";
  $insert_stmt = $conn->prepare($insert_query);

  if ($insert_stmt) {
    $insert_stmt->bind_param("ssssssss", $teacher_id,$mode_name, $total_coins,$description, $no_of_questions, $time_required, $champ_id, $qualification);
    $insert_stmt->execute();
    $insert_stmt->close();
    
    $char_string='abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $string='';
    while(strlen($string)<4){
        $string.=$char_string[random_int(0,strlen($char_string))];
    }
    $last_id=mysqli_insert_id($conn);
    $code=rand(1,9999);
    $unique_id=$string."_".$code;
    $query="UPDATE game_mode set unique_id='".$unique_id."' where mode_id='".$last_id."'";
    $res=mysqli_query($conn,$query);

    $get_modeid_query = "SELECT mode_id from game_mode where mode_name = ? and champ_id = ? limit 1";
    $get_modeid_stmt = $conn->prepare($get_modeid_query);

    if ($get_modeid_stmt) {
      $get_modeid_stmt->bind_param("ss", $mode_name, $champ_id);
      $get_modeid_stmt->execute();
      $get_modeid_stmt->bind_result($mode_id);
      $get_modeid_stmt->fetch();
      $get_modeid_stmt->close();

      $set_questions_query = "INSERT INTO chosen_questions(label_id, mode_id) values(?, ?)";
      $set_questions_stmt = $conn->prepare($set_questions_query);

      if ($set_questions_stmt) {
        $set_questions_stmt->bind_param("ss", $label_id, $mode_id);
        $set_questions_stmt->execute();
        $set_questions_stmt->close();
      } else {
        die("Insert query preparation failed: " . $conn->error);
      }
    } else {
      die("Insert query preparation failed: " . $conn->error);
    }
  } 

if($mode_name==='play_win_gift'){
    
    $gift_query = "SELECT gift_id FROM gift WHERE gift_type = ?";
  $gift_stmt1 = $conn->prepare($gift_query);

  if ($gift_stmt1) {
    $gift_stmt1->bind_param("s", $gift_type);
    $gift_stmt1->execute();
    $gift_stmt1->bind_result($gift_id);
    $gift_stmt1->fetch();
    $gift_stmt1->close();
  } else {
    die("Category query preparation failed: " . $conn->error);
  }
    
  // Assuming the chosen_gift_type table has exactly these 5 columns: gift_id, gift_type, gift_name, gift_description, gift_image
  $gift_query1 = "INSERT INTO chosen_gift_type (gift_id,mode_id, gift_type, gift_name, gift_description, gift_image) VALUES (?,?, ?, ?, ?, ?)";
  $gift_stmt = $conn->prepare($gift_query1);

  if ($gift_stmt) {
    $gift_stmt->bind_param("ssssss", $gift_id,$mode_id, $gift_type, $gift_name, $gift_description, $gift_image);
    $gift_stmt->execute();
    $gift_stmt->close();
  }
  else {
    die("Insert query preparation failed: " . $conn->error);
  }
}
} else {
    echo "Error preparing check statement: " . $conn->error;
}
  
}
else{
    echo "<script>alert('Please select a Game Mode'); window.history.back();</script>";
    exit();
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


  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <!-- CSS Files -->
  <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="../assets/css/paper-dashboard.css?v=2.0.1" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="../assets/demo/demo.css" rel="stylesheet" />



  <!-- CSS FontAwesome -->
  <script src="https://kit.fontawesome.com/52f3e32cf9.js" crossorigin="anonymous"></script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <!-- CSS FontAwesome -->
  <script src="https://kit.fontawesome.com/52f3e32cf9.js" crossorigin="anonymous"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed&display=swap" rel="stylesheet" />
  <!-- fonts -->


  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
  <link rel="stylesheet" href="style.css" />

  <!--<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>-->
  <script data-require="bootstrap" data-semver="3.3.2" src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
  <script data-require="angular.js@1.3.x" src="https://code.angularjs.org/1.3.14/angular.js" data-semver="1.3.14"></script>
  <link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/43.2.0/ckeditor5.css" />
  <script type="importmap">
    {
        "imports": {
            "ckeditor5": "https://cdn.ckeditor.com/ckeditor5/43.2.0/ckeditor5.js",
            "ckeditor5/": "https://cdn.ckeditor.com/ckeditor5/43.2.0/"
        }
    }
    </script>
    <script data-require="ui-bootstrap" src="https://cdnjs.cloudflare.com/ajax/libs/angular-ui-bootstrap/0.13.0/ui-bootstrap-tpls.min.js" data-semver="0.13.0"></script>

  <style>
    body {
      /* font-family: "Roboto", Helvetica, Arial, sans-serif; */
      font-weight: 100;
      font-size: 12px;
      line-height: 30px;
      color: #777;
      background: #4caf50;
    }

    .ck-editor__editable_inline:not(.ck-comment__input *) {
    height: 130px;
    overflow-y: auto;
    }

    .container {
      max-width: 400px;
      width: 100%;
      margin: 0 auto;
      position: relative;
    }
    
     .styled-title {
            color: #ff9d5c;
            font-size: 22px;
            font-weight: bold;
        }
     .styled-input, .styled-textarea {
            border-color: #ff9d5c;
            width: 100%;
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
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>NEW GAME MODE | KGamify</title>

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
          <div style="width: 234px; height: 83px" class="logo-image-small">
            <img src="../assets/img/kgamify logo T.png" />
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
          <li>
            <a href="./create_new_championship.php">
              <i class="far fa-plus-square"></i>
              <p style="font-size: 15px; font-weight: bold">
                New Championship
              </p>
            </a>
          </li>

          <!-- New Category   -->
          <!-- <li>
            <a href="../example/new_category.php">
              <i class="fas fa-trophy"></i>
              <p style="font-size: 15px; font-weight: bold">New Category</p>
            </a>
          </li> -->

          <!-- New Game Mode   -->
          <li class="active">
            <a href="../example/add_new_mode.php">
              <i class="fas fa-crosshairs"></i>
              <p style="font-size: 15px; font-weight: bold">New Game Mode</p>
            </a>
          </li>

          <!-- <li>
            <a href="../example/add_new_faculty.php">
              <i class="fas fa-solid fa-user-plus"></i>
              <p style="font-size: 15px; font-weight: bold">New Faculty</p>
            </a>
          </li> -->

          <!-- New Question -->
          <li>
            <a href="../example/add_question.php">
              <i class="fas fa-question"></i>
              <p style="font-size: 15px; font-weight: bold">New Question</p>
            </a>
          </li>

          <!-- New Label -->
          <li>
            <a href="../example/new_label.php">
              <i class="fas fa-tag"></i>
              <p style="font-size: 15px; font-weight: bold">New Label</p>
            </a>
          </li>

          <!-- End Second Section   -->

          <!-- Start Third Section -->

         <!--All Information-->
          <li>
            <a href="#">
              <p style="color: rgb(255, 81, 0); font-size: 15px">
                All Information
              </p>
            </a>
          </li>

            <li>
            <a href="../example/all_championships.php">
              <i class="fas fa-trophy"></i>
              <p style="font-size: 15px; font-weight: bold">All Championships</p>
            </a>
          </li>        

            <!-- Question Bank   -->
          <li>
            <a href="../example/question_bank.php">
              <i class="fas fa-question-circle"></i>
              <p style="font-size: 15px; font-weight: bold">Question Bank</p>
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
            <a href="../example/all_game_modes.php">
              <i class="fas fa-coins"></i>
              <p style="font-size: 15px; font-weight: bold">All Game Modes</p>
            </a>
          </li>
          
          <li>
            <a href="../example/all_category.php">
              <i class="fas fa-layer-group"></i>
              <p style="font-size: 15px; font-weight: bold">All Categories</p>
            </a>
          </li>

          <!-- Wrong Questions -->
          <li>
            <a href="../example/wrong_questions.php">
              <i class="fas fa-times-circle"></i>
              <p style="font-size: 15px; font-weight: bold">Wrong Questions</p>
            </a>
          </li>
          
          
           <!--Analytics Section-->
           <li class="active">
            <a href="#">
              <p style="color: rgb(255, 81, 0); font-size: 15px">Analytics</p>
            </a>
          </li>
          
          <li>
            <a href="../example/user_championship.php">
              <i class="fas fa-chart-line"></i>
              <p style="font-size: 15px; font-weight: bold">Championship</p>
            </a>
          </li>
          
          
          
            <!--Help Section-->
          <li class="active">
            <a href="#">
              <p style="color: rgb(255, 81, 0); font-size: 15px">Support</p>
            </a>
          </li>
          
           <li>
            <a href="../example/show_teachers.php">
              <i class="fas fa-user"></i>
              <p style="font-size: 15px; font-weight: bold">
                Teacher's Help
              </p>
            </a>
          </li>
          
           <li>
            <a href="../example/contact.php">
                <i class="fas fa-phone"></i> 
              <p style="font-size: 15px; font-weight: bold">
                Contact
              </p>
            </a>
          </li>
          
           <!--Help Section-->
          <li class="active">
            <a href="#">
              <p style="color: rgb(255, 81, 0); font-size: 15px">Terms and Conditions</p>
            </a>
          </li>
          
           <li>
            <a href="../example/show_teachers_privacy.php">
              <i class="fas fa-user"></i>
              <p style="font-size: 15px; font-weight: bold">
                For Teacher
              </p>
            </a>
          </li>
          
          
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

            <!-- linkkkkk -->
            <!-- Example single danger button -->
            <div class="btn-group">
              <button type="button" class="btn btn-primary dropdown-toggle text-white " data-bs-toggle="dropdown" aria-expanded="false">
                <?php
                // Start the session to access session variables

                $conn = new mysqli('localhost', 'u477273611_playquest', 'TEAcher23@#', 'u477273611_teacherpanel');

                if ($conn->connect_error) {
                  die("Connection failed: " . $conn->connect_error);
                }

                if (isset($_SESSION['email'])) {
                  $email = $_SESSION['email'];

                  // SQL query to select 'teacher_name' from 'teacher' table based on 'email'
                  $sql = "SELECT teacher_name FROM teacher WHERE email = '$email'";
                  $result = $conn->query($sql);

                  // Check if result is not empty
                  if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    echo "Hello, " . $row["teacher_name"];
                  } else {
                    echo "No result";
                  }
                } else {
                  echo "Session email not set";
                }

                $conn->close();
                ?>
              </button>

              <style>
                .btn-primary:hover {
                  background-color: inherit;
                  /* or use 'transparent' */
                }
              </style>

              <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <li>
                  <div class="d-flex align-items-center">
                    <img src="profile_logo.png" alt="Profile Logo" class="ms-2 py-1" style="width: 30px; height: 30px; border-radius: 30%; margin-right: 5px; cursor: pointer;" onclick="window.location.href = 'profile_page.php';">
                    <div style="margin-right: auto; cursor: pointer;" onclick="window.location.href = 'profile_page.php';">Profile</div>
                  </div>
                </li>

                <li>
                  <hr class="dropdown-divider">
                </li>

                <li>
                  <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="logout.php">Logout</a></li>
              </ul>
            </div>


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

              <!-- form start  -->
              <form method="post" action="add_new_mode.php">


                <div class="card-header">
                  <div class="container">
                    <!-- 1st one -->
                    <div id="contact">
                      <fieldset>
                        <p style="text-align: center;color: #ff9d5c; font-size: 30px;font-weight: bold; ">Create New Game Mode</p>

                        <hr style="height:1px; border:none;  background-color:#ff9d5c;">
                        <br>
                        <br>
                      </fieldset>
                      
                      
                      <!-- dsaddsadsasa -->

                      <p style="color: #ff9d5c;font-size: 22px;font-weight: bold; ">Select Labels</p>
                      <p style="color: #00c800;font-size: 18px">Questions in the Championship will appear from Questions under the label selected from here</p>


                      <div style=" display: grid; min-width: 89ch; font-size: 16px" class="select">

                        <?php
                        // PHP code to retrieve category names and populate the dropdown
                        // $conn = new mysqli('localhost', 'u477273611_playquest', 'TEAcher23@#', 'u477273611_teacherpanel');

                        // if ($conn->connect_error) {
                        //   die("Connection failed: " . $conn->connect_error);
                        // }
                        
                        // $teacher_query = "SELECT teacher_id FROM teacher WHERE email = ?";
                        //   $teacher_stmt = $conn->prepare($teacher_query);
                            
                        //   if ($teacher_stmt) {
                        //     $teacher_stmt->bind_param("s", $_SESSION['email']);
                        //     $teacher_stmt->execute();
                        //     $teacher_stmt->bind_result($teacher_id);
                        //     $teacher_stmt->fetch();
                        //     $teacher_stmt->close();
                        //   } else {
                        //     die("Teacher query preparation failed: " . $conn->error);
                        //   }

                        // $sql = "SELECT label_name FROM label where teacher_id=$teacher_id";
                        // $result = $conn->query($sql);
                        ?>
                        <select style="border-color: #ff9d5c;" id="label" name="label">
                          <?php
                          if ($label_count > 0) {
                            while ($row = $label_result->fetch_assoc()) {
                              $label_name = $row["label_name"];
                              echo "<option value='$label_name'>$label_name</option>";
                            }
                          }
                          $label_result->free(); // Free the result set
                          ?>
                        </select>

                        <span class="focus"></span>

                      </div>
                      </br>
                      </br>
                      
                      
                        <!-- 2nd one -->
                      <p style="color: #ff9d5c;font-size: 22px;font-weight: bold; ">Championship Name</p>
                      <div style=" display: grid; min-width: 89ch; font-size: 16px" class="select">

                        <?php
                        // PHP code to retrieve category names and populate the dropdown
                        // $conn = new mysqli('localhost', 'u477273611_playquest', 'TEAcher23@#', 'u477273611_teacherpanel');

                        // if ($conn->connect_error) {
                        //   die("Connection failed: " . $conn->connect_error);
                        // }

                        // $teacher_query = "SELECT teacher_id FROM teacher WHERE email = ?";
                        //   $teacher_stmt = $conn->prepare($teacher_query);
                            
                        //   if ($teacher_stmt) {
                        //     $teacher_stmt->bind_param("s", $_SESSION['email']);
                        //     $teacher_stmt->execute();
                        //     $teacher_stmt->bind_result($teacher_id);
                        //     $teacher_stmt->fetch();
                        //     $teacher_stmt->close();
                        //   } else {
                        //     die("Teacher query preparation failed: " . $conn->error);
                        //   }

                        // $sql = "SELECT champ_name FROM championship where teacher_id=$teacher_id";
                        // $result = $conn->query($sql);
                        ?>
                        <select id="champ_name" name="champ_name" style="border-color: #ff9d5c;">
                          <?php
                          if ($champ_count > 0) {
                            while ($row = $champ_result->fetch_assoc()) {
                              $champ_name = $row["champ_name"];
                              echo "<option value='$champ_name'>$champ_name</option>";
                            }
                          }
                          $champ_result->free(); // Free the result set
                          ?>
                        </select>

                        <span class="focus"></span>

                      </div>
                      <!-- ended 2nd one -->
                      <br /><br />

                      <p style="color: #ff9d5c;font-size: 22px;font-weight: bold; ">Game Mode name</p>
                      <div style=" display: grid; min-width: 89ch; font-size: 16px" class="select">
                       
                        <fieldset>
                          <input type="radio" id="quick_hit" name="mode_name" value="quick_hit">
                          <label style="color: black;font-size: 15px;font-weight: normal; " for="quick_hit">Quick Hit</label><br>
                          <input type="radio" id="play_win_gift" name="mode_name" value="play_win_gift">
                          <label style="color: black ;font-size: 15px;font-weight: normal; " for="play_win_gift">Play & Win Gift</label><br>
                        </fieldset>
                        <span class="focus"></span>

                      </div>

                    
                      <br />
                      <!-- ended 1st one -->
                      <p style="color: #ff9d5c;font-size: 22px;font-weight: bold;">Description/Rules</p>
                      <textarea name="description" id="description" placeholder="Write Description/Rules here...." required>
                    </textarea>
                      <!--<textarea name="description" id="editor" placeholder="Write Description/Rules here...."></textarea>-->
                      <br>


                      <br />
                      <br />

                      <fieldset>

                       
                        <p style="color: #ff9d5c;font-size: 22px;font-weight: bold; ">Required Qualification</p>
                      <div style=" display: grid; min-width: 89ch; font-size: 16px" class="select">

                        <?php
                        // PHP code to retrieve category names and populate the dropdown
                        $conn = new mysqli('localhost', 'u477273611_playquest', 'TEAcher23@#', 'u477273611_teacherpanel');

                        if ($conn->connect_error) {
                          die("Connection failed: " . $conn->connect_error);
                        }

                        $sql = "SELECT qualification_name FROM qualification";
                        $result = $conn->query($sql);
                        ?>
                        <select id="qualification" name="qualification" style="border-color: #ff9d5c;">
                          <?php
                          if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                              $qualification_name = $row["qualification_name"];
                              echo "<option value='$qualification_name'>$qualification_name</option>";
                            }
                          }
                          $result->free(); // Free the result set
                          ?>
                        </select>

                         

                      </fieldset>
                      <br>
        <div id="gift-info" style="display: none;">
        <div id="select_gift_type">
            <p style="color: #ff9d5c; font-size: 22px; width: 100%; font-weight: bold;">Select Gift Type</p>
            <?php
            // PHP code to retrieve gift data
            $conn = new mysqli('localhost', 'u477273611_playquest', 'TEAcher23@#', 'u477273611_teacherpanel');

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "SELECT gift_id, gift_type FROM gift";
            $result = $conn->query($sql);
            $gifts = [];

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $gifts[] = $row;
                }
            }
            $result->free(); // Free the result set
            $conn->close();
            ?>
            <div style="display: grid; min-width: 89ch; font-size: 16px;" class="select">
                <select class="js-example-basic-single" name="gift_type" id="gift-select" style="width: 100%;">
                    <?php
                    // htmlspecialchars($gift["gift_id"], ENT_QUOTES, 'UTF-8')
                    foreach ($gifts as $gift) {
                        echo "<option value='" . $gift["gift_type"] . "'>" . $gift["gift_type"] . "</option>";
                    }
                    ?>
                </select>
            </div>
            <span class="focus"></span>
        </div>
        <br>
        
        
        <div class="gift-card" id="gift-card">
        <p style="color: #ff9d5c; font-size: 22px; font-weight: bold;">Gift Card Name</p>
        <input style="border-color: #ff9d5c; width: 100%;" placeholder="Enter Gift Card Name" name="gift_name" id="gift-card-name" type="text" tabindex="1"/>
        <br><br>

        <p style="color: #ff9d5c; font-size: 22px; font-weight: bold;">Add Description</p>
        <textarea name="gift_card_text" id="gift-card-description" placeholder="Write Description here...."></textarea>
       
        <br />

        <p style="color: #ff9d5c; font-size: 22px; font-weight: bold;">Add Gift Card Image</p>
        <input type="file" id="img" name="timg" accept="image/*" />
        <img id="gift-card-image" style="display: none; max-width: 100%; height: auto;" />
        <br><br>
        </div>
        
        
        <div class="coupon" id="coupon"> 
        <p style="color: #ff9d5c; font-size: 22px; font-weight: bold;">Coupon Name</p>
        <input style="border-color: #ff9d5c; width: 100%;" placeholder="Enter Coupon Name" name="gift_name" id="coupon_name" type="text" tabindex="1"/>
        <br><br>

        <p style="color: #ff9d5c; font-size: 22px; font-weight: bold;">Coupon Description</p>
        <textarea name="coupon_text" id="coupon_description" placeholder="Write Description here...."></textarea>
       
        <br />

        <p style="color: #ff9d5c; font-size: 22px; font-weight: bold;">Add Coupon Image</p>
        <input type="file" id="img" name="timg" accept="image/*" />
        <img id="coupon-image" style="display: none; max-width: 100%; height: auto;" />
        <br><br>
        </div>
        
        
        <div class="product" id="product">
        <p style="color: #ff9d5c; font-size: 22px; font-weight: bold;">Product Name</p>
        <input style="border-color: #ff9d5c; width: 100%;" placeholder="Enter Product Name" name="gift_name" id="product_name" type="text" tabindex="1"/>
        <br><br>

        <p style="color: #ff9d5c; font-size: 22px; font-weight: bold;">Product Description</p>
        <textarea name="product_text" id="product_description" placeholder="Write Description here...."></textarea>
       
        <br />

        <p style="color: #ff9d5c; font-size: 22px; font-weight: bold;">Add Product Image</p>
        <input type="file" id="img" name="timg" accept="image/*" />
        <img id="coupon-image" style="display: none; max-width: 100%; height: auto;" />
        <br><br>
        </div>
        </div>
        
       

  <fieldset>
    <p style="color: #ff9d5c; font-size: 22px; width: 100%; font-weight: bold;">Number of Questions</p>
    <input placeholder="Enter Number of Questions" id="n_questions" type="number" name="no_of_questions" tabindex="1" required/>
  </fieldset>
  <br />

  <fieldset>
    <p style="color: #ff9d5c; font-size: 22px; width: 100%; font-weight: bold;">Time Required (Enter in Minutes)</p>
    <input placeholder="Enter Time Required (In Minutes)" id="t_required" type="text" tabindex="1" name="time_required" required/>
  </fieldset>
  <br /><br>
  
  <br>

  <fieldset>
    <input type="submit" id="submit" value="Create Game Mode" style="font-size: 15px; padding: 10px 25px; background-color: #ff9d5c; color: white; border-radius: 8px; border: #ff9d5c;" />
  </fieldset>
</form>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const quickHitRadio = document.getElementById('quick_hit');
    const playWinGiftRadio = document.getElementById('play_win_gift');
    const giftInfoSection = document.getElementById('gift-info');
    
    function toggleGiftInfo() {
      if (playWinGiftRadio.checked) {
        giftInfoSection.style.display = 'block';
      } else {
        giftInfoSection.style.display = 'none';
      }
    }

    // Initial check
    toggleGiftInfo();

    // Add event listeners to radio buttons
    quickHitRadio.addEventListener('change', toggleGiftInfo);
    playWinGiftRadio.addEventListener('change', toggleGiftInfo);
  });
</script>


<script>
    $(document).ready(function () {
      $("#gift-card").hide();
      $("#coupon").hide();
      $("#product").hide();
      $("#gift-select").change(function () {
          var selectedValue = $("#gift-select").val();
          console.log("Selected value:", selectedValue);
          if (selectedValue == "Gift Card") {
              $("#gift-card").show();
              $("#coupon").hide();
              $("#product").hide();
          }
          else if(selectedValue == "Coupon"){
              $("#coupon").show();
              $("#gift-card").hide();
              $("#product").hide();
          }
          else{
              $("#product").show();
              $("#gift-card").hide();
              $("#coupon").hide();
          }
      }).change();
    });
</script> 
<script>
    document.getElementById("submit").addEventListener("click", function(event) {
    var gift_card = document.getElementById("gift-card-name").value;
    var coupon = document.getElementById("coupon_name").value;
    var product = document.getElementById("product_name").value;
    var questions=document.getElementById("n_questions").value;
    var time=document.getElementById("t_required").value;
    var pattern = /[!@#$%^&*()+\=\[\]{};':"\\|,.<>\/?]+/;
    var alphapattern = /[!@#$%^&*()+\=\[\]{};':"\\|,.<>\/?_a-zA-Z-]+/;

    if (pattern.test(gift_card)) {
        event.preventDefault(); // Prevent form submission
        alert("Gift Card Name should not contain any special characters");
    }
    else if (pattern.test(coupon)) {
        event.preventDefault(); // Prevent form submission
        alert("Coupon Name should not contain any special characters");
    }
    else if (pattern.test(product)) {
        event.preventDefault(); // Prevent form submission
        alert("Product Name should not contain any special characters");
    }
    else if (alphapattern.test(questions)) {
        event.preventDefault(); // Prevent form submission
        alert("Number of questions should not contain any alphabets or special characters");
    }
    else if (alphapattern.test(time)) {
        event.preventDefault(); // Prevent form submission
        alert("Time Required should not contain any alphabets or special characters");
    }
});
</script>

<script type="module">
    import {
        ClassicEditor,
        Essentials,
        Bold,
        Italic,
        Font,
        Paragraph,
        Indent, 
        IndentBlock, 
        BlockQuote,
        Autoformat,
        TextTransformation,
        Code,
        Strikethrough, 
        Subscript, 
        Superscript,
        Underline,
        CodeBlock,
        FindAndReplace,Heading,Highlight,AutoLink, Link,List,MediaEmbed,Clipboard,Table, TableToolbar,Alignment
    } from 'ckeditor5';

    ClassicEditor
        .create( document.querySelector( '#description' ), {
            plugins: [ Essentials, Bold, Italic, Font, Paragraph,Indent, IndentBlock, BlockQuote, Autoformat, TextTransformation ,Code, Strikethrough, Subscript, Superscript, Underline,CodeBlock,FindAndReplace,Heading,Highlight,AutoLink, Link,List,MediaEmbed,Clipboard,Table, TableToolbar,Alignment],
            toolbar:{items: [
                'undo', 'redo', '|', 'bold', 'italic', 'underline', 'strikethrough', 'code', 'subscript', 'superscript' ,'|',
                'fontSize', 'fontFamily', 'fontColor','bulletedList', 'numberedList','insertTable','alignment','|', 'outdent', 'indent', 'blockquote','mediaEmbed','codeBlock','findAndReplace','heading','highlight','link','fontBackgroundColor'
            ],shouldNotGroupWhenFull: true},
            table: {
            contentToolbar: [ 'tableColumn', 'tableRow', 'mergeTableCells' ]
        }
        } )
        .then( /* ... */ )
        .catch( /* ... */ );
        
        ClassicEditor
        .create( document.querySelector( '#gift-card-description' ), {
            plugins: [ Essentials, Bold, Italic, Font, Paragraph,Indent, IndentBlock, BlockQuote, Autoformat, TextTransformation ,Code, Strikethrough, Subscript, Superscript, Underline,CodeBlock,FindAndReplace,Heading,Highlight,AutoLink, Link,List,MediaEmbed,Clipboard,Table, TableToolbar,Alignment],
            toolbar:{items: [
                'undo', 'redo', '|', 'bold', 'italic', 'underline', 'strikethrough', 'code', 'subscript', 'superscript' ,'|',
                'fontSize', 'fontFamily', 'fontColor','bulletedList', 'numberedList','insertTable','alignment','|', 'outdent', 'indent', 'blockquote','mediaEmbed','codeBlock','findAndReplace','heading','highlight','link','fontBackgroundColor'
            ],shouldNotGroupWhenFull: true},
            table: {
            contentToolbar: [ 'tableColumn', 'tableRow', 'mergeTableCells' ]
        }
        } )
        .then( /* ... */ )
        .catch( /* ... */ );
        
        ClassicEditor
        .create( document.querySelector( '#coupon_description' ), {
            plugins: [ Essentials, Bold, Italic, Font, Paragraph,Indent, IndentBlock, BlockQuote, Autoformat, TextTransformation ,Code, Strikethrough, Subscript, Superscript, Underline,CodeBlock,FindAndReplace,Heading,Highlight,AutoLink, Link,List,MediaEmbed,Clipboard,Table, TableToolbar,Alignment],
            toolbar:{items: [
                'undo', 'redo', '|', 'bold', 'italic', 'underline', 'strikethrough', 'code', 'subscript', 'superscript' ,'|',
                'fontSize', 'fontFamily', 'fontColor','bulletedList', 'numberedList','insertTable','alignment','|', 'outdent', 'indent', 'blockquote','mediaEmbed','codeBlock','findAndReplace','heading','highlight','link','fontBackgroundColor'
            ],shouldNotGroupWhenFull: true},
            table: {
            contentToolbar: [ 'tableColumn', 'tableRow', 'mergeTableCells' ]
        }
        } )
        .then( /* ... */ )
        .catch( /* ... */ );
        
        ClassicEditor
        .create( document.querySelector( '#product_description' ), {
            plugins: [ Essentials, Bold, Italic, Font, Paragraph,Indent, IndentBlock, BlockQuote, Autoformat, TextTransformation ,Code, Strikethrough, Subscript, Superscript, Underline,CodeBlock,FindAndReplace,Heading,Highlight,AutoLink, Link,List,MediaEmbed,Clipboard,Table, TableToolbar,Alignment],
            toolbar:{items: [
                'undo', 'redo', '|', 'bold', 'italic', 'underline', 'strikethrough', 'code', 'subscript', 'superscript' ,'|',
                'fontSize', 'fontFamily', 'fontColor','bulletedList', 'numberedList','insertTable','alignment','|', 'outdent', 'indent', 'blockquote','mediaEmbed','codeBlock','findAndReplace','heading','highlight','link','fontBackgroundColor'
            ],shouldNotGroupWhenFull: true},
            table: {
            contentToolbar: [ 'tableColumn', 'tableRow', 'mergeTableCells' ]
        }
        } )
        .then( /* ... */ )
        .catch( /* ... */ );
</script>


<script>
    // CKEDITOR.replace( 'description' );
    // CKEDITOR.replace( 'gift_card_text' );
    // CKEDITOR.replace( 'coupon_text' );
    // CKEDITOR.replace( 'product_text' );
</script>

<script>
    $(document).ready(function() {
      $(".navbar-toggler").on("click", function() {
        $("body").toggleClass("nav-open");
      });
    });
  </script>

</body>

</html>