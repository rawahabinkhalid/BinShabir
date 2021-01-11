<?php
include_once("conn.php");


$count = 1;
$sql = 'SELECT * FROM otherexpense WHERE Date >= "' .$_POST['date_from'] . '" AND Date <= "' . $_POST['date_to'] . '"';
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {
    echo '
    <tr>
        <td scope="row"><b>'.$count++.'</b></td>
        <td>'.$row['ExpenseHead'].'</td>
        <td>'.$row['Description'].'</td>
        <td>'.$row['Date'].'</td>
        <td>'.$row['Amount'].'</td>
    </tr>';
}
?>