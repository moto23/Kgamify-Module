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
            'user_name' => $_GET['user_name'] ?? null,
            'email' => $_GET['email'] ?? null,
            'password' => $_GET['password'] ?? null,
            'phone_no' => $_GET['phone_no'] ?? null,
            'qualification' => $_GET['qualification'] ?? null,
        ];
    }

    // Validate that required fields are present
    if (empty($inputData['user_name']) || empty($inputData['email']) || empty($inputData['password']) || empty($inputData['phone_no']) || empty($inputData['qualification'])) {
        $data = [
            'status' => 400,
            'message' => 'Bad Request: Some input data is missing',
        ];
        header("HTTP/1.0 400 Bad Request");
        echo json_encode($data);
        exit();
    }

    // Generate the user_key
    $randomAlphabets = substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 4);
    $randomNumbers = mt_rand(1000, 9999);
    $user_name = $inputData['user_name'];
    $user_key = $randomAlphabets . '_' . $user_name . '_' . $randomNumbers;

    // Add the generated user_key to the input data
    $inputData['user_key'] = $user_key;

    // Store the user
    $storeUser = storeUser($inputData);
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
