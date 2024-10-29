<?php
session_start();
$servername = "localhost";
$username = "u477273611_playquest";
$password = "TEAcher23@#";
$database = "u477273611_teacherpanel";


// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $database);

if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];

    // Fetch teacher_id
    $sql = "SELECT teacher_id FROM teacher WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $teacher_id = $row["teacher_id"];
    } else {
        echo "No result";
        exit;
    }
} else {
    echo "Session email not set";
    exit;
}

// Fetch user_id and champ_id from the result table for the teacher
$res = mysqli_query($conn, "SELECT user_id, champ_id FROM result WHERE teacher_id=$teacher_id");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

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


  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
  <link rel="stylesheet" href="style.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"> -->
  <!-- <link rel="stylesheet" href="https://cdn.datatables.net/2.0.3/css/dataTables.bootstrap5.min.css" /> -->
  <link rel="stylesheet" href="https://cdn.datatables.net/2.0.3/css/dataTables.dataTables.css" />

  <script data-require="jquery" data-semver="2.1.3" src="http://code.jquery.com/jquery-2.1.3.min.js"></script>
  <script data-require="bootstrap" data-semver="3.3.2" src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
  <script data-require="angular.js@1.3.x" src="https://code.angularjs.org/1.3.14/angular.js" data-semver="1.3.14"></script>
  <script data-require="ui-bootstrap" src="https://cdnjs.cloudflare.com/ajax/libs/angular-ui-bootstrap/0.13.0/ui-bootstrap-tpls.min.js" data-semver="0.13.0"></script>
  <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
  <!-- <script src="https://cdn.datatables.net/2.0.3/js/dataTables.min.js"></script> -->
  <script src="https://cdn.datatables.net/2.0.3/js/dataTables.js"></script>
  <!-- <script src="https://cdn.datatables.net/2.0.3/js/dataTables.bootstrap5.min.js"></script> -->
  <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script> -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

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
    
    table.dataTable td {
        font-size: 13px;
    }

    table.dataTable th {
        font-size: 13px;
    }
    
    .dataTables_scrollHeadInner, .table{
      width:100%!important
    };

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
      margin: 22px 39px 46px;
      padding: 7px 27px;
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
  <title>CHAMPIONSHIP ANALYTICS | KGamify</title>


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
          <li>
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
          <li class="active">
            <a href="#">
              <p style="color: rgb(255, 81, 0); font-size: 15px">
                All Information
              </p>
            </a>
          </li>
          
          <li class>
            <a href="../example/all_championships.php">
              <i class="fas fa-trophy"></i>
              <p style="font-size: 15px; font-weight: bold">All Championships</p>
            </a>
          </li>
          
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
          
          <li class="active">
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
          " style="height: 70px;">
        <div class="container-fluid" style="margin-bottom: 10px">
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
      
      
      <!--<nav class="-->
      <!--      navbar navbar-expand-lg navbar-absolute-->
      <!--      fixed-top-->
      <!--      navbar-transparent-->
      <!--    ">-->
      <!--  <div class="container-fluid" style="margin-bottom: 10px">-->
      <!--    <div class="navbar-wrapper">-->
      <!--      <div class="navbar-toggle">-->
      <!--        <button type="button" class="navbar-toggler">-->
      <!--          <span class="navbar-toggler-bar bar1"></span>-->
      <!--          <span class="navbar-toggler-bar bar2"></span>-->
      <!--          <span class="navbar-toggler-bar bar3"></span>-->
      <!--        </button>-->
      <!--      </div>-->
      <!--      <a style="color: orange; font-size: 25px" class="navbar-brand" href="javascript:;"></a>-->
      <!--    </div>-->
      <!--    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">-->
      <!--      <span class="navbar-toggler-bar navbar-kebab"></span>-->
      <!--      <span class="navbar-toggler-bar navbar-kebab"></span>-->
      <!--      <span class="navbar-toggler-bar navbar-kebab"></span>-->
      <!--    </button>-->


      <!--    <div class="collapse navbar-collapse justify-content-end" id="navigation">-->

            <!-- linkkkkk -->
            <!-- Example single danger button -->
      <!--      <div class="btn-group">-->
      <!--      <button type="button" class="btn btn-primary dropdown-toggle text-white " data-bs-toggle="dropdown" aria-expanded="false">-->
                <?php
                // Start the session to access session variables

                // $conn = new mysqli('localhost', 'u477273611_playquest', 'TEAcher23@#', 'u477273611_teacherpanel');

                // if ($conn->connect_error) {
                //   die("Connection failed: " . $conn->connect_error);
                // }

                // if (isset($_SESSION['email'])) {
                //   $email = $_SESSION['email'];

                //   // SQL query to select 'teacher_name' from 'teacher' table based on 'email'
                //   $sql = "SELECT teacher_name FROM teacher WHERE email = '$email'";
                //   $result = $conn->query($sql);

                //   // Check if result is not empty
                //   if ($result->num_rows > 0) {
                //     $row = $result->fetch_assoc();
                //     echo "Hello, " . $row["teacher_name"];
                //   } else {
                //     echo "No result";
                //   }
                // } else {
                //   echo "Session email not set";
                // }

                // $conn->close();
                ?>
      <!--        </button>-->

             

      <!--        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">-->
      <!--          <li>-->
      <!--            <div class="d-flex align-items-center">-->
      <!--              <img src="profile_logo.png" alt="Profile Logo" class="ms-2 py-1" style="width: 30px; height: 30px; border-radius: 30%; margin-right: 5px; cursor: pointer;" onclick="window.location.href = 'profile_page.php';">-->
      <!--              <div style="margin-right: auto; cursor: pointer;" onclick="window.location.href = 'profile_page.php';">Profile</div>-->
      <!--            </div>-->
      <!--          </li>-->

      <!--          <li>-->
      <!--            <hr class="dropdown-divider">-->
      <!--          </li>-->

      <!--          <li>-->
      <!--            <hr class="dropdown-divider">-->
      <!--          </li>-->
      <!--          <li><a class="dropdown-item" href="index.php">Logout</a></li>-->
      <!--        </ul>-->
      <!--      </div>-->


      <!--    </div>-->
      <!--  </div>-->
      <!--</nav>-->
      
      <!--Form start-->
      
        <div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card demo-icons">

              <!-- form start  -->
             <form method="post" action="user_championship.php">
                <div class="card-header">
                  <div class="container">
                    <!-- 1st one -->

                    <div id="contact">
                      <fieldset>
                        <p style="text-align: center;color: #ff9d5c; font-size: 30px;font-weight: bold; ">Championship Analytics</p>

                        <hr style="height:1px; border:none;  background-color:#ff9d5c;">
                        <br>
                      </fieldset>
                      <div class="container">
                      <table id="myTable" class="table-striped cell-border">
                        <thead>
                          <tr>
                            <th>Sr. No</th>
                            <th>ID</th>
                            <th>Championship Name</th>
                            <th>Championship Start Date</th>
                            <th>Championship End Date</th>
                            <th>User Name</th>
                            <th>Question</th>
                            <th>Question Coins</th>
                            <th>Question Solving Time</th>
                            <th>Date</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $a = 1;
                          while ($row = mysqli_fetch_assoc($res)) {
                    $user_id = $row['user_id'];
                    $champ_id = $row['champ_id'];
                    
                    // Now, fetch questions related to this user_id from result_per_question
                    $questions_query = "SELECT question_id, time_taken, created_at FROM result_per_question WHERE user_id = ?";
                    $questions_stmt = $conn->prepare($questions_query);
                    $questions_stmt->bind_param("s", $user_id);
                    $questions_stmt->execute();
                    $questions_result = $questions_stmt->get_result();
                    
                    while ($question_row = $questions_result->fetch_assoc()) {
                        $question_id = $question_row['question_id'];
                        $time_taken = $question_row['time_taken'];
                        $created_at = $question_row['created_at'];
                        $date = (new DateTime($created_at))->format('Y-m-d');
                        
                        // Fetch championship details
                        $champ_query = "SELECT champ_name, start_date, end_date FROM championship WHERE champ_id = ?";
                        $champ_stmt = $conn->prepare($champ_query);
                        $champ_stmt->bind_param("s", $champ_id);
                        $champ_stmt->execute();
                        $champ_stmt->bind_result($champ_name, $start_date, $end_date);
                        $champ_stmt->fetch();
                        $champ_stmt->close();
                        
                        // Fetch user details
                        $user_query = "SELECT user_name FROM user WHERE user_id = ?";
                        $user_stmt = $conn->prepare($user_query);
                        $user_stmt->bind_param("s", $user_id);
                        $user_stmt->execute();
                        $user_stmt->bind_result($user_name);
                        $user_stmt->fetch();
                        $user_stmt->close();
                        
                        // Fetch question details
                        $question_query = "SELECT question_text, total_coins FROM question WHERE question_id = ?";
                        $question_stmt = $conn->prepare($question_query);
                        $question_stmt->bind_param("s", $question_id);
                        $question_stmt->execute();
                        $question_stmt->bind_result($question_text, $coins);
                        $question_stmt->fetch();
                        $question_stmt->close();
                              
                              
                        //   while ($row = mysqli_fetch_assoc($res)) {
                        //     $champ_id = $row['champ_id'];
                        //     $champ_query = "SELECT champ_name,start_date,end_date from championship where champ_id = ?";
                        //     $champ_stmt = $conn->prepare($champ_query);

                        //     if ($champ_stmt) {
                        //       $champ_stmt->bind_param("s", $champ_id);
                        //       $champ_stmt->execute();
                        //       $champ_stmt->bind_result($champ_name,$start_date,$end_date);
                        //       $champ_stmt->fetch();
                        //       $champ_stmt->close();
                        //     }
                            
                        //     $teacher_query = "SELECT teacher_id from championship where champ_id = ?";
                        //     $teacher_stmt = $conn->prepare($teacher_query);

                        //     if ($teacher_stmt) {
                        //       $teacher_stmt->bind_param("s", $champ_id);
                        //       $teacher_stmt->execute();
                        //       $teacher_stmt->bind_result($teacher_id);
                        //       $teacher_stmt->fetch();
                        //       $teacher_stmt->close();
                        //     }

                        //     $user_query = "SELECT user_name from user where user_id = ?";
                        //     $user_stmt = $conn->prepare($user_query);

                        //     if ($user_stmt) {
                        //       $user_stmt->bind_param("s", $row['user_id']);
                        //       $user_stmt->execute();
                        //       $user_stmt->bind_result($user_name);
                        //       $user_stmt->fetch();
                        //       $user_stmt->close();
                        //     }
                          ?>
                            <tr>
                              <td><?php echo $a++ ?></td>
                              <td><?php echo $row['result_per_question_id'] ?></td>
                              <td><?php echo $champ_name?></td>
                              <td><?php echo $start_date?></td>
                              <td><?php echo $end_date?></td>
                              <td><?php echo $user_name ?></td>
                              <td><?php echo $question_text ?></td>
                              <td><?php echo $coins ?></td>
                              <td><?php echo $time_taken ?></td>
                              <td><?php echo $date ?></td>
                            </tr>
                          <?php 
                            } 
                            $questions_stmt->close();
                          }
                          $conn->close();
                        //   } 
                          ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    </div>
    </form>
    <script>
      $(document).ready(function() {
        $('#myTable').DataTable({
          lengthMenu: [
            [500, 1000, 1500, -1],
            [500, 1000, 1500, 'All']
          ],
          autoWidth: false,
          scrollX: true,
          columnDefs: [{
              targets: [1,8],
              className: 'dt-right'
            },
            {
              targets: [2,3,4,5,6,7],
              className: 'dt-center'
            }
          ]
        }).columns.adjust();;
      });
    </script>
              
    </body>
</html>