<?php
include_once('conn.php');

$productionno = $_POST['productionNo'];

// $description = $_POST['description'];
// $date = $_POST['date'];
// $amount = $_POST['amount'];

$sql = 'INSERT INTO income (`ProductionNo`) VALUES ("'.$productionno.'")';
$result = mysqli_query($conn, $sql);

if($result){
    
    $IncomeId = mysqli_insert_id($conn);

    for($i = 0; $i < count($_POST['description']); $i++) {
        $sql1 = "INSERT INTO income_description (`IncomeId`,`Description`,`Date`,`Amount`)
                            VALUES (".$IncomeId.",'".$_POST['description'][$i]."','".$_POST['date'][$i]."','".$_POST['amount'][$i]."')";
        $result1 = mysqli_query($conn,$sql1);
    }
    
    echo '<script>alert("Your Form Has been Submitted!");window.open("Income.php", "_self");</script>'; 
}
else{
    echo $sql;
}

?>