<?php
include_once("conn.php");

$partyname = $_POST['partyname'];
$item_name = $_POST['item_name'];
$contractno = $_POST['contractno'];

// $head = $_POST['head'];
// $description = $_POST['description'];
// $weight = $_POST['weight'];
// $unit = $_POST['unit'];
// $rate = $_POST['rate'];
// $amount = $_POST['amount'];

$sql = 'INSERT INTO toolmilling (`PartyName`,`ItemName`,`ContractNo`) VALUES ("'.$partyname.'","'.$item_name.'","'.$contractno.'")';
$result = mysqli_query($conn, $sql);

if($result){
    
    $ToolMillingId = mysqli_insert_id($conn);

    for($i = 0; $i < count($_POST['head']); $i++) {
        $sql1 = "INSERT INTO toolmilling_description (`ToolMilling_Id`,`Head`,`Description`,`Weight`,`Unit`,`Rate`,`Amount`)
                            VALUES ( ".$ToolMillingId.",'".$_POST['head'][$i]."','".$_POST['description'][$i]."','".$_POST['weight'][$i]."','".$_POST['unit'][$i]."','".$_POST['rate'][$i]."','".$_POST['amount'][$i]."')";
        $result1 = mysqli_query($conn,$sql1);
        
        // Over All Profit and Loss Calculate krne ke liye ye kaam kiya ha
        if($_POST['head'][$i] == 'Processing'){ 
            
            $sql2 = "INSERT INTO overallprofit (`Description`,`Amount`) VALUES ('Tool Milling','".$_POST['amount'][$i]."') ";
            $result2 = mysqli_query($conn,$sql2);
        }
    }


    echo '<script>alert("Your Form Has been Submitted!");window.open("ToolMilling.php", "_self");</script>'; 
}
else{
    echo $sql;
}
?>