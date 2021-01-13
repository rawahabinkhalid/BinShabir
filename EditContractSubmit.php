<?php
include_once('conn.php');

// Creditor Contract Form Field
// $purchasesuppliername = $_POST['purchasesuppliername'];
// $purchasesupplierPoNum = $_POST['purchasesupplierPoNum'];
// $purchaseordernum = $_POST['purchaseordernum'];

// // Toolmill Contract Form Field
// $salecustomername_toolmill = $_POST['salecustomername_toolmill'];
// $salecustomerSoNum_toolmill = $_POST['salecustomerSoNum_toolmill'];
// $salesordernum_toolmill = $_POST['salesordernum_toolmill'];

$contracttype = $_POST['contracttype'];
$ContractNo = $_POST['ContractNo'];
$quality = $_POST['quality'];
$variety = $_POST['variety'];

$ourreference = $_POST['ourreference'];
$brand = $_POST['brand'];
$quantity = $_POST['quantity'];
$moisture = $_POST['moisture'];
$paymentterms = $_POST['paymentterms'];
$price = $_POST['price'];
$chalkyimmaturekernels = $_POST['chalkyimmaturekernels'];
$packingweight = $_POST['packingweight'];
$tags = $_POST['tags'];
$loadingbags = $_POST['loadingbags'];
$inspectiondate = $_POST['inspectiondate'];
$emptybagsloading = $_POST['emptybagsloading'];
$fumigation = $_POST['fumigation'];
$silicagel = $_POST['silicagel'];
$kraftpaper = $_POST['kraftpaper'];
$specialinstruction = $_POST['specialinstruction'];
$processingmill = $_POST['processingmill'];

if(isset($_POST['contracttype']) && $_POST['contracttype'] == "Debtor/AccountReceivable/Sales"){

    // Deptor Contract Form Field
    $salecustomername = $_POST['salecustomername'];
    $salecustomerSoNum = $_POST['salecustomerSoNum'];
    $salesordernum = $_POST['salesordernum'];

    $sql = 'UPDATE debtor SET `ContractType`= "'.$contracttype.'", `SaleCustomerName` = "'.$salecustomername.'", `SaleCustomerSoNum` = "'.$salecustomerSoNum.'", `ContractNo` = "'.$ContractNo.'", `Quality` = "'.$quality.'", `Variety` = "'.$variety.'",
                                `OurReference` = "'.$ourreference.'", `SaleOrderNum` = "'.$salesordernum.'", `Brand` = "'.$brand.'", `Quantity` = "'.$quantity.'",
                                `Moisture` = "'.$moisture.'", `PaymentTerms` = "'.$paymentterms.'", `Price` = "'.$price.'", `ChalkyImmatureKernels` = "'.$chalkyimmaturekernels.'", `PackingWeight` = "'.$packingweight.'", `Tags` = "'.$tags.'", `LoadingBags` = "'.$loadingbags.'",
                                `InspectionDate` = "'.$inspectiondate.'", `EmptyBagsLoading` = "'.$emptybagsloading.'", `Fumigation` = "'.$fumigation.'", `Silicagel` = "'.$silicagel.'", `KraftPaper` = "'.$kraftpaper.'", `SpecialInstruction` = "'.$specialinstruction.'",
                                `ProcessingMill` = "'.$processingmill.'" WHERE ContractNo = '.$ContractNo;
    $result = mysqli_query($conn, $sql);

    if($result){

        echo '<script>alert("Your Form Has been Submitted!");window.open("EditContract.php", "_self");</script>'; 
        
    }
    else{
        echo $sql;
    }
}

?>