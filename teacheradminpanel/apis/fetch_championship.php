<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With');

include('user_function.php');

$requestMethod = $_SERVER["REQUEST_METHOD"];
if ($requestMethod == "GET") {
    $mode_id = isset($_GET['mode_id']) ? $_GET['mode_id'] : '';

    if ($mode_id != '') {
        $fetchChampionshipName = fetchChampionshipName([
            'mode_id' => $mode_id,
        ]);

        echo $fetchChampionshipName; 
    } else {
        $data = [
            'status' => 422,
            'message' => 'Enter correct mode id',
        ];
        header("HTTP/1.0 422 Unprocessable Entity");
        echo json_encode($data);
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
