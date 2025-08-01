<?php
session_start();

$conn = mysqli_connect("localhost", "root", "", "db");

if (isset($_POST["admins"])) {
    $username =  $_POST['username'];
    $password = $_POST['password'];
    
    $sql = "SELECT * FROM admins WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result);

    if ($count == 1) {
        $_SESSION["username"] = $username;
        header("Location: dashboard.php"); 
        exit(); 
    } else {
        echo "<h2 class='text-center text-danger'>Login Failed. Invalid username or password.</h2>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
</head>
<style>
    body {
            font-family: Arial, sans-serif;
        }
    h2{
        width:100%;
        height:50px;
        background-color:#f8f9fa;
        padding-left:40px;
        font-size:30px;
        padding-top:10px;
    }
    h4{
        width:100%;
        height:50px;
        background-color:#f8f9fa;
        padding-left:40px;
        font-size:30px;
        padding-top:10px;
    }
    </style>
<body><br>
    <h2>Visitor Management System - Admin Login</h2>
<br><br>
    <div class="container mt-5">
    <h4>Login Page</h4>
        <form method="POST" class="p-4 border rounded shadow-sm bg-dark">
            

            <div class="form-group">
                <label for="username" style="font-weight:bold; color:white;">Username:</label>
                <input type="text" name="username" id="username" class="form-control" placeholder="Enter username" required>
            </div>

            <div class="form-group">
                <label for="password" style="font-weight:bold; color:white;">Password:</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="Enter password" required>
            </div>

            <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                <label class="form-check-label" for="remember" style="font-weight:bold; color:white;">Remember Me</label>
            </div>

            <div class="text-center">
            <button type="submit" name="admins" class="btn btn-primary">Login</button>

            <a href="chnagepassword.php">Forgot Your Password?</a>
            </div>
        </form>
    </div>
</body>
</html>
