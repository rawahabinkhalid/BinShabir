<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('location: index.php');
}

include_once('conn.php');
?>

<!DOCTYPE html>
<html lang="en">
<!-- Mirrored from mannatthemes.com/metrica/material-vertical-2/projects/projects-index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 10 Mar 2020 08:03:26 GMT -->

<head>
    <meta charset="utf-8">
    <title>Add Party/Customer - Dashboard</title>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta content="A premium admin dashboard template by Mannatthemes" name="description">
    <meta content="Mannatthemes" name="author">
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">
    <!--Morris Chart CSS -->
    <link rel="stylesheet" href="assets/plugins/morris/morris.css">
    <!-- App css -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="assets/css/icons.css" rel="stylesheet" type="text/css">
    <link href="assets/css/metisMenu.min.css" rel="stylesheet" type="text/css">
    <link href="assets/css/style.css" rel="stylesheet" type="text/css">
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
                                    <li class="breadcrumb-item active">Add party</li>
                                </ol>
                            </div>
                            <h4 class="page-title"></h4>
                        </div>
                        <!--end page-title-box-->
                    </div>
                    <!--end col-->
                </div>
                <!-- end page title end breadcrumb -->
                <form action="AddPartySubmit.php" method="POST">
                    <br><br>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Type:</label>
                                <select type="text" name="type" id="" class="form-control" placeholder="" required>
                                    <option selected disabled>Select Contract Type</option>
                                    <option value="Debtor/AccountReceivable"> Debtor/AccountReceivable</option>
                                    <option value="Creditor/AccountPayable">Creditor/AccountPayable</option>
                                    <!-- <option value="Capital">Capital</option>
                                    <option value="Revenue">Revenue</option>
                                    <option value="Expenditure">Expenditure</option>
                                    <option value="Liability">Liability</option> -->
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Name: <span class="text-danger">*</span></label>
                                <input type="text" name="partyname" id="" class="form-control" placeholder="" required maxlength="100" onkeypress="return onlyAlphabets(event,this);">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Name Initials:</label>
                                <input type="text" name="nameinitials" id="" class="form-control" placeholder="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Address: <span class="text-danger">*</span></label>
                                <input type="text" name="address" id="" class="form-control" placeholder="" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>NTN:</label>
                                <input type="text" name="NTN" id="" class="form-control" placeholder="">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>GST No:</label>
                                <input type="text" name="GSTNo" id="" class="form-control" placeholder="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Phone No: <span class="text-danger">*</span></label>
                                <input type="text" name="Phoneno" id="Phoneno" class="form-control" required data-inputmask="'mask': '9999-9999999'" onchange="checkNumber();" placeholder="e.g. 0300-0000000" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Contact Person: <span class="text-danger">*</span></label>
                                <input type="text" name="contactperson" id="" class="form-control" placeholder="" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Email:</label>
                                <input type="email" name="email" id="" class="form-control" placeholder="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Dispatch Address:</label>
                                <input type="text" name="dispatchaddress" id="" class="form-control" placeholder="">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>CNIC:</label>
                                <input type="text" name="cnic" id="cnic" data-inputmask="'mask': '99999-9999999-9'" onchange="checkCNIC();" class="form-control" placeholder="e.g. 41111-1111111-1">
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
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/metisMenu.min.js"></script>
    <script src="assets/js/waves.min.js"></script>
    <script src="assets/js/jquery.slimscroll.min.js"></script>
    <!--Plugins-->
    <script src="assets/plugins/morris/morris.min.js"></script>
    <script src="assets/plugins/raphael/raphael.min.js"></script>
    <script src="assets/plugins/moment/moment.js"></script>
    <script src="assets/plugins/apexcharts/apexcharts.min.js"></script>
    <script src="assets/pages/jquery.projects_dashboard.init.js"></script>
    <!-- App js -->
    <script src="assets/js/app.js"></script>

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
            if (regexp.test(str) || str == "" ) {
                jQuery('#submitbutton').prop("disabled", false);

            } else {
                alert('Please enter correct CNIC number');
                jQuery('#submitbutton').prop("disabled", true);
                return false;
            }
        }
    </script>

    <script>
        $('#headername').html("Add Party / Customer");
    </script>

    <!-- Only Alphabets Entered in Name Input Box Start -->
    <script>
        function onlyAlphabets(e, t) {
            try {
                if (window.event) {
                    var charCode = window.event.keyCode;
                } else if (e) {
                    var charCode = e.which;
                } else {
                    return true;
                }
                if (!(charCode > 47 && charCode < 58)) // accept everything except numbers
                    return true;
                else
                    return false;
            } catch (err) {
                alert(err.Description);
            }
        }
    </script>
    <!-- Only Alphabets Entered in Name Input Box End -->


</body>

</html>