<?php
// Database credentials
$servername = "localhost";
$username = "u477273611_playquest";
$password = "TEAcher23@#";
$database = "u477273611_teacherpanel";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch the verification token from the URL
$token = $_GET['token'];

// Prepare statement to get the data from pending_verifications
$stmt = $conn->prepare("SELECT * FROM pending_verifications WHERE verify_token = ?");
$stmt->bind_param("s", $token);
$stmt->execute();
$result = $stmt->get_result();

// Check if a matching record was found
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    
    // Insert the user data into the teacher table
    $stmt = $conn->prepare("INSERT INTO teacher (status,teacher_name, username, email, password, phone, institute, department) VALUES (?,?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("isssssss", $row['status'],$row['teacher_name'], $row['username'], $row['email'], $row['password'], $row['phone'], $row['institute'], $row['department']);
    
    if ($stmt->execute()) {
        // Generate unique ID
        $char_string = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $string = '';
        while (strlen($string) < 4) {
            $string .= $char_string[random_int(0, strlen($char_string) - 1)];
        }
        $last_id = $stmt->insert_id;
        $code = rand(1, 9999);
        $unique_id = $string . "_" . $row['username'] . "_" . $code;

        // Update unique_id in the database
        $query = "UPDATE teacher SET unique_id='$unique_id' WHERE teacher_id='$last_id'";
        $conn->query($query);

        // Remove the record from pending_verifications
        $stmt = $conn->prepare("DELETE FROM pending_verifications WHERE verify_token = ?");
        $stmt->bind_param("s", $token);
        $stmt->execute();

        // Show confirmation message
        echo "<div style='display: flex; justify-content: center; align-items: center; height: 100vh;'>
                <div style='width: 50%; text-align: center;'>
                    <h2 style='color: green;font-weight:bold;font-size:25px;'>Thank you for confirming your email with us!! Your Account will be activated within 24 hours. You can now close this page.</h2>
                </div>
              </div>";
    } else {
        echo "Error: " . $conn->error;
    }
} else {
    echo "Invalid verification link.";
}

// Close prepared statement and database connection
$stmt->close();
$conn->close();
?>
