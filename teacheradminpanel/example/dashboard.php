<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // Redirect to the login page
    echo "<script>alert('You need to LOGIN to view this page.'); window.location.href = 'index.php';</script>";
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

  <link rel="icon" href="../assets/img/PlayQuest Logo.png" type="image/icon type" />

  <!-- fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed&display=swap" rel="stylesheet" />

  <!-- css dashboard -->

  <link rel="stylesheet" href="dashboard.css" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

  <!-- css dashboard -->
  <!-- fonts -->
  <meta charset="utf-8" />
   <link rel="icon" href="../assets/img/KLOGO.png" type="image/icon type" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

  <title>Dashboard | KGamify</title>
  <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no" name="viewport" />
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="../assets/css/paper-dashboard.css?v=2.0.1" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="../assets/demo/demo.css" rel="stylesheet" />

  <!-- CSS FontAwesome -->
  <script src="https://kit.fontawesome.com/52f3e32cf9.js" crossorigin="anonymous"></script>



  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

  <style>
        /* .btn-primary:hover {
         background-color: inherit;
                 
    } */
                 
        button.btn-primary:hover {
        color: black; /* New text color */
    }
  </style>



</head>

<body class="">
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
          <li class="active">
            <a href="#">
              <p style="color: rgb(255, 81, 0); font-size: 15px">Main Menu</p>
            </a>
          </li>

          <!-- Dashboard -->
          <li class="active">
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

          <!-- Create New Championship -->
          <li class="#">
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
                <i class="fas fa-align-justify"></i>
                <p style="font-size: 15px; font-weight: bold">New Category</p>
              </a>
            </li> -->

          <!-- New Game Mode   -->
          <li>
            <a href="../example/add_new_mode.php">
              <i class="fas fa-crosshairs"></i>
              <p style="font-size: 15px; font-weight: bold">New Game Mode</p>
            </a>
          </li>





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
          
                    <!-- All Championships -->
          <li>
            <a href="../example/all_championships.php">
              <i class="fas fa-trophy"></i>
              <p style="font-size: 15px; font-weight: bold">All Championships</p>
            </a>
          </li>

          <!-- All Championships -->
          <!-- Question Bank   -->
          <li>
            <a href="../example/question_bank.php">
              <i class="fas fa-question-circle"></i>
              <p style="font-size: 15px; font-weight: bold">Question Bank</p>
            </a>
          </li>


          <!-- All Categories -->

          <!-- <li>
              <a href="../example/all_category.php">
                <i class="fas fa-th"></i>
                <p style="font-size: 15px; font-weight: bold">All Categories</p>
              </a>
            </li> -->



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
              <p style="font-size: 15px; font-weight: bold">
                Wrong Questions
              </p>
            </a>
          </li>
          
          <!--Analytics Section-->
           <li>
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
          <!-- End Fourth Section   -->
          
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


    <div class="main-panel">
      <!-- Navbar -->

      <nav class="
            navbar navbar-expand-lg navbar-absolute
            fixed-top
            navbar-transparent
          ">
        <div class="container-fluid" style="margin-bottom: 10px">
          <div class="navbar-wrapper">
            <div class="navbar-toggle">
              <button type="button" class="navbar-toggler">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </button>
            </div>
            <a style="color: orange; font-size: 25px" class="navbar-brand" href="javascript:;">DASHBOARD</a>
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
      <div class="content">
        <div style="height: 80vh" class="row">
          <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
              <div style="margin: 20px; height: 20vh" class="card-body">
                <div style="padding: 40px" class="row">
                  <div class="col-5 col-md-4">
                    <div class="icon-big text-center icon-warning">
                      <i style="color: rgb(255, 123, 0)" class="fas fa-trophy"></i>
                    </div>
                  </div>
                  <div class="col-7 col-md-8">
                    <div class="numbers">
                      <p id="total_championships" style="font-size: 40px" class="card-title">
                        <?php

                        $conn = new mysqli('localhost', 'u477273611_playquest', 'TEAcher23@#', 'u477273611_teacherpanel');
                        $email = $_SESSION['email'];
                        if ($conn->connect_error) {
                          die("Connection failed: " . $conn->connect_error);
                        }

                        // SQL query to retrieve data
                        $sql = "SELECT count(*) as c from championship";
                        $result = $conn->query($sql);

                        // // Format data as an associative array
                        // $data = [];
                        if ($result->num_rows > 0) {
                          while ($row = $result->fetch_assoc()) {
                            echo $row["c"];
                          }
                        } else {
                          echo "0 result";
                        }



                        $conn->close();

                        ?>


                      </p>
                      <p class="card-category">Total Championships</p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer">
                <hr />
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
              <div style="margin: 20px; height: 20vh" class="card-body">
                <div style="padding: 40px" class="row">
                  <div class="col-5 col-md-4">
                    <div class="icon-big text-center icon-warning" style="color: rgb(255, 123, 0)">
                      <i class="fas fa-users"></i>
                    </div>
                  </div>

                  <div class="col-7 col-md-8">
                    <div class="numbers">
                      <p id="total_registered_users" style="font-size: 40px" class="card-title">

                        <?php

                        $conn = new mysqli('localhost', 'u477273611_playquest', 'TEAcher23@#', 'u477273611_teacherpanel');

                        if ($conn->connect_error) {
                          die("Connection failed: " . $conn->connect_error);
                        }

                        // SQL query to retrieve data
                        $sql = "SELECT count(*) as c from user";
                        $result = $conn->query($sql);

                        // // Format data as an associative array
                        // $data = [];
                        if ($result->num_rows > 0) {
                          while ($row = $result->fetch_assoc()) {
                            echo $row["c"];
                          }
                        } else {
                          echo "0 result";
                        }



                        $conn->close();

                        ?>
                      </p>
                      <p class="card-category">Total Registered Users</p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer">
                <hr />
              </div>
            </div>
          </div>


          <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
              <div style="margin: 20px; height: 20vh" class="card-body">
                <div style="padding: 40px" class="row">
                  <div class="col-5 col-md-4">
                    <div class="icon-big text-center icon-warning" style="color: rgb(255, 123, 0)">
                      <i class="fas fa-align-justify"></i>
                    </div>
                  </div>

                  <div class="col-7 col-md-8">
                    <div class="numbers">
                      <p id="total_registered_users" style="font-size: 40px" class="card-title">

                        <?php

                        $conn = new mysqli('localhost', 'u477273611_playquest', 'TEAcher23@#', 'u477273611_teacherpanel');

                        if ($conn->connect_error) {
                          die("Connection failed: " . $conn->connect_error);
                        }

                        // SQL query to retrieve data
                        $sql = "SELECT count(*) as c from category";
                        $result = $conn->query($sql);

                        // // Format data as an associative array
                        // $data = [];
                        if ($result->num_rows > 0) {
                          while ($row = $result->fetch_assoc()) {
                            echo $row["c"];
                          }
                        } else {
                          echo "0 result";
                        }



                        $conn->close();

                        ?>


                      </p>
                      <p class="card-category">Total Categories</p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer">
                <hr />
              </div>
            </div>
          </div>
          
          <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
              <div style="margin: 20px; height: 20vh" class="card-body">
                <div style="padding: 40px" class="row">
                  <div class="col-5 col-md-4">
                    <div class="icon-big text-center icon-warning" style="color: rgb(255, 123, 0)">
                      <i class="fas fa-dice-d6"></i>
                    </div>
                  </div>

                  <div class="col-7 col-md-8">
                    <div class="numbers">
                      <p id="total_gamemode" style="font-size: 40px" class="card-title">

                        <?php

                        $conn = new mysqli('localhost', 'u477273611_playquest', 'TEAcher23@#', 'u477273611_teacherpanel');

                        if ($conn->connect_error) {
                          die("Connection failed: " . $conn->connect_error);
                        }

                        // SQL query to retrieve data
                        $sql = "SELECT count(*) as c from game_mode";
                        $result = $conn->query($sql);

                        // // Format data as an associative array
                        // $data = [];
                        if ($result->num_rows > 0) {
                          while ($row = $result->fetch_assoc()) {
                            echo $row["c"];
                          }
                        } else {
                          echo "0 result";
                        }
                        $conn->close();

                        ?>


                      </p>
                      <p class="card-category">Total Game Modes</p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer">
                <hr />
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <script>
    $(document).ready(function() {
      $(".navbar-toggler").on("click", function() {
        $("body").toggleClass("nav-open");
      });
    });
  </script>

</body>

</html>