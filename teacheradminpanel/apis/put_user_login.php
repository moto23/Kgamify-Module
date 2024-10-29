<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Method: PUT');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With');

include('user_function.php');

$requestMethod = $_SERVER["REQUEST_METHOD"];

if ($requestMethod == "PUT") {
    $inputData = json_decode(file_get_contents("php://input"), true);

    // Check if all required parameters are provided
    if (!isset($inputData['user_id'])) {
        $data = [
            'status' => 400,
            'message' => 'Bad Request: user_id parameter is required',
        ];
        header("HTTP/1.0 400 Bad Request");
        echo json_encode($data);
        exit();
    }

    // Call the putUserLogin function
    $putUserLogin = putUserLogin($inputData);

    echo $putUserLogin;
} else {
    $data = [
        'status' => 405,
        'message' => $requestMethod . ' Method not allowed',
    ];
    header("HTTP/1.0 405 Method not allowed");
    echo json_encode($data);
}
?>
