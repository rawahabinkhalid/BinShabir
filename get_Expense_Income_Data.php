<?php
include_once('conn.php');

$count = 1;
$data_tbody = '';
$data_tfoot = '';
$totalexpenxe = 0;

$count1 = 1;
$data_tbody1 = '';
$data_tfoot1 = '';
$totalincome = 0;

$sql = 'SELECT * FROM expense JOIN expense_description ON expense.Id = expense_description.ExpenseId WHERE ProductionNo = "'.$_POST['productionno'].'" ';
$result = mysqli_query($conn, $sql);

//EXPENSE DETAILS TABLE

if(mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)){
        $data_tbody .= '
            <tr>
                <td scope="row"><b>'.$count++.'</b></td>
                <td>'.$row['ProductionNo'].'</td>
                <td>'.$row['Description'].'</td>
                <td>'.$row['Date'].'</td>
                <td>'.$row['Amount'].'</td>
            </tr>';
            
        $totalexpenxe = floatval($totalexpenxe) + floatval($row['Amount']);
    }
    $data_tfoot .= '
        <tr>
            <td scope="row" colspan="4" class="text-center"><b>Total Expense</b></td>
            <td>'.number_format(($totalexpenxe), 2).'</td>
        </tr>';
        
    $jsonObj = new \StdClass;        
    $jsonObj->tbody = $data_tbody;
    $jsonObj->tfoot = $data_tfoot;
    // echo json_encode($jsonObj);
}

//INCOME DETAILS TABLE
$sql1 = 'SELECT * FROM income JOIN income_description ON income.Id = income_description.IncomeId WHERE ProductionNo = "'.$_POST['productionno'].'" ';

$result1 = mysqli_query($conn, $sql1);

if(mysqli_num_rows($result1) > 0) {
    while($row1 = mysqli_fetch_assoc($result1)){

        $data_tbody1 .= '
            <tr>
                <td scope="row"><b>'.$count1++.'</b></td>
                <td>'.$row1['ProductionNo'].'</td>
                <td>'.$row1['Description'].'</td>
                <td>'.$row1['Date'].'</td>
                <td>'.$row1['Amount'].'</td>
            </tr>';

        $totalincome = floatval($totalincome) + floatval($row1['Amount']);
    }
    $data_tfoot1 .= '
        <tr>
            <td scope="row" colspan="4" class="text-center"><b>Total Income</b></td>
            <td>'.number_format(($totalincome), 2).'</td>
        </tr>';
        
    $jsonObj->tbody1 = $data_tbody1;
    $jsonObj->tfoot1 = $data_tfoot1;
}
    echo json_encode($jsonObj);

?>