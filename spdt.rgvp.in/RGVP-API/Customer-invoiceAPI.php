<?php

include "include.php"; // VARIABLES
$SelectColumns = array("InvoiceID", "InvoiceNo", "InvoiceDate", "InvoiceBranch", "CustomerID", "CustomerName", "CustomerEmail", "CustomerAddress", "CustomerPhone", "GSTIN", "InvoiceStartDate", "InvoiceEndDate", "Dockets", "InvoiceDueDate", "InvoiceDueDateCharges", "PaidAmount", "BillingAmount", "GSTAmount", "TotalAmount", "InvoiceStatus", "TransactionDate", "Transaction_mode", "TransactionID", "Narration", "AddedBy", "AddedDate", "UpdateBy", "UpdateDate"); // array("id", "name", "email", "mobile", "start_date");
$InsertColumns = array("InvoiceNo", "InvoiceDate", "InvoiceBranch", "CustomerID", "CustomerName", "CustomerEmail", "CustomerAddress", "CustomerPhone", "GSTIN", "InvoiceStartDate", "InvoiceEndDate", "Dockets", "InvoiceDueDate", "InvoiceDueDateCharges", "PaidAmount", "BillingAmount", "GSTAmount", "TotalAmount", "InvoiceStatus", "AddedBy", "UpdateBy");
$UpdateColumns = array("InvoiceNo", "InvoiceDate", "InvoiceBranch", "CustomerID", "CustomerName", "CustomerEmail", "CustomerAddress", "CustomerPhone", "GSTIN", "InvoiceStartDate", "InvoiceEndDate", "Dockets", "InvoiceDueDate", "InvoiceDueDateCharges", "PaidAmount", "BillingAmount", "GSTAmount", "TotalAmount", "InvoiceStatus", "TransactionDate", "Transaction_mode", "TransactionID", "Narration", "AddedBy", "UpdateBy");
$InsertColumnsData = array("txt_InvoiceNo", "date_InvoiceDate", "txt_InvoiceBranch", "txt_CustomerID", "txt_CustomerName", "txt_CustomerEmail", "txt_CustomerAddress", "txt_CustomerPhone", "txt_GSTIN", "date_InvoiceStartDate", "date_InvoiceEndDate", "txt_Dockets", "date_InvoiceDueDate", "txt_InvoiceDueDateCharges", "txt_PaidAmount", "txt_BillingAmount", "txt_GSTAmount", "txt_TotalAmount", "ddl_InvoiceStatus", "txt_AddedBy", "txt_UpdateBy");
$ColumnAPIUpdateData = array("txt_InvoiceNo", "date_InvoiceDate", "txt_InvoiceBranch", "txt_CustomerID", "txt_CustomerName", "txt_CustomerEmail", "txt_CustomerAddress", "txt_CustomerPhone", "txt_GSTIN", "date_InvoiceStartDate", "date_InvoiceEndDate", "txt_Dockets", "date_InvoiceDueDate", "txt_InvoiceDueDateCharges", "txt_PaidAmount", "txt_BillingAmount", "txt_GSTAmount", "txt_TotalAmount", "ddl_InvoiceStatus", "date_TransactionDate", "ddl_Transaction_mode", "txt_TransactionID", "txt_Narration", "txt_AddedBy", "txt_UpdateBy");
$InsertColDataString = "";
$UpdateColDataString = "";
$sIndexColumn = "InvoiceID";
$sTable = "customerinvoice";
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
            $InvoiceNumber = "AONE/" . $posted["txt_InvoiceBranch"] . "/" . $id . "";
            $Sql_input1 = "UPDATE customerinvoice Set InvoiceNo = '$InvoiceNumber' where InvoiceID = $id ";
            $Sql_output1 = $RGVP->DB->Execute_Query($Sql_input1, "SET", "UPDATE");
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
            $CustomerID = $posted["txt_CustomerID"];
            $InvoiceBranch = $posted['txt_InvoiceBranch'];
            $InvoiceDate = $posted['date_InvoiceDate'];
            $TransactionType = "Receipt";
            $TotalAmount = $posted['txt_TotalAmount'];
            $InvoiceStatus = "Active";
            $AddedBy = $posted['txt_AddedBy'];
            $UpdateBy = $posted['txt_UpdateBy'];
            $TransactionDate = $posted["date_TransactionDate"];
            $Transactionmode = $posted["ddl_Transaction_mode"];
            $TransactionID = $posted["txt_TransactionID"];
            $PaidAmount = $posted['txt_PaidAmount'];
            $Narration = $posted['txt_Narration'];
            $Remark = "Receipt for the Payment of RS." . $PaidAmount . " for Invoice No. # " . $posted["txt_InvoiceNo"] . " By Transaction Mode #" . $Transactionmode . " having TransactionID #." . $TransactionID . " on Transaction Date #" . $TransactionDate . "";

            $Sql_input_doc = "INSERT INTO customer_accounts (`CustomerID`, `Branch_code`, `Date_Transaction`, `Transaction_type`, `Transaction_mode`, `TransactionDate`, `TransactionID`, `TransactionAmount`,`Narration`,`Remark`, `Status`, `AddedBy`, `UpdateBy`)
                  VALUES ('$CustomerID', '$InvoiceBranch', '$InvoiceDate', '$TransactionType', '$Transactionmode', '$TransactionDate', '$TransactionID', '$PaidAmount','$Narration','$Remark', '$InvoiceStatus', '$AddedBy', '$UpdateBy')";
            $Sql_output_doc = $RGVP->DB->Execute_Query($Sql_input_doc, "SET", "UPDATE");

            // GET DATA
            $Sql_input = "SELECT " . implode(",", $SelectColumns) . " FROM $sTable WHERE $sIndexColumn = " . intval($_GET["id"]);
            $Sql_output = $RGVP->DB->Execute_Query($Sql_input, "GET", "SQLObj");
            die(json_encode(mysqli_fetch_assoc($Sql_output)));
        }
        break;
    case "UPDATE-STATUS":
        // AJAX EDIT FROM JQUERY
        if (isset($_GET["id"]) && 0 < intval($_GET["id"])) {
            // SAVE DATA
            for ($j = 0; $j < count($ColumnAPIUpdateData); $j++)
                $UpdateColDataString .= $UpdateColumns[$j] . " = '" . $posted[$ColumnAPIUpdateData[$j]] . "',";
            $UpdateColDataString = substr($UpdateColDataString, 0, strlen($UpdateColDataString) - 1);
            $Sql_input = " UPDATE $sTable SET $UpdateColDataString WHERE $sIndexColumn = " . intval($_GET["id"]);
            $Sql_output = $RGVP->DB->Execute_Query($Sql_input, "SET", "UPDATE");

            // GET DATA
            $Sql_input = "SELECT " . implode(",", $SelectColumns) . " FROM $sTable WHERE $sIndexColumn = " . intval($_GET["id"]);
            $Sql_output = $RGVP->DB->Execute_Query($Sql_input, "GET", "SQLObj");
            die(json_encode(mysqli_fetch_assoc($Sql_output)));
        }
        break;
    case "DELETE":
        // AJAX REMOVE FROM JQUERY
        if (isset($_GET["id"]) && 0 < intval($_GET["id"])) {
            //dbinit($gaSql);
            // REMOVE DATA
            $Sql_input = " DELETE FROM $sTable WHERE $sIndexColumn = " . intval($_GET["id"]);
            $Sql_output = $RGVP->DB->Execute_Query($Sql_input, "SET", "DELETE");
            if ($RGVP->DB->StatusCode == "501" || $RGVP->DB->StatusCode == "503") {
                echo $RGVP->DB->Exception . $RGVP->DB->Msg;
            }
        }
        break;
    case "SELECT-WITH-ID":
        if (isset($_GET["id"]) && 0 < intval($_GET["id"])) {
            $Sql_input = "SELECT " . implode(",", $SelectColumns) . " FROM $sTable WHERE $sIndexColumn = " . intval($_GET["id"]);
            $Sql_output = $RGVP->DB->Execute_Query($Sql_input, "GET", "SQLObj");
            die(json_encode(mysqli_fetch_assoc($Sql_output)));
        }
        break;
    case "SELECT-WITH-IDSTATUS":
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
        if (isset($_GET["customerid"]))
            if ($sWhere == "")
                $sWhere = " WHERE CustomerID = " . $_GET["customerid"];
            else
                $sWhere .= " AND CustomerID = " . $_GET["customerid"];

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
            $output["data"][] = array_merge(array('<a data-id="row-' . $row[0] . '" href="javascript:editstatus(' . $row[0] . ');" class="btn btn-info"><i class="fa fa-check-square"></i></a><a href="customer-invoice-print.php?txt_InvoiceID=' . $row[0] . '" target="_blank"  class="btn btn-success"><i class="fa fa-print"></i></a><a href="javascript:removeRow(' . $row[0] . ');" class="btn btn-danger" ><i class="fa fa-close"></i></a>'), $row);
        }
        // RETURN IN JSON
        die(trim(json_encode($output))); // . $sQueryDisplay);
        //echo "";
        break;
    default:
        echo "Invalid Command.";
        break;
}
