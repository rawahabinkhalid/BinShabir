<?php
// include_once('conn.php');

// $json = new \StdClass;

// $sql = 'SELECT `Quality` FROM makecontract WHERE `ContractNo` ='.$_POST['ContractNo'];
// $result = mysqli_query($conn, $sql);
// $row = mysqli_fetch_assoc($result);
// $json->quality = $row['Quality'];

// $sql = 'SELECT `Variety` FROM makecontract WHERE `ContractNo` ='.$_POST['ContractNo'];
// $result = mysqli_query($conn, $sql);
// $row = mysqli_fetch_assoc($result);
// $json->variety = $row['Variety'];

// echo json_encode($json);

include_once('conn.php');

$sql = 'SELECT * FROM `contract` WHERE ContractNo = '.$_POST['contractno'];
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

if ($row['ContractType'] == 'Debtor/AccountReceivable/Sales') {
    $sql = 'SELECT * FROM `debtor` WHERE ContractNo =' . $_POST['contractno'];
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

} else if ($row['ContractType'] == 'Creditor/AccountPayable/Purchase') {
    $sql = 'SELECT * FROM `creditor` WHERE ContractNo =' . $_POST['contractno'];
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

} else if ($row['ContractType'] == 'Sales') {
    $sql = 'SELECT * FROM `toolmillcontract` WHERE ContractNo =' . $_POST['contractno'];
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

}

echo json_encode($row);
?>