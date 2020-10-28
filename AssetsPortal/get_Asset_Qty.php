<?php
include_once 'conn.php';

$asset_id = $_POST['asset_id'];
$qty = 0;
// $sqlSelect = 'SELECT * FROM asset_in WHERE Id = ' . $asset_id;
// $resultSelect = mysqli_query($conn, $sqlSelect);

// if ($resultSelect->num_rows > 0) {
//     $rowSelect = $resultSelect->fetch_assoc();

$sql =
    'SELECT SUM(AssetQty) AS RecvdQty FROM asset JOIN asset_in ON asset_in.AssetId = asset.AssetId WHERE asset_in.Id = ' .
    $asset_id .
    ' GROUP BY asset_in.Id';
// echo $sql;
$result = mysqli_query($conn, $sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $qty = $row['RecvdQty'];
    $sqlOut =
        'SELECT SUM(AssignedQty) AS AssignedQty FROM asset JOIN asset_in ON asset_in.AssetId = asset.AssetId JOIN asset_assign ON asset_assign.AssetInId = asset_in.Id WHERE asset_in.Id = ' .
        $asset_id .
        ' GROUP BY asset_in.Id';
    // echo $sqlOut;
    $resultOut = mysqli_query($conn, $sqlOut);

    if ($resultOut->num_rows > 0) {
        $rowOut = $resultOut->fetch_assoc();
        $qty = floatval($qty) - floatval($rowOut['AssignedQty']);
    }
}
// }
echo $qty;
?>
