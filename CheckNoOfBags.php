<?php
include_once('conn.php');

// $sqlcheck = 'SELECT weighing.Id, ContractNo, WeighingId, SUM(Bags) as bags FROM weighing_description_receiving JOIN weighing ON weighing.Id = weighing_description_receiving.WeighingId WHERE ContractNo = '.$_POST['ContractId'];

$sqlcheck = 'SELECT * FROM contract_wise_totalbags WHERE ContractNo = '.$_POST['ContractId'] ;
$result = mysqli_query($conn, $sqlcheck);
$row = mysqli_fetch_assoc($result);
if ($result){
    // echo $row['bags'];
    echo $row['TotalBags'];
}
else{
echo $sqlcheck;
}


?>