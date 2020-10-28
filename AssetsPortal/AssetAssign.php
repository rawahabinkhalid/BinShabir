<?php
include_once 'conn.php'; ?>

<!DOCTYPE html>
<html lang="en">
<!-- Mirrored from mannatthemes.com/metrica/material-vertical-2/projects/projects-index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 10 Mar 2020 08:03:26 GMT -->

<head>
    <meta charset="utf-8">
    <title>Assign Asset - Dashboard</title>
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
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
    <style>
    label {
        font-weight: bold;
    }
    </style>
</head>

<body>
    <!-- Top Bar Start -->
    <?php include_once 'header.php'; ?>
    <div class="page-wrapper">
        <!-- Left Sidenav -->
        <?php include_once 'sidebar.php'; ?>

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
                                    <li class="breadcrumb-item active">Assign Asset</li>
                                </ol>
                            </div>
                            <h4 class="page-title"></h4>
                        </div>
                        <!--end page-title-box-->
                    </div>
                    <!--end col-->
                </div>
                <!-- end page title end breadcrumb -->
                <form action="AddAssetAssignSubmit.php" method="POST">
                    <br><br>
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Name:</label>
                                <select name="name" id="name" class="form-control" placeholder="" required>
                                    <option value="" selected disabled>Please select an asset</option>
                                    <!-- </select> -->
                                    <?php
                                    $sqlAsset =
                                        'SELECT asset_in.Id, asset.AssetId, AssetName, Brand, Description, Price, SUM(AssetQty) FROM asset JOIN asset_in ON asset_in.AssetId = asset.AssetId GROUP BY asset_in.Id';
                                    $resultAsset = $conn->query($sqlAsset);
                                    // echo $sqlAsset;
                                    if ($resultAsset->num_rows > 0) {
                                        while (
                                            $rowAsset = $resultAsset->fetch_assoc()
                                        ) {
                                            $sqlAssetAssign =
                                                'SELECT asset_in.Id, asset.AssetId, AssetName, Brand, Description, Price, SUM(AssignedQty) FROM asset JOIN asset_in ON asset_in.AssetId = asset.AssetId LEFT JOIN asset_assign ON asset_in.Id = asset_assign.AssetInId WHERE asset.AssetId = ' .
                                                $rowAsset['AssetId'] .
                                                ' GROUP BY asset.AssetId';
                                            // echo $sqlAssetAssign;
                                            $resultAssetAssign = $conn->query(
                                                $sqlAssetAssign
                                            );
                                            $assignedQty = 0;
                                            if (
                                                $resultAssetAssign->num_rows > 0
                                            ) {
                                                $rowAssetAssign = $resultAssetAssign->fetch_assoc();
                                                $assignedQty = floatval(
                                                    $rowAssetAssign[
                                                        'SUM(AssignedQty)'
                                                    ]
                                                );
                                            }
                                            $qty =
                                                floatval(
                                                    $rowAsset['SUM(AssetQty)']
                                                ) - floatval($assignedQty);
                                            if ($qty > 0) {
                                                echo '<option value="' .
                                                    $rowAsset['Id'] .
                                                    '">' .
                                                    $rowAsset['AssetName'] .
                                                    ' - ' .
                                                    $rowAsset['Brand'] .
                                                    ' - ' .
                                                    $rowAsset['Description'] .
                                                    ' - ' .
                                                    $rowAsset['Price'] .
                                                    '</option>';
                                            }
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Assigned Qty:</label>
                                <input type="number" min="0" max="0" name="qty" id="qty" class="form-control" placeholder="" required>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Assigned Date:</label>
                                <input type="date" name="assigned_date" id="" class="form-control" placeholder="" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Issued To:</label>
                                <input type="text" name="department" id="" class="form-control" placeholder="" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Assigned To:</label>
                                <input type="text" name="assigned_to" id="" class="form-control" placeholder="" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <br>
                            <div class="form-group">
                                <button type="submit" disabled id="submitbutton" class="btn btn-success">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="row">
                    <div class="col-md-12">
                    <div class="table-responsive">
                    <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col"><b>S.No</b></th>
                                    <th scope="col"><b>Asset Name</b></th>
                                    <th scope="col"><b>Description</b></th>
                                    <th scope="col"><b>Brand</b></th>
                                    <th scope="col"><b>Asset Type</b></th>
                                    <th scope="col"><b>Actual Price</b></th>
                                    <th scope="col"><b>Depreciation Rate</b></th>
                                    <th scope="col"><b>Depreciated Price</b></th>
                                    <th scope="col"><b>Date</b></th>
                                    <th scope="col"><b>Qty</b></th>
                                    <!-- <th scope="col"><b>Assigned Date</b></th>
                                    <th scope="col"><b>Department</b></th>
                                    <th scope="col"><b>Assigned To</b></th> -->
                                    <!-- <th scope="col"><b>N.Weight</b></th> -->
                                </tr>
                            </thead>
                            <tbody id="">
                                <?php
                                // $count = 1;
                                // $sql = 'SELECT makecontract.ContractNo, CustomerName, makecontract.Quality, makecontract.Variety, SUM(Bags), SUM(CAST(REPLACE(LOWER(NetWT), "kg", "") AS DECIMAL(10,2))) FROM makecontract JOIN weighing ON makecontract.ContractNo = weighing.ContractNo JOIN weighing_description_receiving ON weighing_description_receiving.WeighingId = weighing.Id GROUP BY weighing_description_receiving.WeighingId, makecontract.ContractNo';
                                // // echo $sql;
                                // $result = mysqli_query($conn, $sql);
                                // if(mysqli_num_rows($result) > 0) {
                                //     while($row = mysqli_fetch_assoc($result)){
                                //       echo '
                                //             <tr>
                                //                 <th scope="row"><b>'.$count++.'</b></th>
                                //                 <td>'.$row['ContractNo'].'</td>
                                //                 <td>'.$row['CustomerName'].'</td>
                                //                 <td>'.$row['Quality'].'</td>
                                //                 <td>'.$row['Variety'].'</td>
                                //                 <td>'.$row['SUM(Bags)'].'</td>
                                //                 <td>'.$row['SUM(CAST(REPLACE(LOWER(NetWT), "kg", "") AS DECIMAL(10,2)))'].'</td>
                                //             </tr>';
                                //     }
                                // }
                                $count = 1;
                                $sqlAsset =
                                    'SELECT asset_in.Id, asset.AssetId, Deprication_Rate, Price, Date, Asset_Type, AssetName, Brand, Description, Price, SUM(AssetQty) FROM asset JOIN asset_in ON asset_in.AssetId = asset.AssetId GROUP BY asset_in.Id';
                                $resultAsset = $conn->query($sqlAsset);
                                // echo $sqlAsset;
                                if ($resultAsset->num_rows > 0) {
                                    while (
                                        $rowAsset = $resultAsset->fetch_assoc()
                                    ) {
                                        $sqlAssetAssign =
                                            'SELECT asset_in.Id, asset.AssetId, AssetName, Brand, Description, Price, SUM(AssignedQty) FROM asset JOIN asset_in ON asset_in.AssetId = asset.AssetId LEFT JOIN asset_assign ON asset_in.Id = asset_assign.AssetInId WHERE asset.AssetId = ' .
                                            $rowAsset['AssetId'] .
                                            ' GROUP BY asset.AssetId';
                                        // echo $sqlAssetAssign;
                                        $resultAssetAssign = $conn->query(
                                            $sqlAssetAssign
                                        );
                                        $assignedQty = 0;
                                        if ($resultAssetAssign->num_rows > 0) {
                                            $rowAssetAssign = $resultAssetAssign->fetch_assoc();
                                            $assignedQty = floatval(
                                                $rowAssetAssign[
                                                    'SUM(AssignedQty)'
                                                ]
                                            );
                                        }
                                        $qty =
                                            floatval(
                                                $rowAsset['SUM(AssetQty)']
                                            ) - floatval($assignedQty);
                                        if ($qty > 0) {
                                            echo '
                                    <tr>
                                        <td scope="row"><b>' .
                                                $count++ .
                                                '</b></td>
                                        <td>' .
                                                $rowAsset['AssetName'] .
                                                '</td>
                                        <td>' .
                                                $rowAsset['Description'] .
                                                '</td>
                                        <td>' .
                                                $rowAsset['Brand'] .
                                                '</td>
                                        <td>' .
                                                $rowAsset['Asset_Type'] .
                                                '</td>
                                        <td>Rs. ' .
                                                number_format(
                                                    floatval(
                                                        $rowAsset['Price']
                                                    ),
                                                    2
                                                ) .
                                                '</td>
                                        <td>';
                                            if (
                                                $rowAsset['Asset_Type'] ==
                                                'Fixed'
                                            ) {
                                                echo $rowAsset[
                                                    'Deprication_Rate'
                                                ] . ' %';
                                            }
                                            echo '</td>
                                        <td>';
                                            if (
                                                $rowAsset['Asset_Type'] ==
                                                'Fixed'
                                            ) {
                                                $depreciation = 0;
                                                $price = floatval(
                                                    $rowAsset['Price']
                                                );
                                                $rate =
                                                    floatval(
                                                        $rowAsset[
                                                            'Deprication_Rate'
                                                        ]
                                                    ) / 100;
                                                $now = time(); // or your date as well
                                                $your_date = strtotime(
                                                    $rowAsset['Date']
                                                );
                                                $datediff = $now - $your_date;

                                                $daysPassed = floor(
                                                    $datediff / (60 * 60 * 24)
                                                );
                                                echo 'Rs. ' .
                                                    number_format(
                                                        $price -
                                                            (($price * $rate) /
                                                                365) *
                                                                $daysPassed,
                                                        2
                                                    );
                                            }
                                            echo '</td>
                                            <td>' .
                                                date(
                                                    'd-M-Y',
                                                    strtotime($rowAsset['Date'])
                                                ) .
                                                '</td>
                                                <td>' .
                                                $qty .
                                                '</td>
    
                                    </tr>';
                                        }
                                    }
                                }
                                ?>
                            </tbody>
                            <tfoot id="">

                            </tfoot>
                        </table>
                    </div>
                    </div>
                </div>
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
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script>
    $(":input").inputmask();
    $('#name').on('change', function() {
        $.ajax({
            type: 'POST',
            url: 'get_Asset_Qty.php',
            data: 'asset_id=' + encodeURIComponent($(this).val()),
            success: function(response) {
                console.log(response);
                $('#qty').prop('max', response);
            },
        });
    })

    $('#qty').on('change', function() {
        if(parseFloat($(this).attr('min')) > parseFloat($(this).val()))
            $(this).val($(this).attr('min'));
        if(parseFloat($(this).attr('max')) < parseFloat($(this).val()))
            $(this).val($(this).attr('max'));
        if(parseFloat($(this).val()) > 0)
            $('#submitbutton').prop('disabled', false);
        else
            $('#submitbutton').prop('disabled', true);
    })

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
    </script>

    <script>
    $('#headername').html("Assign Asset");
    </script>
    <script>
    $(document).ready( function () {
        $('.table').DataTable();
    } );
    </script>

</body>

</html>