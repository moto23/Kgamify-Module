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
            'question_id' => $_GET['question_id'] ?? null,
            'user_id' => $_GET['user_id'] ?? null,
            'time_taken' => $_GET['time_taken'] ?? null,
            'expected_time' => $_GET['expected_time'] ?? null,
            'points_earned' => $_GET['points_earned'] ?? null,
            'correct_ans' => $_GET['correct_ans'] ?? null,
            'submitted_ans' => $_GET['submitted_ans'] ?? null,
        ];
    }

    // Validate that required fields are present
    $requiredFields = ['question_id', 'user_id', 'time_taken', 'expected_time', 'points_earned', 'correct_ans', 'submitted_ans'];
    foreach ($requiredFields as $field) {
        if (empty($inputData[$field])) {
            $data = [
                'status' => 400,
                'message' => "Bad Request: $field is missing",
            ];
            header("HTTP/1.0 400 Bad Request");
            echo json_encode($data);
            exit();
        }
    }

    // Store the result
    $storeResult = storeResultperQuestion($inputData);
    echo $storeResult;

} else {
    $data = [
        'status' => 405,
        'message' => $requestMethod . ' Method not allowed',
    ];
    header("HTTP/1.0 405 Method not allowed");
    echo json_encode($data);
}
?>
