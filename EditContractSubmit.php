<?php
include_once('conn.php');

$contracttype = $_POST['contracttype'];
$ContractNo = $_POST['ContractNo'];
$quality = $_POST['quality'];
$variety = $_POST['variety'];

$ourreference = $_POST['ourreference'];
$brokenpercentage = $_POST['brokenpercentage'];
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

    $sql = 'UPDATE debtor SET `ContractType`= "'.$contracttype.'", `SaleCustomerName` = "'.$salecustomername.'", `SaleCustomerSoNum` = "'.$salecustomerSoNum.'", `ContractNo` = "'.$ContractNo.'", `Quality` = "'.$quality.'", `Variety` = "'.$variety.'",
                                `OurReference` = "'.$ourreference.'", `BrokenPercentage` = "'.$brokenpercentage.'", `Brand` = "'.$brand.'", `Quantity` = "'.$quantity.'",
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

} else if(isset($_POST['contracttype']) && $_POST['contracttype'] == "Creditor/AccountPayable/Purchase"){

    // Creditor Contract Form Field
    $purchasesuppliername = $_POST['purchasesuppliername'];
    $purchasesupplierPoNum = $_POST['purchasesupplierPoNum'];

    $sql = 'UPDATE creditor SET `ContractType`= "'.$contracttype.'", `PurchaseSupplierName` = "'.$purchasesuppliername.'", `PurchaseSupplierSoNum` = "'.$purchasesupplierPoNum.'", `ContractNo` = "'.$ContractNo.'", `Quality` = "'.$quality.'", `Variety` = "'.$variety.'",
                                `OurReference` = "'.$ourreference.'", `BrokenPercentage` = "'.$brokenpercentage.'", `Brand` = "'.$brand.'", `Quantity` = "'.$quantity.'",
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

} else if(isset($_POST['contracttype']) && $_POST['contracttype'] == "Sales"){

    // Toolmill Contract Form Field
    $salecustomername_toolmill = $_POST['salecustomername_toolmill'];
    $salecustomerSoNum_toolmill = $_POST['salecustomerSoNum_toolmill'];

    $sql = 'UPDATE toolmillcontract SET `ContractType`= "'.$contracttype.'", `SaleCustomerName` = "'.$salecustomername_toolmill.'", `SaleCustomerSoNum` = "'.$salecustomerSoNum_toolmill.'", `ContractNo` = "'.$ContractNo.'", `Quality` = "'.$quality.'", `Variety` = "'.$variety.'",
                                `OurReference` = "'.$ourreference.'", `BrokenPercentage` = "'.$brokenpercentage.'", `Brand` = "'.$brand.'", `Quantity` = "'.$quantity.'",
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