<?php
include_once('conn.php');

$partyname = $_POST['partyname'];
$item_name = $_POST['item_name'];
$contractno = $_POST['contractno'];

// $milling_itemname = $_POST['milling_itemname'];
// $milling_desription = $_POST['milling_desription'];
// $milling_percentage = $_POST['milling_percentage'];
// $milling_bags = $_POST['milling_bags'];
// $milling_kg = $_POST['milling_kg'];
// $milling_Nweight = $_POST['milling_Nweight'];

for($i = 0; $i < count($_POST['milling_itemname']); $i++) {
    $sql = 'INSERT INTO production_milling (`PartyName`,`Party_ItemName`,`ContractNo`,`M_ItemName`,`M_Description`,`M_Percentage`,`M_Bags`,`M_KG`,`M_NWeight`) VALUES 
                            ("'.$partyname.'","'.$item_name.'","'.$contractno.'","'.$_POST['milling_itemname'][$i].'","'.$_POST['milling_desription'][$i].'","'.$_POST['milling_percentage'][$i].'","'.$_POST['milling_bags'][$i].'","'.$_POST['milling_kg'][$i].'","'.$_POST['milling_Nweight'][$i].'")';
    $result = mysqli_query($conn, $sql);

}
    echo '<script>alert("Your Form Has been Submitted!");window.open("Production_Milling.php", "_self");</script>'; 

?>