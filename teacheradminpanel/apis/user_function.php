<?php

require "../inc/dbcon.php";

function error422($message){
    $data = [
        'status' => 422,
        'message' => $message,
     ];
     header("HTTP/1.0 422 Unprocessable Entity");
     echo json_encode($data);
     exit();
}


function storePersonalData($params) {
    global $conn;

    // Escape the input parameters
    $name = mysqli_real_escape_string($conn, $params['name']);
    $email = mysqli_real_escape_string($conn, $params['email']);
    $age = mysqli_real_escape_string($conn, $params['age']);
    $location = mysqli_real_escape_string($conn, $params['location']);
    $user_id = mysqli_real_escape_string($conn, $params['user_id']);
    $interests = mysqli_real_escape_string($conn, $params['interests']);
    $phone_no = mysqli_real_escape_string($conn, $params['phone_no']);

    // Validate the input parameters
    $requiredParams = [
        'name' => $name,
        'email' => $email,
        'age' => $age,
        'location' => $location,
        'user_id' => $user_id,
        'interests' => $interests,
        'phone_no' => $phone_no,
    ];

    foreach ($requiredParams as $param => $value) {
        if (empty(trim($value))) {
            return error422("Enter $param");
        }
    }

    // Insert into result table
    $resultQuery = "INSERT INTO personal_data(user_id, name, email, age, location,phone_no, interests) 
                    VALUES ('$user_id', '$name', '$email', '$age', '$location', '$phone_no','$interests')";
    $resultResult = mysqli_query($conn, $resultQuery);

    if ($resultResult) {
        $data = [
            'status' => 201,
            'message' => 'Result stored successfully',
        ];
        header("HTTP/1.0 201 Created");
        return json_encode($data);
    } else {
        $data = [
            'status' => 500,
            'message' => 'Internal Server Error: Unable to store result',
        ];
        header("HTTP/1.0 500 Internal Server Error");
        return json_encode($data);
    }
}

function storeResult($params) {
    global $conn;

    // Escape the input parameters
    $time_taken = mysqli_real_escape_string($conn, $params['time_taken']);
    $expected_time = mysqli_real_escape_string($conn, $params['expected_time']);
    $game_mode = mysqli_real_escape_string($conn, $params['game_mode']);
    $champ_id = mysqli_real_escape_string($conn, $params['champ_id']);
    $user_id = mysqli_real_escape_string($conn, $params['user_id']);
    $total_questions = mysqli_real_escape_string($conn, $params['total_questions']);
    $correct_questions = mysqli_real_escape_string($conn, $params['correct_questions']);
    $total_score = mysqli_real_escape_string($conn, $params['total_score']);
    $total_bonus = mysqli_real_escape_string($conn, $params['total_bonus']);
    $total_penalty = mysqli_real_escape_string($conn, $params['total_penalty']);
    $total_negative_points = mysqli_real_escape_string($conn, $params['total_negative_points']);

    // Validate the input parameters
    $requiredParams = [
        'time_taken' => $time_taken,
        'expected_time' => $expected_time,
        'game_mode' => $game_mode,
        'champ_id' => $champ_id,
        'user_id' => $user_id,
        'total_questions' => $total_questions,
        'correct_questions' => $correct_questions,
        'total_score' => $total_score,
        'total_bonus' => $total_bonus,
        'total_penalty' => $total_penalty,
        'total_negative_points' => $total_negative_points
    ];

    foreach ($requiredParams as $param => $value) {
        if (empty(trim($value))) {
            return error422("Enter $param");
        }
    }
    
    $teacherIdQuery = "SELECT teacher_id FROM championship WHERE champ_id = '$champ_id'";
    $teacherIdResult = mysqli_query($conn, $teacherIdQuery);
    
    if ($teacherIdResult && mysqli_num_rows($teacherIdResult) > 0) {
        $row = mysqli_fetch_assoc($teacherIdResult);
        $teacher_id = $row['teacher_id'];
    } else {
        return error422("Invalid champ_id: Teacher not found");
    }

    // Insert into result table
    $resultQuery = "INSERT INTO result(champ_id,user_id,teacher_id, time_taken, expected_time, game_mode, total_questions, correct_questions,total_score,total_bonus,total_penalty,total_negative_points) 
                    VALUES ('$champ_id', '$user_id','$teacher_id', '$time_taken', '$expected_time', '$game_mode', '$total_questions', '$correct_questions','$total_score','$total_bonus','$total_penalty','$total_negative_points')";
    $resultResult = mysqli_query($conn, $resultQuery);

    if ($resultResult) {
        $data = [
            'status' => 201,
            'message' => 'Result stored successfully',
        ];
        header("HTTP/1.0 201 Created");
        return json_encode($data);
    } else {
        $data = [
            'status' => 500,
            'message' => 'Internal Server Error: Unable to store result',
        ];
        header("HTTP/1.0 500 Internal Server Error");
        return json_encode($data);
    }
}

function storeResultperQuestion($params) {
    global $conn;

    // Escape the input parameters
    $time_taken = mysqli_real_escape_string($conn, $params['time_taken']);
    $expected_time = mysqli_real_escape_string($conn, $params['expected_time']);
    $points_earned = mysqli_real_escape_string($conn, $params['points_earned']);
    $question_id = mysqli_real_escape_string($conn, $params['question_id']);
    $user_id = mysqli_real_escape_string($conn, $params['user_id']);
    $correct_ans = mysqli_real_escape_string($conn, $params['correct_ans']);
    $submitted_ans = mysqli_real_escape_string($conn, $params['submitted_ans']);

    // Validate the input parameters
    $requiredParams = [
        'time_taken' => $time_taken,
        'expected_time' => $expected_time,
        'points_earned' => $points_earned,
        'question_id' => $question_id,
        'user_id' => $user_id,
        'correct_ans' => $correct_ans,
        'submitted_ans' => $submitted_ans
    ];

    foreach ($requiredParams as $param => $value) {
        if (empty(trim($value))) {
            return error422("Enter $param");
        }
    }

    // Insert into result table
    $resultQuery = "INSERT INTO result_per_question(question_id,user_id, time_taken, expected_time, points, correct_ans, submitted_ans) 
                    VALUES ('$question_id', '$user_id', '$time_taken', '$expected_time', '$points_earned', '$correct_ans', '$submitted_ans')";
    $resultResult = mysqli_query($conn, $resultQuery);

    if ($resultResult) {
        $data = [
            'status' => 201,
            'message' => 'Result stored successfully',
        ];
        header("HTTP/1.0 201 Created");
        return json_encode($data);
    } else {
        $data = [
            'status' => 500,
            'message' => 'Internal Server Error: Unable to store result',
        ];
        header("HTTP/1.0 500 Internal Server Error");
        return json_encode($data);
    }
}


function storeUser($params) {
    global $conn;

    // Escape the input parameters
    $user_name = mysqli_real_escape_string($conn, $params['user_name']);
    $email = mysqli_real_escape_string($conn, $params['email']);
    $password = mysqli_real_escape_string($conn, $params['password']);
    $user_key = mysqli_real_escape_string($conn, $params['user_key']);
    $phone_no = mysqli_real_escape_string($conn, $params['phone_no']);
    $qualification = mysqli_real_escape_string($conn, $params['qualification']);

    // Validate the input parameters
    if (empty(trim($user_name))) {
        return error422('Enter user name');
    } elseif (empty(trim($user_key))) {
        return error422('Enter user key');
    } elseif (empty(trim($phone_no))) {
        return error422('Enter phone number');
    } elseif (empty(trim($qualification))) {
        return error422('Enter qualification');
    } elseif (empty(trim($email))) {
        return error422('Enter email');
    } elseif (empty(trim($password))) {
        return error422('Enter password');
    }

    // Check if the email already exists
    $checkQuery = "SELECT * FROM user WHERE email = '$email'";
    $checkResult = mysqli_query($conn, $checkQuery);

    if (mysqli_num_rows($checkResult) > 0) {
        // Email already exists
        $data = [
            'status' => 409,
            'message' => 'User already exists',
        ];
        header("HTTP/1.0 409 Conflict");
        return json_encode($data);
    } else {
        // Proceed to insert the new user
        $query = "INSERT INTO user(user_name, email, password, user_qualification, user_key, phone_no, first_login, recent_login) 
                  VALUES ('$user_name', '$email', '$password', '$qualification', '$user_key', '$phone_no', CURDATE(), CURDATE())";
        $result = mysqli_query($conn, $query);

        if ($result) {
            $data = [
                'status' => 201,
                'message' => 'User created successfully',
            ];
            header("HTTP/1.0 201 Created");
            return json_encode($data);
        } else {
            $data = [
                'status' => 500,
                'message' => 'Internal Server Error',
            ];
            header("HTTP/1.0 500 Internal Server Error");
            return json_encode($data);
        }
    }
}



function getUserId($labelParams){
    global $conn;

    if($labelParams['user_key'] == null){
        return error422('Enter user key');
    }

    $user_key_query = mysqli_real_escape_string($conn,$labelParams['user_key']);
    $query = "SELECT user_id FROM user WHERE user_key ='$user_key_query' LIMIT 1";
    $result = mysqli_query($conn,$query);

    if($result){
        if(mysqli_num_rows($result) == 1){
            $res = mysqli_fetch_assoc($result);

            $data = [
                'status' => 200,
                'message' => 'User id fetched successfully',
                'data' => $res
             ];
             header("HTTP/1.0 200 OK");
             return json_encode($data);
        }
        else{
            $data = [
                'status' => 469,
                'message' => 'No user found',
             ];
             header("HTTP/1.0 469 Not found");
             return json_encode($data);
        }
    }
    else{
        $data = [
            'status' => 500,
            'message' => 'Internal Server Error',
         ];
         header("HTTP/1.0 500 Internal Server Error");
         return json_encode($data);
    }
}


function getTeacherDetails($labelParams){
    global $conn;

    if($labelParams['teacher_id'] == null){
        return error422('Enter Teacher Id');
    }

    $user_key_query = mysqli_real_escape_string($conn,$labelParams['teacher_id']);
    $query = "SELECT * FROM teacher WHERE teacher_id ='$user_key_query' LIMIT 1";
    $result = mysqli_query($conn,$query);

    if($result){
        if(mysqli_num_rows($result) == 1){
            $res = mysqli_fetch_assoc($result);

            $data = [
                'status' => 200,
                'message' => 'Teacher id fetched successfully',
                'data' => $res
             ];
             header("HTTP/1.0 200 OK");
             return json_encode($data);
        }
        else{
            $data = [
                'status' => 469,
                'message' => 'No user found',
             ];
             header("HTTP/1.0 469 Not found");
             return json_encode($data);
        }
    }
    else{
        $data = [
            'status' => 500,
            'message' => 'Internal Server Error',
         ];
         header("HTTP/1.0 500 Internal Server Error");
         return json_encode($data);
    }
}

function getDetails($params) {
    global $conn;

    if ($params['champ_id'] == null) {
        return error422('Enter Championship id');
    }

    $user_champ_query = mysqli_real_escape_string($conn, $params['champ_id']);
    
    // Define the base URL
    $base_url = 'https://kgamify.in/teacheradminpanel/example/';

    $query = "SELECT 
                gm.mode_id, 
                gm.mode_name, 
                gm.time_minutes, 
                gm.no_of_question, 
                ch.champ_id,
                ch.champ_name,
                ch.start_date, 
                ch.end_date, 
                ch.start_time, 
                ch.end_time,
                ch.category_id,
                ch.status as champ_status,
                c.category_name,
                c.status as category_status,
                ch.teacher_id,
                t.teacher_name,
                t.upload_img,
                g.gift_image
              FROM 
                game_mode gm
                LEFT JOIN championship ch ON gm.champ_id = ch.champ_id
                LEFT JOIN category c ON ch.category_id = c.category_id
                LEFT JOIN teacher t ON ch.teacher_id = t.teacher_id
                LEFT JOIN chosen_gift_type g ON gm.mode_id = g.mode_id
              WHERE 
                gm.champ_id = '$user_champ_query'";

    $result = mysqli_query($conn, $query);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            $res = mysqli_fetch_all($result, MYSQLI_ASSOC);

            // Append the base URL to the image paths
            foreach ($res as &$row) {
                if (!empty($row['upload_img'])) {
                    // Clean up the image path
                    $image_path = trim($row['upload_img'], '/');
                    // Combine base URL with cleaned image path
                    $row['upload_img'] = rtrim($base_url, '/') . '/' . $image_path;
                }
            }
            unset($row); // Break the reference with the last element

            $data = [
                'status' => 200,
                'message' => 'Details fetched successfully',
                'data' => $res
            ];
            header("HTTP/1.0 200 OK");
            return json_encode($data);
        } else {
            $data = [
                'status' => 469,
                'message' => 'Some details are missing',
            ];
            header("HTTP/1.0 469 Not Found");
            return json_encode($data);
        }
    } else {
        $data = [
            'status' => 500,
            'message' => 'Internal Server Error',
        ];
        header("HTTP/1.0 500 Internal Server Error");
        return json_encode($data);
    }
}



function getGameMode($labelParams){
    global $conn;

    if($labelParams['champ_id'] == null){
        return error422('Enter Championship id');
    }
    if($labelParams['user_id'] == null){
        return error422('Enter User id');
    }

    $user_champ_query = mysqli_real_escape_string($conn,$labelParams['champ_id']);
    $user_key_query = mysqli_real_escape_string($conn,$labelParams['user_id']);

    // $query = "SELECT game_mode.mode_id, mode_name, time_minutes, no_of_question, user_points.user_id FROM game_mode left join user_points on game_mode.mode_id = user_points.mode_id  AND (user_points.user_id = '$user_key_query' OR user_points.user_id IS NULL) WHERE champ_id = '$user_champ_query';";
    
    $query = "SELECT mode_id, mode_name, time_minutes, no_of_question FROM game_mode WHERE champ_id = '$user_champ_query';";

    $result = mysqli_query($conn,$query);


    if($result){
        if(mysqli_num_rows($result) > 0){
            // $res = mysqli_fetch_assoc($result);
            $res = mysqli_fetch_all($result,MYSQLI_ASSOC);
            $data = [
                'status' => 200,
                'message' => 'Game Mode fetched successfully',
                'data' => $res
             ];
             header("HTTP/1.0 200 OK");
             return json_encode($data);
        }
        else{
            $data = [
                'status' => 469,
                'message' => 'No game modes',
             ];
             header("HTTP/1.0 469 Not found");
             return json_encode($data);
        }
    }
    else{
        $data = [
            'status' => 500,
            'message' => 'Internal Server Error',
         ];
         header("HTTP/1.0 500 Internal Server Error");
         return json_encode($data);
    }
}


function checkUserPlayed($params){
    global $conn;

    if($params['user_id'] == null){
        return error422('Enter User ID');
    }else if($params['champ_id'] == null){
        return error422('Enter Champ ID');
    }

    $user_id = mysqli_real_escape_string($conn,$params['user_id']);
    $champ_id = mysqli_real_escape_string($conn,$params['champ_id']);
    $query = "SELECT * from result WHERE user_id =$user_id and champ_id=$champ_id";
    $result = mysqli_query($conn,$query);

    if($result){
        if(mysqli_num_rows($result) > 0){
            $res = mysqli_fetch_assoc($result);

            $data = [
                'status' => 200,
                'message' => 'User Already Played',
                'data' => $res
             ];
             header("HTTP/1.0 200 OK");
             return json_encode($data);
        }
        else{
            $data = [
                'status' => 409,
                'message' => 'User can play',
             ];
             header("HTTP/1.0 409 Conflict");
             return json_encode($data);
        }
    }
    else{
        $data = [
            'status' => 500,
            'message' => 'Internal Server Error',
         ];
         header("HTTP/1.0 500 Internal Server Error");
         return json_encode($data);
    }
}

function checkUserData($params){
    global $conn;

    if($params['email'] == null){
        return error422('Enter Email');
    }else if($params['password'] == null){
        return error422('Enter Password');
    }

    $email = mysqli_real_escape_string($conn,$params['email']);
    $password = mysqli_real_escape_string($conn,$params['password']);
    $query = "SELECT * from user WHERE email ='$email' and password='$password'";
    $result = mysqli_query($conn,$query);

    if($result){
        if(mysqli_num_rows($result) > 0){
            $res = mysqli_fetch_assoc($result);

            $data = [
                'status' => 200,
                'message' => 'User Found',
                'data' => $res
             ];
             header("HTTP/1.0 200 OK");
             return json_encode($data);
        }
        else{
            $data = [
                'status' => 469,
                'message' => 'No user found',
             ];
             header("HTTP/1.0 469 Not found");
             return json_encode($data);
        }
    }
    else{
        $data = [
            'status' => 500,
            'message' => 'Internal Server Error',
         ];
         header("HTTP/1.0 500 Internal Server Error");
         return json_encode($data);
    }
}

function getUserData($params){
    global $conn;

    if($params['user_id'] == null){
        return error422('Enter user Id');
    }

    $user_id_query = mysqli_real_escape_string($conn,$params['user_id']);
    $query = "SELECT user.user_id, user_name, user_qualification, user_year, sum(points) as points, count(*) as champs FROM user left join user_points on user.user_id = user_points.user_id WHERE user.user_id ='$user_id_query'";
    $result = mysqli_query($conn,$query);

    if($result){
        if(mysqli_num_rows($result) == 1){
            $res = mysqli_fetch_assoc($result);

            $data = [
                'status' => 200,
                'message' => 'User data fetched successfully',
                'data' => $res
             ];
             header("HTTP/1.0 200 OK");
             return json_encode($data);
        }
        else{
            $data = [
                'status' => 469,
                'message' => 'No user found',
             ];
             header("HTTP/1.0 469 Not found");
             return json_encode($data);
        }
    }
    else{
        $data = [
            'status' => 500,
            'message' => 'Internal Server Error',
         ];
         header("HTTP/1.0 500 Internal Server Error");
         return json_encode($data);
    }
}



function getCategoryList(){

    global $conn;

    $query = "select start_date, end_date, start_time, end_time, champ_id , category.category_id , category_name , champ_name from category left join championship on category.category_id = championship.category_id WHERE championship.category_id IS NOT NULL";
    $query_run = mysqli_query($conn,$query);

    if($query_run){

        if(mysqli_num_rows($query_run) > 0){

            $res = mysqli_fetch_all($query_run,MYSQLI_ASSOC);

            $data = [
                'status' => 200,
                'message' => 'category fetched successfully',
                'data' => $res
             ];
             header("HTTP/1.0 200 OK");
             return json_encode($data);

        }else{
            $data = [
                'status' => 469,
                'message' => 'No category found',
             ];
             header("HTTP/1.0 469 No category found");
             return json_encode($data);
        }
    }
    else{
        $data = [
            'status' => 500,
            'message' => 'Internal Server Error',
         ];
         header("HTTP/1.0 500 Internal Server Error");
         return json_encode($data);
    }
}

function getQuestion($params) {
    global $conn;

    if ($params['mode_id'] == null) {
        return error422('Enter correct championship id or game mode');
    }

    $modeId = mysqli_real_escape_string($conn, $params['mode_id']);

    $query = "SELECT 
                question.question_id,
                question.label_id,
                teacher_id,
                question_text,
                option1_text,
                option2_text,
                option3_text,
                option4_text,
                question_image,
                option1_img,
                option2_img,
                option3_img,
                option4_img,
                expected_time,
                GROUP_CONCAT(DISTINCT correct_answer ORDER BY correct_answer SEPARATOR ',') AS correct_answers,
                total_coins 
              FROM 
                question 
              INNER JOIN 
                chosen_questions ON question.label_id = chosen_questions.label_id 
              INNER JOIN 
                answer ON question.question_id = answer.question_id 
              WHERE 
                chosen_questions.mode_id = '$modeId' 
              GROUP BY 
                question.question_id;";

    $result = mysqli_query($conn, $query);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            $res = mysqli_fetch_all($result, MYSQLI_ASSOC);

            // Replace 'correct_answer' with 'correct_answers' in the final output
            foreach ($res as &$row) {
                $row['correct_answer'] = $row['correct_answers'];
                unset($row['correct_answers']); // Optional: remove the temporary field if not needed
            }

            $data = [
                'status' => 200,
                'message' => 'Questions fetched successfully',
                'data' => $res
            ];
            header("HTTP/1.0 200 OK");
            return json_encode($data);
        } else {
            $data = [
                'status' => 469,
                'message' => 'No questions found',
            ];
            header("HTTP/1.0 469 Not found");
            return json_encode($data);
        }
    } else {
        $data = [
            'status' => 500,
            'message' => 'Internal Server Error',
        ];
        header("HTTP/1.0 500 Internal Server Error");
        return json_encode($data);
    }
}

function fetchChampionshipName($params) {
    global $conn;

    if ($params['mode_id'] == null) {
        return error422('Enter correct mode id');
    }

    $modeId = mysqli_real_escape_string($conn, $params['mode_id']);

    $query = "SELECT championship.champ_name AS championshipName
        FROM game_mode
        INNER JOIN championship ON game_mode.champ_id = championship.champ_id
        WHERE game_mode.mode_id = '$modeId'";
    
    $result = mysqli_query($conn, $query);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $data = [
                'status' => 200,
                'message' => 'Championship name fetched successfully',
                'championshipName' => $row['championshipName'],
            ];
            header("HTTP/1.0 200 OK");
            return json_encode($data);
        } else {
            $data = [
                'status' => 469,
                'message' => 'No championship found',
            ];
            header("HTTP/1.0 469 Not found");
            return json_encode($data);
        }
    } else {
        $data = [
            'status' => 500,
            'message' => 'Internal Server Error',
        ];
        header("HTTP/1.0 500 Internal Server Error");
        return json_encode($data);
    }
}


function storeUserPoints($params){
    global $conn;
    $user_id = mysqli_real_escape_string($conn,$params['user_id']);
    $mode_id = mysqli_real_escape_string($conn,$params['mode_id']);
    $points = mysqli_real_escape_string($conn,$params['points']);
    $reward = mysqli_real_escape_string($conn,$params['reward']);

    

    if(empty(trim($user_id))){
        return error422('Enter user id of points');
    }
    elseif(empty(trim($mode_id))){
        return error422('Enter mode id of points');
    }
    else{
        $query = "INSERT INTO user_points(user_id,mode_id,points,reward) values('$user_id','$mode_id','$points','$reward')";
        $result = mysqli_query($conn,$query);

        if($result){
            $data = [
                'status' => 201,
                'message' => 'Points added successfully',
             ];
             header("HTTP/1.0 201 Created");
             return json_encode($data);
        }else{
            $data = [
                'status' => 500,
                'message' => 'Internal Server Error',
             ];
             header("HTTP/1.0 500 Internal Server Error");
             return json_encode($data);
        }
    }

}


function storeWrongQuestion($params){
    global $conn;
    $user_id = mysqli_real_escape_string($conn,$params['user_id']);
    $question_id = mysqli_real_escape_string($conn,$params['question_id']); 

    if(empty(trim($user_id))){
        return error422('Enter user id of wrong question');
    }
    elseif(empty(trim($question_id))){
        return error422('Enter question id of wrong question');
    }
    else{
        $query = "INSERT INTO wrong_question(user_id,question_id) values('$user_id','$question_id')";
        $result = mysqli_query($conn,$query);

        if($result){
            $data = [
                'status' => 201,
                'message' => 'Wrong question added successfully',
             ];
             header("HTTP/1.0 201 Created");
             return json_encode($data);
        }else{
            $data = [
                'status' => 500,
                'message' => 'Internal Server Error',
             ];
             header("HTTP/1.0 500 Internal Server Error");
             return json_encode($data);
        }
    }

}


function putUserLogin($params){
    global $conn;

    if($params['user_id'] == null){
        return error422('Enter user id');
    }

    $user_id_query = mysqli_real_escape_string($conn,$params['user_id']);
    $query = "update user set recent_login = CURDATE() where user_id = '$user_id_query'";
    $result = mysqli_query($conn,$query);

    if($result){
       
            

            $data = [
                'status' => 200,
                'message' => 'User id fetched successfully',
           
             ];
             header("HTTP/1.0 200 OK");
             return json_encode($data);
        
       
    }
    else{
        $data = [
            'status' => 500,
            'message' => 'Internal Server Error',
         ];
         header("HTTP/1.0 500 Internal Server Error");
         return json_encode($data);
    }



}





function getUserPoints($params){
    global $conn;

    if($params['user_id'] == null){
        return error422('Enter user id');
    }

    $user_id_query = mysqli_real_escape_string($conn,$params['user_id']);
    $query = "SELECT sum(points) from user_points where user_id=$user_id_query LIMIT 1";
    $result = mysqli_query($conn,$query);

    if($result){
        if(mysqli_num_rows($result) == 1){
            $res = mysqli_fetch_assoc($result);

            $data = [
                'status' => 200,
                'message' => 'User id fetched successfully',
                'data' => $res
             ];
             header("HTTP/1.0 200 OK");
             return json_encode($data);
        }
        else{
            $data = [
                'status' => 469,
                'message' => 'No user found',
             ];
             header("HTTP/1.0 469 Not found");
             return json_encode($data);
        }
    }
    else{
        $data = [
            'status' => 500,
            'message' => 'Internal Server Error',
         ];
         header("HTTP/1.0 500 Internal Server Error");
         return json_encode($data);
    }
}




?>