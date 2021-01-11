<?php
include_once('conn.php');

$productionno = $_POST['productionNo'];

// $description = $_POST['description'];
// $date = $_POST['date'];
// $amount = $_POST['amount'];

// Edit Expense 
$sqlSelect = 'SELECT * FROM expense WHERE Id = '.$productionno;
$resultSelect = $conn->query($sqlSelect);

if(mysqli_num_rows($resultSelect) > 0 ){
    for($i = 0; $i < count($_POST['description']); $i++) {
        $sql1 = "INSERT INTO expense_description (`ExpenseId`,`Description`,`Date`,`Amount`)
                            VALUES (".$productionno.",'".$_POST['description'][$i]."','".$_POST['date'][$i]."','".$_POST['amount'][$i]."')";
        $result1 = mysqli_query($conn,$sql1);

        $sql2 = "INSERT INTO overallloss (`Description`,`Date`,`Amount`) VALUES ('SM Expense','".$_POST['date'][$i]."','".$_POST['amount'][$i]."') ";
        $result2 = mysqli_query($conn,$sql2);
    }
        echo '<script>alert("Your Form Has been Submitted!");window.open("EditExpense.php", "_self");</script>';   
} 

else{
    // Expense
    $sql = 'INSERT INTO expense (`ProductionNo`) VALUES ("'.$productionno.'")';
    $result = mysqli_query($conn, $sql);
    
    if($result){
        
        $ExpenseId = mysqli_insert_id($conn);
    
        for($i = 0; $i < count($_POST['description']); $i++) {
            $sql1 = "INSERT INTO expense_description (`ExpenseId`,`Description`,`Date`,`Amount`)
                                VALUES (".$ExpenseId.",'".$_POST['description'][$i]."','".$_POST['date'][$i]."','".$_POST['amount'][$i]."')";
            $result1 = mysqli_query($conn,$sql1);

            $sql2 = "INSERT INTO overallloss (`Description`,`Date`,`Amount`) VALUES ('OP Expense','".$_POST['date'][$i]."','".$_POST['amount'][$i]."') ";
            $result2 = mysqli_query($conn,$sql2);
        }
        
        echo '<script>alert("Your Form Has been Submitted!");window.open("Expense.php", "_self");</script>'; 
    }
    else{
        echo $sql;
    }
}


?>