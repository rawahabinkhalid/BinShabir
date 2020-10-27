<?php
include_once('conn.php');

$contractno = $_POST['contractno'];
$quality = $_POST['quality'];
$variety = $_POST['variety'];
// $description = $_POST['description'];
// $receiving = $_POST['receiving'];
// $date = $_POST['date'];
// $grn = $_POST['grn'];
// $truckno = $_POST['truckno'];
// $bags = $_POST['bags'];
// $netwt = $_POST['netwt'];


$sql = 'INSERT INTO weighing (`ContractNo`,`Quality`,`Variety`) VALUES ("'.$contractno.'","'.$quality.'","'.$variety.'")';
$result = mysqli_query($conn, $sql);

if($result){
    
    $WeighingId = mysqli_insert_id($conn);
    $sumofbags = 0;
    for($i = 0; $i < count($_POST['description']); $i++) {
        $sql1 = "INSERT INTO weighing_description_receiving (`WeighingId`,`Description`,`Receiving`,`Date`,`GRN`,`TruckNo`,`Bags`,`NetWT`)
                            VALUES ( ".$WeighingId.",'".$_POST['description'][$i]."','".$_POST['receiving'][$i]."','".$_POST['date'][$i]."','".$_POST['grn'][$i]."','".$_POST['truckno'][$i]."','".$_POST['bags'][$i]."','".$_POST['netwt'][$i]."')";
        $result1 = mysqli_query($conn,$sql1);
        
        $sumofbags += intval($_POST['bags'][$i]);
    }
    if($result1){

            $sqlcheckcontractId = 'SELECT * FROM contract_wise_totalbags WHERE ContractNo = '.$contractno ;
            $rescontractId = mysqli_query($conn, $sqlcheckcontractId);
            if(mysqli_num_rows($rescontractId) > 0){
                $upadateBags = 'UPDATE contract_wise_totalbags SET TotalBags = TotalBags+"'.$sumofbags.'" WHERE ContractNo = '.$contractno ;
                $resUpdate = mysqli_query($conn, $upadateBags);
            }
            else{
                $insertBags = 'INSERT INTO contract_wise_totalbags (`ContractNo`,`TotalBags`) VALUES ("'.$contractno.'","'.$sumofbags.'")';
                $resInsert = mysqli_query($conn, $insertBags);    
            }

        echo '<script>alert("Your Form Has been Submitted!");window.open("Weighing.php", "_self");</script>'; 

        // header('Location: Weighing.php');
    }
    else{
        echo $sql1;
    }
}
else{
    echo $sql;
}

?>