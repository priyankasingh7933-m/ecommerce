<?php
// Assume connection and insert query already likha hua hai

// After successful insert
session_start();
$_SESSION['success'] = "Good Job! Visitor's Detail has been added";
header('Location: dashboard.php');
exit();
?>
