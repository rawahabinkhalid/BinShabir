<?php
include_once('conn.php');

$sql = 'SELECT * FROM makecontract WHERE ContractNo ='.$_POST['contractno'] ;
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);

echo json_encode($row);
?>