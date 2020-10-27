<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ricemill";
session_start();
if(!isset($_SESSION['user_id']))
    header('location: ../index.php');
else {
    if($_SESSION['user_type'] != 'Assets')
        header('location: ../dashboard.php');
}
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

?>