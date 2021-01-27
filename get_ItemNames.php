<?php
include_once('conn.php');


$sql = 'SELECT Items FROM gatepass_g_recieved JOIN gatepass_g_recieved_items ON gatepass_g_recieved.Id = gatepass_g_recieved_items.GoodReceivedId 
                            WHERE ContractNo = "'.$_POST['contractno'].'"';
// echo $sql;
$result = mysqli_query($conn, $sql);
if($result->num_rows > 0) {
        echo ' <option selected disabled>Select Variety</option>';
    while($row = mysqli_fetch_assoc($result)){
        
        echo '
            <option value="'.$row['Items'].'">'.$row['Items'].'</option>
        ';
    }
}
?>