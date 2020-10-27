<?php
include_once("conn.php");


$count = 1;
$sql = 'SELECT * FROM weigh_bridge WHERE Date >= "' . $_POST['date_from'] . '" AND Date <= "' . $_POST['date_to'] . '"';
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {
    echo '
    <tr>
        <td scope="row"><b>'.$count++.'</b></td>
        <td>'.$row['Date'].'</td>
        <td>'.$row['Truck'].'</td>
        <td>'.$row['Weight'].'</td>
        <td>'.$row['Rate'].'</td>
        <td>'.$row['Amount'].'</td>
    </tr>';
}
?>