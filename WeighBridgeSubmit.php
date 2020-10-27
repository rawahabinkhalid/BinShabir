<?php
include_once 'conn.php';

for ($i = 0; $i < count($_POST['date']); $i++) {
    $sql1 =
        "INSERT INTO weigh_bridge (`Date`,`Truck`,`Weight`,`Rate`,`Amount`)
                            VALUES ( '" .
        $_POST['date'][$i] .
        "','" .
        $_POST['truck'][$i] .
        "','" .
        $_POST['weight'][$i] .
        "','" .
        $_POST['rate'][$i] .
        "','" .
        $_POST['amount'][$i] .
        "')";
    $result1 = mysqli_query($conn, $sql1);
}

echo '<script>alert("Your Form Has been Submitted!");window.open("Weighbridge.php", "_self");</script>';
?>
