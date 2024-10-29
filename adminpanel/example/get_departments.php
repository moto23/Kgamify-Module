<?php
// get_departments.php
error_log(print_r($_POST, true));
// Database connection
$conn = new mysqli('localhost', 'u477273611_playquest', 'TEAcher23@#', 'u477273611_teacherpanel');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch departments based on selected institute
$institute = $_POST['institute'];
$sql = "SELECT department_name FROM department WHERE institute_name = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $institute);
$stmt->execute();
$result = $stmt->get_result();

$departments = array();
while ($row = $result->fetch_assoc()) {
    $departments[] = $row['department_name'];
}

// Log the departments for debugging
error_log(print_r($departments, true));

// Return departments as JSON
echo json_encode($departments);

$stmt->close();
$conn->close();
?>
