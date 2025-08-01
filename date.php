<?php
$conn = mysqli_connect("localhost", "root", "", "db");

$start_date = isset($_GET['start']) ? $_GET['start'] : '';
$end_date = isset($_GET['end']) ? $_GET['end'] : '';

// Optional: If you want to filter by date from DB, modify this query:
$query = "SELECT * FROM visitor"; 
$data = mysqli_query($conn, $query);
?>

<html>
<head>
    <title>Record display</title>
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
        .sidebar a:hover {
            background: #495057;
        }
        .content-wrapper {
            margin-left: 240px;
            padding: 30px;
        }
        .table-container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        .form-inline label {
            margin-right: 10px;
            font-weight: bold;
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

<!-- Main Content -->
<div class="content-wrapper">
    <h1 class="text-center text-warning mb-4">Visitor Detail</h1>
    <h3>Between Dates Reports</h3>

    <!-- Date Filter Form -->
    <form class="form-inline mb-4" method="GET" action="">
        <label for="start">Start Date:</label>
        <input type="date" name="start" id="start" class="form-control mr-3" value="<?php echo $start_date; ?>" required>

        <label for="end">End Date:</label>
        <input type="date" name="end" id="end" class="form-control mr-3" value="<?php echo $end_date; ?>" required>

        <button type="submit" class="btn btn-dark">Filter</button>
    </form>

    <h4 class="text-center text-primary mb-4">
        <?php if ($start_date && $end_date): ?>
            Report From <?php echo $start_date; ?> to <?php echo $end_date; ?>
        <?php endif; ?>
    </h4>

    <div class="table-container">
        <table class="table">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>FullName</th>
                    <th>Contact Number</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php while($row = mysqli_fetch_array($data)) { ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['full_name']; ?></td>
                    <td><?php echo $row['phone']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td>
                        <a href="#" class="btn btn-info btn-sm mr-2">Edit</a>
                        <a href="#" class="btn btn-danger btn-sm">Delete</a>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>
