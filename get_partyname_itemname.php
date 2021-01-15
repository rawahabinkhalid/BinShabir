<?php
include_once('conn.php');

$sql = 'SELECT * FROM `contract` WHERE ContractNo = '.$_POST['contractno'];
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

if ($row['ContractType'] == 'Debtor/AccountReceivable/Sales') {
    $sql = 'SELECT *, SaleCustomerName AS PartyName FROM `debtor` WHERE ContractNo =' . $_POST['contractno'];
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

} else if ($row['ContractType'] == 'Creditor/AccountPayable/Purchase') {
    $sql = 'SELECT *, PurchaseSupplierName AS PartyName FROM `creditor` WHERE ContractNo =' . $_POST['contractno'];
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

} else if ($row['ContractType'] == 'Sales') {
    $sql = 'SELECT *, SaleCustomerName AS PartyName FROM `toolmillcontract` WHERE ContractNo =' . $_POST['contractno'];
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

}

echo json_encode($row);
