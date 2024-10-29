<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // Redirect to the login page
    echo "<script>alert('You need to LOGIN to view this page.'); window.location.href = 'index.php';</script>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>No Labels Found</title>
    <style>
        body, html {
            height: 100%;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: Arial, sans-serif;
        }
        .container {
            text-align: center;
        }
        .container h1 {
            color: #e68a47;
        }
        .container button {
            font-size: 15px;
            padding: 10px 25px;
            background-color: #ff9d5c;
            color: white;
            border-radius: 8px;
            border: none;
            cursor: pointer;
        }
        .container button:hover {
            background-color: #e68a47;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Please create a new label before adding a Question.</h1>
        <button onclick="window.location.href='new_label.php'">
            Create New Label
        </button>
    </div>
</body>
</html>
