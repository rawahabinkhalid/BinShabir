<?php
include_once('conn.php');

$count = 1;
$data_tbody = '';
$data_tfoot = '';
$totalweight = 0;

$party_name = '';
$date = '';
$timein = '';
$vehicleno = '';

$sql = 'SELECT * FROM gatepass_g_recieved JOIN gatepass_g_recieved_items ON gatepass_g_recieved.Id = gatepass_g_recieved_items.GoodReceivedId WHERE ContractNo = "'.$_POST['Contract_No'].'" ';
$result = mysqli_query($conn, $sql);

//GOODS RECIEVED NOTE TABLE

if(mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)){
        
        $contract_no = $row['ContractNo'];
        $party_name = $row['PartyName'];
        $date = $row['Date'];
        $timein = $row['TimeIn'];
        $vehicleno = $row['VehicleNo'];

        $data_tbody .= '
            <tr>
                <td scope="row"><b>'.$count++.'</b></td>
                <td>'.$row['GRN_No'].'</td>
                <td>'.$row['Items'].'</td>
                <td>'.$row['Description'].'</td>
                <td>'.$row['Packsize'].'</td>
                <td>'.$row['Quantity'].'</td>
                <td>'.$row['ExWeight'].'</td>
                <td>'.$row['Weight'].'</td>
            </tr>';

        $totalweight = floatval($totalweight) + floatval($row['Weight']);
    }
        $data_tfoot .= '
            <tr>
                <td scope="row" colspan="1"></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td><b>Total Weight</b></td>
            </tr>
            <tr>
                <td scope="row" colspan="1"></td>
                <td></td>
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
    
    $jsonObj->contract_no = $contract_no;
    $jsonObj->party_name = $party_name;
    $jsonObj->date = $date;
    $jsonObj->timein = $timein;
    $jsonObj->vehicleno = $vehicleno;
    
    echo json_encode($jsonObj);
}

?>