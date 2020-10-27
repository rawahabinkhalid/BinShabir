<?php
include_once('conn.php');

$contracttype = $_POST['contracttype'];
$customername = $_POST['customername'];
$customerPoNum = $_POST['customerPoNum'];
$ContractNo = $_POST['ContractNo'];
$quality = $_POST['quality'];
$variety = $_POST['variety'];
// $b1 = $_POST['b1'];
// $b2 = $_POST['b2'];
// $damage = $_POST['damage'];


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

$sql = 'INSERT INTO makecontract (`ContractType`,`CustomerName`,`CustomerPoNum`,`ContractNo`,`Quality`,`Variety`,
                            `OurReference`,`ProductionOrderNum`,`BagsFilling`,`Brand`,`MilledQuantity`,`Whiteness`,
                            `BrokenPercentage`,`Moisture`,`ChalkyImmatureKernels`,`PackingWeight`,`Tags`,`LoadingBags`,
                            `InspectionDate`,`EmptyBagsLoading`,`Fumigation`,`Silicagel`,`KraftPaper`,`SpecialInstruction`,
                            `ProcessingMill`) VALUES ("'.$contracttype.'","'.$customername.'","'.$customerPoNum.'","'.$ContractNo.'","'.$quality.'","'.$variety.'",
                                                "'.$ourreference.'","'.$productionordernum.'","'.$bagsfilling.'","'.$brand.'","'.$milledquantity.'","'.$whiteness.'",
                                                "'.$brokenpercentage.'","'.$moisture.'","'.$chalkyimmaturekernels.'","'.$packingweight.'","'.$tags.'","'.$loadingbags.'",
                                                "'.$inspectiondate.'","'.$emptybagsloading.'","'.$fumigation.'","'.$silicagel.'","'.$kraftpaper.'","'.$specialinstruction.'",
                                                "'.$processingmill.'")';
$result = mysqli_query($conn, $sql);

if($result){

    echo '<script>alert("Your Form Has been Submitted!");window.open("MakeContract.php", "_self");</script>'; 
    
    // header('Location: MakeContract.php');
}
else{
    echo $sql;
}

?>