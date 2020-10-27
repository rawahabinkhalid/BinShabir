<?php
include_once('conn.php');

$name = $_POST['name'];
$description = $_POST['description'];
$brand = $_POST['brand'];
$price = $_POST['price'];
$deprication = $_POST['deprication'];
$date = $_POST['date'];
$asset_type = $_POST['asset_type'];

$sql = 'INSERT INTO asset_in (`AssetId`, `Description`, `Brand`, `Asset_Type`, `Price`, `Deprication_Rate`, `Date`) VALUES ('.$name.', "'.$description.'", "'.$brand.'", "'.$asset_type.'", "'.$price.'", "'.$deprication.'", "'.$date.'")';
$result = mysqli_query($conn, $sql);

if($result){

    echo '<script>alert("Your Form Has been Submitted!");window.open("AssetIn.php", "_self");</script>'; 
    
    // header('Location: AddParty.php');
}
else{
    echo $sql;
}

?>