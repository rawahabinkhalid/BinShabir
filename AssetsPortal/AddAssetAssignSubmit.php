<?php
include_once 'conn.php';

$name = $_POST['name'];
$assigned_date = $_POST['assigned_date'];
$department = $_POST['department'];
$assigned_to = $_POST['assigned_to'];
$qty = $_POST['qty'];

$sql =
    'INSERT INTO asset_assign (`AssetInId`, `AssignedQty`, `Date`, `Department`, `Assigned_To`) VALUES (' .
    $name .
    ', ' .
    $qty .
    ', "' .
    $assigned_date .
    '", "' .
    $department .
    '", "' .
    $assigned_to .
    '")';
$result = mysqli_query($conn, $sql);

if ($result) {
    echo '<script>alert("Your Form Has been Submitted!");window.open("AssetAssign.php", "_self");</script>';

    // header('Location: AddParty.php');
} else {
    echo $sql;
}

?>
