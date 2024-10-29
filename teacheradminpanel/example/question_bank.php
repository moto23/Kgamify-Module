<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // Redirect to the login page
    echo "<script>alert('You need to LOGIN to view this page.'); window.location.href = 'index.php';</script>";
    exit();
}
?>
<?php

$servername = "localhost";
$username = "u477273611_playquest";
$password = "TEAcher23@#";
$database = "u477273611_teacherpanel";

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $database);
$res = mysqli_query($conn, "select * from question");
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['updatequestion'])) {
  $question_text = $_POST['question_text'];
  $question_id = $_POST['question_id'];
  $option1_text = $_POST['option1_text'];
  $option2_text = $_POST['option2_text'];
  $option3_text = $_POST['option3_text'];
  $option4_text = $_POST['option4_text'];
  $total_coins = $_POST['total_coins'];
  $query = "UPDATE question set question_text='$question_text',option1_text='$option1_text',option2_text='$option2_text',option3_text='$option3_text',option4_text='$option4_text',total_coins='$total_coins' where question_id='$question_id'";
  $query_run = mysqli_query($conn, $query);

  if ($query_run) {
    echo "<script>alert('Question Updated');window.location.href='question_bank.php';</script>";
  } else {
    echo '<script>alert("Question Not Updated");</script>';
  }
}

if (isset($_POST['deletelabel'])) {
  // $label_name = $_POST['label_name'];
  $delete_id = $_POST['delete_id'];
  $query = "DELETE from label where label_id='$delete_id'";
  $query_run = mysqli_query($conn, $query);

  if ($query_run) {
    echo '<script>alert("Label Deleted");</script>';
  } else {
    echo '<script>alert("Label Not Deleted");</script>';
  }
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
    
    table.dataTable td {
        font-size: 12px;
    }

    table.dataTable th {
        font-size: 13px;
    }

    .dataTables_scrollHeadInner, .table{
      width:100%!important
    };

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
  <title>ALL QUESTIONS | KGamify</title>


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
          
          <li>
            <a href="../example/all_championships.php">
              <i class="fas fa-trophy"></i>
              <p style="font-size: 15px; font-weight: bold">All Championships</p>
            </a>
          </li>
          
          <li class="active">
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
          
          <!-- End Fourth Section   -->
        </ul>
      </div>
    </div>

    <div class="main-panel" style="height: 70px;">
        
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

      <div class="modal" id="editmodal" tabindex="-1">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Edit Question</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="question_bank.php" method="POST">
              <div class="modal-body">
                <input type="hidden" name="srno" id="srno">
                <input type="hidden" name="question_id" id="question_id">
                <div class="form-group">
                  <label>Question Text</label>
                  <input type="text" class="form-control" id="question_text" name="question_text" required>
                  <label>Option-1 Text</label>
                  <input type="text" class="form-control" id="option1_text" name="option1_text" required>
                  <label>Option-2 Text</label>
                  <input type="text" class="form-control" id="option2_text" name="option2_text" required>
                  <label>Option-3 Text</label>
                  <input type="text" class="form-control" id="option3_text" name="option3_text" required>
                  <label>Option-4 Text</label>
                  <input type="text" class="form-control" id="option4_text" name="option4_text" required>
                  <label>Total Coins</label>
                  <input type="text" class="form-control" id="total_coins" name="total_coins" required>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="closebtn" style="font-size: 15px;margin-right:8px; padding: 5px 8px;background-color:#ff9d5c;border: #ff9d5c;border-radius:5px;color:white;font-weight:bold;" data-bs-dismiss="modal">Close</button>
                <button type="submit" name="updatequestion" class="updatebtn" style="font-size: 15px; padding: 5px 8px;background-color:#ff9d5c;border: #ff9d5c;border-radius:5px;color:white;font-weight:bold;">Update</button>
              </div>
            </form>
          </div>
        </div>
      </div>

      <!-- form code starts         -->

      <div class="content">
        <div style="height: 100vh;" class="row">
          <div class="col-md-12">
            <div class="card demo-icons">
              <div class="card-header">
                <div class="container">
                  <!-- 1st one -->
                  <div id="contact">

                    <fieldset>
                      <p style="text-align: center;color: #ff9d5c; font-size: 30px;font-weight: bold; ">Your Questions</p>
                      <hr style="height:2px; border:none;  background-color:#ff9d5c;">
                      <br>
                    </fieldset>


                    <div class="container">
                      <table id="myTable" class="table-striped cell-border">
                        <thead>
                          <tr>
                            <th>Sr. No</th>
                            <th>Question ID</th>
                            <th>Action</th>
                            <th>Label Name</th>
                            <th>Question Text</th>
                            <th>Option1 Text</th>
                            <th>Option2 Text</th>
                            <th>Option3 Text</th>
                            <th>Option4 Text</th>
                            <th>Total Coins</th>
                            <th>Creation Time</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $a = 1;
                        //   while ($row = mysqli_fetch_assoc($res)) {
                            $email = $_SESSION['email'];
                            // $teacher_id = $row['teacher_id'];
                            $teacher_query = "SELECT teacher_id from teacher where email = ?";
                            $teacher_stmt = $conn->prepare($teacher_query);

                            if ($teacher_stmt) {
                              $teacher_stmt->bind_param("s", $email);
                              $teacher_stmt->execute();
                              $teacher_stmt->bind_result($teacher_id);
                              $teacher_stmt->fetch();
                              $teacher_stmt->close();
                            }
                            
                            $t_query = "SELECT teacher_name from teacher where teacher_id = ?";
                            $t_stmt = $conn->prepare($t_query);

                            if ($t_stmt) {
                              $t_stmt->bind_param("s", $teacher_id);
                              $t_stmt->execute();
                              $t_stmt->bind_result($teacher_name);
                              $t_stmt->fetch();
                              $t_stmt->close();
                            }
                            $teacher = mysqli_query($conn, "select * from question where teacher_id= '$teacher_id'");
                            while ($row = mysqli_fetch_assoc($teacher)) {
                                $label_query = "SELECT label_name from label where label_id = ?";
                            $label_stmt = $conn->prepare($label_query);

                            if ($label_stmt) {
                              $label_stmt->bind_param("s", $row['label_id']);
                              $label_stmt->execute();
                              $label_stmt->bind_result($label_name);
                              $label_stmt->fetch();
                              $label_stmt->close();
                            }
                          ?>
                            <tr>
                              <td><?php echo $a++ ?></td>
                              <td><?php echo $row['question_id'] ?></td>
                              <td><a class="editbtn">
                                  <i class="fas fa-solid fa-pen-to-square" style="color:#ff9d5c;margin-right:10px;cursor:pointer;"></i></a>
                                <!--<a class="deletebtn">-->
                                <!--  <i class="fas fa-solid fa-trash" style="color:#ff9d5c;margin-left:10px;cursor:pointer;"></i></a>-->
                              </td>
                              <td><?php echo $label_name ?></td>
                              <td><?php echo $row['question_text'] ?></td>
                              <td><?php echo $row['option1_text'] ?></td>
                              <td><?php echo $row['option2_text'] ?></td>
                              <td><?php echo $row['option3_text'] ?></td>
                              <td><?php echo $row['option4_text'] ?></td>
                              <td><?php echo $row['total_coins'] ?></td>
                              <td><?php echo $row['created_at'] ?></td>
                            </tr>
                          <?php } ?>
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
    <script>
      $(document).ready(function() {
        $('#myTable').DataTable({
          lengthMenu: [
            [500, 1000, 1500, -1],
            [500,1000, 1500, 'All']
          ],
          scrollX: true,
          columnDefs: [{
              targets: 9,
              className: 'dt-right'
            },
            {
              targets: [2,3,4,5,6,7,8,10],
              className: 'dt-center'
            }
          ]
        }).columns.adjust();
      });
    </script>
    <script>
      $(document).ready(function() {
        $('.editbtn').on('click', function() {
          $('#editmodal').modal('show');
          $tr = $(this).closest('tr');

          var data = $tr.children("td").map(function() {
            return $(this).text();
          }).get();

          console.log(data);

          $('#srno').val(data[0]);
          $('#question_id').val(data[1]);
          $('#question_text').val(data[5]);
          $('#option1_text').val(data[6]);
          $('#option2_text').val(data[7]);
          $('#option3_text').val(data[8]);
          $('#option4_text').val(data[9]);
          $('#total_coins').val(data[10]);
        });
      });
    </script>

    <script>
      $(document).ready(function() {
        $('.deletebtn').on('click', function() {
          $('#deletemodal').modal('show');
          $tr = $(this).closest('tr');

          var data = $tr.children("td").map(function() {
            return $(this).text();
          }).get();

          console.log(data);

          $('#srno').val(data[0]);
          $('#delete_id').val(data[1]);
        });
      });
    </script>

</body>

</html>
