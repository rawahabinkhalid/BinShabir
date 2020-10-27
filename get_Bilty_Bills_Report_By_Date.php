<?php
include_once("conn.php");


$count = 1;
$sql = 'SELECT * FROM bilty_bill WHERE Date >= "' . $_POST['date_from'] . '" AND Date <= "' . $_POST['date_to'] . '"';
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {
    echo '
    <tr>
        <td scope="row"><b>'.$count++.'</b></td>
        <td>'.$row['Date'].'</td>
        <td>'.$row['Reference_Name'].'</td>
        <td>'.$row['Bill_No'].'</td>
        <td>'.$row['Reference_Contact'].'</td>
        <td>'.$row['Amount_Received'].'</td>
    </tr>';
}
?>