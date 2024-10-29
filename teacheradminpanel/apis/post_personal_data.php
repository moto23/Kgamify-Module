<?php

error_reporting(0);

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST, GET');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With');

include('user_function.php');

$requestMethod = $_SERVER["REQUEST_METHOD"];

if ($requestMethod == "POST" || $requestMethod == "GET") {
    // If POST, check for JSON input
    if ($requestMethod == "POST") {
        $inputData = json_decode(file_get_contents("php://input"), true);
    }

    // If no JSON input or if GET method, try getting data from URL parameters
    if (empty($inputData)) {
        $inputData = [
            'user_id' => $_GET['user_id'] ?? null,
            'name' => $_GET['name'] ?? null,
            'email' => $_GET['email'] ?? null,
            'age' => $_GET['age'] ?? null,
            'location' => $_GET['location'] ?? null,
            'phone_no' => $_GET['phone_no'] ?? null,
            'interests' => $_GET['interests'] ?? null,
        ];
    }

    // Validate that required fields are present
    if (empty($inputData['user_id']) || empty($inputData['name']) || empty($inputData['email']) || empty($inputData['age']) || empty($inputData['location']) || empty($inputData['phone_no']) || empty($inputData['location']) || empty($inputData['interests'])) {
        $data = [
            'status' => 400,
            'message' => 'Bad Request: Some input data is missing',
        ];
        header("HTTP/1.0 400 Bad Request");
        echo json_encode($data);
        exit();
    }


    $storeUser = storePersonalData($inputData);
    echo $storeUser;

} else {
    $data = [
        'status' => 405,
        'message' => $requestMethod . ' Method not allowed',
    ];
    header("HTTP/1.0 405 Method not allowed");
    echo json_encode($data);
}
?>
