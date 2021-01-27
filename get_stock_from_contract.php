<?php

include_once('conn.php');


    $varieties = ["Final", "Short grain", "B1", "B2", "B3", "CSR", "Broken CSR", "Peddy", "Powder", "Choba", "Sweeping", "Stones"];
    
    $count = 1;
    $sql = 'SELECT  toolmillcontract.ContractNo, SaleCustomerName, ProcessingMill, Quality, Variety, 
                    SUM(gatepass_g_recieved_items.Quantity) AS Quantity, gatepass_g_recieved_items.Items
                    FROM toolmillcontract 
                    JOIN gatepass_g_recieved ON toolmillcontract.ContractNo = gatepass_g_recieved.ContractNo
                    JOIN gatepass_g_recieved_items ON gatepass_g_recieved.Id = gatepass_g_recieved_items.GoodReceivedId
                    WHERE gatepass_g_recieved_items.Type = "Rice" AND toolmillcontract.ContractNo = "'.$_POST['contractNo'].'" AND gatepass_g_recieved_items.Items = "'.$_POST['item_name'].'"
                    GROUP BY ContractNo';

    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        // print_r($row);
        // echo '<br>';
        $sql1 = 'SELECT ' . $row['Quantity'] . ' - SUM(production_goods.Bags) AS Quantity, SUM(production_goods.Bags) AS Production_Bags
        FROM production_goods 
        WHERE ContractNo = ' . $row['ContractNo'] . ' AND Party_ItemName = "' . $row['Items'] . '"
        GROUP BY ContractNo
        ';
        $result1 = mysqli_query($conn, $sql1);
        if ($result1->num_rows > 0) {
            while ($row1 = mysqli_fetch_assoc($result1)) {

                $quantity = $row1['Quantity'];
                $sql_gi_raw_material = 'SELECT *, SUM(gatepass_g_issue_items.Quantity) AS Quantity FROM gatepass_g_issue 
                            JOIN gatepass_g_issue_items ON gatepass_g_issue.Id = gatepass_g_issue_items.GoodIssueId
                            WHERE gatepass_g_issue.ContractNo = ' . $row['ContractNo'] . ' AND gatepass_g_issue_items.Items = "' . $row['Items'] . '"
                            AND gatepass_g_issue_items.ItemName = "" GROUP BY gatepass_g_issue.ContractNo, gatepass_g_issue_items.Items';
                // echo $sql_gi_raw_material;

                $r_gi_raw_material = mysqli_query($conn, $sql_gi_raw_material);
                if ($r_gi_raw_material->num_rows > 0) {
                    $row_gi_raw_material  = mysqli_fetch_assoc($r_gi_raw_material);
                    $quantity -= $row_gi_raw_material['Quantity'];
                }

                $sql_stock_transfer = 'SELECT *, SUM(BagsTransfer) AS Quantity FROM stocktransfer 
                            WHERE ContractNoFrom = ' . $row['ContractNo'] . ' AND Items = "' . $row['Items'] . '"
                            AND ItemName = "" GROUP BY ContractNoFrom, Items';
                // echo $sql_stock_transfer . '<br>';

                $r_stock_transfer = mysqli_query($conn, $sql_stock_transfer);
                if ($r_stock_transfer->num_rows > 0) {
                    $row_stock_transfer  = mysqli_fetch_assoc($r_stock_transfer);
                    $quantity -= $row_stock_transfer['Quantity'];
                }

                $sql_stock_transfer = 'SELECT *, SUM(BagsTransfer) AS Quantity FROM stocktransfer 
                            WHERE ContractNoTo = ' . $row['ContractNo'] . ' AND Items = "' . $row['Items'] . '"
                            AND ItemName = "" GROUP BY ContractNoTo, Items';

                $r_stock_transfer = mysqli_query($conn, $sql_stock_transfer);
                if ($r_stock_transfer->num_rows > 0) {
                    $row_stock_transfer  = mysqli_fetch_assoc($r_stock_transfer);
                    $quantity += $row_stock_transfer['Quantity'];
                }

                echo $quantity;
            }
        } else {
            $quantity = $row['Quantity'];

            $sql_gi_raw_material = 'SELECT *, SUM(gatepass_g_issue_items.Quantity) AS Quantity, gatepass_g_issue_items.Items FROM gatepass_g_issue 
                            JOIN gatepass_g_issue_items ON gatepass_g_issue.Id = gatepass_g_issue_items.GoodIssueId
                            WHERE gatepass_g_issue.ContractNo = ' . $row['ContractNo'] . '
                            AND gatepass_g_issue_items.ItemName = "" GROUP BY gatepass_g_issue.ContractNo ';
            // echo $sql_gi_raw_material;
            $r_gi_raw_material = mysqli_query($conn, $sql_gi_raw_material);
            if ($r_gi_raw_material->num_rows > 0) {
                $row_gi_raw_material  = mysqli_fetch_assoc($r_gi_raw_material);
                $quantity -= $row_gi_raw_material['Quantity'];
            }

            $sql_stock_transfer = 'SELECT *, SUM(BagsTransfer) AS Quantity FROM stocktransfer 
                        WHERE ContractNoFrom = ' . $row['ContractNo'] . '
                        AND ItemName = "" GROUP BY ContractNoFrom';
            // echo $sql_stock_transfer . '<br>';

            $r_stock_transfer = mysqli_query($conn, $sql_stock_transfer);
            if ($r_stock_transfer->num_rows > 0) {
                $row_stock_transfer  = mysqli_fetch_assoc($r_stock_transfer);
                $quantity -= $row_stock_transfer['Quantity'];
            }

            $sql_stock_transfer = 'SELECT *, SUM(BagsTransfer) AS Quantity FROM stocktransfer 
                        WHERE ContractNoTo = ' . $row['ContractNo'] . '
                        AND ItemName = "" GROUP BY ContractNoTo';

            $r_stock_transfer = mysqli_query($conn, $sql_stock_transfer);
            if ($r_stock_transfer->num_rows > 0) {
                $row_stock_transfer  = mysqli_fetch_assoc($r_stock_transfer);
                $quantity += $row_stock_transfer['Quantity'];
            }

            echo $quantity;
        }
    }
                                
?>