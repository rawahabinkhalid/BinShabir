<?php
include_once('conn.php');
?>

<!DOCTYPE html>
<html lang="en">
<!-- Mirrored from mannatthemes.com/metrica/material-vertical-2/projects/projects-index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 10 Mar 2020 08:03:26 GMT -->

<head>
    <meta charset="utf-8">
    <title>Asset In - Dashboard</title>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta content="A premium admin dashboard template by Mannatthemes" name="description">
    <meta content="Mannatthemes" name="author">
    <!-- App favicon -->
    <link rel="shortcut icon" href="../assets/images/favicon.ico">
    <!--Morris Chart CSS -->
    <link rel="stylesheet" href="../assets/plugins/morris/morris.css">
    <!-- App css -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="../assets/css/icons.css" rel="stylesheet" type="text/css">
    <link href="../assets/css/metisMenu.min.css" rel="stylesheet" type="text/css">
    <link href="../assets/css/style.css" rel="stylesheet" type="text/css">
    <style>
    label {
        font-weight: bold;
    }
    </style>
</head>

<body>
    <!-- Top Bar Start -->
    <?php
    include_once('header.php');
    ?>
    <div class="page-wrapper">
        <!-- Left Sidenav -->
        <?php
            include_once('sidebar.php');
        ?>

        <!-- Page Content-->
        <div class="page-content">
            <div class="container-fluid">
                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-box">
                            <div class="float-right">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="">RiceMill</a></li>
                                    <li class="breadcrumb-item active">Add Asset</li>
                                </ol>
                            </div>
                            <h4 class="page-title"></h4>
                        </div>
                        <!--end page-title-box-->
                    </div>
                    <!--end col-->
                </div>
                <!-- end page title end breadcrumb -->
                <form action="AddAssetInSubmit.php" method="POST">
                    <br><br>
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Name:</label>
                                <select name="name" id="" class="form-control" placeholder="" required>
                                    <option value="" selected disabled>Please select an asset</option>
                                    <?php
                                    $sqlAsset = 'SELECT * FROM asset';
                                    $resultAsset = $conn->query($sqlAsset);
                                    if($resultAsset->num_rows > 0) {
                                        while($rowAsset = $resultAsset->fetch_assoc()) {
                                            echo '<option value="'.$rowAsset['AssetId'].'">'.$rowAsset['AssetName'].'</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Description:</label>
                                <input type="text" name="description" id="" class="form-control" placeholder="" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Brand:</label>
                                <input type="text" name="brand" id="" class="form-control" placeholder="" required>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Type:</label>
                                <select name="asset_type" id="asset_type" class="form-control" placeholder="" required>
                                    <option value="" selected disabled>Please select an asset</option>
                                    <option value="Fixed">Fixed</option>
                                    <option value="Consumable">Consumable</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Price:</label>
                                <input type="number" name="price" id="" class="form-control" placeholder="" required>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Date:</label>
                                <input type="date" name="date" id="" value="<?php echo date('Y-m-d'); ?>" class="form-control" placeholder="" required>
                            </div>
                        </div>
                        <div class="col-md-2" id="deprecationDiv" style="display: none;">
                            <div class="form-group">
                                <label>Depreciation Rate:</label>
                                <input type="number" name="deprication" id="deprication" min="0" step="0.5" value="0" max="100" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <br>
                            <div class="form-group">
                                <button type="submit" id="submitbutton" class="btn btn-success">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!-- container -->
            <footer class="footer text-center text-sm-left">&copy; <b>2020 <a href="https://matz.group/"> MATZ SOLUTIONS
                        PVT.LTD</a> </b> <span class="text-muted d-none d-sm-inline-block float-right"></i> All Right
                    Reserved</span>
            </footer>
            <!--end footer-->
        </div>
        <!-- end page content -->
    </div>
    <!-- end page-wrapper -->
    <!-- jQuery  -->
    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/metisMenu.min.js"></script>
    <script src="../assets/js/waves.min.js"></script>
    <script src="../assets/js/jquery.slimscroll.min.js"></script>
    <!--Plugins-->
    <script src="../assets/plugins/morris/morris.min.js"></script>
    <script src="../assets/plugins/raphael/raphael.min.js"></script>
    <script src="../assets/plugins/moment/moment.js"></script>
    <script src="../assets/plugins/apexcharts/apexcharts.min.js"></script>
    <script src="../assets/pages/jquery.projects_dashboard.init.js"></script>
    <!-- App js -->
    <script src="../assets/js/app.js"></script>

    <!-- PHONE NO VALIDATION      -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3/jquery.inputmask.bundle.js"></script>
    <script>
    $(":input").inputmask();
    </script>

    <script>
    function checkNumber() {
        str = document.getElementById('Phoneno').value;
        console.log(str)
        if (str.substring(0, 2) == '03') {
            jQuery('#submitbutton').prop("disabled", false);
        } else {
            alert('Please enter correct mobile number');
            jQuery('#submitbutton').prop("disabled", true);
            return false;
        }
    }

    function checkCNIC() {
        var flag = false;
        regexp = /^(?!000|666)[0-8][0-9]{4}-(?!00)[0-9]{7}-(?!0000)[0-9]{1}$/;
        str = document.getElementById('cnic').value;
        if (regexp.test(str)) {
            jQuery('#submitbutton').prop("disabled", false);

        } else {
            alert('Please enter correct CNIC number');
            jQuery('#submitbutton').prop("disabled", true);
            return false;
        }
    }

    $('#deprication').on('change', function() {
        if($(this).val() == '')
            $(this).val($(this).attr('min'))
        if(parseFloat($(this).val()) < parseFloat($(this).attr('min')))
            $(this).val($(this).attr('min'))
        if(parseFloat($(this).val()) > parseFloat($(this).attr('max')))
            $(this).val($(this).attr('max'))
    })

    $('#asset_type').on('change', function() {
        if($(this).val() == 'Fixed') {
            $('#deprecationDiv').css('display', '');
            $('#deprication').prop('required', true);
            $('#deprication').val('0');
        }
        else {
            $('#deprecationDiv').css('display', 'none');
            $('#deprication').val('');
            $('#deprication').prop('required', false);
        }
    })
    </script>

    <script>
    $('#headername').html("Asset In");
    </script>

</body>

</html>