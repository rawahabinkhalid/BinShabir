<?php
include_once('conn.php');


$sql = 'SELECT VehicleNo FROM gatepass_g_recieved WHERE GRN_No = "'.$_POST['grnno'].'"';
// echo $sql;
$result = mysqli_query($conn, $sql);
if($result->num_rows > 0) {
    $row = mysqli_fetch_assoc($result);
        $VehicleNo = $row['VehicleNo'];
}

echo json_encode($VehicleNo);

?>