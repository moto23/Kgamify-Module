<?php
$servername = "localhost";
$username = "u477273611_playquest";
$password = "TEAcher23@#";
$database = "u477273611_teacherpanel";

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $database);
$res = mysqli_query($conn, "select * from qualification");
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['updatequalification'])) {
  $qualification_name = $_POST['qualification_name'];
  $qualification_id = $_POST['qualification_id'];
  $query = "UPDATE qualification set qualification_name='$qualification_name' where qualification_id='$qualification_id'";
  $query_run = mysqli_query($conn, $query);

  if ($query_run) {
    echo "<script>alert('Qualification Updated');window.location.href='all_qualifications.php';</script>";
  } else {
    echo '<script>alert("Qualification Not Updated");</script>';
  }
}

if (isset($_POST['deletecategory'])) {
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

  <link rel="icon" href="../assets/img/title.png" type="image/icon type" />

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
  <link rel="icon" type="image/png" href="../assets/img/title.png" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>ALL QUALIFICATION | PlayQuest</title>


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
            <img src="../assets/img/kgamify admin D.png" />
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

          <!-- New Teacher -->
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
          <li class="active">
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
          
          <li class="active">
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

      <div class="modal" id="editmodal" tabindex="-1">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Edit Qualification</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="all_qualifications.php" method="POST">
              <div class="modal-body">
                <input type="hidden" name="srno" id="srno">
                <input type="hidden" name="qualification_id" id="qualification_id">
                <div class="form-group">
                  <label>Qualification Name</label>
                  <input type="text" class="form-control" id="qualification_name" name="qualification_name">
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="closebtn" style="font-size: 15px;margin-right:8px; padding: 5px 8px;background-color:#ff9d5c;border: #ff9d5c;border-radius:5px;color:white;font-weight:bold;" data-bs-dismiss="modal">Close</button>
                <button type="submit" name="updatequalification" class="updatebtn" style="font-size: 15px; padding: 5px 8px;background-color:#ff9d5c;border: #ff9d5c;border-radius:5px;color:white;font-weight:bold;">Update</button>
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
                      <p style="text-align: center;color: #ff9d5c; font-size: 30px;font-weight: bold; ">Qualifications List</p>
                      <hr style="height:2px; border:none;  background-color:#ff9d5c;">
                      <br>
                    </fieldset>


                    <div class="container">
                      <table id="myTable" class="table-striped cell-border">
                        <thead>
                          <tr>
                            <th>Sr. No</th>
                            <th>Qualification ID</th>
                            <th>Action</th>
                            <th>Qualification Name</th>
                            <th>Category Creation Time</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $a = 1;
                          while ($row = mysqli_fetch_assoc($res)) {
                          ?>
                            <tr>
                              <td><?php echo $a++ ?></td>
                              <td><?php echo $row['qualification_id'] ?></td>
                              <td><a class="editbtn">
                                  <i class="fas fa-solid fa-pen-to-square" style="color:#ff9d5c;margin-right:10px;cursor:pointer;"></i></a>
                                <!--<a class="deletebtn">-->
                                <!--  <i class="fas fa-solid fa-trash" style="color:#ff9d5c;margin-left:10px;cursor:pointer;"></i></a>-->
                              </td>
                              <td><?php echo $row['qualification_name'] ?></td>
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
            [500, 1000, 1500, 'All']
          ],
          columnDefs: [{
              targets: 4,
              className: 'dt-right'
            },
            {
              targets: [2,3],
              className: 'dt-center'
            }
          ]
        });
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
          $('#qualification_id').val(data[1]);
          $('#qualification_name').val(data[3]);
          $('#action').val(data[4]);
          $('#created_at').val(data[5]);
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