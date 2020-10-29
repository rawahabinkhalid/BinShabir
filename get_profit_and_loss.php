<?php
include_once('conn.php');

$yearFilter = $_POST['yearFilter'] . '-';
$monthFilter = '';
if(isset($_POST['monthFilter']))
    $monthFilter = $_POST['monthFilter'] . '-';
$dateLike = $yearFilter . $monthFilter;

$totalIncome = 0;
$count = 1;
$sql = 'SELECT *, SUM(Amount) FROM overallprofit WHERE DefaultDate LIKE "' . $dateLike . '%"';

$result = mysqli_query($conn,$sql);
while($row = mysqli_fetch_assoc($result)){
    $totalIncome = floatval($totalIncome) + floatval($row['SUM(Amount)']);
}

$totalExpense = 0;
$count = 1;
$sql1 = 'SELECT *, SUM(Amount) FROM overallloss WHERE DefaultDate LIKE "' . $dateLike . '%"';
$result = mysqli_query($conn,$sql1);
while($row = mysqli_fetch_assoc($result)){
    $totalExpense = floatval($totalExpense) + floatval($row['SUM(Amount)']);
}

$data = new \StdClass;
$data->totalIncome = $totalIncome;
$data->totalExpense = $totalExpense;
// $data->sql = $sql;
// $data->sql1 = $sql1;

echo json_encode($data);
?>