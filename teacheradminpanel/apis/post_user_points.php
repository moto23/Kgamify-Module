<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Method: POST');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With');

include('user_function.php');

$requestMethod = $_SERVER["REQUEST_METHOD"];

if ($requestMethod == "POST") {
    $inputData = json_decode(file_get_contents("php://input"), true);

    // Check if all required parameters are provided
    if (!isset($inputData['user_id']) || !isset($inputData['mode_id']) || !isset($inputData['points']) || !isset($inputData['reward'])) {
        $data = [
            'status' => 400,
            'message' => 'Bad Request: user_id, mode_id, points, and reward parameters are required',
        ];
        header("HTTP/1.0 400 Bad Request");
        echo json_encode($data);
        exit();
    }

    // Call the storeUserPoints function
    $storeUserPoints = storeUserPoints($inputData);

    echo $storeUserPoints;
} else {
    $data = [
        'status' => 405,
        'message' => $requestMethod . ' Method not allowed',
    ];
    header("HTTP/1.0 405 Method not allowed");
    echo json_encode($data);
}
?>
