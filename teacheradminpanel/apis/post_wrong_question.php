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
    if (!isset($inputData['user_id']) || !isset($inputData['question_id'])) {
        $data = [
            'status' => 400,
            'message' => 'Bad Request: user_id and question_id parameters are required',
        ];
        header("HTTP/1.0 400 Bad Request");
        echo json_encode($data);
        exit();
    }

    // Call the storeWrongQuestion function
    $storeWrongQuestion = storeWrongQuestion($inputData);

    echo $storeWrongQuestion;
} else {
    $data = [
        'status' => 405,
        'message' => $requestMethod . ' Method not allowed',
    ];
    header("HTTP/1.0 405 Method not allowed");
    echo json_encode($data);
}
?>
