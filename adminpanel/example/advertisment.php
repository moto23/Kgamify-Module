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

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title_name'];
    $description = $_POST['t_text'];
    $image_url = "";
    $link_url = "";
    $company_name = $_POST['company'];

    // Fetch company_id based on company_name
    $stmt = $conn->prepare("SELECT company_id FROM add_company WHERE company_name = ?");
    $stmt->bind_param("s", $company_name);
    $stmt->execute();
    $stmt->bind_result($company_id);
    $stmt->fetch();
    $stmt->close();

    // Check if a link is provided
    if (!empty($_POST['ad_url'])) {
        $link_url = $_POST['ad_url'];
    }

    // Ensure only one type of image input is used
    if (!empty($image_url) && !empty($link_url)) {
        echo "Please provide either an image file or an image URL, not both.";
        exit;
    }

    // Insert data into the database
    $stmt = $conn->prepare("INSERT INTO add_advertisment (title, ad_description, ad_image, ad_link, company_id, company_name) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $title, $description, $image_url, $link_url, $company_id, $company_name);

    if ($stmt->execute()) {
        echo "New advertisement added successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
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

  <title>ADD Advertisment | KGAMIFY</title>
  <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no" name="viewport" />
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet" />
   <script data-require="jquery" data-semver="2.1.3" src="http://code.jquery.com/jquery-2.1.3.min.js"></script>
  <script data-require="bootstrap" data-semver="3.3.2" src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
  <script data-require="angular.js@1.3.x" src="https://code.angularjs.org/1.3.14/angular.js" data-semver="1.3.14"></script>
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
          
          
           <li>
            <a href="../example/company.php">
              <i class="fas fa-city"></i>
              <p style="font-size: 15px; font-weight: bold">
                Add Company
              </p>
            </a>
          </li>
          
           <li class="active">
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
                        <p style="text-align: center;color: #ff9d5c; font-size: 30px;font-weight: bold; ">Add Advertisment For User Application</p>

                        <hr style="height:1px; border:none;  background-color:#ff9d5c;">
                        <br>
                      </fieldset>
               
                     <form action="advertisment.php" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
    <fieldset>
        <p style="color: #ff9d5c; font-size: 22px; font-weight: bold;">Select Company</p>
        <div style="display: grid; min-width: 89ch; font-size: 16px" class="select">
            <?php
            // PHP code to retrieve company names and populate the dropdown
            $conn = new mysqli('localhost', 'u477273611_playquest', 'TEAcher23@#', 'u477273611_teacherpanel');
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            $sql = "SELECT company_name FROM add_company";
            $result = $conn->query($sql);
            ?>
            <select style="border-color: #ff9d5c;" id="company" name="company">
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $company_name = $row["company_name"];
                        echo "<option value='$company_name'>$company_name</option>";
                    }
                }
                $result->free(); // Free the result set
                ?>
            </select>
            <span class="focus"></span>
        </div>
        <br><br>

        <div class="adv" id="adv">
            <p style="color: #ff9d5c; font-size: 22px; font-weight: bold;">Title of Advertisement</p>
            <input style="border-color: #ff9d5c; width: 100%;" placeholder="Enter Title Name" name="title_name" id="title_name" type="text" tabindex="1" autofocus />
            <br><br>
            <fieldset>
                <p style="color: #ff9d5c; font-size: 22px; font-weight: bold;">Description of Advertisement</p>
                <textarea name="t_text" id="editor" placeholder="Write Description here...."></textarea>
            </fieldset>
            <br />
            <br>

          <p style="color: #ff9d5c; font-size: 22px; font-weight: bold;">Add Advertisement Image</p>
<input type="file" id="img" name="Iimg" accept="image/*" />
<img id="add-image" style="display: none; max-width: 100%; height: auto;" />
<p id="error-message" style="color: red; font-size: 16px; display: none;"></p>
<br><br>
            <p>Or</p>
            <fieldset>
                <p style="color: #ff9d5c; font-size: 22px; font-weight: bold;">Add link for Advertisement Image</p>
                <input style="border-color: #ff9d5c; width: 100%;" placeholder="Enter link for Image" id="website" type="text" name="ad_url" tabindex="1" autofocus />
            </fieldset>
            <br />
            <br>
            <input type="submit" id="submit" value="Submit Advertisement Details" style="font-size: 15px; font-weight: bold; margin-bottom: 1rem; padding: 10px 25px; background-color: #ff9d5c; color: white; border-radius: 8px; border: #ff9d5c;" />
        </div>
    </fieldset>
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
    var title = document.getElementById("title_name").value;
    var pattern = /[!@#$%^&*()+\=\[\]{};':"\\|,.<>\/?0-9]+/;
    var emailpattern = /[!#$%^&*()+\=\[\]{};':"\\|,<>\/?]+/;
    var alphapattern = /[!@#$%^&*()+\=\[\]{};':"\\|,.<>\/?a-zA-Z]+/;
    
    if (title.trim() === "") {
        event.preventDefault();
        alert("Please fill all fields");
    }
    else{

    if (pattern.test(title)) {
        event.preventDefault(); // Prevent form submission
        alert("Advertisement Name should not contain any special characters or numbers");
    }
    }
});


document.getElementById('img').addEventListener('change', function(event) {
    const file = event.target.files[0];
    const img = document.createElement('img');
    const errorMessage = document.getElementById('error-message');
    const addImage = document.getElementById('add-image');
    
    // Clear any previous error message
    errorMessage.style.display = 'none';
    addImage.style.display = 'none';
    
    if (file) {
        // Check the file format
        const fileType = file.type;
        const validFormats = ['image/png', 'image/jpeg', 'image/jpg'];
        
        if (!validFormats.includes(fileType)) {
            errorMessage.textContent = "Error: Image must be in PNG, JPG, or JPEG format.";
            errorMessage.style.display = 'block';
            return;
        }
        
        const reader = new FileReader();
        
        reader.onload = function(e) {
            img.src = e.target.result;
            
            img.onload = function() {
                // Check the dimensions of the image
                const width = img.naturalWidth;
                const height = img.naturalHeight;
                
                if (width > 1280 || height > 720) {
                    errorMessage.textContent = "Error: Image dimensions must be 1280x720 pixels or less.";
                    errorMessage.style.display = 'block';
                } else {
                    // If valid, display the image
                    addImage.src = img.src;
                    addImage.style.display = 'block';
                }
            }
        }
        
        reader.readAsDataURL(file);
    }
});
</script>
  
  <script>
    function validateForm() {
        var imgInput = document.getElementById("img").value;
        var urlInput = document.getElementById("website").value;
        
        if (imgInput == "" && urlInput == "") {
            alert("Please provide either an image file or a link for the advertisement image.");
            return false;
        }
        return true;
    }
</script>

<script>
  CKEDITOR.replace( 't_text' );
 
  </script>
     

</body>

</html>