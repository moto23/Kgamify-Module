<!DOCTYPE html>
<html lang="en">
  <head>

    <link rel="icon" href="../assets/img/title.png" type="image/icon type" />

    <!-- fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Roboto+Condensed&display=swap"
      rel="stylesheet"
    />
    <!-- fonts -->


    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css" />

    <script data-require="jquery" data-semver="2.1.3" src="http://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script data-require="bootstrap" data-semver="3.3.2" src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
    <script data-require="angular.js@1.3.x" src="https://code.angularjs.org/1.3.14/angular.js" data-semver="1.3.14"></script>
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

            #contact input[type="text"]{
              width: 100%;
              border: 1px solid #ff9d5c;
              background: #fff;
              margin: 0 0 5px;
              padding: 10px;
            }

            #contact input[type="text"]:hover{
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
    <script
      src="https://kit.fontawesome.com/52f3e32cf9.js"
      crossorigin="anonymous"
    ></script>

    <meta charset="utf-8" />
    <link
      rel="apple-touch-icon"
      sizes="76x76"
      href="../assets/img/title.png"
    />
    <link rel="icon" type="image/png" href="../assets/img/title.png" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>EDIT QUESTION | PlayQuest</title>

    <!-- tiny mce -->
    <!-- <script
      src="https://cdn.tiny.cloud/1/6x2lct5ci3repi2zerjxkto4t9ju86wfyyzn6x448cijg7g8/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    ></script> -->

    <script>
      tinymce.init({
        selector: "#mytextarea",
      });
    </script>

    <!-- tiny mce -->

    <meta
      content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no"
      name="viewport"
    />
    <!--     Fonts and icons     -->
    <link
      href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200"
      rel="stylesheet"
    />
    <link
      href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css"
      rel="stylesheet"
    />
    <!-- CSS Files -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="../assets/css/paper-dashboard.css?v=2.0.1" rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="../assets/demo/demo.css" rel="stylesheet" />
  </head>

  <body>
    <div class="wrapper">

      <div class="sidebar" data-color="white" data-active-color="danger">
        <div
          style="display: flex; flex-direction: column; align-items: center"
          class="logo"
        >
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

           

            <!-- New Game Mode   -->
            <li>
              <a href="../example/add_new_mode.php">
                <i class="fas fa-crosshairs"></i>
                <p style="font-size: 15px; font-weight: bold">New Game Mode</p>
              </a>
            </li>


            <li>
              <a href="../example/add_new_faculty.php">
                <i class="fas fa-solid fa-user-plus"></i>
                <p style="font-size: 15px; font-weight: bold">New Faculty</p>
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

             <!-- Wrong Questions -->
            <li>
              <a href="../example/wrong_questions.php">
                <i class="fas fa-times-circle"></i>
                <p style="font-size: 15px; font-weight: bold">Wrong Questions</p>
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
            <!-- End Fourth Section   -->
          </ul>
        </div>
      </div>
     
      <div class="main-panel" style="height: 70px;" >
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
                <li><a class="dropdown-item" href="index.php">Logout</a></li>
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
                <div class="card-header">
                  <div class="container">
                    <!-- 1st one -->
                    <div id="contact">
                      <fieldset>
                        <p style="text-align: center;color: #ff9d5c; font-size: 30px;font-weight: bold; ">Edit Question</p>
                        
                        <hr style="height:1px; border:none;  background-color:#ff9d5c;">
                        <br>
                        <br>
                      </fieldset>


                       <!-- dsaddsadsasa -->

                      <p style="color: #ff9d5c;font-size: 22px;font-weight: bold; ">Add/Edit Labels</p>
                      <p style="color: #00c800;font-size: 18px">Questions in the Championship will appear from Questions under the label selected from here</p>


                      <div 
                        style=" display: grid; min-width: 89ch; font-size: 16px"
                        class="select"
                      >
                        <select style="border-color: #ff9d5c;" id="standard-select">
                          <!-- <option value="Option 1">Option 1</option>
                          <option value="Option 2">Option 2</option>
                          <option value="Option 3">Option 3</option>
                          <option value="Option 4">Option 4</option>
                          <option value="Option 5">Option 5</option> -->
                        </select>
                        <span class="focus"></span>

                      </div>

                      <!-- dsadsadsa -->
                      <!-- ended 2nd one -->
                      <br /><br />
                      <!-- 3rd one -->
                      <p style="color: #ff9d5c;font-size: 22px;font-weight: bold; ">Question Text</p>

                      <textarea id="question_text" style="border-color: #ff9d5c; width: 100%;" ></textarea>
                      <!-- ended 3rd one -->


                      <br />
                      <br />

                      <fieldset>
                        <p style="color: #ff9d5c; font-size: 22px; width: 100%;font-weight: bold; ">Option 1</p>
                        <input
                          placeholder="Enter Option 1"
                          id="option_1"
                          type="text"
                          tabindex="1"
                          required
                          autofocus
                        />
                      </fieldset>
                      <br />

                      <fieldset>
                        <p style="color: #ff9d5c; font-size: 22px; width: 100%;font-weight: bold; ">Option 2</p>
                        <input
                          placeholder="Enter Option 2"
                          id="option_2"
                          type="text"
                          tabindex="1"
                          required
                          autofocus
                        />
                      </fieldset>
                      <br />

                      <fieldset>
                        <p style="color: #ff9d5c; font-size: 22px; width: 100%;font-weight: bold; ">Option 3</p>
                        <input
                          placeholder="Enter Option 3"
                          id="option_3"
                          type="text"
                          tabindex="1"
                          required
                          autofocus
                        />
                      </fieldset>
                      <br />

                      <fieldset>
                        <p style="color: #ff9d5c; font-size: 22px; width: 100%;font-weight: bold; ">Option 4</p>
                        <input
                          placeholder="Enter Option 4"
                          id="option_4"
                          type="text"
                          tabindex="1"
                          required
                          autofocus
                        />
                      </fieldset>
                      <br />

                      <!-- dsaddsadsasa -->

                      <p style="color: #ff9d5c;font-size: 22px;font-weight: bold; ">Correct Option</p>

                       <div 
                        style=" display: grid; min-width: 89ch; font-size: 16px"
                        class="select"
                      >
                        <select style="border-color: #ff9d5c;" id="correct_options">
                          <option value="option_1">Option 1</option>
                          <option value="option_2">Option 2</option>
                          <option value="option_3">Option 3</option>
                          <option value="option_4">Option 4</option>
                        </select>
                      </div>
                     
                      <br>

                      <!-- dsadsadsa -->

                      <fieldset>
                        <p style="color: #ff9d5c; font-size: 22px; width: 100%;font-weight: bold; ">Total Coins</p>
                        <input
                          placeholder="Enter Number of Coins"
                          id="total_coins"
                          type="text"
                          tabindex="1"
                          required
                          autofocus
                        />
                      </fieldset>

                      <br>
                      <br>
                      <!-- last one -->
                      <fieldset>
                      
                      <input type="submit" onclick="submit()" id="submit" value="Add Question" style=" font-size: 15px; padding: 10px 25px;background-color: #ff9d5c; color: white;border-radius: 8px;border: #ff9d5c;"/>

                      </fieldset>
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

    
  </body>
</html>
