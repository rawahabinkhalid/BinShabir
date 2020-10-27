<?php
include_once('conn.php');

$username=$_POST['username'];
$userpassword=$_POST['userpassword'];

$sql = 'SELECT * FROM `user` WHERE `UserName`="'.$username.'" AND `UserPassword`="'.$userpassword.'"';
$result = mysqli_query($conn, $sql);
if(mysqli_num_rows($result) > 0)
{    
    $row = mysqli_fetch_assoc($result);
    session_start();
    $_SESSION['user_id'] = $row['Id'];
    $_SESSION['user_type'] = $row['UserType'];
    
    if($_SESSION['user_type'] == 'Main')
        header('location:dashboard.php');
    else if($_SESSION['user_type'] == 'Assets')
        header('location:AssetsPortal/dashboard.php');
}
else
{
    echo 'Incorrect Credentials';
}
?>