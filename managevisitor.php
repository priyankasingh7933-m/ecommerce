<?php
$conn = mysqli_connect("localhost", "root", "", "db");
if (isset($_POST['filter'])) {
    $fromDate = $_POST['fromDate'];
    $toDate = $_POST['toDate'];

    if (!empty($fromDate) && !empty($toDate)) {
        $query = "SELECT * FROM visitor WHERE DATE(created_at) BETWEEN '$fromDate' AND '$toDate'";
    } else {
        // fallback if dates are not selected
        $query = "SELECT * FROM visitor";
    }
} else {
    $query = "SELECT * FROM visitor";
}
$data = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visitor Management System</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
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
            margin-left: 20px;
            font-size: 12px;
        }
        .sidebar a {
            color: white;
            padding: 12px 20px;
            display: flex;
            align-items: center;
            text-decoration: none;
            font-size: 16px;
        }
        .sidebar a:hover {
            background: #495057;
        }
        .navbar-custom {
            margin-left: 220px;
            background: white;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            padding: 10px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .navbar-custom img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
        }
        .container {
            margin-left: 220px;
            padding: 20px;
        }
        .breadcrumb {
            font-size: 14px;
            color: #6c757d;
            margin-bottom: 20px;
            text-align: right;
        }
        .form-section {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .form-section h2 {
            margin-bottom: 20px;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        .form-group {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }
        .form-group label {
            width: 150px;
            font-weight: bold;
        }
        .form-group input {
            flex: 1;
            padding: 10px;
            margin-left: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .form-group.button-center {
            justify-content: center;
        }
        .form-group.button-center button {
            padding: 10px 20px;
            background-color: #1d1f1e;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .form-group.button-center button:hover {
            background-color: #333;
        }
        table {
            width: 100%;
            margin-top: 30px;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ccc;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f9f9f9;
        }
        .action-icons a {
            margin-right: 10px;
            color: inherit;
            text-decoration: none;
        }
        .action-icons a:hover {
            color: #007bff;
        }
        .footer {
            margin-left: 220px;
            padding: 15px;
            font-size: 14px;
            color: #6c757d;
            margin-top: 50px;
        }
    </style>
</head>
<body>

<div class="sidebar">
    <h6>NAVIGATION</h6>
    <a href="dashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
    <a href="addvisitor.php"><i class="fa fa-plus" aria-hidden="true"></i> New Visitor</a>
    <a href="managevisitor.php"><i class="fas fa-users-cog"></i> Manage Visitor</a>
    <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
</div>

<div class="navbar-custom">
    <div class="logo">
        <img src="logo.png" alt="Logo">
    </div>
    <div class="profile">
        <img src="profile.jpg" alt="Profile">
    </div>
</div>

<div class="container">
    <div class="breadcrumb">
        <span style="color:blue;"> Manage Visitor </span> / Manage Visitor
    </div>

    <div class="form-section">
        <h2>Manage Visitor</h2>
        <form method="POST" action="date.php">

            <div class="form-group">
                <label>Find Between Dates</label>
                <input type="date" name="fromDate">
            </div>
            <div class="form-group">
                <label>To Date</label>
                <input type="date" name="toDate">
            </div>
            <div class="form-group button-center">
                <button type="submit" name="filter">Submit</button>
            </div>
        </form>
    </div>

    <table class="table">
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Contact</th>
            <th>Action</th>
        </tr>
        <?php while($row = mysqli_fetch_array($data)) { ?>
        <tr>
            <td><?php echo $row['full_name']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><?php echo $row['phone']; ?></td>
            <td class="action-icons">
                <a href="editvisitor.php?fullname=<?php echo $row['full_name'];?>" title="Edit">
                    <i class="fas fa-edit" style="color:#007bff;"></i>
                </a>
                <a href="deletevisitor.php?id=<?php echo $row['id'];?>" 
                   onclick="return confirm('Are you sure to delete?')" 
                   title="Delete">
                    <i class="fas fa-trash-alt" style="color:red;"></i>
                </a>
            </td>
        </tr>
        <?php } ?>
    </table>
</div>x
</body>
</html>
