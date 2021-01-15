<?php
include_once('conn.php');

$count = 1;

$data_tbody = '';
$data_tfoot = '';
$grossweight = 0;
$bardanaweight = 0;
$totalBags = 0;

$data_tbody1 = '';
$data_tfoot1 = '';
$dischargeweight = 0;
$estimatedshortage = 0;
$m_totalBags = 0;

$data_tbody2 = '';
$data_tfoot2 = '';
$totalbillamount = 0;

$sql = 'SELECT * FROM production_goods WHERE ContractNo = "' . $_POST['contractno'] . '" ';
$result = mysqli_query($conn, $sql);

//GOODS RECIEVED FOR MILLING TABLE

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $data_tbody .= '
            <tr>
                <td scope="row"><b>' . $count++ . '</b></td>
                <td>' . $row['Date'] . '</td>
                <td>' . $row['GRN'] . '</td>
                <td>' . $row['Vehicle'] . '</td>
                <td>' . $row['ItemName'] . '</td>
                <td>' . $row['Bags'] . '</td>
                <td>' . $row['Packing'] . '</td>
                <td>' . $row['NWeight'] . '</td>
            </tr>';

        $grossweight = floatval($grossweight) + floatval($row['NWeight']);
        $bardanaweight = floatval($bardanaweight) + floatval($row['BardanaWeight']);
        $totalBags = floatval($totalBags) + floatval($row['Bags']);
    }
    $data_tfoot .= '
        <tr>
            <td scope="row" colspan="5"><b>Gross Weight</b></td>
            <td></td>
            <td></td>
            <td>' . $grossweight . '</td>
        </tr>
        <tr>
            <td scope="row" colspan="5"><b>Less: Bardana Weight</b></td>
            <td></td>
            <td></td>
            <td>' . $bardanaweight . '</td>
        </tr>
        <tr>
            <td scope="row" colspan="5"><b>Net Weight Processed</b></td>
            <td>' . $totalBags . '</td>
            <td></td>
            <td>' . ($grossweight - $bardanaweight) . '</td>
        </tr>';

    $jsonObj = new \StdClass;
    $jsonObj->tbody = $data_tbody;
    $jsonObj->tfoot = $data_tfoot;
    // echo json_encode($jsonObj);
}

// MILLING DETAILS TABLE
$percentage = 0;

$sql1 = 'SELECT * FROM production_milling WHERE ContractNo = "' . $_POST['contractno'] . '" ';
$result1 = mysqli_query($conn, $sql1);

if (mysqli_num_rows($result1) > 0) {
    while ($row1 = mysqli_fetch_assoc($result1)) {

        $percentage_temp = $row1['M_NWeight'] / ($grossweight - $bardanaweight) * 100;
        $data_tbody1 .= '
            <tr>
                <td>' . $row1['M_ItemName'] . '</td>
                <td>' . $row1['M_Description'] . '</td>
                <td>' . number_format(floatval($percentage_temp), 2) . '</td>
                <td>' . $row1['M_Bags'] . '</td>
                <td>' . $row1['M_KG'] . '</td>
                <td>' . $row1['M_NWeight'] . '</td>
            </tr>';

        $percentage = floatval($percentage) + floatval($percentage_temp);

        $dischargeweight = floatval($dischargeweight) + floatval($row1['M_NWeight']);
        $estimatedshortage = floatval(($grossweight - $bardanaweight) - $dischargeweight);
        $m_totalBags = floatval($m_totalBags) + floatval($row1['M_Bags']);
    }
    $data_tfoot1 .= '
        <tr>
            <td scope="row" colspan="2"><b>Total Discharge Weight</b></td>
            <td></td>
            <td></td>
            <td></td>
            <td>' . $dischargeweight . '</td>
        </tr>
        <tr>
            <td scope="row" colspan="2"><b>Estimated Shortage</b></td>
            <td>' . number_format((100 - $percentage), 2) . '%</td>
            <td></td>
            <td></td>
            <td>' . $estimatedshortage . '</td>
        </tr>
        <tr>
            <td scope="row" colspan="2"></td>
            <td>100%</td>
            <td>' . $m_totalBags . '</td>
            <td></td>
            <td>' . ($dischargeweight + $estimatedshortage) . '</td>
        </tr>';

    $jsonObj->tbody1 = $data_tbody1;
    $jsonObj->tfoot1 = $data_tfoot1;
}


// MILLING BILL TABLE
$sql2 = 'SELECT * FROM toolmilling JOIN toolmilling_description ON toolmilling.Id = toolmilling_description.ToolMilling_Id WHERE ContractNo = "' . $_POST['contractno'] . '" ';
// echo $sql2;
$result2 = mysqli_query($conn, $sql2);

if (mysqli_num_rows($result2) > 0) {
    while ($row2 = mysqli_fetch_assoc($result2)) {

        $data_tbody2 .= '
            <tr>
                <td scope="row"><b>' . $count++ . '</b></td>
                <td>' . $row2['Head'] . '</td>
                <td>' . $row2['Description'] . '</td>
                <td>' . $row2['Weight'] . '</td>
                <td>' . $row2['Unit'] . '</td>
                <td>' . $row2['Rate'] . '</td>
                <td>' . $row2['Amount'] . '</td>
            </tr>';

        $totalbillamount = floatval($totalbillamount) + floatval($row2['Amount']);
    }

    $data_tfoot2 .= '
        <tr>
            <td scope="row" colspan="6"><b>Total Bill Amount</b></td>
            <td>' . number_format(($totalbillamount), 2) . '</td>
        </tr>';

    $jsonObj->tbody2 = $data_tbody2;
    $jsonObj->tfoot2 = $data_tfoot2;
}
echo json_encode($jsonObj);
