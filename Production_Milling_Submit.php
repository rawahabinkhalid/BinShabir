<?php
include_once('conn.php');

$partyname = $_POST['partyname'];
$item_name = $_POST['item_name'];
$contractno = $_POST['contractno'];

$milling_itemname = $_POST['milling_itemname'];
$milling_desription = $_POST['milling_desription'];
$milling_percentage = $_POST['milling_percentage'];
$milling_bags = $_POST['milling_bags'];
$milling_kg = $_POST['milling_kg'];
$milling_Nweight = $_POST['milling_Nweight'];


$sql = 'INSERT INTO production_milling (`PartyName`,`Party_ItemName`,`ContractNo`,`M_ItemName`,`M_Description`,`M_Percentage`,`M_Bags`,`M_KG`,`M_NWeight`) VALUES 
                            ("'.$partyname.'","'.$item_name.'","'.$contractno.'","'.$milling_itemname.'","'.$milling_desription.'","'.$milling_percentage.'","'.$milling_bags.'","'.$milling_kg.'","'.$milling_Nweight.'")';
$result = mysqli_query($conn, $sql);

if($result){

    echo '<script>alert("Your Form Has been Submitted!");window.open("Production_Milling.php", "_self");</script>'; 

    // header('Location: Production_Milling.php');
}
else{
    echo $sql1;
}

?>