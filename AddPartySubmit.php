<?php
include_once('conn.php');

$type = $_POST['type'];
$partyname = $_POST['partyname'];
$nameinitials = $_POST['nameinitials'];
$address = $_POST['address'];
$NTN = $_POST['NTN'];
$GSTNo = $_POST['GSTNo'];
$Phoneno = $_POST['Phoneno'];
$contactperson = $_POST['contactperson'];
$email = $_POST['email'];
$dispatchaddress = $_POST['dispatchaddress'];
$cnic = $_POST['cnic'];

$sql = 'INSERT INTO addparty (`Type`,`PartyName`,`NameInitials`,`Address`,`NTN`,`GSTNo`,`PhoneNo`,`ContactPerson`,`Email`,`DispatchAddress`,`CNIC`) VALUES ("'.$type.'","'.$partyname.'","'.$nameinitials.'","'.$address.'","'.$NTN.'","'.$GSTNo.'","'.$Phoneno.'","'.$contactperson.'","'.$email.'","'.$dispatchaddress.'","'.$cnic.'")';
$result = mysqli_query($conn, $sql);

if($result){

    echo '<script>alert("Your Form Has been Submitted!");window.open("AddParty.php", "_self");</script>'; 
    
    // header('Location: AddParty.php');
}
else{
    echo $sql;
}

?>