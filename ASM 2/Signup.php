<?php
include "connect.php";

$hoten = $password = $confirm = $email = $dob = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['name'])) {
        $hoten = htmlspecialchars($_POST['name']);
    }
    if (!empty($_POST['pwd'])) {
        $password = htmlspecialchars($_POST['pwd']);
    }
    if (!empty($_POST['confirm'])) {
        $confirm = htmlspecialchars($_POST['confirm']);
    }
    if (!empty($_POST['email'])) {
        $email = htmlspecialchars($_POST['email']);
    }
    if (!empty($_POST['dob'])) {
        $dob = htmlspecialchars($_POST['dob']);
    }

    // Check if passwords match
    if ($password === $confirm) {
        // SQL query to insert user details with unhashed password
        $sql = "INSERT INTO User (Name, password, Email, DoB) VALUES (?, ?, ?, ?)";

        if ($stmt = mysqli_prepare($conn, $sql)) {
            mysqli_stmt_bind_param($stmt, "ssss", $hoten, $password, $email, $dob);

            if (mysqli_stmt_execute($stmt)) {
                header('Location: login.php'); // Redirect to login page
                exit();
            } else {
                echo "Error: Could not execute query: " . mysqli_error($conn);
            }

            mysqli_stmt_close($stmt);
        } else {
            echo "Error: Could not prepare query: " . mysqli_error($conn);
        }
    } else {
        echo "Passwords do not match.";
    }

    mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Sign Up</title>
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
    <h2>Sign Up</h2>
    <form method="post" action="signup.php">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" required>
        </div>
        <div class="form-group">
            <label for="pwd">Password:</label>
            <input type="password" class="form-control" id="pwd" name="pwd" placeholder="Enter password" required>
        </div>
        <div class="form-group">
            <label for="confirm">Confirm Password:</label>
            <input type="password" class="form-control" id="confirm" name="confirm" placeholder="Confirm password" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required>
        </div>
        <div class="form-group">
            <label for="dob">Date of Birth:</label>
            <input type="date" class="form-control" id="dob" name="dob" required>
        </div>
        <button type="submit" class="btn btn-primary form-control">Register</button>
    </form>
</div>
</body>
</html>
