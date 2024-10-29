<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['giftname']) && isset($_POST['d_text']) && isset($_FILES['gimg']) && isset($_POST['gift'])) {
        $gift_name = $_POST['giftname'];
        $gift_desc = $_POST['d_text'];
        $gift_type = $_POST['gift'];
        $gift_image = $_POST['timg'];

       

            // Database connection
            $conn = new mysqli('localhost', 'u477273611_playquest', 'TEAcher23@#', 'u477273611_teacherpanel');

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Fetch gift_id and gift_type from the gift table based on the selected gift_type
            $stmt = $conn->prepare("SELECT gift_id, gift_type FROM gift WHERE gift_name = ?");
            $stmt->bind_param("s", $gift_type);
            $stmt->execute();
            $stmt->bind_result($gift_id, $gift_type);

            if ($stmt->fetch()) {
                $stmt->close();

                 // Use prepared statement to insert data safely
    $stmt = $conn->prepare("INSERT INTO chosen_gift_type (gift_name, gift_description, gift_image) VALUES (?,?,?)");

    // Check if the statement was prepared successfully
    if ($stmt) {
      $stmt->bind_param("sss", $gift_name, $gift_desc,$gift_image);
      $execval = $stmt->execute();

      // Check if the insert query was successful
      if ($execval) {
        // echo "Data inserted successfully!";
      } else {
        echo '<script>alert("Gift Already Added")</script>';
        // Error: " . $stmt->error;
      }

      $stmt->close();
    } else {
        echo '<script>alert("Gift Already Added")</script>';
    //   echo "Error: " . $conn->error;
    }

    $conn->close();
  } else {
    echo "category name is not set in the POST data.";
  }
}
}
?>