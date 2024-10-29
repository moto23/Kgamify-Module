<?php
// Check if labelname is set in the POST data
$conn = new mysqli('localhost', 'u477273611_playquest', 'TEAcher23@#', 'u477273611_teacherpanel');

// Check for database connection error
if ($conn->connect_error) {
    die("Connection Failed : " . $conn->connect_error);
}
$id=$_GET['champ_id'];
$status=$_GET['status'];

$query="update championship set status=$status where champ_id=$id";
mysqli_query($conn,$query);
header('location:all_championships.php');
$conn->close();
?>