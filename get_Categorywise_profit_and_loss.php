<?php
include_once('conn.php');

$yearFilter = $_POST['yearFilter'] . '-';
$monthFilter = '';
if(isset($_POST['monthFilter']))
    $monthFilter = $_POST['monthFilter'] . '-';
$dateLike = $yearFilter . $monthFilter;

// INCOME  
$totalWeighbridge = 0;
$sql1 = 'SELECT *, SUM(Amount) FROM overallprofit WHERE `Description` = "WeighBridge" AND DefaultDate LIKE "' . $dateLike . '%"';
$result1 = mysqli_query($conn,$sql1);
while($row1 = mysqli_fetch_assoc($result1)){
    $totalWeighbridge = floatval($totalWeighbridge) + floatval($row1['SUM(Amount)']);
}

$totalBiltybills = 0;
$sql2 = 'SELECT *, SUM(Amount) FROM overallprofit WHERE `Description` = "BiltyBills" AND DefaultDate LIKE "' . $dateLike . '%"';
$result2 = mysqli_query($conn,$sql2);
while($row2 = mysqli_fetch_assoc($result2)){
    $totalBiltybills = floatval($totalBiltybills) + floatval($row2['SUM(Amount)']);
}

$totalToolmillingProcessing = 0;
$sql3 = 'SELECT *, SUM(Amount) FROM overallprofit WHERE `Description` = "Tool Milling" AND DefaultDate LIKE "' . $dateLike . '%"';
$result3 = mysqli_query($conn,$sql3);
while($row3 = mysqli_fetch_assoc($result3)){
    $totalToolmillingProcessing = floatval($totalToolmillingProcessing) + floatval($row3['SUM(Amount)']);
}

$totalSelfManufacturingIncome = 0;
$sql4 = 'SELECT *, SUM(Amount) FROM overallprofit WHERE `Description` = "SM Income" AND DefaultDate LIKE "' . $dateLike . '%"';
$result4 = mysqli_query($conn,$sql4);
while($row4 = mysqli_fetch_assoc($result4)){
    $totalSelfManufacturingIncome = floatval($totalSelfManufacturingIncome) + floatval($row4['SUM(Amount)']);
}

// EXPENSE
$totalOtherexpense = 0;
$sql5 = 'SELECT *, SUM(Amount) FROM overallloss WHERE `Description` = "OtherExpnse" AND DefaultDate LIKE "' . $dateLike . '%"';
$result5 = mysqli_query($conn,$sql5);
while($row5 = mysqli_fetch_assoc($result5)){
    $totalOtherexpense = floatval($totalOtherexpense) + floatval($row5['SUM(Amount)']);
}

$totalToolmillingLabour = 0;
$sql6 = 'SELECT *, SUM(Amount) FROM overallloss WHERE `Description` = "Tool Milling" AND DefaultDate LIKE "' . $dateLike . '%"';
$result6 = mysqli_query($conn,$sql6);
while($row6 = mysqli_fetch_assoc($result6)){
    $totalToolmillingLabour = floatval($totalToolmillingLabour) + floatval($row6['SUM(Amount)']);
}

$totalSelfManufacturingExpense = 0;
$sql7 = 'SELECT *, SUM(Amount) FROM overallloss WHERE `Description` = "SM Expense" AND DefaultDate LIKE "' . $dateLike . '%"';
$result7 = mysqli_query($conn,$sql7);
while($row7 = mysqli_fetch_assoc($result7)){
    $totalSelfManufacturingExpense = floatval($totalSelfManufacturingExpense) + floatval($row7['SUM(Amount)']);
}

$data = new \StdClass;
$data->totalWeighbridge = $totalWeighbridge;
$data->totalBiltybills = $totalBiltybills;
$data->totalToolmillingProcessing = $totalToolmillingProcessing;
$data->totalSelfManufacturingIncome = $totalSelfManufacturingIncome;
$data->masterTotalIncome = $totalWeighbridge + $totalBiltybills + $totalToolmillingProcessing + $totalSelfManufacturingIncome;

$data->totalOtherexpense = $totalOtherexpense;
$data->totalToolmillingLabour = $totalToolmillingLabour;
$data->totalSelfManufacturingExpense = $totalSelfManufacturingExpense;
$data->masterTotalExpense = $totalOtherexpense + $totalToolmillingLabour + $totalSelfManufacturingExpense;

// $data->sql = $sql;
// $data->sql1 = $sql1;

echo json_encode($data);
?>