<?php
session_start();
$conn = new mysqli('localhost', 'u477273611_playquest', 'TEAcher23@#', 'u477273611_teacherpanel');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the image file is uploaded
if (isset($_FILES['image']) && isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
    $image = $_FILES['image'];
    $uploadDir = 'uploads/'; // Directory to store the uploaded images
    $imageFileType = strtolower(pathinfo($image['name'], PATHINFO_EXTENSION));
    $fileName = uniqid() . '.' . $imageFileType; // Generate a unique file name
    $uploadFilePath = $uploadDir . $fileName;

    // Ensure the directory exists
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    // Move the uploaded file to the directory
    if (move_uploaded_file($image['tmp_name'], $uploadFilePath)) {
        // Save the image link in the database
        $imageLink = $uploadFilePath;
        $stmt = $conn->prepare("UPDATE teacher SET upload_img = ? WHERE email = ?");
        $stmt->bind_param("ss", $imageLink, $email);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            echo "Image uploaded successfully!";
        } else {
            echo "Failed to save the image link in the database.";
        }

        $stmt->close();
    } else {
        echo "Failed to upload the image.";
    }
} else {
    echo "No image uploaded or user session not found.";
}

$conn->close();
?>
