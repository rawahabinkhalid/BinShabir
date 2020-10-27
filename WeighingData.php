<?php
include_once('conn.php');

$json = new \StdClass;

$sql = 'SELECT `Quality` FROM makecontract WHERE `ContractNo` ='.$_POST['ContractNo'];
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$json->quality = $row['Quality'];

$sql = 'SELECT `Variety` FROM makecontract WHERE `ContractNo` ='.$_POST['ContractNo'];
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$json->variety = $row['Variety'];

echo json_encode($json);
?>