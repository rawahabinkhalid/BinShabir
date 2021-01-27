<?php
include_once('conn.php');

$jsonObj = new \StdClass;  
$jsonObj->NWeight = 0;
$jsonObj->BardanaWeight = 0;

$sql = 'SELECT SUM(NWeight), SUM(BardanaWeight) FROM production_goods WHERE ContractNo = "'.$_POST['contractno'].'"  GROUP BY ContractNo';
// echo $sql;
$result = mysqli_query($conn, $sql);
if($result->num_rows > 0) {
    $row = mysqli_fetch_assoc($result);

    $SUM_NWeight = $row['SUM(NWeight)'];
    $SUM_BardanaWeight = $row['SUM(BardanaWeight)'];

    $jsonObj->NWeight = $SUM_NWeight;
    $jsonObj->BardanaWeight = $SUM_BardanaWeight;
}
echo json_encode($jsonObj);
?>