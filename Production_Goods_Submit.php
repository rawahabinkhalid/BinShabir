<?php
include_once('conn.php');

$partyname = $_POST['partyname'];
$item_name = $_POST['item_name'];
$contractno = $_POST['contractno'];

$date = $_POST['date'];
$GRN = $_POST['GRN'];
$vehicle = $_POST['vehicle'];
$bardanaweight = $_POST['bardanaweight'];
$itemname = $_POST['itemname'];
$Bags = $_POST['Bags'];
$Packing = $_POST['Packing'];
$Nweight = $_POST['Nweight'];


$sql = 'INSERT INTO production_goods (`PartyName`,`Party_ItemName`,`ContractNo`,`Date`,`GRN`,`Vehicle`,`ItemName`,`Bags`,`Packing`,`BardanaWeight`,`NWeight`) VALUES 
                                ("'.$partyname.'","'.$item_name.'","'.$contractno.'","'.$date.'","'.$GRN.'","'.$vehicle.'","'.$itemname.'","'.$Bags.'","'.$Packing.'","'.$bardanaweight.'","'.$Nweight.'")';
$result = mysqli_query($conn, $sql);

if($result){

  echo '<script>alert("Your Form Has been Submitted!");window.open("Production_Goods.php", "_self");</script>'; 

  // header('Location: Production_Goods.php');
}
else{
    echo $sql;
}

?>