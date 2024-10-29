<?php
// Enable CORS and specify allowed methods and headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With');

// Establish database connection
$conn = new mysqli('localhost', 'u477273611_playquest', 'TEAcher23@#', 'u477273611_teacherpanel');

// Check for database connection error
if ($conn->connect_error) {
    $response = [
        'status' => 500,
        'message' => 'Database Connection Failed: ' . $conn->connect_error
    ];
    echo json_encode($response);
    exit();
}

// Handle GET request
$requestMethod = $_SERVER["REQUEST_METHOD"];
if ($requestMethod == "GET") {
    // Fetch privacy policy content from the database
    $sql = "SELECT add_teacher_privacy FROM privacy_teacher LIMIT 1";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Fetch the data from the first row
        $row = $result->fetch_assoc();
        $privacy_policy = $row['add_teacher_privacy'];

        $response = [
            'status' => 200,
            'message' => 'Privacy Policy for teacher Fetched Successfully',
            'data' => $privacy_policy
        ];
    } else {
        $response = [
            'status' => 404,
            'message' => 'No Privacy Policy Found'
        ];
    }

    echo json_encode($response);
} else {
    $response = [
        'status' => 405,
        'message' => $requestMethod . ' Method Not Allowed'
    ];
    header("HTTP/1.0 405 Method Not Allowed");
    echo json_encode($response);
}

// Close the database connection
$conn->close();
?>
