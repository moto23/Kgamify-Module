<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // Redirect to the login page
    echo "<script>alert('You need to LOGIN to view this page.'); window.location.href = 'index.php';</script>";
    exit();
}
?>
<?php
$labels = isset($_GET['labels']) ? $_GET['labels'] : 1; // Default to 1 to avoid undefined index
$champs = isset($_GET['champs']) ? $_GET['champs'] : 1; // Default to 1 to avoid undefined index
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>No Labels or Championships Found</title>
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
            margin: 5px;
        }
        .container button:hover {
            background-color: #e68a47;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php if ($labels == 0) { ?>
            <h1>Please create a new label before creating the game-mode.</h1>
            <button onclick="window.location.href='new_label.php'">Create New Label</button>
        <?php } elseif ($champs == 0) { ?>
            <h1>Please create a new championship before creating the game-mode.</h1>
            <button onclick="window.location.href='create_new_championship.php'">Create New Championship</button>
        <?php } ?>
    </div>
</body>
</html>
