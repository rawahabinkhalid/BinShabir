<?php
include_once 'conn.php';

$contractno = $_POST['contractno'];
$extenddate = $_POST['extenddate'];
$packing = $_POST['packing'];
$polishing = $_POST['polishing'];
$broken = $_POST['broken'];
$extendQty = $_POST['extendQty'];
$brand = $_POST['brand'];
$prodOrder = $_POST['prodOrder'];

$sql =
    'INSERT INTO extendcontract (`ContractId`,`ExtendDate`,`Packing`,`Polishing`,`Broken`,`ExtendQty`,`Brand`,
                            `ProdOrderNo`) VALUES ("'.$contractno.'","'.$extenddate.'","'.$packing.'",
                                                   "'.$polishing.'","'.$broken.'","'.$extendQty.'",
                                                   "'.$brand.'","'.$prodOrder.'")';
$result = mysqli_query($conn, $sql);

if ($result) {
    echo '<script>alert("Your Form Has been Submitted!");window.open("ExtendContracts.php", "_self");</script>';

    // header('Location: MakeContract.php');
} else {
    echo $sql;
}

?>