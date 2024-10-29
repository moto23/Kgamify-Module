<?php

require_once("add_new_mode.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Database connection
    $conn = new mysqli('localhost', 'u477273611_playquest', 'TEAcher23@#', 'u477273611_teacherpanel');

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get form data
    $gift_id = $_POST['gift_id'];
    $giftname = $_POST['giftname'];
    $gift_description = $_POST['d_text'];
    $gift_image= $_POST['timg'];
    $gift_type = $_POST['gift_cat'];
    
     // Retrieve gift_type from gift table
    $gift_query = "SELECT gift_id FROM gift WHERE gift_type = ?";
    $gift_stmt = $conn->prepare($gift_query);
    
    if ($gift_stmt) {
      $gift_stmt->bind_param("s", $gift_type);
      $gift_stmt->execute();
      $gift_stmt->bind_result($gift_id);
      $gift_stmt->fetch();
      $gift_stmt->close();
    } else {
      die("Gift query preparation failed: " . $conn->error);
    }
   

    // Insert data into chosen_gift_type table
    $stmt = $conn->prepare("INSERT INTO chosen_gift_type (gift_id, gift_type,gift_name, gift_description, gift_image) VALUES (?, ?, ?,?,?)");
    $stmt->bind_param("issss", $gift_id, $gift_type,$giftname, $gift_description, $gift_image);

    if ($stmt->execute()) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
