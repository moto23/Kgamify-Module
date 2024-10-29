<?php
$conn = new mysqli('localhost', 'u477273611_playquest', 'TEAcher23@#', 'u477273611_teacherpanel');

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $gift_type = $_POST['gift'];
  $gift_name = $_POST['giftname'];
  $gift_description = $_POST['d_text'];
  $gift_image = $_POST['timg'];


      // Check if the gift type already exists in the table
      $stmt = $db->prepare("SELECT id FROM chosen_gift_type WHERE gift_type = ?");
      $stmt->bind_param("s", $gift_type);
      $stmt->execute();
      $stmt->store_result();

      if ($stmt->num_rows > 0) {
          // Update the existing record
          $stmt->bind_result($id);
          $stmt->fetch();
          $stmt->close();

          $stmt = $db->prepare("UPDATE chosen_gift_type SET gift_name = ?, gift_description = ?, gift_image = ? WHERE id = ?");
          $stmt->bind_param("sssi", $gift_name, $gift_description, $gift_image, $id);
      } else {
          // Insert a new record
          $stmt->close();
          $stmt = $db->prepare("INSERT INTO chosen_gift_type (gift_type, gift_name, gift_description, gift_image) VALUES (?, ?, ?, ?)");
          $stmt->bind_param("ssss", $gift_type, $gift_name, $gift_description, $gift_image);
      }

      if ($stmt->execute()) {
          echo "Gift details saved successfully.";
      } else {
          echo "Failed to save gift details.";
      }

      $stmt->close();
  } else {
      echo "Please select an image file.";
  
}
?>
