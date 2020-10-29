<?php
include_once('conn.php');

$sql = 'SELECT * FROM makecontract WHERE ContractNo = '.$_POST['contract_no'];
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
?>

<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label>Contract Type:</label>
            <select class="form-control" name="contracttype" required>
                <option <?php echo ($row['ContractType']=="") ? 'selected' : '' ;?> selected disabled>Select Contract Type</option>
                <option <?php echo ($row['ContractType']=="Debtor/AccountReceivable") ? 'selected' : '' ;?> value="Debtor/AccountReceivable"> Debtor/AccountReceivable</option>
                <option <?php echo ($row['ContractType']=="Supplier/Creditor") ? 'selected' : '' ;?> value="Supplier/Creditor"> Supplier/Creditor</option>
                <option <?php echo ($row['ContractType']=="Capital") ? 'selected' : '' ;?> value="Capital"> Capital</option>
                <option <?php echo ($row['ContractType']=="Revenue") ? 'selected' : '' ;?> value="Revenue"> Revenue</option>
                <option <?php echo ($row['ContractType']=="Expenditure") ? 'selected' : '' ;?> value="Expenditure"> Expenditure</option>
                <option <?php echo ($row['ContractType']=="Liability") ? 'selected' : '' ;?> value="Liability"> Liability</option>
            </select>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>Customer Name:</label>
            <input type="text" name="customername" value="<?php echo $row['CustomerName'] ?>" class="form-control">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>Customer PO Number:</label>
            <input type="text" name="customerPoNum" value="<?php echo $row['CustomerPoNum'] ?>" class="form-control">
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
                <option <?php echo ($row['Quality']== "") ? 'selected' : '' ;?> selected disabled>Select Quality</option>
                <option <?php echo ($row['Quality']== "Parboiled") ? 'selected' : '' ;?> value="Parboiled">Parboiled</option>
                <option <?php echo ($row['Quality']== "Prestream") ? 'selected' : '' ;?> value="Prestream">Prestream</option>
                <option <?php echo ($row['Quality']== "Brown") ? 'selected' : '' ;?> value="Brown">Brown</option>
                <option <?php echo ($row['Quality']== "White") ? 'selected' : '' ;?> value="White">White</option>
            </select>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>Variety:</label>
            <select class="form-control" name="variety" required>
                <option <?php echo ($row['Variety'] == "") ? 'selected' : '' ;?> selected disabled>Select Variety</option>
                <option <?php echo ($row['Variety'] == "1121 Kainaat") ? 'selected' : '' ;?> value="1121 Kainaat">1121 Kainaat</option>
                <option <?php echo ($row['Variety'] == "Super Kernal Basmati Sindh-Punjab") ? 'selected' : '' ;?> value="Super Kernal Basmati Sindh-Punjab">Super Kernal Basmati Sindh-Punjab</option>
                <option <?php echo ($row['Variety'] == "Rice 386 Basmati") ? 'selected' : '' ;?> value="Rice 386 Basmati">Rice 386 Basmati</option>
                <option <?php echo ($row['Variety'] == "Rice 386 Supri") ? 'selected' : '' ;?> value="Rice 386 Supri">Rice 386 Supri</option>
                <option <?php echo ($row['Variety'] == "Super Fine") ? 'selected' : '' ;?> value="Super Fine">Super Fine</option>
                <option <?php echo ($row['Variety'] == "Irri 9-C9") ? 'selected' : '' ;?> value="Irri 9-C9">Irri 9-C9</option>
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
    <div class="col-md-8">
        <div class="form-group">
            <label>Our Reference:</label>
            <input type="text" name="ourreference" value="<?php echo $row['OurReference'] ?>" class="form-control" required>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>Production Order No:</label>
            <input type="text" name="productionordernum" value="<?php echo $row['ProductionOrderNum'] ?>" class="form-control" required>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label>Bags Filling:</label>
            <input type="text" name="bagsfilling" value="<?php echo $row['BagsFilling'] ?>" class="form-control" required>
        </div>
    </div>
    <div class="col-md-8">
        <div class="form-group">
            <label>Brand:</label>
            <input type="text" name="brand" value="<?php echo $row['Brand'] ?>" class="form-control" required>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label>Milled Qunatity M/T:</label>
            <input type="text" name="milledquantity" value="<?php echo $row['MilledQuantity'] ?>" class="form-control" required>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>Whiteness:</label>
            <input type="text" name="whiteness" value="<?php echo $row['Whiteness'] ?>" class="form-control" required>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-2">
        <div class="form-group">
            <label>Broken Percentage:</label>
            <input type="text" name="brokenpercentage" value="<?php echo $row['BrokenPercentage'] ?>" class="form-control" required>
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label>Moisture:</label>
            <input type="text" name="moisture" value="<?php echo $row['Moisture'] ?>" class="form-control" required>
        </div>
    </div>
    <div class="col-md-8">
        <div class="form-group">
            <label>Chalky & Immature Kernels:</label>
            <input type="text" name="chalkyimmaturekernels" value="<?php echo $row['ChalkyImmatureKernels'] ?>" class="form-control" required>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-10">
        <div class="form-group">
            <label>Packing / Packing Weight:</label>
            <input type="text" name="packingweight" value="<?php echo $row['PackingWeight'] ?>" class="form-control" required>
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
            <input type="text" name="loadingbags" value="<?php echo $row['LoadingBags'] ?>" class="form-control" required>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label>Expected Inspection Date:</label>
            <input type="date" name="inspectiondate" value="<?php echo $row['InspectionDate'] ?>" class="form-control" required>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label>Empty Bags Loading:</label>
            <input type="text" name="emptybagsloading" value="<?php echo $row['InspectionDate'] ?>" class="form-control" required>
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
            <input type="text" name="specialinstruction" value="<?php echo $row['SpecialInstruction'] ?>" class="form-control">
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>Processing Mill:</label>
            <input type="text" name="processingmill" value="<?php echo $row['ProcessingMill'] ?>" class="form-control">
        </div>
    </div>
</div>