<?php
 $conn=mysqli_connect("localhost","root","","db");
 $query="select * FROM visitor";
 $data=mysqli_query($conn,$query);
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Visitor Management</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
  
</head>
<body>

<div class="container">
        <h1 class="text-center text-primary mb-4 mt-4">Employee Information</h1>
        <table class="table">
            <tr class="table-dark">
                <th>FullName</th>
                <th>Email</th>
                <th>MobileNumber</th>
                <th>Address</th>
                <th>WhomToMeet</th>
                <th>Department</th>
                <th>ReasonToMeet</th>
                <th>VisitorEntringTime</th>
               
                <th>Actions </th>
        <?php while($row=mysqli_fetch_array($data)){ ?>
            <tr>
    <td><?php echo $row['FullName']; ?></td>   
    <td><?php echo $row['Email']; ?></td>   
    <td><?php echo $row['MobileNumber']; ?></td>   
    <td><?php echo $row['Address']; ?></td>  
    <td><?php echo $row['WhomToMeet']; ?></td>  
    <td><?php echo $row['Department']; ?></td>  
    <td><?php echo $row['ReasonToMeet']; ?></td>  
    <td><?php echo $row['VisitorEntringTime']; ?></td>  
    <td><?php echo $row['OutingRemark']; ?></td>  
    <td>
    <a href="managevisitor.php?fullname=<?php echo urlencode($row['FullName']); ?>" class="btn btn-dark btn-sm me-3 d-inline">Update</a>

    </td>
</tr>


            <?php }?>
        </table>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>