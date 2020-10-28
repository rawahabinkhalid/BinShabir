<?php
include_once 'conn.php';

$yearFilter = $_POST['yearFilter'];
$monthFilter = '';
if (isset($_POST['monthFilter'])) {
    $monthFilter = $_POST['monthFilter'] . '-';
}
$dateLike = $yearFilter . '-' . $monthFilter;
$count = 1;
$sql =
    'SELECT asset.*, asset_in.*, asset_in.Date AS AssetInDate, asset_assign.Date AS AssetAssignDate, Department, Assigned_To, asset_in.Id AS asset_in_id FROM asset JOIN asset_in ON asset_in.AssetId = asset.AssetId LEFT JOIN asset_assign ON asset_in.Id = asset_assign.AssetInId WHERE asset_in.Date LIKE "' .
    $dateLike .
    '%" GROUP BY asset_in.Id';
// echo $sql;
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {
    echo '
                                    <tr>
                                        <td scope="row"><b>' .
        $count++ .
        '</b></td>
                                        <td>' .
        $row['AssetName'] .
        '</td>
                                        <td>' .
        $row['Description'] .
        '</td>
                                        <td>' .
        date('d-M-Y', strtotime($row['AssetInDate'])) .
        '</td>
                                        <td>' .
        $row['AssetQty'] .
        '</td>
                                        <td>' .
        $row['Brand'] .
        '</td>
                                        <td>' .
        $row['Asset_Type'] .
        '</td>
                                        <td>Rs. ' .
        number_format(floatval($row['Price']), 2) .
        '</td>
                                        <td>';
    if ($row['Asset_Type'] == 'Fixed') {
        echo $row['Deprication_Rate'] . ' %';
    }
    echo '</td>
                                        <td style="display: none;">';
    if ($row['Asset_Type'] == 'Fixed') {
        $depreciation = 0;
        $price = floatval($row['Price']);
        $rate = floatval($row['Deprication_Rate']) / 100;
        $now = time(); // or your date as well
        $your_date = strtotime($row['Date']);
        $datediff = $now - $your_date;

        $daysPassed = floor($datediff / (60 * 60 * 24));
        echo (($price * $rate) / 365) * $daysPassed;
    }
    echo '</td>
                                        <td>';
    echo 'Rs. ' . number_format((($price * $rate) / 365) * $daysPassed, 2);
    echo '</td>
                                        <td>';
    echo 'Rs. ' .
        number_format($price - (($price * $rate) / 365) * $daysPassed, 2);
    echo '</td>
                                    <td style="display: none;">';
    echo $price - (($price * $rate) / 365) * $daysPassed;

    echo '</td>
                                    </tr>';
}
?>
