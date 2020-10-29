<?php
include_once('conn.php');

$contractno = $_POST['contractno'];
$GRNNo = $_POST['GRNNo'];
$partyname = $_POST['partyname'];
$date = $_POST['date'];
$timein = $_POST['timein'];
$vehicleNo = $_POST['vehicleNo'];

$chalky = $_POST['chalky'];
$b1 = $_POST['b1'];
$b2 = $_POST['b2'];
$b3 = $_POST['b3'];
$dd = $_POST['dd'];
$shv = $_POST['shv'];
$redstripe = $_POST['redstripe'];
$choba = $_POST['choba'];
$ov = $_POST['ov'];
$moisture = $_POST['moisture'];
$cooking = $_POST['cooking'];

// $Items = $_POST['Items'];
// $Description = $_POST['Description'];
// $LabNo = $_POST['LabNo'];
// $Packsize = $_POST['Packsize'];
// $Quantity = $_POST['Quantity'];
// $ExWeight = $_POST['ExWeight'];
// $Weight = $_POST['Weight'];

$sql = 'INSERT INTO gatepass_g_recieved (`ContractNo`,`GRN_No`,`PartyName`,`Date`,`TimeIn`,`VehicleNo`,
                            `Chalky`,`B1`,`B2`,`B3`,`DD`,`Shv`,`RedStripe`,`Choba`,`Ov`,`Moisture`,`Cooking`) 
        VALUES ("'.$contractno.'","'.$GRNNo.'","'.$partyname.'","'.$date.'","'.$timein.'","'.$vehicleNo.'",
                "'.$chalky.'","'.$b1.'","'.$b2.'","'.$b3.'","'.$dd.'","'.$shv.'",
                "'.$redstripe.'","'.$choba.'","'.$ov.'","'.$moisture.'","'.$cooking.'")';
$result = mysqli_query($conn, $sql);

if($result){

    $GoodReceivedId = mysqli_insert_id($conn);

     for($i = 0; $i < count($_POST['Items']); $i++) {
        $sql1 = "INSERT INTO gatepass_g_recieved_items (`GoodReceivedId`,`Items`,`Description`,`LabNo`,`Packsize`,`Quantity`,`ExWeight`,`Weight`)
                            VALUES (".$GoodReceivedId.",'".$_POST['Items'][$i]."','".$_POST['Description'][$i]."','".$_POST['LabNo'][$i]."','".$_POST['Packsize'][$i]."','".$_POST['Quantity'][$i]."','".$_POST['ExWeight'][$i]."','".$_POST['Weight'][$i]."')";
        $result1 = mysqli_query($conn,$sql1);
    }
    if($result1){

        echo '<script>alert("Your Form Has been Submitted!");window.open("GatePass_GoodRecieved.php", "_self");</script>'; 

        // header('Location: GatePass_GoodRecieved.php');
    }
    else{
        echo $sql1;
    }
}
else{
    echo $sql;
}
?>