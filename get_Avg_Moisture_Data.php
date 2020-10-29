<?php
include_once('conn.php');

$count = 1;

$data_tbody = '';
$data_tfoot = '';
$totalmoisture = 0;

$sql = 'SELECT * FROM gatepass_g_recieved WHERE ContractNo = "'.$_POST['contractno'].'" ';
$result = mysqli_query($conn, $sql);

//AVERAGE MOISTURE TABLE

if(mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)){
        $data_tbody .= '
            <tr>
                <td scope="row"><b>'.$count++.'</b></td>
                <td>'.$row['GRN_No'].'</td>
                <td>'.$row['Date'].'</td>
                <td>'.$row['Moisture'].'</td>
            </tr>';

        $totalmoisture = floatval($totalmoisture) + floatval($row['Moisture']);
        $averagemoisture = floatval($totalmoisture) / ($count - 1);
    }
    $data_tfoot .= '
        <tr>
            <td scope="row" colspan="3"><b>Total Moisture is :</b></td>
            <td>'.number_format(floatval($totalmoisture), 2).'</td>
        </tr>
        <tr>
            <td scope="row" colspan="3"><b>Average Moisture is :</b></td>
            <td>'.number_format(floatval($averagemoisture), 2).'</td>
        </tr>';
        
    $jsonObj = new \StdClass;        
    $jsonObj->tbody = $data_tbody;
    $jsonObj->tfoot = $data_tfoot;
    // echo json_encode($jsonObj);
}
    echo json_encode($jsonObj);

?>