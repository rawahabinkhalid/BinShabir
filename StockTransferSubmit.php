<?php
include_once('conn.php');

$contractnofrom = $_POST['contractnofrom'];
$contractnoto = $_POST['contractnoto'];
$bagstransfer = $_POST['bagstransfer'];
$itemvariety = $_POST['itemvariety'];
$itemname = (isset($_POST['itemname'])) ? $_POST['itemname'] : '';

if ($itemname != '')
    $sql = 'INSERT INTO stocktransfer (`ContractNoFrom`,`ContractNoTo`,`BagsTransfer`,`Items`,`ItemName`) VALUES ("' . $contractnofrom . '","' . $contractnoto . '","' . $bagstransfer . '","' . $itemvariety . '","' . $itemname . '")';
else
    $sql = 'INSERT INTO stocktransfer (`ContractNoFrom`,`ContractNoTo`,`BagsTransfer`,`Items`) VALUES ("' . $contractnofrom . '","' . $contractnoto . '","' . $bagstransfer . '","' . $itemvariety . '")';
$result = mysqli_query($conn, $sql);

if ($result) {

    $sqlcheck = 'SELECT * FROM production_milling WHERE ContractNo = ' . $contractnoto;
    $result1 = mysqli_query($conn, $sqlcheck);

    if (mysqli_num_rows($result1) > 0) {
        if ($itemname != '') {
            $SubBags = 'UPDATE production_milling SET M_Bags = M_Bags-"' . $bagstransfer . '" WHERE ContractNo = ' . $contractnofrom . ' AND Party_ItemName = "' . $itemvariety . '"  AND M_ItemName = "' . $itemname . '" ';
            // echo $SubBags;
            $resUpdate = mysqli_query($conn, $SubBags);

            $AddBags = 'UPDATE production_milling SET M_Bags = M_Bags+"' . $bagstransfer . '" WHERE ContractNo = ' . $contractnoto . ' AND Party_ItemName = "' . $itemvariety . '"  AND M_ItemName = "' . $itemname . '" ';
            // echo $AddBags;
            $resUpdate = mysqli_query($conn, $AddBags);
            if (mysqli_affected_rows($conn) <= 0) {
                $insertBags = 'INSERT INTO production_milling (`ContractNo`,`Party_ItemName`,`M_ItemName`,`M_Bags`) VALUES ("' . $contractnoto . '","' . $itemvariety . '","' . $itemname . '","' . $bagstransfer . '")';
                $resInsert = mysqli_query($conn, $insertBags);
            }
            // } else {


            //     $sql2 = 'UPDATE production_goods SET Bags = Bags+"' . $bagstransfer . '" WHERE ContractNo =  ' . $contractnoto . ' AND Party_ItemName = "' . $itemvariety . '"  ';
            //     $res_sql2 = mysqli_query($conn, $sql2);

            //     $sql2 = 'UPDATE production_goods SET Bags = Bags-"' . $bagstransfer . '" WHERE ContractNo =  ' . $contractnofrom . ' AND Party_ItemName = "' . $itemvariety . '"  ';
            //     $res_sql2 = mysqli_query($conn, $res_sql2);
            //     if (mysqli_affected_rows($conn) <= 0) {
            //         $insertBags2 = 'INSERT INTO production_goods (`Party_ItemName`,`ItemName`,`ContractNo`,`Bags`) VALUES ("' . $itemvariety . '","' . $itemvariety . '","' . $contractnoto . '","' . $bagstransfer . '")';
            //         $resInsert2 = mysqli_query($conn, $insertBags2);
            //     }
        }
    }



    // $sqlcheck = 'SELECT * FROM contract_wise_totalbags WHERE ContractNo = '.$contractnoto ;
    // $result1 = mysqli_query($conn, $sqlcheck);
    // if(mysqli_num_rows($result1) > 0){
    //     // echo "1";
    //     $AddBags = 'UPDATE contract_wise_totalbags SET TotalBags = TotalBags+"'.$bagstransfer.'" WHERE ContractNo = '.$contractnoto ;
    //     // echo $AddBags;
    //     $resUpdate = mysqli_query($conn, $AddBags);

    //     $SubBags = 'UPDATE contract_wise_totalbags SET TotalBags = TotalBags-"'.$bagstransfer.'" WHERE ContractNo = '.$contractnofrom ;
    //     // echo $SubBags;
    //     $resUpdate = mysqli_query($conn, $SubBags);

    // }
    // else{
    //     // echo "2";
    //     $insertBags = 'INSERT INTO contract_wise_totalbags (`ContractNo`,`TotalBags`) VALUES ("'.$contractnoto.'","'.$bagstransfer.'")';
    //     $resInsert = mysqli_query($conn, $insertBags);    

    //     $Sub1Bags = 'UPDATE contract_wise_totalbags SET TotalBags = TotalBags-"'.$bagstransfer.'" WHERE ContractNo = '.$contractnofrom ;
    //     $resUpdate = mysqli_query($conn, $Sub1Bags);
    // }

    // echo '<script>alert("Your Form Has been Submitted!");window.open("StockTransfer.php", "_self");</script>'; 

    // header('Location: StockTransfer.php');
} else {
    echo $sql;
}
