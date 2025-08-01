<?php
session_start();

// Database connection
$conn = new mysqli("localhost", "root", "", "db"); // db = your database name

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get user input
$username = $_POST['username'];
$password = $_POST['password'];

// Query to check user in 'admin' table
$sql = "SELECT * FROM admins WHERE username = '$username' AND password = '$password'";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    $_SESSION['admins'] = $username; // Session set
    header("Location: dashboard.php");
    exit();
} else {
    echo "<script>alert('Invalid Username or Password');window.location.href='adminlogin.php';</script>";
}

$conn->close();
?>
