<?php
$conn=mysqli_connect("localhost","root","","db");
$id=$_GET["id"];
$query="delete from visitor where id = '$id'";
$data=mysqli_query($conn,$query);
header("location:managevisitor.php");
exit();
?>  