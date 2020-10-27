<?php
include_once('conn.php');

$sql = 'INSERT INTO otherexpense (`Description`,`Date`,`Amount`) VALUES ("'.$_POST['description'].'","'.$_POST['date'].'","'.$_POST['amount'].'") ';
$result = mysqli_query($conn,$sql);

if($result){

    $sql1 = 'INSERT INTO overallloss (`Description`,`Date`,`Amount`) VALUES ("OtherExpnse '.$_POST['description'].'","'.$_POST['date'].'","'.$_POST['amount'].'") ';  
    $result1 = mysqli_query($conn,$sql1);

    echo '<script>alert("Your Form Has been Submitted!");window.open("OtherExpense.php", "_self");</script>'; 
}
else {
    echo $sql;
}




?>