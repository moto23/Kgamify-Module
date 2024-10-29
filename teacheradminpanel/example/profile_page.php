<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // Redirect to the login page
    echo "<script>alert('You need to LOGIN to view this page.'); window.location.href = 'index.php';</script>";
    exit();
}
?>


<?php
session_start();
$conn = new mysqli('localhost', 'u477273611_playquest', 'TEAcher23@#', 'u477273611_teacherpanel');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$profileImage = "profile_logo.png";

if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];

    // Fetch the uploaded image link from the database
    $stmt = $conn->prepare("SELECT upload_img FROM teacher WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if ($row["upload_img"]) {
            $profileImage = $row["upload_img"];
            $_SESSION['profile_image'] = $profileImage; // Store the image link in session
        } else {
            $profileImage = "profile_logo.png";
            $_SESSION['profile_image'] = $profileImage; // Store the default image in session
        }
    } else {
        $profileImage = "profile_logo.png";
        $_SESSION['profile_image'] = $profileImage; // Store the default image in session
    }

    $stmt->close();
} else {
    $profileImage = "profile_logo.png";
    $_SESSION['profile_image'] = $profileImage; // Store the default image in session
}

$conn->close();
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" href="../assets/img/KLOGO.png" type="image/icon type" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

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
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/title.png" />
  <link rel="icon" type="image/png" href="../assets/img/title.png" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

  <title>PROFILE PAGE</title>
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
  
  
  
  <!--new added-->
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>




  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>


  <style>
    .btn-primary.dropdown-toggle:hover {
      color: black;
    }
  </style>


</head>

<body class="">

  <style>
    .custom-bg-white {
      background-color: white !important;
      /* !important is used to ensure the style is applied */
    }
  </style>
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
          <li class="custom-bg-white">
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

        <li>
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
          ">
        <div class="container-fluid" style="margin-bottom: 6px">
          <div class="navbar-wrapper">
            <div class="navbar-toggle">
              <button type="button" class="navbar-toggler">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </button>
            </div>
            <a style="color: orange; font-size: 25px" class="navbar-brand" href="javascript:;">Profile Section</a>
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
              <button id="profileButton" style=" font-size: 15px; padding: 8px 8px;background-color: #ff9d5c; color: white;border-radius: 8px;border: #ff9d5c;" type="button" class=" dropdown-toggle text-white" data-bs-toggle="dropdown" aria-expanded="false">
                <?php
                // Start the session to access session variables
                session_start();
$conn = new mysqli('localhost', 'u477273611_playquest', 'TEAcher23@#', 'u477273611_teacherpanel');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$profileImg = "profile_logo.png"; // Default image

if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
    $sql = "SELECT teacher_name, upload_img FROM teacher WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $teacherName = $row["teacher_name"];
        $profileImg = $row["upload_img"] ? $row["upload_img"] : $profileImg;
    } else {
        $teacherName = "No result";
    }
} else {
    $teacherName = "Session email not set";
}

$conn->close();
                
                
                
                
    //             session_start();

    //             $conn = new mysqli('localhost', 'u477273611_playquest', 'TEAcher23@#', 'u477273611_teacherpanel');

    //             if ($conn->connect_error) {
    //               die("Connection failed: " . $conn->connect_error);
    //             }

    //             if (isset($_SESSION['email'])) {
    //               $email = $_SESSION['email'];

    //               // SQL query to select 'teacher_name' from 'teacher' table based on 'email'
    //               $sql = "SELECT teacher_name FROM teacher WHERE email = '$email'";
    //               $result = $conn->query($sql);

    //               // Check if result is not empty
    //              if ($result->num_rows > 0) {
    //               $row = $result->fetch_assoc();
    //               echo "Hello, " . $row["teacher_name"];
    //               $profileImg = $row["upload_img"] ? $row["upload_img"] : "profile_logo.png";
    //               } else {
    //               echo "No result";
    //               $profileImg = "profile_logo.png";
    //              }
    // }       else {
    //       echo "Session email not set";
    //       $profileImg = "profile_logo.png";
           
    // }
    
    

    //             $conn->close();
                ?>
                <?php echo "Hello, " . htmlspecialchars($teacherName); ?>
              </button>
              
              <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileButton">
        <li>
            <div class="d-flex align-items-center">
                <img src="<?php echo htmlspecialchars($profileImg); ?>" alt="Profile Logo" class="ms-2 pe-3 py-1" style="width: 30px; height: 30px; border-radius: 30%;">
                Profile
            </div>
        </li>
        <li>
            <hr class="dropdown-divider">
        </li>
        <li><a class="dropdown-item" href="logout.php">Logout</a></li>
    </ul>

            </div>

            <script>
              // Update the profile name in the dropdown toggle button
              function changeName() {
                var newName = document.getElementById("new_name").value;

                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function() {
                  if (this.readyState == 4 && this.status == 200) {
                    alert(this.responseText); // Display the response message in an alert
                    document.getElementById("new_name").value = ""; // Clear the input field

                    // Update the button text in the dropdown
                    document.getElementById("profileButton").innerText = newName;
                  }
                };
                xhr.open("POST", "change_name.php", true);
                xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhr.send("new_name=" + newName);
              }
            </script>



      </nav>

      <!-- Profile Section -->
      <!-- Profile Section -->
      <style>
        .custom-bg-grey {
          background-color: white;
        }

        .custom-card {
          box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        
  .profile-container {
            position: relative;
            width: 120px; /* Decreased size */
            height: 120px; /* Decreased size */
            border-radius: 50%;
            overflow: hidden;
            background-color: #f1f1f1;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 20px auto; /* Center horizontally */
        }

        .profile-container img {
            width: 100%; /* Adjusted to fit the container */
            height: 100%;
            object-fit: cover;
        }

        .profile-container .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 165, 0, 0.5); /* Light orange color */
            display: none;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
        }

        .profile-container:hover .overlay {
            display: flex;
        }

        .profile-container .overlay .icon {
            color: white;
            font-size: 24px;
            margin: 0 10px;
            cursor: pointer;
        }
        .modal-footer .btn {
        color: white;
    }
    
    .center-text {
        text-align: center;
    }
    </style>
</style>

      </style>

      <div class="container">
        <div class="row">
          <div class="col-md-6 mx-auto mt-5">

            <div class="card">

            </div>
          </div>
        </div>
      </div>



       <div class="container">
    <div class="row">
        <div class="col-md-6 mx-auto mt-5">
            <div class="card custom-card">
                <div class="profile-container">
                    <img id="profileImage" src="<?php echo $profileImage; ?>" alt="Profile Image">
                    <div class="overlay">
                        <span class="icon" id="uploadIcon">&#128247;</span>
                    </div>
                </div>

                <h8 class="center-text">Upload Your Photo</h8>

                <input type="file" id="uploadInput" style="display:none;" accept="image/*">
                <div class="modal fade" id="cropModal" tabindex="-1" role="dialog" aria-labelledby="cropModalLabel"
                     aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="cropModalLabel">Crop Image</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div id="cropperContainer">
                                    <img id="cropImage" src="" alt="Crop Image">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary" id="uploadCroppedImage">Upload Cropped Image</button>
                            </div>
                        </div>
                    </div>
                </div>


                    <?php
                    date_default_timezone_set('Asia/Kolkata');

                    $conn = new mysqli('localhost', 'u477273611_playquest', 'TEAcher23@#', 'u477273611_teacherpanel');
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }
                    $email = $_SESSION['email'];
                    $phone = $_SESSION['phone'];
                    $sql = "SELECT teacher_name, department, created_at FROM teacher WHERE email = '$email' AND phone = '$phone'";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        $name = $row["teacher_name"];
                        $department = $row["department"];
                        $created_at = $row["created_at"];
                        $created_at_local = new DateTime($created_at, new DateTimeZone('UTC'));
                        $created_at_local->setTimezone(new DateTimeZone('Asia/Kolkata'));
                        $created_at_formatted = $created_at_local->format('Y-m-d H:i:s');

                        echo "<ul class='list-group'>";
                        echo "<li class='list-group-item'>Name: $name</li>";
                        echo "<li class='list-group-item'>Email: $email</li>";
                        echo "<li class='list-group-item'>Phone: $phone</li>";
                        echo "<li class='list-group-item'>Department: $department</li>";
                        echo "<li class='list-group-item'>Account Creation Date: $created_at_formatted</li>";
                        echo "</ul>";

                        // Change Name form with AJAX
                        echo "<div class='mt-3'>";
                        echo "<form id='changeNameForm' method='post' action='change_name.php'>";
                        echo "<div class='form-group'>";
                        echo "<input type='text' id='new_name' name='new_name' class='form-control' placeholder='Enter new name' required>";
                        echo "</div>";
                        echo "<button type='submit' class='btn btn-primary text-white' style='background-color: darkorange; border-color: orange;'>Change Name</button>";
                        echo "</form>";
                        echo "<div id='message' class='mt-2'></div>"; // Container for success message
                        echo "</div>";

                        // Change Password button
                        echo "<div class='mt-3'>";
                        echo "<a href='change_password.php' class='btn btn-primary text-white' style='background-color: darkorange; border-color: orange;'>Change Password</a>";
                        echo "</div>";
                    } else {
                        echo "No result";
                    }
                    $conn->close();
                    ?>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css">

     <script>
     
     
//         document.addEventListener("DOMContentLoaded", function () {
//             var profileImageSrc = localStorage.getItem("profileImage");
//             if (profileImageSrc) {
//                 document.getElementById('profileImage').src = profileImageSrc;
//             }
//         });

//         document.getElementById('uploadIcon').addEventListener('click', function () {
//             document.getElementById('uploadInput').click();
//         });

//         var cropper;
//         document.getElementById('uploadInput').addEventListener('change', function (e) {
//             var files = e.target.files;
//             if (files.length > 0) {
//                 var reader = new FileReader();
//                 reader.onload = function (event) {
//                     var image = document.getElementById('cropImage');
//                     image.src = event.target.result;
//                     $('#cropModal').modal('show');

//                     $('#cropModal').on('shown.bs.modal', function () {
//                         cropper = new Cropper(image, {
//                             aspectRatio: 1,
//                             viewMode: 2,
//                         });
//                     });
//                 };
//                 reader.readAsDataURL(files[0]);
//             }
//         });

//       document.getElementById('uploadCroppedImage').addEventListener('click', function () {
//     var canvas = cropper.getCroppedCanvas({
//         width: 300,
//         height: 300,
//     });

//     canvas.toBlob(function (blob) {
//         var formData = new FormData();
//         formData.append('image', blob, 'cropped.png');

//         $.ajax({
//             url: 'upload_image.php',
//             method: 'POST',
//             data: formData,
//             processData: false,
//             contentType: false,
//             success: function (response) {
//                 $('#cropModal').modal('hide');
//                 var imageUrl = canvas.toDataURL();
//                 $('#profileImage').attr('src', imageUrl);
//                 localStorage.setItem('profileImage', imageUrl);
//                 alert(response); // Display the server response
//             },
//             error: function (xhr, status, error) {
//                 console.error('Error details:', xhr, status, error); // Log the error details to the console
//                 alert('An error occurred while uploading the image. Please try again.');
//             }
//         });
//     });
// });




document.addEventListener("DOMContentLoaded", function () {
                        var profileImageSrc = localStorage.getItem("profileImage");
                        if (profileImageSrc) {
                            document.getElementById('profileImage').src = profileImageSrc;
                        }
                    });

                    document.getElementById('uploadIcon').addEventListener('click', function () {
                        document.getElementById('uploadInput').click();
                    });

                    var cropper;
                    document.getElementById('uploadInput').addEventListener('change', function (e) {
                        var files = e.target.files;
                        if (files.length > 0) {
                            var reader = new FileReader();
                            reader.onload = function (event) {
                                var image = document.getElementById('cropImage');
                                image.src = event.target.result;
                                $('#cropModal').modal('show');

                                $('#cropModal').on('shown.bs.modal', function () {
                                    cropper = new Cropper(image, {
                                        aspectRatio: 1,
                                        viewMode: 2,
                                    });
                                });
                            };
                            reader.readAsDataURL(files[0]);
                        }
                    });

                    document.getElementById('uploadCroppedImage').addEventListener('click', function () {
                        var canvas = cropper.getCroppedCanvas({
                            width: 300,
                            height: 300,
                        });

                        canvas.toBlob(function (blob) {
                            var formData = new FormData();
                            formData.append('image', blob, 'cropped.png');

                            $.ajax({
                                url: 'upload_image.php',
                                method: 'POST',
                                data: formData,
                                processData: false,
                                contentType: false,
                                success: function (response) {
                                    $('#cropModal').modal('hide');
                                    var imageUrl = canvas.toDataURL();
                                    $('#profileImage').attr('src', imageUrl);
                                    localStorage.setItem('profileImage', imageUrl);
                                    alert(response); // Display the server response
                                },
                                error: function (xhr, status, error) {
                                    console.error('Error details:', xhr, status, error); // Log the error details to the console
                                    alert('An error occurred while uploading the image. Please try again.');
                                }
                            });
                        });
                    });
    </script>
            </div>
          </div>
        </div>
      </div>


</body>

</html>
