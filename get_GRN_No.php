<?php
include_once('conn.php');


$sql = 'SELECT GRN_No FROM gatepass_g_recieved WHERE ContractNo = "'.$_POST['contractno'].'"';
// echo $sql;
$result = mysqli_query($conn, $sql);
if($result->num_rows > 0) {
        echo ' <option selected disabled>Select GRN No</option>';
    while($row = mysqli_fetch_assoc($result)){
        
        echo '
            <option value="'.$row['GRN_No'].'">'.$row['GRN_No'].'</option>
        ';
    }
}
?>