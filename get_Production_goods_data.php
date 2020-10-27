<?php
include_once("conn.php");

$sql = 'SELECT SUM(CAST(NWeight AS DECIMAL(9,2))) AS totalgoods_nweight FROM production_goods WHERE ContractNo = "'.$_POST['contractno'].'" GROUP BY ContractNo';
$result = mysqli_query($conn, $sql);

if($result->num_rows>0){
 echo $result->fetch_assoc()['totalgoods_nweight'];
}
else{
    echo $sql;
}


?>