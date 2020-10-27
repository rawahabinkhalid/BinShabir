<?php
include_once 'conn.php';



for ($i = 0; $i < count($_POST['date']); $i++) {
    $sql1 = "INSERT INTO bilty_bill (`Date`,`Reference_Name`,`Bill_No`,`Reference_Contact`,`Amount_Received`)
                            VALUES ( '".$_POST['date'][$i]."','".$_POST['referencename'][$i] ."','".$_POST['billno'][$i]."','".$_POST['referencecontract'][$i]."','".$_POST['totalamountreceived'][$i]."')";
    $result1 = mysqli_query($conn, $sql1);

    // Over All Profit Calculate krne ke liye ye kaam kiya ha
    $sql2 = "INSERT INTO overallprofit (`Description`,`Date`,`Amount`) VALUES ('BiltyBills','".$_POST['date'][$i]."','".$_POST['totalamountreceived'][$i]."') ";
    $result2 = mysqli_query($conn,$sql2);
}

echo '<script>alert("Your Form Has been Submitted!");window.open("BiltyBills.php", "_self");</script>';
?>