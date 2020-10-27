<?php
include_once('conn.php');

$contractnofrom = $_POST['contractnofrom'];
$contractnoto = $_POST['contractnoto'];
$bagstransfer = $_POST['bagstransfer'];

$sql = 'INSERT INTO stocktransfer (`ContractNoFrom`,`ContractNoTo`,`BagsTransfer`) VALUES ("'.$contractnofrom.'","'.$contractnoto.'","'.$bagstransfer.'")';
$result = mysqli_query($conn, $sql);

if($result){
    
    $sqlcheck = 'SELECT * FROM contract_wise_totalbags WHERE ContractNo = '.$contractnoto ;
    $result1 = mysqli_query($conn, $sqlcheck);
    if(mysqli_num_rows($result1) > 0){
        // echo "1";
        $AddBags = 'UPDATE contract_wise_totalbags SET TotalBags = TotalBags+"'.$bagstransfer.'" WHERE ContractNo = '.$contractnoto ;
        // echo $AddBags;
        $resUpdate = mysqli_query($conn, $AddBags);

        $SubBags = 'UPDATE contract_wise_totalbags SET TotalBags = TotalBags-"'.$bagstransfer.'" WHERE ContractNo = '.$contractnofrom ;
        // echo $SubBags;
        $resUpdate = mysqli_query($conn, $SubBags);

    }
    else{
        // echo "2";
        $insertBags = 'INSERT INTO contract_wise_totalbags (`ContractNo`,`TotalBags`) VALUES ("'.$contractnoto.'","'.$bagstransfer.'")';
        $resInsert = mysqli_query($conn, $insertBags);    
    
        $Sub1Bags = 'UPDATE contract_wise_totalbags SET TotalBags = TotalBags-"'.$bagstransfer.'" WHERE ContractNo = '.$contractnofrom ;
        $resUpdate = mysqli_query($conn, $Sub1Bags);
    }
    
    echo '<script>alert("Your Form Has been Submitted!");window.open("StockTransfer.php", "_self");</script>'; 
    
    // header('Location: StockTransfer.php');
}
else{
    echo $sql;
}

?>