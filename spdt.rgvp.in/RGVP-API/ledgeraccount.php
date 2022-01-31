<?php

include "include.php"; // VARIABLES
$SelectColumns = array("BAID", "CompanyID", "MasterName", "BankAccountName", "BankAccountNumber", "BankIFSCode", "BankName", "BankBranch", "AccountDescription", "Balance", "AddedBy", "ModifiedDate", "CreatedDate"); // array("id", "name", "email", "mobile", "start_date");
$InsertColumns = array("CompanyID", "MasterName", "BankAccountName", "BankAccountNumber", "BankIFSCode", "BankName", "BankBranch", "AccountDescription", "Balance", "AddedBy");
$UpdateColumns = array("CompanyID", "MasterName", "BankAccountName", "BankAccountNumber", "BankIFSCode", "BankName", "BankBranch", "AccountDescription", "Balance", "AddedBy");
$InsertColumnsData = array("txt_CompanyID", "txt_MasterName", "txt_BankAccountName", "txt_BankAccountNumber", "txt_BankIFSCode", "txt_BankName", "txt_BankBranch", "txt_AccountDescription", "txt_Balance", "txt_AddedBy");
$ColumnAPIUpdateData = array("txt_CompanyID", "txt_MasterName", "txt_BankAccountName", "txt_BankAccountNumber", "txt_BankIFSCode", "txt_BankName", "txt_BankBranch", "txt_AccountDescription", "txt_Balance", "txt_AddedBy");
$InsertColDataString = "";
$UpdateColDataString = "";
$sIndexColumn = "BAID";
$sTable = "bank_accounts";
$gaSql["user"] = RGVPDB_USERNAME;
$gaSql["password"] = RGVPDB_PASSWORD;
$gaSql["db"] = RGVPDB_DBNAME;
$gaSql["server"] = RGVPDB_HOST;

$RGVPDBCon = "";
$RGVPDBCon = $RGVP->DB->GetConnection();
$CommandType = "EMPTY";
if (isset($_REQUEST["CommandType"]))
    $CommandType = $_REQUEST["CommandType"];
$posted = $_REQUEST;
foreach ($posted as &$val)
    $val = mysqli_real_escape_string($RGVPDBCon, trim($val));

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
              header("location:../view-ledgeraccount.php?txt_id=".$id."&btnSearch=Search");
//            $Sql_output = $RGVP->DB->Execute_Query("SELECT " . implode(",", $SelectColumns) . " FROM $sTable WHERE $sIndexColumn = " . $id, "GET", "SQLObj");
//            die(json_encode(mysqli_fetch_assoc($Sql_output)));
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
        while ($aRow = mysqli_fetch_array($rResult)) {
            $row = array();
            for ($i = 0; $i < count($SelectColumns); $i++) {
                if ($SelectColumns[$i] == "version")
                    $row[] = ( $aRow[$SelectColumns[$i]] == "0" ) ? "-" : $aRow[$SelectColumns[$i]];
                else if ($SelectColumns[$i] != " ")
                    $row[] = $aRow[$SelectColumns[$i]];
            }
            $output["data"][] = array_merge(array('<a data-id="row-' . $row[0] . '" href="javascript:editRow(' . $row[0] . ');" class="btn btn-success"><i class="fa fa-edit"></i></a>&nbsp;<a href="javascript:removeRow(' . $row[0] . ');" class="btn btn-danger" ><i class="fa fa-close"></i></a>'), $row, $row);
        }
        // RETURN IN JSON
        die(trim(json_encode($output))); // . $sQueryDisplay);
        //echo "";
        break;
    default:
        echo "Invalid Command.";
        break;
}