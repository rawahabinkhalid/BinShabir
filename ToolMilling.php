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
    <title>Tool Milling - Dashboard</title>
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

    .itembutton {

        font-size: 18px;
        color: #9C4BEB;
        background: transparent;
        border: 2px solid #9C4BEB;
        border-radius: 15px 15px 15px 15px;
        padding: 4px;
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
                                    <li class="breadcrumb-item active">Tool Milling</li>
                                </ol>
                            </div>
                            <h4 class="page-title"></h4>
                        </div>
                        <!--end page-title-box-->
                    </div>
                    <!--end col-->
                </div>
                <!-- end page title end breadcrumb -->
                <form action="ToolMillingSubmit.php" method="POST">
                    <br><br>
                    <div class="row">
                    <div class="col-md-4">
                            <div class="form-group">
                                <label>Contract #:</label>
                                <select class="form-control" name="contractno" id="contractno" required>
                                    <option selected disabled>Select Contract No</option>
                                    <?php
                                        $sql = 'SELECT * FROM makecontract';
                                        $result = mysqli_query($conn, $sql);
                                        while($row = mysqli_fetch_assoc($result)){
                                            echo'
                                            <option value="'.$row['ContractNo'].'">'.$row['ContractNo'].'</option>';
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Party Name :</label>
                                <input type="text" class="form-control" name="partyname" id="partyname" readonly>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Item Name :</label>
                                <input type="text" class="form-control" name="item_name" id="item_name" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>
                                    <h3 style="color: #7088C8"><u>Tool Milling:</u></h3>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Head:</label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Description:</label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Weight/Quantity:</label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Unit:</label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Rate:</label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Amount ( Rs. ):</label>
                            </div>
                        </div>
                    </div>
                    <div id="items">

                    </div>
                    <div class="row">
                        <div class="col-2">
                            <input name="addFieldButton" type="button" value="+Add Row" onclick="addField();"
                                class="form-control itembutton">
                        </div>
                        <div class="col-3">
                            <input name="delFieldButton" type="button" value="+Remove Row" onclick="delField();"
                                class="form-control itembutton">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-4">
                            <br>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!-- container -->
            <br><br><br>

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

    <script>
    $('#headername').html("Tool Milling");
    </script>

    <!-- script of add_button/del_button work -->
    <script>
    counter = -1;

    function addField() {
        counter++;

        var content = '';
        content += '<div class="row" id="ToolMilling_row_' + counter + '" name="ToolMilling_row">';
        content += '    <div class="col-md-2">';
        content += '        <div class="form-group">';
        content += '            <select name="head[]" class="form-control" required>';
        content += '                <option value="Select Head"  selected disabled>Select Head</option>';
        content += '                <option value="Processing">Processing</option>';
        content += '                <option value="Labour">Labour</option>';
        content += '            </select>';
        content += '        </div>';
        content += '    </div>';
        content += '    <div class="col-md-2">';
        content += '        <div class="form-group">';
        content += '            <input type="text" name="description[]" class="form-control">';
        content += '        </div>';
        content += '    </div>';
        content += '    <div class="col-md-2">';
        content += '        <div class="form-group">';
        content += '            <input type="text" name="weight[]" id="weight" class="form-control" onkeyup="sum(counter)">';
        content += '        </div>';
        content += '    </div>';
        content += '    <div class="col-md-2">';
        content += '        <div class="form-group">';
        content += '            <input type="text" name="unit[]" class="form-control">';
        content += '        </div>';
        content += '    </div>';
        content += '    <div class="col-md-2">';
        content += '        <div class="form-group">';
        content += '            <input type="text" name="rate[]" id="rate" class="form-control" onkeyup="sum(counter)">';
        content += '        </div>';
        content += '    </div>';
        content += '    <div class="col-md-2">';
        content += '        <div class="form-group">';
        content += '            <input type="text" name="amount[]" id="amount" class="form-control" readonly>';
        content += '        </div>';
        content += '    </div>';
        content += '</div>';
        $('#items').append(content);
    }

    function delField() {
        $("#ToolMilling_row_" + counter).remove();
        counter--;
    }
    </script>


    <script>
    // MULTIPLY OF TWO NUMBER FUNCTIONALITY
    function sum(counter) {
        console.log(counter)
        var weight = document.getElementsByName('weight[]')[counter].value;
        var rate = document.getElementsByName('rate[]')[counter].value;
        var result = parseInt(weight) * parseInt(rate);
        if (!isNaN(result)) {
            document.getElementsByName('amount[]')[counter].value = result;
        }
    }
    </script>

    <script>
    $('#contractno').on('change', function() {
        var contractno = $(this).val();

        $.ajax({
            type: 'POST',
            url: 'get_partyname_itemname.php',
            data: 'contractno=' + contractno,
            success: function(response) {
                console.log(response);

                var json_response = JSON.parse(response);

                $('#partyname').val(json_response.CustomerName);
                $('#item_name').val(json_response.Variety);
            },
        });
    })
    </script>
    
</body>

</html>