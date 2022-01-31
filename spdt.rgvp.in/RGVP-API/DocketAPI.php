<?php

include "include.php"; // VARIABLES
$SelectColumns = array("DocketID", "DocketNumber", "DocketDate", "FromBranch", "ToBranch", "PickupDelivery", "QTY", "PackingType", "ActualWeight", "PaymentType", "BillingPartySelection", "EDD", "ServiceType", "FromConsignor", "FromGSTIN", "FromAddress", "FromCity", "FromPincode", "FromState", "FromPhone", "ToConsignee", "ToGSTIN", "ToAddress", "ToCity", "ToPincode", "ToState", "ToPhone", "ItemDescription", "VolmetricWeight", "ChargedWeight", "InvoiceNo", "InvoiceValue", "RiskType", "BookedBy", "EWayBillNo", "ExpiryDate", "ValueAddedService", "VASAmount", "BasicFreight", "FOV", "FuelSurcharge", "DocketCharge", "ODAOPA", "HandlingCharge", "CODDACC", "ToPayCharge", "OtherCharges", "GSTRate", "SubTotal", "GSTAmt", "GrandTotal", "Status", "AddedBy", "AddedDate", "UpdateBy", "UpdatedDate"); // array("id", "name", "email", "mobile", "start_date");
$InsertColumns = array("DocketNumber", "DocketDate", "FromBranch", "ToBranch", "PickupDelivery", "QTY", "PackingType", "ActualWeight", "PaymentType", "BillingPartySelection", "EDD", "ServiceType", "FromConsignor", "FromGSTIN", "FromAddress", "FromCity", "FromPincode", "FromState", "FromPhone", "ToConsignee", "ToGSTIN", "ToAddress", "ToCity", "ToPincode", "ToState", "ToPhone", "ItemDescription", "VolmetricWeight", "ChargedWeight", "InvoiceNo", "InvoiceValue", "RiskType", "BookedBy", "EWayBillNo", "ExpiryDate", "ValueAddedService", "VASAmount", "BasicFreight", "FOV", "FuelSurcharge", "DocketCharge", "ODAOPA", "HandlingCharge", "CODDACC", "ToPayCharge", "OtherCharges", "GSTRate", "SubTotal", "GSTAmt", "GrandTotal", "Status", "AddedBy", "UpdateBy");
$UpdateColumns = array("DocketNumber", "DocketDate", "FromBranch", "ToBranch", "PickupDelivery", "QTY", "PackingType", "ActualWeight", "PaymentType", "BillingPartySelection", "EDD", "ServiceType", "FromConsignor", "FromGSTIN", "FromAddress", "FromCity", "FromPincode", "FromState", "FromPhone", "ToConsignee", "ToGSTIN", "ToAddress", "ToCity", "ToPincode", "ToState", "ToPhone", "ItemDescription", "VolmetricWeight", "ChargedWeight", "InvoiceNo", "InvoiceValue", "RiskType", "BookedBy", "EWayBillNo", "ExpiryDate", "ValueAddedService", "VASAmount", "BasicFreight", "FOV", "FuelSurcharge", "DocketCharge", "ODAOPA", "HandlingCharge", "CODDACC", "ToPayCharge", "OtherCharges", "GSTRate", "SubTotal", "GSTAmt", "GrandTotal", "Status", "AddedBy", "UpdateBy");
$InsertColumnsData = array("txt_DocketNumber", "date_DocketDate", "txt_FromBranch", "txt_ToBranch", "ddl_PickupDelivery", "txt_QTY", "ddl_PackingType", "txt_ActualWeight", "ddl_PaymentType", "txt_BillingPartySelection", "date_EDD", "ddl_ServiceType", "txt_FromConsignor", "txt_FromGSTIN", "txt_FromAddress", "txt_FromCity", "txt_FromPincode", "txt_FromState", "txt_FromPhone", "txt_ToConsignee", "txt_ToGSTIN", "txt_ToAddress", "txt_ToCity", "txt_ToPincode", "txt_ToState", "txt_ToPhone", "txt_ItemDescription", "txt_VolmetricWeight", "txt_ChargedWeight", "txt_InvoiceNo", "txt_InvoiceValue", "ddl_RiskType", "txt_BookedBy", "txt_EWayBillNo", "date_ExpiryDate", "ddl_ValueAddedService", "txt_VASAmt", "txt_BasicFreight", "txt_FOV", "txt_FuelSurcharge", "txt_DocketCharge", "txt_ODAOPA", "txt_HandlingCharge", "txt_CODDACC", "txt_ToPayCharge", "txt_OtherCharges", "txt_GSTRate", "txt_SubTotal", "txt_GSTAmt", "txt_GrandTotal", "ddl_Status", "txt_AddedBy", "txt_UpdateBy");
$ColumnAPIUpdateData = array("txt_DocketNumber", "date_DocketDate", "txt_FromBranch", "txt_ToBranch", "ddl_PickupDelivery", "txt_QTY", "ddl_PackingType", "txt_ActualWeight", "ddl_PaymentType", "txt_BillingPartySelection", "date_EDD", "ddl_ServiceType", "txt_FromConsignor", "txt_FromGSTIN", "txt_FromAddress", "txt_FromCity", "txt_FromPincode", "txt_FromState", "txt_FromPhone", "txt_ToConsignee", "txt_ToGSTIN", "txt_ToAddress", "txt_ToCity", "txt_ToPincode", "txt_ToState", "txt_ToPhone", "txt_ItemDescription", "txt_VolmetricWeight", "txt_ChargedWeight", "txt_InvoiceNo", "txt_InvoiceValue", "ddl_RiskType", "txt_BookedBy", "txt_EWayBillNo", "date_ExpiryDate", "ddl_ValueAddedService", "txt_VASAmt", "txt_BasicFreight", "txt_FOV", "txt_FuelSurcharge", "txt_DocketCharge", "txt_ODAOPA", "txt_HandlingCharge", "txt_CODDACC", "txt_ToPayCharge", "txt_OtherCharges", "txt_GSTRate", "txt_SubTotal", "txt_GSTAmt", "txt_GrandTotal", "ddl_Status", "txt_AddedBy", "txt_UpdateBy");
$InsertColDataString = "";
$UpdateColDataString = "";
$sIndexColumn = "DocketID";
$sTable = "docket";
$RGVP = new \RGVPCore\RGVPCore();
$RGVPDBCon = "";
$RGVPDBCon = $RGVP->DB->GetConnection();
$CommandType = "EMPTY";
if (isset($_REQUEST["CommandType"]))
    $CommandType = $_REQUEST["CommandType"];
$posted = $_REQUEST;
foreach ($posted as &$val)
    if (gettype($val) == "string")
        $val = mysqli_real_escape_string($RGVPDBCon, $val);

function SringReplace($Content) {
    $Content = str_replace('|', ",", $Content);
    return $Content;
}

switch ($CommandType) {
    case "EMPTY":
        echo "No Command Type Received.";
        break;
    case "INSERT":
        // AJAX ADD FROM JQUERY
        if (isset($_REQUEST)) {
            //dbinit($gaSql);
            foreach ($InsertColumnsData as $FieldData)
                $InsertColDataString .= "'" . $posted[$FieldData] . "',";
            $InsertColDataString = substr($InsertColDataString, 0, strlen($InsertColDataString) - 1);
            $Sql_input = "INSERT INTO $sTable (" . implode(",", $InsertColumns) . ") VALUES ($InsertColDataString)";
            $Sql_input = str_replace(",,", ",'',", $Sql_input);
            $Sql_output = $RGVP->DB->Execute_Query($Sql_input, "SET", "INSERT");
            $id = $RGVP->DB->PrimaryKeyID;
            $Sql_output = $RGVP->DB->Execute_Query("SELECT " . implode(",", $SelectColumns) . " FROM $sTable WHERE $sIndexColumn = " . $id, "GET", "SQLObj");
            die(json_encode(mysqli_fetch_assoc($Sql_output)));
        }
        break;
    case "UPDATE-SAVE":
        // AJAX EDIT FROM JQUERY
        if (isset($_GET["id"]) && 0 < intval($_GET["id"])) {
            // SAVE DATA
            for ($j = 0; $j < count($ColumnAPIUpdateData); $j++)
                $UpdateColDataString .= $UpdateColumns[$j] . " = '" . $posted[$ColumnAPIUpdateData[$j]] . "',";
            $UpdateColDataString = substr($UpdateColDataString, 0, strlen($UpdateColDataString) - 1);
            $Sql_input = " UPDATE $sTable SET $UpdateColDataString WHERE $sIndexColumn = " . intval($_GET["id"]);
            $Sql_output = $RGVP->DB->Execute_Query($Sql_input, "SET", "UPDATE");

            // GET DATA
           // $Sql_input = "SELECT " . implode(",", $SelectColumns) . " FROM $sTable WHERE $sIndexColumn = " . intval($_GET["id"]);
            //$Sql_output = $RGVP->DB->Execute_Query($Sql_input, "GET", "SQLObj");
            //die(json_encode(mysqli_fetch_assoc($Sql_output)));
            header("location:../docket-view.php?txt_id=" . $_GET['id'] );
        }
        break;
 case "DELETE":
        // AJAX REMOVE FROM JQUERY
        if (isset($_GET["id"]) && 0 < intval($_GET["id"])) {
            //dbinit($gaSql);
            // REMOVE DATA
           echo $Sql_input = " UPDATE $sTable Set `Status` = 'Cancelled' WHERE $sIndexColumn = " . intval($_GET["id"]);
            $Sql_output = $RGVP->DB->Execute_Query($Sql_input, "SET", "UPDATE");
            if ($RGVP->DB->StatusCode == "501" || $RGVP->DB->StatusCode == "503") {
                echo $RGVP->DB->Exception . $RGVP->DB->Msg;
            }
            else
            {
                echo "true";
            }
        }
        break;
    case "SELECT-WITH-ID":
//        if (isset($_GET["number"]) && 0 < intval($_GET["number"])) {
//             $Sql_input = "SELECT *  FROM docket where DocketNumber='".$_GET["number"]."'and FromBranch ='".$_GET["branch"]."'";
//            $Sql_output = $RGVP->DB->Execute_Query($Sql_input, "GET", "SQLObj");
//            die(json_encode(mysqli_fetch_assoc($Sql_output)));
//        }
        if (isset($_GET["id"]) && 0 < intval($_GET["id"])) {
            $Sql_input = "SELECT " . implode(",", $SelectColumns) . " FROM $sTable WHERE $sIndexColumn = " . intval($_GET["id"]);
            $Sql_output = $RGVP->DB->Execute_Query($Sql_input, "GET", "SQLObj");
            die(json_encode(mysqli_fetch_assoc($Sql_output)));
        }
        break;
    case "SELECT":
        // QUERY LIMIT
        $sLimit = "";
        if (isset($_GET["iDisplayStart"]) && $_GET["iDisplayLength"] != "-1") {
            $sLimit = "LIMIT " . intval($_GET["iDisplayStart"]) . ", " . intval($_GET["iDisplayLength"]);
        }
        // QUERY ORDER
        $sOrder = "";
        if (isset($_GET["iSortCol_0"])) {
            $sOrder = "ORDER BY ";
            for ($i = 0; $i < intval($_GET["iSortingCols"]); $i++) {
                if ($_GET["bSortable_" . intval($_GET["iSortCol_" . $i])] == "true") {
                    $sOrder .= $SelectColumns[intval($_GET["iSortCol_" . $i])] . " " . ( $_GET["sSortDir_" . $i] === "asc" ? "asc" : "desc" ) . ", ";
                }
            }
            $sOrder = substr_replace($sOrder, "", -2);
            if ($sOrder == "ORDER BY")
                $sOrder = "";
        }
        // QUERY SEARCH
        $sWhere = "";
        if (isset($_GET["sSearch"]) && $_GET["sSearch"] != "") {
            $sWhere = "WHERE (";
            for ($i = 0; $i < count($SelectColumns); $i++) {
                if (isset($_GET["bSearchable_" . $i]) && $_GET["bSearchable_" . $i] == "true") {
                    $sWhere .= $SelectColumns[$i] . " LIKE '%" . mysqli_real_escape_string($RGVPDBCon, $_GET["sSearch"]) . "%' OR ";
                }
            }
            $sWhere = substr_replace($sWhere, "", -3);
            $sWhere .= ")";
        }
        // BUILD QUERY
        for ($i = 0; $i < count($SelectColumns); $i++) {
            if (isset($_GET["bSearchable_" . $i]) && $_GET["bSearchable_" . $i] == "true" && $_GET["sSearch_" . $i] != "") {
                if ($sWhere == "")
                    $sWhere = "WHERE ";
                else
                    $sWhere .= " AND ";
                $sWhere .= $SelectColumns[$i] . " LIKE '%" . mysqli_real_escape_string($RGVPDBCon, $_GET["sSearch_" . $i]) . "%' ";
            }
        }
        // FETCH
        $sQueryDisplay = "";
        $sQuery = " SELECT " . implode(",", $SelectColumns) . " FROM $sTable $sWhere $sOrder $sLimit ";
        $sQueryDisplay .= $sQuery . "\n";
        $rResult = $RGVP->DB->Execute_Query($sQuery, "GET", "SQLObj");
        $sQuery = " SELECT COUNT(" . $sIndexColumn . ") FROM $sTable ";
        $sQueryDisplay .= $sQuery . "\n";
        $rResultTotal = $RGVP->DB->Execute_Query($sQuery, "GET", "SQLObj");
        $aResultTotal = mysqli_fetch_array($rResultTotal);
        $iTotal = $aResultTotal[0];
        $output = array();
        while ($aRow = mysqli_fetch_array($rResult)) {
            $row = array();
            for ($i = 0; $i < count($SelectColumns); $i++) {
                if ($SelectColumns[$i] == "version")
                    $row[] = ( $aRow[$SelectColumns[$i]] == "0" ) ? "-" : $aRow[$SelectColumns[$i]];
                else if ($SelectColumns[$i] != " ")
                    $row[] = $aRow[$SelectColumns[$i]];
            }
            $output["data"][] = array_merge(array('<a href="docket-view.php?txt_id=' . $row[0] . '" class="btn btn-warning btn-docket-action" ><i class="fa fa-eye"></i></a>'), $row, $row);
        }
        // RETURN IN JSON
        die(trim(json_encode($output))); // . $sQueryDisplay);
        //echo "";
        break;
    case "SELECTAllSTATUS":
        // QUERY LIMIT
        $sLimit = "";
        if (isset($_GET["iDisplayStart"]) && $_GET["iDisplayLength"] != "-1") {
            $sLimit = "LIMIT " . intval($_GET["iDisplayStart"]) . ", " . intval($_GET["iDisplayLength"]);
        }
        // QUERY ORDER
        $sOrder = "";
        if (isset($_GET["iSortCol_0"])) {
            $sOrder = "ORDER BY ";
            for ($i = 0; $i < intval($_GET["iSortingCols"]); $i++) {
                if ($_GET["bSortable_" . intval($_GET["iSortCol_" . $i])] == "true") {
                    $sOrder .= $SelectColumns[intval($_GET["iSortCol_" . $i])] . " " . ( $_GET["sSortDir_" . $i] === "asc" ? "asc" : "desc" ) . ", ";
                }
            }
            $sOrder = substr_replace($sOrder, "", -2);
            if ($sOrder == "ORDER BY")
                $sOrder = "";
        }
        // QUERY SEARCH
        $sWhere = "";
        if (isset($_GET["sSearch"]) && $_GET["sSearch"] != "") {
            $sWhere = "WHERE (";
            for ($i = 0; $i < count($SelectColumns); $i++) {
                if (isset($_GET["bSearchable_" . $i]) && $_GET["bSearchable_" . $i] == "true") {
                    $sWhere .= $SelectColumns[$i] . " LIKE '%" . mysqli_real_escape_string($RGVPDBCon, $_GET["sSearch"]) . "%' OR ";
                }
            }
            $sWhere = substr_replace($sWhere, "", -3);
            $sWhere .= ")";
        }
        // BUILD QUERY
        for ($i = 0; $i < count($SelectColumns); $i++) {
            if (isset($_GET["bSearchable_" . $i]) && $_GET["bSearchable_" . $i] == "true" && $_GET["sSearch_" . $i] != "") {
                if ($sWhere == "")
                    $sWhere = "WHERE ";
                else
                    $sWhere .= " AND ";
                $sWhere .= $SelectColumns[$i] . " LIKE '%" . mysqli_real_escape_string($RGVPDBCon, $_GET["sSearch_" . $i]) . "%' ";
            }
        }
        // FETCH
        $sQueryDisplay = "";
        $sQuery = " SELECT " . implode(",", $SelectColumns) . " FROM $sTable WHERE Status !='Cancelled' $sOrder $sLimit ";

        $sQueryDisplay .= $sQuery . "\n";
        $rResult = $RGVP->DB->Execute_Query($sQuery, "GET", "SQLObj");
        $sQuery = " SELECT COUNT(" . $sIndexColumn . ") FROM $sTable ";
        $sQueryDisplay .= $sQuery . "\n";
        $rResultTotal = $RGVP->DB->Execute_Query($sQuery, "GET", "SQLObj");
        $aResultTotal = mysqli_fetch_array($rResultTotal);
        $iTotal = $aResultTotal[0];
        $output = array();
        while ($aRow = mysqli_fetch_array($rResult)) {
            $row = array();
            for ($i = 0; $i < count($SelectColumns); $i++) {
                if ($SelectColumns[$i] == "version")
                    $row[] = ( $aRow[$SelectColumns[$i]] == "0" ) ? "-" : $aRow[$SelectColumns[$i]];
                else if ($SelectColumns[$i] != " ")
                    $row[] = $aRow[$SelectColumns[$i]];
            }
            $output["data"][] = array_merge(array('<a href="docket-view.php?txt_id=' . $row[1] . '" class="btn btn-warning btn-docket-action" ><i class="fa fa-eye"></i></a>'), $row, $row);
        }
        // RETURN IN JSON
        die(trim(json_encode($output))); // . $sQueryDisplay);
        //echo "";
        break;
    case "SELECTCLOSEDSTATUS":
        // QUERY LIMIT
        $sLimit = "";
        if (isset($_GET["iDisplayStart"]) && $_GET["iDisplayLength"] != "-1") {
            $sLimit = "LIMIT " . intval($_GET["iDisplayStart"]) . ", " . intval($_GET["iDisplayLength"]);
        }
        // QUERY ORDER
        $sOrder = "";
        if (isset($_GET["iSortCol_0"])) {
            $sOrder = "ORDER BY ";
            for ($i = 0; $i < intval($_GET["iSortingCols"]); $i++) {
                if ($_GET["bSortable_" . intval($_GET["iSortCol_" . $i])] == "true") {
                    $sOrder .= $SelectColumns[intval($_GET["iSortCol_" . $i])] . " " . ( $_GET["sSortDir_" . $i] === "asc" ? "asc" : "desc" ) . ", ";
                }
            }
            $sOrder = substr_replace($sOrder, "", -2);
            if ($sOrder == "ORDER BY")
                $sOrder = "";
        }
        // QUERY SEARCH
        $sWhere = "";
        if (isset($_GET["sSearch"]) && $_GET["sSearch"] != "") {
            $sWhere = "WHERE (";
            for ($i = 0; $i < count($SelectColumns); $i++) {
                if (isset($_GET["bSearchable_" . $i]) && $_GET["bSearchable_" . $i] == "true") {
                    $sWhere .= $SelectColumns[$i] . " LIKE '%" . mysqli_real_escape_string($RGVPDBCon, $_GET["sSearch"]) . "%' OR ";
                }
            }
            $sWhere = substr_replace($sWhere, "", -3);
            $sWhere .= ")";
        }
        // BUILD QUERY
        for ($i = 0; $i < count($SelectColumns); $i++) {
            if (isset($_GET["bSearchable_" . $i]) && $_GET["bSearchable_" . $i] == "true" && $_GET["sSearch_" . $i] != "") {
                if ($sWhere == "")
                    $sWhere = "WHERE ";
                else
                    $sWhere .= " AND ";
                $sWhere .= $SelectColumns[$i] . " LIKE '%" . mysqli_real_escape_string($RGVPDBCon, $_GET["sSearch_" . $i]) . "%' ";
            }
        }
        // FETCH
        $sQueryDisplay = "";
        $sQuery = " SELECT " . implode(",", $SelectColumns) . " FROM $sTable WHERE Status ='Cancelled' $sOrder $sLimit ";

        $sQueryDisplay .= $sQuery . "\n";
        $rResult = $RGVP->DB->Execute_Query($sQuery, "GET", "SQLObj");
        $sQuery = " SELECT COUNT(" . $sIndexColumn . ") FROM $sTable ";
        $sQueryDisplay .= $sQuery . "\n";
        $rResultTotal = $RGVP->DB->Execute_Query($sQuery, "GET", "SQLObj");
        $aResultTotal = mysqli_fetch_array($rResultTotal);
        $iTotal = $aResultTotal[0];
        $output = array();
        while ($aRow = mysqli_fetch_array($rResult)) {
            $row = array();
            for ($i = 0; $i < count($SelectColumns); $i++) {
                if ($SelectColumns[$i] == "version")
                    $row[] = ( $aRow[$SelectColumns[$i]] == "0" ) ? "-" : $aRow[$SelectColumns[$i]];
                else if ($SelectColumns[$i] != " ")
                    $row[] = $aRow[$SelectColumns[$i]];
            }
            $output["data"][] = array_merge(array('<a href="docket-view.php?txt_id=' . $row[1] . '" class="btn btn-warning btn-docket-action" ><i class="fa fa-eye"></i></a>'), $row, $row);
        }
        // RETURN IN JSON
        die(trim(json_encode($output))); // . $sQueryDisplay);
        //echo "";
        break;
    case "SELECT-DOCKET-BRANCHMANIFEST":
        $sWhere = "";
        $sOrder = "order by DocketDate desc,DocketNumber desc";
        $sLimit = "";

        if (isset($posted["FromBranch"]) && isset($posted["ToBranch"])) {
            if ($posted["ToBranch"] == "NGP" || $posted["ToBranch"] == "JBP" || $posted["ToBranch"] == "RPR") {
                $sWhere = "Where FromBranch ='" . $posted["FromBranch"] . " ' AND ToBranch IN (select Code from branch where HubCode='" . $posted["ToBranch"] . "')  AND `Status`= 'New'";
            } else {
                $sWhere = "Where FromBranch ='" . $posted["FromBranch"] . " ' AND ToBranch ='" . $posted["ToBranch"] . " '  AND `Status`= 'New'";
            }
        }

        // FETCH
        $sQueryDisplay = "";
        $sQuery = " SELECT " . implode(",", $SelectColumns) . " FROM $sTable $sWhere $sOrder $sLimit ";
        $sQueryDisplay .= $sQuery . "\n";
        $rResult = $RGVP->DB->Execute_Query($sQuery, "GET", "SQLObj");
        $sQuery = " SELECT COUNT(" . $sIndexColumn . ") FROM $sTable ";
        $sQueryDisplay .= $sQuery . "\n";
        $rResultTotal = $RGVP->DB->Execute_Query($sQuery, "GET", "SQLObj");
        $aResultTotal = mysqli_fetch_array($rResultTotal);
        $iTotal = $aResultTotal[0];
        $output = array();
        $displaytable = "";
        $displayTableRow = "";
        if ($RGVP->DB->StatusCode == "502") {
            $aRow = mysqli_num_rows($rResult);
            if ($aRow > 0) {


                while ($aRow = mysqli_fetch_assoc($rResult)) {
//                    $QTY += $aRow['QTY'];
//                    $ChargedWeight += $aRow['ChargedWeight'];
//                    $GrandTotal += $aRow['GrandTotal'];

                    $displayTableRow .= '<tr><td><button type="button" class="btn btn-danger btn-calc-docket btn-xs" onclick="calc_docket(' . $aRow['DocketID'] . ')" id="btndoc_' . $aRow['DocketID'] . '">Add Row</button></td> <td>' . $aRow['DocketNumber'] . '</td>'
                            . ' <td>' . $aRow['DocketDate'] . '</td>
                                <td>' . $aRow['FromBranch'] . ' </td>
                                <td>' . $aRow['ToBranch'] . ' </td>
                                <td id="datadocQty_' . $aRow['DocketID'] . '" class="text-right">' . $aRow['QTY'] . ' </td>
                                <td id="datadocWt_' . $aRow['DocketID'] . '" class="text-right">' . $aRow['ChargedWeight'] . ' </td>
                                <td id="datadocAmt_' . $aRow['DocketID'] . '" class="text-right">' . $aRow['GrandTotal'] . '</td>';
                    ' </tr>';
                }
            } else {
                $returnstring = $RGVP::GetStatus("607", FALSE);
            }
            echo $displayTableRow;
        } else {
            $displayTableRow = $RGVP::GetStatus("503", FALSE, "", $Sql_input);
        }
        break;
    case "SELECT-DOCKET-DATE":
        $sWhere = "";
        $sOrder = "order by DocketDate desc";
        $sLimit = "";
        $ID = $_REQUEST["txt_id"];
        if (isset($posted["InvoiceStartDate"]) && isset($posted["InvoiceEndDate"])) {
            $sWhere = "Where DocketDate between '" . $posted["InvoiceStartDate"] . "' and '" . $posted['InvoiceEndDate'] . "' and BillingPartySelection='$ID'";
        }

        // FETCH
        $sQueryDisplay = "";
        $sQuery = " SELECT " . implode(",", $SelectColumns) . " FROM $sTable $sWhere $sOrder $sLimit ";
        $sQueryDisplay .= $sQuery . "\n";
        $rResult = $RGVP->DB->Execute_Query($sQuery, "GET", "SQLObj");
        $sQuery = " SELECT COUNT(" . $sIndexColumn . ") FROM $sTable ";
        $sQueryDisplay .= $sQuery . "\n";
        $rResultTotal = $RGVP->DB->Execute_Query($sQuery, "GET", "SQLObj");
        $aResultTotal = mysqli_fetch_array($rResultTotal);
        $iTotal = $aResultTotal[0];
        $output = array();
        $displaytable = "";
        $displayTableRow = "";
        if ($RGVP->DB->StatusCode == "502") {
            $aRow = mysqli_num_rows($rResult);
            if ($aRow > 0) {


                while ($aRow = mysqli_fetch_assoc($rResult)) {
                    $displayTableRow .= '<tr><td><button type="button" class="btn btn-danger btn-calc-docket" onclick="calc_docket(' . $aRow['DocketID'] . ')" id="btndoc_' . $aRow['DocketID'] . '">Add Row</button></td> <td>' . $aRow['DocketNumber'] . '</td>'
                            . ' <td>' . $aRow['DocketDate'] . '</td>
                                <td>' . $aRow['FromBranch'] . ' </td>
                                <td>' . $aRow['ToBranch'] . ' </td>
                                <td id="datadocQty_' . $aRow['DocketID'] . '" class="text-right">' . $aRow['QTY'] . ' </td>
                                <td id="datadocWt_' . $aRow['DocketID'] . '">' . $aRow['ChargedWeight'] . ' </td>
                                <td id="datadocAmt_' . $aRow['DocketID'] . '">' . $aRow['GrandTotal'] . '</td>';
                    ' </tr>';
                }
            } else {
                $returnstring = $RGVP::GetStatus("607", FALSE);
            }

            // RETURN IN JSON
//        die(trim(json_encode($output))); // . $sQueryDisplay);
            //echo "";
            echo $displayTableRow;
        } else {
            $displayTableRow = $RGVP::GetStatus("503", FALSE, "", $Sql_input);
        }
        break;
    case "SELECT-DOCKET-DATE-INVOICE":
        $sWhere = "";
        $sOrder = "order by DocketDate desc";
        $sLimit = "";
        $CustomerID = $posted["CustomerID"];
        $sWhere = " WHERE BillingPartySelection='$CustomerID' ";
        $sWhereStr = "";
        $Dockets = array();
        $Docketsstr ="";
        
        
        $sQueryInvoice = "SELECT Dockets FROM customerinvoice where InvoiceStatus != 'cancelled' AND CustomerID='$CustomerID'";
        $rResultInvoice = $RGVP->DB->Execute_Query($sQueryInvoice, "GET", "SQLObj");
        if($RGVP->DB->StatusCode = "502")
        {
            while ($InvoiceRow = mysqli_fetch_assoc($rResultInvoice)) {
                $tempDockets = explode("|", $InvoiceRow["Dockets"]);
                $Dockets = array_merge($tempDockets, $Dockets);
            }
        //var_dump($Dockets);
        $Docketsstr = implode(',', $Dockets);
        $Docketsstr = str_replace(",,", ",", $Docketsstr);
        $Docketsstr = str_replace(",,", ",", $Docketsstr);
        $Docketsstr = str_replace(",,", ",", $Docketsstr);
        $Docketsstr = str_replace(",,", ",", $Docketsstr);
        $Docketsstr = str_replace(",,", ",", $Docketsstr);
        $Docketsstr = "(". $Docketsstr.")";
        $Docketsstr = str_replace(",)", ")", $Docketsstr);
        $Docketsstr = str_replace("(,", "(", $Docketsstr);
        }

        if (isset($posted["InvoiceStartDate"]) && isset($posted["InvoiceEndDate"])) {
            $sWhereStr = "DocketDate between '" . $posted["InvoiceStartDate"] . "' AND '" . $posted['InvoiceEndDate'] . "'";
            if($sWhere =="")
                $sWhere .= " Where $sWhereStr ";
            else
                $sWhere .= " AND $sWhereStr ";
        }
        
        //var_dump($Docketsstr);
        if ($Docketsstr != "" && $Docketsstr != "()") {
            $sWhereStr = "DocketID NOT IN $Docketsstr";
            if ($sWhere == "")
                $sWhere .= "Where $sWhereStr ";
            else
                $sWhere .= " AND $sWhereStr ";
        }
        // FETCH
        $sQueryDisplay = "";
        $sQuery = " SELECT " . implode(",", $SelectColumns) . " FROM $sTable $sWhere $sOrder $sLimit ";
        
        
        $rResult = $RGVP->DB->Execute_Query($sQuery, "GET", "SQLObj");
        $output = array();
        $displaytable = "";
        $displayTableRow = "";
        if ($RGVP->DB->StatusCode == "502") {
            $aRow = mysqli_num_rows($rResult);
            if ($aRow > 0) {


                while ($aRow = mysqli_fetch_assoc($rResult)) {
                    $displayTableRow .= '<tr><td><button type="button" class="btn btn-danger btn-calc-docket" onclick="calc_docket(' . $aRow['DocketID'] . ')" id="btndoc_' . $aRow['DocketID'] . '">Add Row</button></td> <td>' . $aRow['DocketNumber'] . '</td>'
                            . ' <td>' . $aRow['DocketDate'] . '</td>
                                <td>' . $aRow['FromBranch'] . ' </td>
                                <td>' . $aRow['ToBranch'] . ' </td>
                                <td id="datadocQty_' . $aRow['DocketID'] . '" class="text-right">' . $aRow['QTY'] . ' </td>
                                <td id="datadocWt_' . $aRow['DocketID'] . '">' . $aRow['ChargedWeight'] . ' </td>
                                <td id="datadocAmt_' . $aRow['DocketID'] . '">' . $aRow['GrandTotal'] . '</td>';
                    ' </tr>';
                }
            } else {
                $returnstring = $RGVP::GetStatus("607", FALSE);
            }

            // RETURN IN JSON
//        die(trim(json_encode($output))); // . $sQueryDisplay);
            //echo "";
            echo $displayTableRow;
        } else {
            $displayTableRow = $RGVP::GetStatus("503", FALSE, "", $Sql_input);
        }
        break;
    case "UPDATE-POD":
        // AJAX EDIT FROM JQUERY
        $id = $posted["id"];
        if (isset($posted["id"]) && 0 < intval($posted["id"])) {
            $id = $posted["id"];

            $path = $_SERVER['DOCUMENT_ROOT'] . "/images/pod/";
            if (!is_dir($path)) {
                mkdir($path, 0777, true);
            }

            $FileUploadStatus = FALSE;
            $imagethumb_file = "";
            if (file_exists($_FILES["txt_uploadfile"]["tmp_name"])) {
                $imagethumb_file_upload = basename($_FILES["txt_uploadfile"]["name"]);
                $Extension = pathinfo($imagethumb_file_upload, PATHINFO_EXTENSION);
                $imagethumb_dir = $path;
                $imagethumb_file = $id . "." . $Extension;
                $imagethumb_file_path = $imagethumb_dir . $imagethumb_file;

                if (move_uploaded_file($_FILES["txt_uploadfile"]["tmp_name"], $imagethumb_file_path)) {
                    $FileUploadStatus = TRUE;
                    $posted["txt_uploadfile"] = $imagethumb_file;
                } else {
                    $FileUploadStatus = FALSE;
                    $posted["txt_uploadfile"] = $posted["txt_uploadfile-name"];
                    echo "File Logo Upload Error.";
                }
            } else {
                $posted["txt_uploadfile"] = $posted["txt_uploadfile-name"];
                echo "File Logo Upload Error..";
            }

            $Sql_input = "UPDATE $sTable SET POD = '$imagethumb_file'";

            $Sql_output = $RGVP->DB->Execute_Query($Sql_input, "SET", "UPDATE");
        }
//        header("location:../view-pod.php");
        break;
    case "SELECT-DOCKET-BRANCHDRS":
        $sWhere = "";
        $sOrder = "order by DocketDate desc,DocketNumber desc";
        $sLimit = "";
        $manifests = "";
        $Dockets = array();


        $sQuerymanifests = "SELECT Dockets FROM manifest where Status = 'Delivered' AND ToBranch='" . $posted["FromBranch"] . "'";
        $rResultmanifest = $RGVP->DB->Execute_Query($sQuerymanifests, "GET", "SQLObj");
        while ($ManifestRow = mysqli_fetch_assoc($rResultmanifest)) {
            $tempDockets = explode("|", $ManifestRow["Dockets"]);
            $Dockets = array_merge($tempDockets, $Dockets);
        }
       $Docketsstr = implode(',', $Dockets);
        $Docketsstr = str_replace(",,", ",", $Docketsstr);
        $Docketsstr = str_replace(",,", ",", $Docketsstr);
        $Docketsstr = str_replace(",,", ",", $Docketsstr);
        $Docketsstr = str_replace(",,", ",", $Docketsstr);
        $Docketsstr = str_replace(",,", ",", $Docketsstr);
        $Docketsstr = "(". $Docketsstr.")";
        $Docketsstr = str_replace(",)", ")", $Docketsstr);
        $Docketsstr = str_replace("(,", "(", $Docketsstr);

//if($posted["FromBranch"]==$posted["ToBranch"])
        //    $manifests="";
        if (isset($posted["ToBranch"])) {
            $sWhere = "Where ToBranch ='" . $posted["ToBranch"] . "' AND `Status`= 'Active' AND `DocketID` in $Docketsstr";
        }
        // FETCH
        $sQueryDisplay = "";
        $sQuery = " SELECT " . implode(",", $SelectColumns) . " FROM $sTable $sWhere $sOrder $sLimit ";

        $sQueryDisplay .= $sQuery . "\n";
        $rResult = $RGVP->DB->Execute_Query($sQuery, "GET", "SQLObj");

        $output = array();
        $displaytable = "";
        $displayTableRow = "";
        if ($RGVP->DB->StatusCode == "502") {
            $aRow = mysqli_num_rows($rResult);
            if ($aRow > 0) {


                while ($aRow = mysqli_fetch_assoc($rResult)) {

                    $displayTableRow .= '<tr><td><button type="button" class="btn btn-danger btn-calc-docket btn-xs" onclick="calc_docket(' . $aRow['DocketID'] . ')" id="btndoc_' . $aRow['DocketID'] . '">Add Row</button></td> <td>' . $aRow['DocketNumber'] . '</td>'
                            . ' <td>' . $aRow['DocketDate'] . '</td>
                                <td>' . $aRow['FromBranch'] . ' </td>
                                <td>' . $aRow['ToBranch'] . ' </td>
                                <td id="datadocQty_' . $aRow['DocketID'] . '" class="text-right">' . $aRow['QTY'] . ' </td>
                                <td id="datadocWt_' . $aRow['DocketID'] . '" class="text-right">' . $aRow['ChargedWeight'] . ' </td>
                                <td id="datadocAmt_' . $aRow['DocketID'] . '" class="text-right">' . $aRow['GrandTotal'] . '</td>';
                    ' </tr>';
                }
            } else {
                $returnstring = $RGVP::GetStatus("607", FALSE);
            }
            echo $displayTableRow;
        } else {
            $displayTableRow = $RGVP::GetStatus("503", FALSE, "", $Sql_input);
        }
        break;
    case "SELECT-DOCKET-BRANCH-STOCK":
        $sWhere = "";
        $sOrder = "order by DocketDate desc,DocketNumber desc";
        $sLimit = "";
        $manifests = "";
        $Dockets = array();


        $sQuerymanifests = "SELECT Dockets FROM manifest where Status = 'Delivered' AND ToBranch='" . $posted["Branch"] . "'";
        $rResultmanifest = $RGVP->DB->Execute_Query($sQuerymanifests, "GET", "SQLObj");
        while ($ManifestRow = mysqli_fetch_assoc($rResultmanifest)) {
            $tempDockets = explode("|", $ManifestRow["Dockets"]);
            $Dockets = array_merge($tempDockets, $Dockets);
        }
        $Docketsstr = implode(',', $Dockets);
        $Docketsstr = str_replace(",,", ",", $Docketsstr);
        $Docketsstr = str_replace(",,", ",", $Docketsstr);
        $Docketsstr = str_replace(",,", ",", $Docketsstr);
        $Docketsstr = str_replace(",,", ",", $Docketsstr);
        $Docketsstr = str_replace(",,", ",", $Docketsstr);
        $Docketsstr = "(". $Docketsstr.")";
        $Docketsstr = str_replace(",)", ")", $Docketsstr);
        $Docketsstr = str_replace("(,", "(", $Docketsstr);
        
//if($posted["FromBranch"]==$posted["ToBranch"])
        //    $manifests="";
        if (isset($posted["Branch"])) {
            $sWhere = "Where `Status`= 'Active' AND `DocketID` in $Docketsstr";
        }
        // FETCH
        $sQueryDisplay = "";
        $sQuery = " SELECT " . implode(",", $SelectColumns) . " FROM $sTable $sWhere $sOrder $sLimit ";

        $sQueryDisplay .= $sQuery . "\n";
        $rResult = $RGVP->DB->Execute_Query($sQuery, "GET", "SQLObj");

        $output = array();
        $displaytable = "";
        $displayTableRow = "";
        if ($RGVP->DB->StatusCode == "502") {
            $aRow = mysqli_num_rows($rResult);
            if ($aRow > 0) {


                while ($aRow = mysqli_fetch_assoc($rResult)) {
                    $displayTableRow .= '<tr>
                        <td>' . $aRow['DocketNumber'] . '</td>
                            <td>' . $aRow['DocketDate'] . '</td>
                                <td>' . $aRow['FromBranch'] . ' </td>
                                <td>' . $aRow['ToBranch'] . ' </td>
                                <td id="datadocQty_' . $aRow['DocketID'] . '" class="text-right">' . $aRow['QTY'] . ' </td>
                                <td id="datadocWt_' . $aRow['DocketID'] . '" class="text-right">' . $aRow['ChargedWeight'] . ' </td>
                                <td id="datadocAmt_' . $aRow['DocketID'] . '" class="text-right">' . $aRow['GrandTotal'] . '</td>';
                    ' </tr>';
                }
            } else {
                $returnstring = $RGVP::GetStatus("607", FALSE);
            }
            echo $displayTableRow;
        } else {
            $displayTableRow = $RGVP::GetStatus("503", FALSE, "", $Sql_input);
        }

        break;

    default:
        echo "Invalid Command.";
        break;
}
