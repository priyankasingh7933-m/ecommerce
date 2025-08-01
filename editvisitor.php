<?php
 $conn=mysqli_connect("localhost","root","","db");
 $query="select * FROM visitor";
 $data=mysqli_query($conn,$query);
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Visitor Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
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
        .content {
    margin-left: 220px;
    padding: 20px;
}

    </style>
</head>
<body>

<div class="sidebar">
    <h6>NAVIGATION</h6>
    <a href="dashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
    <a href="addvisitor.php"><i class="fa fa-plus"></i> New Visitor</a>
    <a href="managevisitor.php"><i class="fas fa-users-cog"></i> Manage Visitor</a>
    <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
</div>

<div class="navbar-custom">
    <div class="logo">
        <img src="assets/logo.png" alt="Logo">
    </div>
    <div class="profile">
        <img src="assets/profile.jpg" alt="Profile">
    </div>
</div>

<div class="content">
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 >Visitor Detail</h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="addvisitor.php">New Visitor</a></li>
            <li class="breadcrumb-item active" aria-current="page">Add New Visitor</li>
        </ol>
    </nav>
</div>
       
<?php while($row=mysqli_fetch_array($data)){ ?>
   
    <form method="POST" action="updatevisitor.php">
    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
    
    <div class="mb-3">
        <label>Full Name</label>
        <input type="text" name="full_name" class="form-control" value="<?php echo $row['full_name']; ?>">
    </div>
    <div class="mb-3">
        <label>Email</label>
        <input type="email" name="email" class="form-control" value="<?php echo $row['email']; ?>">
    </div>
    <div class="mb-3">
        <label>Phone</label>
        <input type="text" name="phone" class="form-control" value="<?php echo $row['phone']; ?>">
    </div>
    <div class="mb-3">
        <label>Address</label>
        <input type="text" name="address" class="form-control" value="<?php echo $row['address']; ?>">
    </div>
    <div class="mb-3">
        <label>Whom to Meet</label>
        <input type="text" name="meeting_with" class="form-control" value="<?php echo $row['meeting_with']; ?>">
    </div>
    <div class="mb-3">
        <label>Department</label>
        <input type="text" name="department" class="form-control" value="<?php echo $row['department']; ?>">
    </div>
    <div class="mb-3">
        <label>Reason to Meet</label>
        <input type="text" name="purpose" class="form-control" value="<?php echo $row['purpose']; ?>">
    </div>
    <div class="mb-3">
        <label>Visitor Entering Time</label>
        <input type="text" name="created_at" class="form-control" value="<?php echo $row['created_at']; ?>" readonly>
    </div>
    <div class="mb-3">
        <label>Outing Remark</label>
        <textarea name="out_remark" class="form-control"><?php echo isset($row['out_remark']) ? $row['out_remark'] : ''; ?></textarea>
    </div>

    <button type="submit" class="btn btn-primary">Update</button>
</form>
<?php } ?>
        


        <div class="footer">
            <p>&copy; 2023 Visitor Management System. All rights reserved.</p>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</div>
</body>
</html>