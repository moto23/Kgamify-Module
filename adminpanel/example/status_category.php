<?php
// Check if labelname is set in the POST data
$conn = new mysqli('localhost', 'u477273611_playquest', 'TEAcher23@#', 'u477273611_teacherpanel');

// Check for database connection error
if ($conn->connect_error) {
    die("Connection Failed : " . $conn->connect_error);
}
$id=$_GET['category_id'];
$status=$_GET['status'];

$query="update category set status=$status where category_id=$id";
mysqli_query($conn,$query);
header('location:all_category.php');
$conn->close();
?>