<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With');

include('user_function.php');

$requestMethod = $_SERVER["REQUEST_METHOD"];
if ($requestMethod == "GET") {
    if (isset($_GET['user_id']) && isset($_GET['champ_id'])) {
        $details = checkUserPlayed($_GET); // Pass $_GET directly
        echo $details;
    } else {
        $data = [
            'status' => 400,
            'message' => 'Bad Request: user_id and champ_id parameter is required',
        ];
        header("HTTP/1.0 400 Bad Request");
        echo $data;
    }
} else {
    $data = [
        'status' => 405,
        'message' => $requestMethod . ' Method not allowed',
    ];
    header("HTTP/1.0 405 Method not allowed");
    echo json_encode($data);
}
?>
