<?php
include_once('conn.php');

$GINNo = $_POST['GINNo'];
$NameOfConsignee = $_POST['nameofconsignee'];
$VehicleNo = $_POST['VehicleNo'];
$VehicleType = $_POST['VehicleType'];
$ContainerNo = $_POST['ContainerNo'];
$SealNo = $_POST['SealNo'];

// $Items = $_POST['Items'];
// $Description = $_POST['Description'];
// $LabNo = $_POST['LabNo'];
// $Packsize = $_POST['Packsize'];
// $Quantity = $_POST['Quantity'];
// $Weight = $_POST['Weight'];

$sql = 'INSERT INTO gatepass_g_issue (`GIN_No`,`NameOfConsignee`,`VehicleNo`,`VehicleType`,`ContainerNo`,`SealNo`) VALUES ("'.$GINNo.'","'.$NameOfConsignee.'","'.$VehicleNo.'","'.$VehicleType.'","'.$ContainerNo.'","'.$SealNo.'")';
$result = mysqli_query($conn, $sql);

if($result){

    $GoodIssueId = mysqli_insert_id($conn);

     for($i = 0; $i < count($_POST['Items']); $i++) {
        $sql1 = "INSERT INTO gatepass_g_issue_items (`GoodIssueId`,`Items`,`Description`,`LabNo`,`Packsize`,`Quantity`,`Weight`)
                            VALUES (".$GoodIssueId.",'".$_POST['Items'][$i]."','".$_POST['Description'][$i]."','".$_POST['LabNo'][$i]."','".$_POST['Packsize'][$i]."','".$_POST['Quantity'][$i]."','".$_POST['Weight'][$i]."')";
        $result1 = mysqli_query($conn,$sql1);
    }
    if($result1){

        echo '<script>alert("Your Form Has been Submitted!");window.open("GatePass_GoodIssue.php", "_self");</script>'; 

        // header('Location: GatePass_GoodIssue.php');
    }
    else{
        echo $sql1;
    }
}
else{
    echo $sql;
}
?>