<?php
include "connect.php";

$email = $password = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['email'])) {
        $email = htmlspecialchars($_POST['email']);
    }
    if (!empty($_POST['password'])) {
        $password = htmlspecialchars($_POST['password']);
    }

    // SQL query to verify user credentials
    $sql = "SELECT * FROM User WHERE Email = ? AND password = ?";
    if ($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, "ss", $email, $password);

        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);
            if (mysqli_num_rows($result) === 1) {
                // Login successful
                header('Location: main.php'); // Redirect to dashboard
                exit();
            } else {
                echo "Invalid email or password.";
            }
        } else {
            echo "Error: Could not execute query: " . mysqli_error($conn);
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "Error: Could not prepare query: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <style>
        body {
            background: linear-gradient(to right, #4caf50, #ffeb3b); /* Green to Yellow gradient */
            font-family: 'Arial', sans-serif;
        }
        .container {
            max-width: 450px;
            padding: 30px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            margin-top: 80px;
        }
        h2 {
            color: #333;
            text-align: center;
        }
        .form-control {
            border-radius: 5px;
            border: 1px solid #ccc;
            margin-bottom: 15px;
        }
        .form-control:focus {
            border-color: #4caf50;
            box-shadow: 0 0 5px rgba(76, 175, 80, 0.5);
        }
        .btn-primary {
            background-color: #4caf50;
            border-color: #4caf50;
        }
        .btn-primary:hover {
            background-color: #388e3c;
            border-color: #388e3c;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Login</h2>
    <form method="post" action="login.php">
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" required>
        </div>
        <p>dont have account?<a href="Signup.php">sign up</a></p>
        <button type="submit" class="btn btn-primary form-control">Login</button>
    </form>
</div>
</body>
</html>
