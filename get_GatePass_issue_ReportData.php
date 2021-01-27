<?php
include_once('conn.php');

$count = 1;
$data_tbody = '';
$data_tfoot = '';
$totalweight = 0;

$nameofconsignee = '';
$vehicleno = '';
$vehicletype = '';
$containerno = '';
$sealno = '';

$sql = 'SELECT * FROM gatepass_g_issue JOIN gatepass_g_issue_items ON gatepass_g_issue.Id = gatepass_g_issue_items.GoodIssueId WHERE GIN_No = "'.$_POST['GIN_NO'].'" ';
// echo $sql;
$result = mysqli_query($conn, $sql);

//GOODS ISSUE NOTE TABLE

if(mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)){
        
        $nameofconsignee = $row['NameOfConsignee'];
        $vehicleno = $row['VehicleNo'];
        $vehicletype = $row['VehicleType'];
        $containerno = $row['ContainerNo'];
        $sealno = $row['SealNo'];

        $data_tbody .= '
            <tr>
                <td>'.$count++.'</td>
                <td>'.$row['Items'].'</td>
                <td>'.$row['Description'].'</td>
                <td>'.$row['Packsize'].'</td>
                <td>'.$row['Quantity'].'</td>
                <td>'.$row['Weight'].'</td>
            </tr>';

        $totalweight = floatval($totalweight) + floatval($row['Weight']);
    }
    $data_tfoot .= '
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td><b>Total Weight</b></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>'.$totalweight.'</td>
        </tr>';
        
    $jsonObj = new \StdClass;        
    $jsonObj->tbody = $data_tbody;
    $jsonObj->tfoot = $data_tfoot;
    
    $jsonObj->nameofconsignee = $nameofconsignee;
    $jsonObj->vehicleno = $vehicleno;
    $jsonObj->vehicletype = $vehicletype;
    $jsonObj->containerno = $containerno;
    $jsonObj->sealno = $sealno;
    
    echo json_encode($jsonObj);
}

?>