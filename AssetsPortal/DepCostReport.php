<?php
include_once 'conn.php'; ?>

<!DOCTYPE html>
<html lang="en">
<!-- Mirrored from mannatthemes.com/metrica/material-vertical-2/projects/projects-index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 10 Mar 2020 08:03:26 GMT -->

<head>
    <meta charset="utf-8">
    <title>Depreciation Cost Report - Dashboard</title>
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
    table tr th{
        background-color: #D3D3D3;
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
                                    <li class="breadcrumb-item active">Depreciation Cost Report</li>
                                </ol>
                            </div>
                            <h4 class="page-title"></h4>
                        </div>
                        <!--end page-title-box-->
                    </div>
                    <!--end col-->
                </div>
                <br><br>
                <!-- end page title end breadcrumb -->
                <div class="row" id="" style="">
                    <div class="col-md-12 text-center">
                        <h3><b><u>Depreciation Cost Report</u></b></h3>
                    </div>
                </div>
                    <form id="yearMonthFilter">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Year:</label>
                                    <select name="yearFilter" id="yearFilter" class="form-control" placeholder="" required>
                                    <option selected disabled value="">Please select a Year</option>
                                    <?php for ($i = 2030; $i >= 2010; $i--) {
                                        echo '<option value="' .
                                            $i .
                                            '">' .
                                            $i .
                                            '</option>';
                                    } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Month:</label>
                                    <select name="monthFilter" id="monthFilter" class="form-control" placeholder="" required>
                                    <option selected disabled value="">Please select a Month</option>
                                    <?php
                                    $month = [
                                        'January',
                                        'February',
                                        'March',
                                        'April',
                                        'May',
                                        'June',
                                        'July',
                                        'August',
                                        'September',
                                        'October',
                                        'November',
                                        'December',
                                    ];
                                    for ($i = 0; $i < count($month); $i++) {
                                        echo '<option value="';
                                        echo strlen(strval($i + 1)) == 1
                                            ? '0' . ($i + 1)
                                            : $i + 1;
                                        echo '">' . $month[$i] . '</option>';
                                    }
                                    ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label style="width: 100%; visibility: hidden">Button</label>
                                    <button type="button" name="filterBtn" id="filterBtn" class="btn btn-primary" style="float: right;">
                                    Filter
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                <div class="row" id="" style="">
                    <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col"><b>S.No</b></th>
                                    <th scope="col"><b>Asset Name</b></th>
                                    <th scope="col"><b>Description</b></th>
                                    <th scope="col"><b>Date</b></th>
                                    <th scope="col"><b>Qty</b></th>
                                    <th scope="col"><b>Brand</b></th>
                                    <th scope="col"><b>Asset Type</b></th>
                                    <th scope="col"><b>Actual Price</b></th>
                                    <th scope="col"><b>Depreciation Rate</b></th>
                                    <th scope="col"><b>Depreciated Cost</b></th>
                                    <th scope="col" style="display: none"><b>Depreciated Cost</b></th>
                                    <th scope="col"><b>Current Value</b></th>
                                    <th scope="col" style="display: none"><b>Current Value</b></th>
                                    <!-- <th scope="col"><b>N.Weight</b></th> -->
                                </tr>
                            </thead>
                            <tbody id="tbody_table">
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
                                $sql =
                                    'SELECT asset.*, asset_in.*, asset_in.Date AS AssetInDate, asset_assign.Date AS AssetAssignDate, Department, Assigned_To, asset_in.Id AS asset_in_id FROM asset JOIN asset_in ON asset_in.AssetId = asset.AssetId LEFT JOIN asset_assign ON asset_in.Id = asset_assign.AssetInId GROUP BY asset_in.Id';
                                $result = mysqli_query($conn, $sql);
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo '
                                    <tr>
                                        <td scope="row"><b>' .
                                        $count++ .
                                        '</b></td>
                                        <td>' .
                                        $row['AssetName'] .
                                        '</td>
                                        <td>' .
                                        $row['Description'] .
                                        '</td>
                                        <td>' .
                                        date(
                                            'd-M-Y',
                                            strtotime($row['AssetInDate'])
                                        ) .
                                        '</td>
                                        <td>' .
                                        $row['AssetQty'] .
                                        '</td>
                                        <td>' .
                                        $row['Brand'] .
                                        '</td>
                                        <td>' .
                                        $row['Asset_Type'] .
                                        '</td>
                                        <td>Rs. ' .
                                        number_format(
                                            floatval($row['Price']),
                                            2
                                        ) .
                                        '</td>
                                        <td>';
                                    if ($row['Asset_Type'] == 'Fixed') {
                                        echo $row['Deprication_Rate'] . ' %';
                                    }
                                    echo '</td>
                                        <td style="display: none;">';
                                    if ($row['Asset_Type'] == 'Fixed') {
                                        $depreciation = 0;
                                        $price = floatval($row['Price']);
                                        $rate =
                                            floatval($row['Deprication_Rate']) /
                                            100;
                                        $now = time(); // or your date as well
                                        $your_date = strtotime($row['Date']);
                                        $datediff = $now - $your_date;

                                        $daysPassed = floor(
                                            $datediff / (60 * 60 * 24)
                                        );
                                        echo (($price * $rate) / 365) *
                                            $daysPassed;
                                    }
                                    echo '</td>
                                        <td>';
                                    echo 'Rs. ' .
                                        number_format(
                                            (($price * $rate) / 365) *
                                                $daysPassed,
                                            2
                                        );
                                    echo '</td>
                                        <td>';
                                    echo 'Rs. ' .
                                        number_format(
                                            $price -
                                                (($price * $rate) / 365) *
                                                    $daysPassed,
                                            2
                                        );
                                    echo '</td>
                                    <td style="display: none;">';
                                    echo $price -
                                        (($price * $rate) / 365) * $daysPassed;

                                    echo '</td>
                                    </tr>';
                                }
                                ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="7" style="text-align:right">Total Asset Value:</th>
                                    <th colspan="4"></th>
                                </tr>
                                <tr>
                                    <th colspan="7" style="text-align:right">Total Depreciated Cost:</th>
                                    <th colspan="4" id="depCostTotal"></th>
                                </tr>
                            </tfoot>
                        </table>
                        </div>
                        </div>
                        <br><br>
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
    <script src="../assets/pages/jquery.projects_dashboard.init.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <!-- App js -->
    <script src="../assets/js/app.js"></script>
    <script src="http://code.jquery.com/jquery-migrate-1.2.1.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js" type="text/javascript"></script>
    <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="Stylesheet" type="text/css" />
    <script>
    $('#headername').html("Depreciation Cost Report");
    </script>
    <script>
    $('#filterBtn').on('click', function() {
        if($('#yearFilter').val() != '' && $('#yearFilter').val() != undefined && $('#yearFilter').val() != null) {
            var data = 'yearFilter=' + $('#yearFilter').val();
            if ($('#monthFilter').val() != '' && $('#monthFilter').val() != undefined && $('#monthFilter').val() != null) {
                data += '&monthFilter=' + $('#monthFilter').val();
            }

            $.ajax({
                type: 'POST',
                url: 'get_Dep_Cost.php',
                data: data,
                success: function(response) {
                    console.log(response);
                    $('.table').dataTable().fnDestroy();
                    $('#tbody_table').html("");
                    $('#tbody_table').html(response);
                    setDataTable();
                },
            });
        } else if ($('#monthFilter').val() != '' && $('#monthFilter').val() != undefined && $('#monthFilter').val() != null) {
            alert('Please select a Year');
        }
    })
    </script>
    <script>
    $(document).ready( function () {
        setDataTable();
    } );

    function setDataTable() {
        $('.table').DataTable({
            "footerCallback": function ( row, data, start, end, display ) {
                var api = this.api(), data;
    
                // Remove the formatting to get integer data for summation
                var intVal = function ( i ) {
                    return typeof i === 'string' ?
                        i.replace(/[\$,]/g, '')*1 :
                        typeof i === 'number' ?
                            i : 0;
                    // return i.toString().split('Rs. ')[1].replaceAll(',', '').replaceAll('.00', '');
                };
    
                // Total over all pages
                total = api
                    .column( 12 )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );
    
                // Total over this page
                pageTotal = api
                    .column( 12, { page: 'current'} )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );
    
                // Update footer
                $( api.column( 10 ).footer() ).html(
                    'Rs. '+numberWithCommas(pageTotal.toFixed(2)) +' (Rs. '+ numberWithCommas(total.toFixed(2)) +' total)'
                );

                // Total over all pages
                totalDep = api
                    .column( 9 )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );
    
                // Total over this page
                pageTotalDep = api
                    .column( 9, { page: 'current'} )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );
    
                // Update footer
                $( '#depCostTotal' ).html(
                    'Rs. '+numberWithCommas(pageTotalDep.toFixed(2)) +' (Rs. '+ numberWithCommas(totalDep.toFixed(2)) +' total)'
                );
            }        
        });        
    }

    function numberWithCommas(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }
    </script>

</body>

</html>