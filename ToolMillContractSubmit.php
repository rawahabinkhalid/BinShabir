<?php
include_once('conn.php');

$contracttype = $_POST['contracttype'];
$salecustomername = $_POST['salecustomername'];
$salecustomerSoNum = $_POST['salecustomerSoNum'];
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

$sql = 'INSERT INTO toolmillcontract (`ContractType`,`SaleCustomerName`,`SaleCustomerSoNum`,`ContractNo`,`Quality`,`Variety`,
                            `OurReference`,`BrokenPercentage`,`Brand`,`Quantity`,`Moisture`,`PaymentTerms`,`Price`,
                            `ChalkyImmatureKernels`,`PackingWeight`,`Tags`,`LoadingBags`,`InspectionDate`,
                            `EmptyBagsLoading`,`Fumigation`,`Silicagel`,`KraftPaper`,`SpecialInstruction`,
                            `ProcessingMill`) VALUES ("'.$contracttype.'","'.$salecustomername.'","'.$salecustomerSoNum.'","'.$ContractNo.'","'.$quality.'","'.$variety.'",
                                                "'.$ourreference.'","'.$brokenpercentage.'","'.$brand.'","'.$quantity.'","'.$moisture.'","'.$paymentterms.'","'.$price.'",
                                                "'.$chalkyimmaturekernels.'","'.$packingweight.'","'.$tags.'","'.$loadingbags.'","'.$inspectiondate.'",
                                                "'.$emptybagsloading.'","'.$fumigation.'","'.$silicagel.'","'.$kraftpaper.'","'.$specialinstruction.'",
                                                "'.$processingmill.'")';
$result = mysqli_query($conn, $sql);
if($result){

    $sql1 = 'INSERT INTO `contract` (`ContractNo`,`ContractType`) VALUES ("'.$ContractNo.'","'.$contracttype.'")';
    $result1 = mysqli_query($conn,$sql1);

    echo '<script>alert("Your Form Has been Submitted!");window.open("ToolMillContract.php", "_self");</script>'; 
    
    // header('Location: MakeContract.php');
}
else{
    echo $sql;
}

?>