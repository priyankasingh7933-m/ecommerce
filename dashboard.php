<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: adminlogin.php');
    exit();
}

$successMessage = '';
if (isset($_SESSION['success'])) {
    $successMessage = $_SESSION['success'];
    unset($_SESSION['success']); // Refresh par message na aaye
}

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Queries
$todayQuery = "SELECT COUNT(*) FROM visitor WHERE DATE(created_at) = CURDATE()";
$todayResult = $conn->query($todayQuery);
$todayCount = $todayResult->fetch_row()[0];

$yesterdayQuery = "SELECT COUNT(*) FROM visitor WHERE DATE(created_at) = CURDATE() - INTERVAL 1 DAY";
$yesterdayResult = $conn->query($yesterdayQuery);
$yesterdayCount = $yesterdayResult->fetch_row()[0];

$last7DaysQuery = "SELECT COUNT(*) FROM visitor WHERE created_at >= CURDATE() - INTERVAL 7 DAY";
$last7DaysResult = $conn->query($last7DaysQuery);
$last7DaysCount = $last7DaysResult->fetch_row()[0];

$totalVisitorsQuery = "SELECT COUNT(*) FROM visitor";
$totalVisitorsResult = $conn->query($totalVisitorsQuery);
$totalVisitorsCount = $totalVisitorsResult->fetch_row()[0];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visitor Management System - Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
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

        <!-- Success message -->
        <?php if ($successMessage): ?>
            <div class="alert alert-success text-center" role="alert">
                <?php echo $successMessage; ?>
            </div>
        <?php endif; ?>

        <h3 class="mb-4">Dashboard</h3>

        <div class="row">
            <!-- Today Visitors -->
            <div class="col-md-3 mb-4">
                <div class="card text-center p-3">
                    <i class="fas fa-user fa-2x mb-2" style="color: purple;"></i>
                    <h5>Today</h5>
                    <h3><?php echo $todayCount; ?></h3>
                </div>
            </div>

            <!-- Yesterday Visitors -->
            <div class="col-md-3 mb-4">
                <div class="card text-center p-3">
                    <i class="fas fa-calendar-day fa-2x mb-2" style="color: dodgerblue;"></i>
                    <h5>Yesterday</h5>
                    <h3><?php echo $yesterdayCount; ?></h3>
                </div>
            </div>

            <!-- Last 7 Days Visitors -->
            <div class="col-md-3 mb-4">
                <div class="card text-center p-3">
                    <i class="fas fa-calendar-week fa-2x mb-2" style="color: green;"></i>
                    <h5>Last 7 Days</h5>
                    <h3><?php echo $last7DaysCount; ?></h3>
                </div>
            </div>

            <!-- Total Visitors -->
            <div class="col-md-3 mb-4">
                <div class="card text-center p-3">
                    <i class="fas fa-eye fa-2x mb-2" style="color: orange;"></i>
                    <h5>Total Visitors</h5>
                    <h3><?php echo $totalVisitorsCount; ?></h3>
                </div>
            </div>
        </div><br><br><br><br><br><br><br><br><br><br><br><br>

        <div class="footer">
            2022 © Developed by <a href="#" target="_blank">Projects</a>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    

    
</body>
</html>

<?php
$conn->close();
?>
