<?php
include_once 'conn.php';

for ($i = 0; $i < count($_POST['date']); $i++) {
    $sql1 =
        "INSERT INTO bilty_bill (`Date`,`Reference_Name`,`Bill_No`,`Reference_Contact`,`Amount_Received`)
                            VALUES ( '" .
        $_POST['date'][$i] .
        "','" .
        $_POST['referencename'][$i] .
        "','" .
        $_POST['billno'][$i] .
        "','" .
        $_POST['referencecontract'][$i] .
        "','" .
        $_POST['totalamountreceived'][$i] .
        "')";
    $result1 = mysqli_query($conn, $sql1);
    // if(!$result1)
    //     echo $conn->error;
}

echo '<script>alert("Your Form Has been Submitted!");window.open("BiltyBills.php", "_self");</script>';
?>