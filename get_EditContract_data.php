<?php
include_once('conn.php');

$sql = 'SELECT * FROM debtor WHERE ContractNo = '.$_POST['contract_no'];
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

$sql1 = 'SELECT * FROM creditor WHERE ContractNo = ' . $_POST['contract_no'];
$result1 = mysqli_query($conn, $sql1);
$row1 = mysqli_fetch_assoc($result1);

$sql2 = 'SELECT * FROM toolmillcontract WHERE ContractNo = ' . $_POST['contract_no'];
$result2 = mysqli_query($conn, $sql2);
$row2 = mysqli_fetch_assoc($result2);

?>

<?php 
if(isset($row['ContractType']) && $row['ContractType'] == "Debtor/AccountReceivable/Sales"){
?>

<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label>Contract Type:</label>
            <input class="form-control" name="contracttype" value="<?php echo $row['ContractType']?>" readonly>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>Sales Customer Name:</label>
            <input type="text" name="salecustomername" value="<?php echo $row['SaleCustomerName'] ?>"
                class="form-control">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>Sales SO Number:</label>
            <input type="text" name="salecustomerSoNum" value="<?php echo $row['SaleCustomerSoNum'] ?>"
                class="form-control">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label>Contract #:</label>
            <input type="text" name="ContractNo" value="<?php echo $row['ContractNo'] ?>" class="form-control" readonly>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>Quality:</label>
            <select class="form-control" name="quality" required>
                <option <?php echo ($row['Quality']== "") ? 'selected' : '' ;?> selected disabled>Select Quality
                </option>
                <option <?php echo ($row['Quality']== "Brown") ? 'selected' : '' ;?> value="Brown">Brown</option>
                <option <?php echo ($row['Quality']== "Paddy") ? 'selected' : '' ;?> value="Paddy">Paddy</option>
                <option <?php echo ($row['Quality']== "Parboiled") ? 'selected' : '' ;?> value="Parboiled">Parboiled
                </option>
                <option <?php echo ($row['Quality']== "Prestream") ? 'selected' : '' ;?> value="Prestream">Prestream
                </option>
                <option <?php echo ($row['Quality']== "White") ? 'selected' : '' ;?> value="White">White</option>
            </select>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>Variety:</label>
            <select class="form-control" name="variety" required>
                <option <?php echo ($row['Variety'] == "") ? 'selected' : '' ;?> selected disabled>Select Variety
                </option>
                <option <?php echo ($row['Variety'] == "1121 Kainaat") ? 'selected' : '' ;?> value="1121 Kainaat">1121
                    Kainaat</option>
                <option <?php echo ($row['Variety'] == "Super Kernal Basmati Sindh-Punjab") ? 'selected' : '' ;?>
                    value="Super Kernal Basmati Sindh-Punjab">Super Kernal Basmati Sindh-Punjab</option>
                <option <?php echo ($row['Variety'] == "Rice 386 Basmati") ? 'selected' : '' ;?>
                    value="Rice 386 Basmati">Rice 386 Basmati</option>
                <option <?php echo ($row['Variety'] == "Rice 386 Supri") ? 'selected' : '' ;?> value="Rice 386 Supri">
                    Rice 386 Supri</option>
                <option <?php echo ($row['Variety'] == "Super Fine") ? 'selected' : '' ;?> value="Super Fine">Super Fine
                </option>
                <option <?php echo ($row['Variety'] == "Irri 9-C9") ? 'selected' : '' ;?> value="Irri 9-C9">Irri 9-C9
                </option>
                <option <?php echo ($row['Variety'] == "Irri 6") ? 'selected' : '' ;?> value="Irri 6">Irri 6</option>
                <option <?php echo ($row['Variety'] == "D-98") ? 'selected' : '' ;?> value="D-98">D-98</option>
                <option <?php echo ($row['Variety'] == "KS-282") ? 'selected' : '' ;?> value="KS-282">KS-282</option>
            </select>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label>
                <h3 style="color: #7088C8"><u>Requirement Form:</u></h3>
            </label>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label>Our Reference:</label>
            <input type="text" name="ourreference" value="<?php echo $row['OurReference'] ?>" class="form-control">
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label>Broken %:</label>
            <input type="text" name="brokenpercentage" value="<?php echo $row['BrokenPercentage'] ?>"
                class="form-control">
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label>Brand:</label>
            <input type="text" name="brand" value="<?php echo $row['Brand'] ?>" class="form-control" required>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <label>Quantity:</label>
            <input type="text" name="quantity" value="<?php echo $row['Quantity'] ?>" class="form-control">
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label>Moisture:</label>
            <input type="text" name="moisture" value="<?php echo $row['Moisture'] ?>" class="form-control">
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label>Payment Terms:</label>
            <input type="text" name="paymentterms" value="<?php echo $row['PaymentTerms'] ?>" class="form-control"
                required>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label>Price:</label>
            <input type="text" name="price" value="<?php echo $row['Price'] ?>" class="form-control" required>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-5">
        <div class="form-group">
            <label>Chalky & Immature Kernels:</label>
            <input type="text" name="chalkyimmaturekernels" value="<?php echo $row['ChalkyImmatureKernels'] ?>"
                class="form-control">
        </div>
    </div>
    <div class="col-md-5">
        <div class="form-group">
            <label>Packing Material/Packing Weight:</label>

            <input type="text" name="packingweight" value="<?php echo $row['PackingWeight'] ?>" class="form-control"
                required>
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label>Tags:</label>
            <input type="text" name="tags" value="<?php echo $row['Tags'] ?>" class="form-control" required>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label>Loading Bags Per Container:</label>
            <input type="text" name="loadingbags" value="<?php echo $row['LoadingBags'] ?>" class="form-control"
                required>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label>Expected Inspection Date:</label>
            <input type="date" name="inspectiondate" value="<?php echo $row['InspectionDate'] ?>" class="form-control"
                required>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label>Empty Bags Loading:</label>
            <input type="text" name="emptybagsloading" value="<?php echo $row['EmptyBagsLoading'] ?>"
                class="form-control" required>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label>Fumigation:</label>
            <input type="text" name="fumigation" value="<?php echo $row['Fumigation'] ?>" class="form-control">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>Silica Gel:</label>
            <input type="text" name="silicagel" value="<?php echo $row['Silicagel'] ?>" class="form-control">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>Kraft Paper/Plastic:</label>
            <input type="text" name="kraftpaper" value="<?php echo $row['KraftPaper'] ?>" class="form-control">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label>Special Instructions:</label>
            <input type="text" name="specialinstruction" value="<?php echo $row['SpecialInstruction'] ?>"
                class="form-control">
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>Processing Mill:</label>
            <input type="text" name="processingmill" value="<?php echo $row['ProcessingMill'] ?>" class="form-control">
        </div>
    </div>
</div>
<?php
}
?>

<?php 
if(isset($row1['ContractType']) && $row1['ContractType'] == "Creditor/AccountPayable/Purchase"){
?>

<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label>Contract Type:</label>
            <input class="form-control" name="contracttype" value="<?php echo $row1['ContractType']?>" readonly>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>Purchase Supplier Name:</label>
            <input type="text" name="purchasesuppliername" value="<?php echo $row1['PurchaseSupplierName'] ?>"
                class="form-control">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>Purchase PO Number:</label>
            <input type="text" name="purchasesupplierPoNum" value="<?php echo $row1['PurchaseSupplierSoNum'] ?>"
                class="form-control">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label>Contract #:</label>
            <input type="text" name="ContractNo" value="<?php echo $row1['ContractNo'] ?>" class="form-control"
                readonly>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>Quality:</label>
            <select class="form-control" name="quality" required>
                <option <?php echo ($row1['Quality']== "") ? 'selected' : '' ;?> selected disabled>Select Quality
                </option>
                <option <?php echo ($row1['Quality']== "Brown") ? 'selected' : '' ;?> value="Brown">Brown</option>
                <option <?php echo ($row1['Quality']== "Paddy") ? 'selected' : '' ;?> value="Paddy">Paddy</option>
                <option <?php echo ($row1['Quality']== "Parboiled") ? 'selected' : '' ;?> value="Parboiled">Parboiled
                </option>
                <option <?php echo ($row1['Quality']== "Prestream") ? 'selected' : '' ;?> value="Prestream">Prestream
                </option>
                <option <?php echo ($row1['Quality']== "White") ? 'selected' : '' ;?> value="White">White</option>
            </select>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>Variety:</label>
            <select class="form-control" name="variety" required>
                <option <?php echo ($row1['Variety'] == "") ? 'selected' : '' ;?> selected disabled>Select Variety
                </option>
                <option <?php echo ($row1['Variety'] == "1121 Kainaat") ? 'selected' : '' ;?> value="1121 Kainaat">1121
                    Kainaat</option>
                <option <?php echo ($row1['Variety'] == "Super Kernal Basmati Sindh-Punjab") ? 'selected' : '' ;?>
                    value="Super Kernal Basmati Sindh-Punjab">Super Kernal Basmati Sindh-Punjab</option>
                <option <?php echo ($row1['Variety'] == "Rice 386 Basmati") ? 'selected' : '' ;?>
                    value="Rice 386 Basmati">Rice 386 Basmati</option>
                <option <?php echo ($row1['Variety'] == "Rice 386 Supri") ? 'selected' : '' ;?> value="Rice 386 Supri">
                    Rice 386 Supri</option>
                <option <?php echo ($row1['Variety'] == "Super Fine") ? 'selected' : '' ;?> value="Super Fine">Super
                    Fine
                </option>
                <option <?php echo ($row1['Variety'] == "Irri 9-C9") ? 'selected' : '' ;?> value="Irri 9-C9">Irri 9-C9
                </option>
                <option <?php echo ($row1['Variety'] == "Irri 6") ? 'selected' : '' ;?> value="Irri 6">Irri 6</option>
                <option <?php echo ($row1['Variety'] == "D-98") ? 'selected' : '' ;?> value="D-98">D-98</option>
                <option <?php echo ($row1['Variety'] == "KS-282") ? 'selected' : '' ;?> value="KS-282">KS-282</option>
            </select>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label>
                <h3 style="color: #7088C8"><u>Requirement Form:</u></h3>
            </label>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label>Our Reference:</label>
            <input type="text" name="ourreference" value="<?php echo $row1['OurReference'] ?>" class="form-control">
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label>Broken %:</label>
            <input type="text" name="brokenpercentage" value="<?php echo $row1['BrokenPercentage'] ?>"
                class="form-control">
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label>Brand:</label>
            <input type="text" name="brand" value="<?php echo $row1['Brand'] ?>" class="form-control" required>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <label>Quantity:</label>
            <input type="text" name="quantity" value="<?php echo $row1['Quantity'] ?>" class="form-control">
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label>Moisture:</label>
            <input type="text" name="moisture" value="<?php echo $row1['Moisture'] ?>" class="form-control">
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label>Payment Terms:</label>
            <input type="text" name="paymentterms" value="<?php echo $row1['PaymentTerms'] ?>" class="form-control"
                required>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label>Price:</label>
            <input type="text" name="price" value="<?php echo $row1['Price'] ?>" class="form-control" required>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-5">
        <div class="form-group">
            <label>Chalky & Immature Kernels:</label>
            <input type="text" name="chalkyimmaturekernels" value="<?php echo $row1['ChalkyImmatureKernels'] ?>"
                class="form-control">
        </div>
    </div>
    <div class="col-md-5">
        <div class="form-group">
            <label>Packing Material/Packing Weight:</label>

            <input type="text" name="packingweight" value="<?php echo $row1['PackingWeight'] ?>" class="form-control"
                required>
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label>Tags:</label>
            <input type="text" name="tags" value="<?php echo $row1['Tags'] ?>" class="form-control" required>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label>Loading Bags Per Container:</label>
            <input type="text" name="loadingbags" value="<?php echo $row1['LoadingBags'] ?>" class="form-control"
                required>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label>Expected Inspection Date:</label>
            <input type="date" name="inspectiondate" value="<?php echo $row1['InspectionDate'] ?>" class="form-control"
                required>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label>Empty Bags Loading:</label>
            <input type="text" name="emptybagsloading" value="<?php echo $row1['EmptyBagsLoading'] ?>"
                class="form-control" required>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label>Fumigation:</label>
            <input type="text" name="fumigation" value="<?php echo $row1['Fumigation'] ?>" class="form-control">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>Silica Gel:</label>
            <input type="text" name="silicagel" value="<?php echo $row1['Silicagel'] ?>" class="form-control">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>Kraft Paper/Plastic:</label>
            <input type="text" name="kraftpaper" value="<?php echo $row1['KraftPaper'] ?>" class="form-control">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label>Special Instructions:</label>
            <input type="text" name="specialinstruction" value="<?php echo $row1['SpecialInstruction'] ?>"
                class="form-control">
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>Processing Mill:</label>
            <input type="text" name="processingmill" value="<?php echo $row1['ProcessingMill'] ?>" class="form-control">
        </div>
    </div>
</div>
<?php
}
?>

<?php 
if(isset($row2['ContractType']) && $row2['ContractType'] == "Sales"){
?>

<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label>Contract Type:</label>
            <input class="form-control" name="contracttype" value="<?php echo $row2['ContractType']?>" readonly>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>Customer Name::</label>
            <input type="text" name="salecustomername_toolmill" value="<?php echo $row2['SaleCustomerName'] ?>"
                class="form-control">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>Sales SO Number:</label>
            <input type="text" name="salecustomerSoNum_toolmill" value="<?php echo $row2['SaleCustomerSoNum'] ?>"
                class="form-control">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label>Contract #:</label>
            <input type="text" name="ContractNo" value="<?php echo $row2['ContractNo'] ?>" class="form-control"
                readonly>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>Quality:</label>
            <select class="form-control" name="quality" required>
                <option <?php echo ($row2['Quality']== "") ? 'selected' : '' ;?> selected disabled>Select Quality
                </option>
                <option <?php echo ($row2['Quality']== "Brown") ? 'selected' : '' ;?> value="Brown">Brown</option>
                <option <?php echo ($row2['Quality']== "Paddy") ? 'selected' : '' ;?> value="Paddy">Paddy</option>
                <option <?php echo ($row2['Quality']== "Parboiled") ? 'selected' : '' ;?> value="Parboiled">Parboiled
                </option>
                <option <?php echo ($row2['Quality']== "Prestream") ? 'selected' : '' ;?> value="Prestream">Prestream
                </option>
                <option <?php echo ($row2['Quality']== "White") ? 'selected' : '' ;?> value="White">White</option>
            </select>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>Variety:</label>
            <select class="form-control" name="variety" required>
                <option <?php echo ($row2['Variety'] == "") ? 'selected' : '' ;?> selected disabled>Select Variety
                </option>
                <option <?php echo ($row2['Variety'] == "1121 Kainaat") ? 'selected' : '' ;?> value="1121 Kainaat">1121
                    Kainaat</option>
                <option <?php echo ($row2['Variety'] == "Super Kernal Basmati Sindh-Punjab") ? 'selected' : '' ;?>
                    value="Super Kernal Basmati Sindh-Punjab">Super Kernal Basmati Sindh-Punjab</option>
                <option <?php echo ($row2['Variety'] == "Rice 386 Basmati") ? 'selected' : '' ;?>
                    value="Rice 386 Basmati">Rice 386 Basmati</option>
                <option <?php echo ($row2['Variety'] == "Rice 386 Supri") ? 'selected' : '' ;?> value="Rice 386 Supri">
                    Rice 386 Supri</option>
                <option <?php echo ($row2['Variety'] == "Super Fine") ? 'selected' : '' ;?> value="Super Fine">Super
                    Fine
                </option>
                <option <?php echo ($row2['Variety'] == "Irri 9-C9") ? 'selected' : '' ;?> value="Irri 9-C9">Irri 9-C9
                </option>
                <option <?php echo ($row2['Variety'] == "Irri 6") ? 'selected' : '' ;?> value="Irri 6">Irri 6</option>
                <option <?php echo ($row2['Variety'] == "D-98") ? 'selected' : '' ;?> value="D-98">D-98</option>
                <option <?php echo ($row2['Variety'] == "KS-282") ? 'selected' : '' ;?> value="KS-282">KS-282</option>
            </select>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label>
                <h3 style="color: #7088C8"><u>Requirement Form:</u></h3>
            </label>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label>Our Reference:</label>
            <input type="text" name="ourreference" value="<?php echo $row2['OurReference'] ?>" class="form-control">
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label>Broken %:</label>
            <input type="text" name="brokenpercentage" value="<?php echo $row2['BrokenPercentage'] ?>"
                class="form-control">
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label>Brand:</label>
            <input type="text" name="brand" value="<?php echo $row2['Brand'] ?>" class="form-control" required>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <label>Quantity:</label>
            <input type="text" name="quantity" value="<?php echo $row2['Quantity'] ?>" class="form-control">
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label>Moisture:</label>
            <input type="text" name="moisture" value="<?php echo $row2['Moisture'] ?>" class="form-control">
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label>Payment Terms:</label>
            <input type="text" name="paymentterms" value="<?php echo $row2['PaymentTerms'] ?>" class="form-control"
                required>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label>Price:</label>
            <input type="text" name="price" value="<?php echo $row2['Price'] ?>" class="form-control" required>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-5">
        <div class="form-group">
            <label>Chalky & Immature Kernels:</label>
            <input type="text" name="chalkyimmaturekernels" value="<?php echo $row2['ChalkyImmatureKernels'] ?>"
                class="form-control">
        </div>
    </div>
    <div class="col-md-5">
        <div class="form-group">
            <label>Packing Material/Packing Weight:</label>

            <input type="text" name="packingweight" value="<?php echo $row2['PackingWeight'] ?>" class="form-control"
                required>
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label>Tags:</label>
            <input type="text" name="tags" value="<?php echo $row2['Tags'] ?>" class="form-control" required>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label>Loading Bags Per Container:</label>
            <input type="text" name="loadingbags" value="<?php echo $row2['LoadingBags'] ?>" class="form-control"
                required>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label>Expected Inspection Date:</label>
            <input type="date" name="inspectiondate" value="<?php echo $row2['InspectionDate'] ?>" class="form-control"
                required>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label>Empty Bags Loading:</label>
            <input type="text" name="emptybagsloading" value="<?php echo $row2['EmptyBagsLoading'] ?>"
                class="form-control" required>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label>Fumigation:</label>
            <input type="text" name="fumigation" value="<?php echo $row2['Fumigation'] ?>" class="form-control">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>Silica Gel:</label>
            <input type="text" name="silicagel" value="<?php echo $row2['Silicagel'] ?>" class="form-control">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>Kraft Paper/Plastic:</label>
            <input type="text" name="kraftpaper" value="<?php echo $row2['KraftPaper'] ?>" class="form-control">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label>Special Instructions:</label>
            <input type="text" name="specialinstruction" value="<?php echo $row2['SpecialInstruction'] ?>"
                class="form-control">
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>Processing Mill:</label>
            <input type="text" name="processingmill" value="<?php echo $row2['ProcessingMill'] ?>" class="form-control">
        </div>
    </div>
</div>
<?php
}
?>