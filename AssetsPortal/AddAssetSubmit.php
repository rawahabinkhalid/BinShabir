<?php
include_once('conn.php');

$name = $_POST['name'];

$sql = 'INSERT INTO asset (`AssetName`) VALUES ("'.$name.'")';
$result = mysqli_query($conn, $sql);

if($result){

    echo '<script>alert("Your Form Has been Submitted!");window.open("AddAsset.php", "_self");</script>'; 
    
    // header('Location: AddParty.php');
}
else{
    echo $sql;
}

?>