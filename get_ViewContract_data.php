<?php
include_once 'conn.php';

$sql = 'SELECT * FROM makecontract WHERE ContractNo = ' . $_POST['contract_no'];
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

echo '
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label>Contract Type: </label>
            ' .
    $row['ContractType'] .
    '
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label>Customer Name: </label>
            ' .
    $row['CustomerName'] .
    '
    </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label>Customer PO Number: </label>
            ' .
    $row['CustomerPoNum'] .
    '
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label>Contract # :</label>
            ' .
    $row['ContractNo'] .
    '
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label>Quality: </label>
            ' .
    $row['Quality'] .
    '
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label>Variety: </label>
            ' .
    $row['Variety'] .
    '
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label>
                <h3 style="color: #7088C8"><u>Requirement Form:</u></h3>
            </label>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <td style="width:50%"><label>Our Reference: </label></td>
                    <td>' .
    $row['OurReference'] .
    '</td>
                </tr>
                <tr>
                    <td><label>Production Order No: </label></td>
                    <td>' .
    $row['ProductionOrderNum'] .
    '</td>
                </tr>
                <tr>
                    <td><label>Bags Filling: </label></td>
                    <td>' .
    $row['BagsFilling'] .
    '</td>
                </tr>
                <tr>
                    <td><label>Brand: </label></td>
                    <td>' .
    $row['Brand'] .
    '</td>
                </tr>
                <tr>
                    <td><label>Milled Qunatity M/T: </label></td>
                    <td>' .
    $row['MilledQuantity'] .
    '</td>
                </tr>
                <tr>
                    <td><label>Whiteness: </label></td>
                    <td>' .
    $row['Whiteness'] .
    '</td>
                </tr>
                <tr>
                    <td><label>Broken Percentage: </label></td>
                    <td>' .
    $row['BrokenPercentage'] .
    '</td>
                </tr>
                <tr>
                    <td><label>Moisture: </label></td>
                    <td>' .
    $row['Moisture'] .
    '</td>
                </tr>
                <tr>
                    <td><label>Chalky & Immature Kernels: </label></td>
                    <td>' .
    $row['ChalkyImmatureKernels'] .
    '</td>
                </tr>
                <tr>
                    <td><label>Packing / Packing Weight: </label></td>
                    <td>' .
    $row['PackingWeight'] .
    '</td>
                </tr>
                <tr>
                    <td><label>Tags: </label></td>
                    <td>' .
    $row['Tags'] .
    '</td>
                </tr>
                <tr>
                    <td><label>Loading Bags Per Container: </label></td>
                    <td>' .
    $row['LoadingBags'] .
    '</td>
                </tr>
                <tr>
                    <td><label>Expected Inspection Date: </label></td>
                    <td>' .
    $row['InspectionDate'] .
    '</td>
                </tr>
                <tr>
                    <td><label>Empty Bags Loading: </label></td>
                    <td>' .
    $row['EmptyBagsLoading'] .
    '</td>
                </tr>
                <tr>
                    <td><label>Fumigation: </label></td>
                    <td>' .
    $row['Fumigation'] .
    '</td>
                </tr>
                <tr>
                    <td><label>Silica Gel: </label></td>
                    <td>' .
    $row['Silicagel'] .
    '</td>
                </tr>
                <tr>
                    <td><label>Kraft Paper/Plastic: </label></td>
                    <td>' .
    $row['KraftPaper'] .
    '</td>
                </tr>
                <tr>
                    <td><label>Special Instructions: </label></td>
                    <td>' .
    $row['SpecialInstruction'] .
    '</td>
                </tr>
                <tr>
                    <td><label>Processing Mill: </label></td>
                    <td>' .
    $row['ProcessingMill'] .
    '</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
';
$sqlExtension = 'SELECT * FROM extendcontract WHERE ContractId = ' . $row['Id'];
$resultExtension = $conn->query($sqlExtension);
if ($resultExtension->num_rows > 0) {
    echo '
    <div class="col-md-12 text-center" id="view_heading">
        <h3><b><u>CONTRACT EXTENSIONS</u></b></h3>
    </div>
    ';
    while ($rowExtension = $resultExtension->fetch_assoc()) {
        echo '<div class="row">
        <div class="col-md-12">
            <table class="table table-bordered">
                <thead>
                    <th>Date</th>
                    <th>Packing</th>
                    <th>Polishing</th>
                    <th>Broken</th>
                    <th>Qty</th>
                    <th>Production Order #</th>
                </thead>
                <tbody>
                    <tr>
                        <td>' .
            $rowExtension['ExtendDate'] .
            '</td>
            <td>' .
            $rowExtension['Packing'] .
            '</td>
            <td>' .
            $rowExtension['Polishing'] .
            '</td>
            <td>' .
            $rowExtension['Broken'] .
            '</td>
            <td>' .
            $rowExtension['ExtendQty'] .
            '</td>
            <td>' .
            $rowExtension['ProdOrderNo'] .
            '</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>';
    }
}
?>
