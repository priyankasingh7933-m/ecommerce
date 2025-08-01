<?php
$conn = mysqli_connect("localhost", "root", "", "db");
if (isset($_POST["submit"])) {
    $Fullname = $_POST['full_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $meeting_with = $_POST['meeting_with'];
    $department = $_POST['department'];
    $purpose = $_POST['purpose'];

    $query = "INSERT INTO visitor (full_name, email, phone, address, meeting_with, department, purpose) VALUES ('$Fullname','$email','$phone','$address','$meeting_with','$department','$purpose')";
$result = mysqli_query($conn, $query);
    if ($result) {
        $Alert = true;
    } else {
        $Alert = false;
    }
}
$Alert = false;
if (isset($_POST['submit'])) {
    $Alert = true;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add New Visitor</title>
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
        input[type="text"], input[type="email"], textarea {
            border-radius: 5px;
            padding: 10px;
        }
        label {
            font-weight: 600;
        }
        h3 {
            font-weight: 600;
            margin-bottom: 20px;
        }
        .btn-dark {
            padding: 10px 25px;
            font-weight: bold;
            border-radius: 5px;
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <h6>NAVIGATION</h6>
        <a href="dashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
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

<!-- Content -->
<div class="content">
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="mb-0">Add New Visitor</h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="addvisitor.php">New Visitor</a></li>
            <li class="breadcrumb-item active" aria-current="page">Add New Visitor</li>
        </ol>
    </nav>
</div>

    <?php if($Alert): ?>
<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Good Job!</strong> Visitor Detail has been added.
  
</div>
<?php endif; ?>
<form action="addvisitor.php" method="POST">
    <div class="form-group">
        <label for="visitorName">Fullname</label>
        <input type="text" name="full_name" class="form-control" placeholder="Enter visitor name" required>
    </div>
    <div class="form-group">
        <label for="visitorEmail">Email</label>
        <input type="email" name="email" class="form-control" placeholder="Enter visitor email" required>
    </div>
    <div class="form-group">
        <label for="visitorPhone">Phone</label>
        <input type="text" name="phone" class="form-control" placeholder="Enter visitor phone" required>
    </div>
    <div class="form-group">
        <label for="visitAddress">Address</label>
        <textarea name="address" class="form-control" rows="4" placeholder="Enter visitor address" required></textarea>
    </div>
    <div class="form-group">
        <label for="Meetingwith">Meeting With</label>
        <input type="text" name="meeting_with" class="form-control" placeholder="Enter name of person meeting with" required>
    </div>
    <div class="form-group">
        <label for="department">Department</label>
        <input type="text" name="department" class="form-control" placeholder="Enter department" required>
    </div>
    <div class="form-group">
        <label for="visitorPurpose">Purpose</label>
        <input type="text" name="purpose" class="form-control" placeholder="Enter visitor purpose" required>
    </div>
    
    <button type="submit" name="submit" class="btn btn-dark">Add Visitor</button>
</form>

    <div class="footer">
            2022 © Developed by <span style="color:blue;">Projects</a>
        </div>
</div>

</body>
</html>
