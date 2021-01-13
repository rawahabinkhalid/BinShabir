<?php
include_once 'conn.php';

$sql = 'SELECT * FROM debtor WHERE ContractNo = ' . $_POST['contract_no'];
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

$sql1 = 'SELECT * FROM creditor WHERE ContractNo = ' . $_POST['contract_no'];
$result1 = mysqli_query($conn, $sql1);
$row1 = mysqli_fetch_assoc($result1);

$sql2 = 'SELECT * FROM toolmillcontract WHERE ContractNo = ' . $_POST['contract_no'];
$result2 = mysqli_query($conn, $sql2);
$row2 = mysqli_fetch_assoc($result2);

if(isset($row['ContractType']) && $row['ContractType'] == "Debtor/AccountReceivable/Sales"){
    echo '
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label>Contract Type: </label>
                '.$row['ContractType'].'
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label>Sales Customer Name: </label>
                '.$row['SaleCustomerName'].'
        </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label>Sales SO Number: </label>
                '.$row['SaleCustomerSoNum'].'
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label>Contract # :</label>
                '.$row['ContractNo'].'
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label>Quality: </label>
                '.$row['Quality'].'
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label>Variety: </label>
                '.$row['Variety'].'
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label>Date Of Contract: </label>
                '.date('d-M-Y', strtotime(explode(" ", $row['DefaultDate'])[0])).'
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
                        <td>'.$row['OurReference'].'</td>
                    </tr>
                    <tr>
                        <td><label>SO#: </label></td>
                        <td>'.$row['SaleOrderNum'].'</td>
                    </tr>
                    <tr>
                        <td><label>Brand: </label></td>
                        <td>'.$row['Brand'].'</td>
                    </tr>
                    <tr>
                        <td><label>Quantity: </label></td>
                        <td>'.$row['Quantity'].'</td>
                    </tr>
                    <tr>
                        <td><label>Moisture: </label></td>
                        <td>'.$row['Moisture'].'</td>
                    </tr>
                    <tr>
                        <td><label>Payment Terms: </label></td>
                        <td>'.$row['PaymentTerms'].'</td>
                    </tr>
                    <tr>
                        <td><label>Price: </label></td>
                        <td>'.$row['Price'].'</td>
                    </tr>
                    <tr>
                        <td><label>Chalky & Immature Kernels: </label></td>
                        <td>'.$row['ChalkyImmatureKernels'].'</td>
                    </tr>
                    <tr>
                        <td><label>Packing / Packing Weight: </label></td>
                        <td>'.$row['PackingWeight'].'</td>
                    </tr>
                    <tr>
                        <td><label>Tags: </label></td>
                        <td>'.$row['Tags'].'</td>
                    </tr>
                    <tr>
                        <td><label>Loading Bags Per Container: </label></td>
                        <td>'.$row['LoadingBags'].'</td>
                    </tr>
                    <tr>
                        <td><label>Expected Inspection Date: </label></td>
                        <td>'.$row['InspectionDate'].'</td>
                    </tr>
                    <tr>
                        <td><label>Empty Bags Loading: </label></td>
                        <td>'.$row['EmptyBagsLoading'].'</td>
                    </tr>
                    <tr>
                        <td><label>Fumigation: </label></td>
                        <td>'.$row['Fumigation'].'</td>
                    </tr>
                    <tr>
                        <td><label>Silica Gel: </label></td>
                        <td>'.$row['Silicagel'].'</td>
                    </tr>
                    <tr>
                        <td><label>Kraft Paper/Plastic: </label></td>
                        <td>'.$row['KraftPaper'].'</td>
                    </tr>
                    <tr>
                        <td><label>Special Instructions: </label></td>
                        <td>'.$row['SpecialInstruction'].'</td>
                    </tr>
                    <tr>
                        <td><label>Processing Mill: </label></td>
                        <td>'.$row['ProcessingMill'].'</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    ';
    $sqlExtension = 'SELECT * FROM extendcontract WHERE ContractNo = ' . $row['ContractNo'];
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
                        <th>SO #</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>'.$rowExtension['ExtendDate'].'</td>
                            <td>'.$rowExtension['Packing'].'</td>
                            <td>'.$rowExtension['Polishing'].'</td>
                            <td>'.$rowExtension['Broken'].'</td>
                            <td>'.$rowExtension['ExtendQty'].'</td>
                            <td>'.$rowExtension['ProdOrderNo'].'</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>';
        }
    }

} else if(isset($row1['ContractType']) && $row1['ContractType'] == "Creditor/AccountPayable/Purchase") {

    echo '
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label>Contract Type: </label>
                '.$row1['ContractType'].'
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label>Purchase Supplier Name: </label>
                '.$row1['PurchaseSupplierName'].'
        </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label>Purchase PO Number: </label>
                '.$row1['PurchaseSupplierSoNum'].'
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label>Contract # :</label>
                '.$row1['ContractNo'].'
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label>Quality: </label>
                '.$row1['Quality'].'
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label>Variety: </label>
                '.$row1['Variety'].'
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label>Date Of Contract: </label>
                '.date('d-M-Y', strtotime(explode(" ", $row1['DefaultDate'])[0])).'
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
                        <td>'.$row1['OurReference'].'</td>
                    </tr>
                    <tr>
                        <td><label>SO#: </label></td>
                        <td>'.$row1['PurchaseOrderNum'].'</td>
                    </tr>
                    <tr>
                        <td><label>Brand: </label></td>
                        <td>'.$row1['Brand'].'</td>
                    </tr>
                    <tr>
                        <td><label>Quantity: </label></td>
                        <td>'.$row1['Quantity'].'</td>
                    </tr>
                    <tr>
                        <td><label>Moisture: </label></td>
                        <td>'.$row1['Moisture'].'</td>
                    </tr>
                    <tr>
                        <td><label>Payment Terms: </label></td>
                        <td>'.$row1['PaymentTerms'].'</td>
                    </tr>
                    <tr>
                        <td><label>Price: </label></td>
                        <td>'.$row1['Price'].'</td>
                    </tr>
                    <tr>
                        <td><label>Chalky & Immature Kernels: </label></td>
                        <td>'.$row1['ChalkyImmatureKernels'].'</td>
                    </tr>
                    <tr>
                        <td><label>Packing / Packing Weight: </label></td>
                        <td>'.$row1['PackingWeight'].'</td>
                    </tr>
                    <tr>
                        <td><label>Tags: </label></td>
                        <td>'.$row1['Tags'].'</td>
                    </tr>
                    <tr>
                        <td><label>Loading Bags Per Container: </label></td>
                        <td>'.$row1['LoadingBags'].'</td>
                    </tr>
                    <tr>
                        <td><label>Expected Inspection Date: </label></td>
                        <td>'.$row1['InspectionDate'].'</td>
                    </tr>
                    <tr>
                        <td><label>Empty Bags Loading: </label></td>
                        <td>'.$row1['EmptyBagsLoading'].'</td>
                    </tr>
                    <tr>
                        <td><label>Fumigation: </label></td>
                        <td>'.$row1['Fumigation'].'</td>
                    </tr>
                    <tr>
                        <td><label>Silica Gel: </label></td>
                        <td>'.$row1['Silicagel'].'</td>
                    </tr>
                    <tr>
                        <td><label>Kraft Paper/Plastic: </label></td>
                        <td>'.$row1['KraftPaper'].'</td>
                    </tr>
                    <tr>
                        <td><label>Special Instructions: </label></td>
                        <td>'.$row1['SpecialInstruction'].'</td>
                    </tr>
                    <tr>
                        <td><label>Processing Mill: </label></td>
                        <td>'.$row1['ProcessingMill'].'</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    ';
    $sqlExtension = 'SELECT * FROM extendcontract WHERE ContractNo = ' . $row1['ContractNo'];
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
                        <th>PO #</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>'.$rowExtension['ExtendDate'].'</td>
                            <td>'.$rowExtension['Packing'].'</td>
                            <td>'.$rowExtension['Polishing'].'</td>
                            <td>'.$rowExtension['Broken'].'</td>
                            <td>'.$rowExtension['ExtendQty'].'</td>
                            <td>'.$rowExtension['ProdOrderNo'].'</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>';
        }
    }

} else if(isset($row2['ContractType']) && $row2['ContractType'] == "Sales") {

    echo '
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label>Contract Type: </label>
                '.$row2['ContractType'].'
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label>Customer Name: </label>
                '.$row2['SaleCustomerName'].'
        </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label>Sales SO Number: </label>
                '.$row2['SaleCustomerSoNum'].'
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label>Contract # :</label>
                '.$row2['ContractNo'].'
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label>Quality: </label>
                '.$row2['Quality'].'
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label>Variety: </label>
                '.$row2['Variety'].'
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label>Date Of Contract: </label>
                '.date('d-M-Y', strtotime(explode(" ", $row2['DefaultDate'])[0])).'
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
                        <td>'.$row2['OurReference'].'</td>
                    </tr>
                    <tr>
                        <td><label>SO#: </label></td>
                        <td>'.$row2['SaleOrderNum'].'</td>
                    </tr>
                    <tr>
                        <td><label>Brand: </label></td>
                        <td>'.$row2['Brand'].'</td>
                    </tr>
                    <tr>
                        <td><label>Quantity: </label></td>
                        <td>'.$row2['Quantity'].'</td>
                    </tr>
                    <tr>
                        <td><label>Moisture: </label></td>
                        <td>'.$row2['Moisture'].'</td>
                    </tr>
                    <tr>
                        <td><label>Payment Terms: </label></td>
                        <td>'.$row2['PaymentTerms'].'</td>
                    </tr>
                    <tr>
                        <td><label>Price: </label></td>
                        <td>'.$row2['Price'].'</td>
                    </tr>
                    <tr>
                        <td><label>Chalky & Immature Kernels: </label></td>
                        <td>'.$row2['ChalkyImmatureKernels'].'</td>
                    </tr>
                    <tr>
                        <td><label>Packing / Packing Weight: </label></td>
                        <td>'.$row2['PackingWeight'].'</td>
                    </tr>
                    <tr>
                        <td><label>Tags: </label></td>
                        <td>'.$row2['Tags'].'</td>
                    </tr>
                    <tr>
                        <td><label>Loading Bags Per Container: </label></td>
                        <td>'.$row2['LoadingBags'].'</td>
                    </tr>
                    <tr>
                        <td><label>Expected Inspection Date: </label></td>
                        <td>'.$row2['InspectionDate'].'</td>
                    </tr>
                    <tr>
                        <td><label>Empty Bags Loading: </label></td>
                        <td>'.$row2['EmptyBagsLoading'].'</td>
                    </tr>
                    <tr>
                        <td><label>Fumigation: </label></td>
                        <td>'.$row2['Fumigation'].'</td>
                    </tr>
                    <tr>
                        <td><label>Silica Gel: </label></td>
                        <td>'.$row2['Silicagel'].'</td>
                    </tr>
                    <tr>
                        <td><label>Kraft Paper/Plastic: </label></td>
                        <td>'.$row2['KraftPaper'].'</td>
                    </tr>
                    <tr>
                        <td><label>Special Instructions: </label></td>
                        <td>'.$row2['SpecialInstruction'].'</td>
                    </tr>
                    <tr>
                        <td><label>Processing Mill: </label></td>
                        <td>'.$row2['ProcessingMill'].'</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    ';
    $sqlExtension = 'SELECT * FROM extendcontract WHERE ContractNo = ' . $row2['ContractNo'];
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
                        <th>SO #</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>'.$rowExtension['ExtendDate'].'</td>
                            <td>'.$rowExtension['Packing'].'</td>
                            <td>'.$rowExtension['Polishing'].'</td>
                            <td>'.$rowExtension['Broken'].'</td>
                            <td>'.$rowExtension['ExtendQty'].'</td>
                            <td>'.$rowExtension['ProdOrderNo'].'</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>';
        }
    }
} 
?>