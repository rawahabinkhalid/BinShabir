<?php
include_once('conn.php');

$contracttype = $_POST['contracttype'];
$customername = $_POST['customername'];
$customerPoNum = $_POST['customerPoNum'];
$ContractNo = $_POST['ContractNo'];
$quality = $_POST['quality'];
$variety = $_POST['variety'];


$ourreference = $_POST['ourreference'];
$productionordernum = $_POST['productionordernum'];
$bagsfilling = $_POST['bagsfilling'];
$brand = $_POST['brand'];
$milledquantity = $_POST['milledquantity'];
$whiteness = $_POST['whiteness'];
$brokenpercentage = $_POST['brokenpercentage'];
$moisture = $_POST['moisture'];
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

$sql = 'UPDATE makecontract SET `ContractType`= "'.$contracttype.'", `CustomerName` = "'.$customername.'", `CustomerPoNum` = "'.$customerPoNum.'", `ContractNo` = "'.$ContractNo.'", `Quality` = "'.$quality.'", `Variety` = "'.$variety.'",
                            `OurReference` = "'.$ourreference.'", `ProductionOrderNum` = "'.$productionordernum.'", `BagsFilling` = "'.$bagsfilling.'", `Brand` = "'.$brand.'", `MilledQuantity` = "'.$milledquantity.'", `Whiteness` = "'.$whiteness.'",
                            `BrokenPercentage` = "'.$brokenpercentage.'", `Moisture` = "'.$moisture.'", `ChalkyImmatureKernels` = "'.$chalkyimmaturekernels.'", `PackingWeight` = "'.$packingweight.'", `Tags` = "'.$tags.'", `LoadingBags` = "'.$loadingbags.'",
                            `InspectionDate` = "'.$inspectiondate.'", `EmptyBagsLoading` = "'.$emptybagsloading.'", `Fumigation` = "'.$fumigation.'", `Silicagel` = "'.$silicagel.'", `KraftPaper` = "'.$kraftpaper.'", `SpecialInstruction` = "'.$specialinstruction.'",
                            `ProcessingMill` = "'.$processingmill.'" WHERE ContractNo ='.$ContractNo;
$result = mysqli_query($conn, $sql);

if($result){

    echo '<script>alert("Your Form Has been Submitted!");window.open("EditContract.php", "_self");</script>'; 
    
    // header('Location: MakeContract.php');
}
else{
    echo $sql;
}

?>