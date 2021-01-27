<?php
include_once('conn.php');

$contracttype = $_POST['contracttype'];
$purchasesuppliername = $_POST['purchasesuppliername'];
$purchasesupplierPoNum = $_POST['purchasesupplierPoNum'];
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

$sql = 'INSERT INTO creditor (`ContractType`,`PurchaseSupplierName`,`PurchaseSupplierSoNum`,`ContractNo`,`Quality`,`Variety`,
                            `OurReference`,`PurchaseOrderNum`,`Brand`,`Quantity`,`Moisture`,`PaymentTerms`,`Price`,
                            `ChalkyImmatureKernels`,`PackingWeight`,`Tags`,`LoadingBags`,`InspectionDate`,
                            `EmptyBagsLoading`,`Fumigation`,`Silicagel`,`KraftPaper`,`SpecialInstruction`,
                            `ProcessingMill`) VALUES ("'.$contracttype.'","'.$purchasesuppliername.'","'.$purchasesupplierPoNum.'","'.$ContractNo.'","'.$quality.'","'.$variety.'",
                                                "'.$ourreference.'","'.$brokenpercentage.'","'.$brand.'","'.$quantity.'","'.$moisture.'","'.$paymentterms.'","'.$price.'",
                                                "'.$chalkyimmaturekernels.'","'.$packingweight.'","'.$tags.'","'.$loadingbags.'","'.$inspectiondate.'",
                                                "'.$emptybagsloading.'","'.$fumigation.'","'.$silicagel.'","'.$kraftpaper.'","'.$specialinstruction.'",
                                                "'.$processingmill.'")';
$result = mysqli_query($conn, $sql);

if($result){

    $sql1 = 'INSERT INTO `contract` (`ContractNo`,`ContractType`) VALUES ("'.$ContractNo.'","'.$contracttype.'")';
    $result1 = mysqli_query($conn,$sql1);

    echo '<script>alert("Your Form Has been Submitted!");window.open("Creditor.php", "_self");</script>'; 
    
    // header('Location: MakeContract.php');
}
else{
    echo $sql;
}

?>