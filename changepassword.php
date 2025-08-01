<?php
$conn = mysqli_connect("localhost", "root", "", "db");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = 'admin'; // You only have one admin right now
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Fetch current password
    $query = "SELECT password FROM admins WHERE username='$username'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    if (!$row) {
        echo "<script>alert('Admin not found.');</script>";
    } elseif ($row['password'] !== $current_password) {
        echo "<script>alert('Current password is incorrect.');</script>";
    } elseif ($new_password !== $confirm_password) {
        echo "<script>alert('New passwords do not match.');</script>";
    } else {
        $update = "UPDATE admins SET password='$new_password' WHERE username='$username'";
        if (mysqli_query($conn, $update)) {
            echo "<script>alert('Password updated successfully!'); window.location='adminlogin.php';</script>";
            exit();
        } else {
            echo "<script>alert('Failed to update password.');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Change Password</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <style>
    body {
            font-family: 'Arial', sans-serif;
            background: #f8f9fa;
        }
        .sidebar {
            height: 100vh;
            background: #343a40;
            color: white;
            position: fixed;
            width: 220px;
            top: 0;
            left: 0;
            padding-top: 20px;
        }
        .sidebar h6 {
            text-align: center;
            margin-bottom: 30px;
            font-size: 12px;
            color: #adb5bd;
        }
        .sidebar a {
            color: white;
            padding: 12px 20px;
            display: flex;
            align-items: center;
            text-decoration: none;
            font-size: 16px;
        }
        .sidebar a i {
            margin-right: 10px;
        }
        .sidebar a:hover {
            background: #495057;
        }
        .content {
            margin-left: 220px;
            padding: 20px;
        }
        .navbar-custom {
            margin-left: 220px;
            background: white;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            padding: 10px 20px;
        }
        .navbar-custom img {
            width: 40px;
            height: 40px;
        }
        .card {
            border: none;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            border-radius: 10px;
        }
        .footer {
            text-align: left;
            padding: 15px;
            font-size: 14px;
            color: #6c757d;
            margin-top: 50px;
        }
    
    .container { margin-left:220px; padding:20px; }
    .form-section { background:#fff; padding:20px; border-radius:8px; box-shadow:0 0 10px rgba(0,0,0,0.1); }
  </style>
</head>
<body>

  <!-- Sidebar -->
  <div class="sidebar">
        <h6>NAVIGATION</h6>
        <a href="#"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
        <a href="addvisitor.php"><i class="fa fa-plus" aria-hidden="true"></i> New Visitor</a>
        <a href="managevisitor.php"><i class="fas fa-users-cog"></i> Manage Visitor</a>
        <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>

  <!-- Navbar -->
  <nav class="navbar navbar-expand navbar-light navbar-custom">
        <div class="container-fluid d-flex justify-content-between">
            <div class="d-flex align-items-center">
                <img src="https://cdn-icons-png.flaticon.com/512/1946/1946488.png" alt="Logo">
                <span class="ml-2 h5 mb-0">Visitor Management System</span>
            </div>
            <div class="ml-auto dropdown">
            <a href="#" class="d-flex align-items-center dropdown-toggle" id="profileDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img src="https://cdn-icons-png.flaticon.com/512/847/847969.png" class="rounded-circle" width="40" height="40" alt="Profile">
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="profileDropdown">
                <a class="dropdown-item" href="changepassword.php">
                    <i class="fas fa-key mr-2"></i> Change Password
                </a>
                <a class="dropdown-item" href="logout.php">
                    <i class="fas fa-sign-out-alt mr-2"></i> Logout
                </a>
            </div></div>
        </div>
    </nav>
  

  <div class="container">
    <div class="form-section">
      <h2>Change Password</h2>

      

      <!-- Change Password Form -->
      <form method="POST" action="changepassword.php">
        <div class="form-group">
          <label for="current_password">Current Password</label>
          <input type="password" id="current_password" name="current_password" class="form-control" required>
        </div>
        <div class="form-group">
          <label for="new_password">New Password</label>
          <input type="password" id="new_password" name="new_password" class="form-control" minlength="6" required>
        </div>
        <div class="form-group">
          <label for="confirm_password">Confirm New Password</label>
          <input type="password" id="confirm_password" name="confirm_password" class="form-control" minlength="6" required>
        </div>
        <button type="submit" class="btn btn-dark">Change</button>
      </form>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
