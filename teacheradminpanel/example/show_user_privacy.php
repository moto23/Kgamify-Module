<?php
session_start();

// if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
//     // Redirect to the login page
//     echo "<script>alert('You need to LOGIN to view this page.'); window.location.href = 'index.php';</script>";
//     exit();
// }
// ?>


<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Establish database connection
$conn = new mysqli('localhost', 'u477273611_playquest', 'TEAcher23@#', 'u477273611_teacherpanel');

// Check for database connection error
if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
}

// Fetch privacy policy content from the database
$sql = "SELECT add_user_privacy FROM privacy_user LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Fetch the data from the first row
    $row = $result->fetch_assoc();
    $privacy_policy = $row['add_user_privacy'];
    $_SESSION['add_user_privacy'] = $privacy_policy;
} else {
    $privacy_policy = "No data found in the table.";
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terms and Conditions for user</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            line-height: 1.6;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .terms-box {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            max-width: 800px;
            width: 100%;
            text-align: center;
        }

        h1 {
            color: #333;
            margin-bottom: 20px;
        }

        .content {
            text-align: left; /* Center-aligns text within the content div */
            font-size: 16px;
            color: #555;
        }

        .privacy-link {
            color: orange;
            text-decoration: none;
            font-weight: bold;
        }

        .privacy-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="terms-box">
        <h1>Terms and Conditions for users</h1>
        <div class="content">
            <?php
            // Display the fetched privacy policy content
            echo nl2br($privacy_policy);
            ?>
        </div>
    </div>

</body>
</html>
