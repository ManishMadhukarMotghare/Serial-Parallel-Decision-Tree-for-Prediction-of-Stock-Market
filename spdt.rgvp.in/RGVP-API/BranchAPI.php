<?php

include "include.php"; // VARIABLES
$SelectColumns = array("BranchID", "BranchName", "Status", "Code", "ContactPerson", "Mobile", "Email", "Address", "City", "State", "Country", "BranchType", "BillingName", "BillingGstNo", "HubCode", "TargetDocket", "TargetWt", "TargetRevenue", "AddedBy", "AddedDate", "UpdateBy", "UpdatedDate"); // array("id", "name", "email", "mobile", "start_date");
$InsertColumns = array("BranchName", "Status", "Code", "ContactPerson", "Mobile", "Email", "Address", "City", "State", "Country", "BranchType","BillingName", "BillingGstNo", "HubCode", "AddedBy", "UpdateBy");
$UpdateColumns = array("BranchName", "Status", "Code", "ContactPerson", "Mobile", "Email", "Address", "City", "State", "Country", "BranchType", "BillingName", "BillingGstNo", "HubCode", "TargetDocket", "TargetWt", "TargetRevenue", "AddedBy", "UpdateBy");
$InsertColumnsData = array("txt_BranchName", "ddl_Status", "txt_Code", "txt_ContactPerson", "txt_Mobile", "txt_Email", "txt_Address", "txt_City", "txt_State", "txt_Country","ddl_BranchType", "txt_BillingName", "txt_BillingGstNo", "txt_HubCode", "txt_AddedBy", "txt_UpdateBy" );
$ColumnAPIUpdateData = array("txt_BranchName", "ddl_Status", "txt_Code", "txt_ContactPerson", "txt_Mobile", "txt_Email", "txt_Address", "txt_City", "txt_State", "txt_Country","ddl_BranchType", "txt_BillingName", "txt_BillingGstNo", "txt_HubCode", "txt_TargetDocket", "txt_TargetWt", "txt_TargetRevenue", "txt_AddedBy", "txt_UpdateBy");
$InsertColDataString = "";
$UpdateColDataString = "";
$sIndexColumn = "BranchID";
$sTable = "branch";
$RGVP = new \RGVPCore\RGVPCore();
$RGVPDBCon = "";
$RGVPDBCon = $RGVP->DB->GetConnection();
$sWhere = "";
$posted = $_REQUEST;
foreach ($posted as &$val)
    if (gettype($val) == "string")
        $val = mysqli_real_escape_string($RGVPDBCon, $val);

$CommandType = "EMPTY";
if (isset($posted["BranchType"]))
    $CommandType = $posted["BranchType"];

switch ($CommandType) {
    case "EMPTY":
        $sWhere = "";
        echo SelectBranch($sWhere);
        break;
    case "HUB":
        $sWhere = " WHERE BranchType='HUB'";
        echo SelectBranch($sWhere);
        break;
    case "BRANCH":
        $sWhere = " WHERE BranchType='Branch'";
        echo SelectBranch($sWhere);
        break;
    case "BOTH":
        $sWhere = " ";
        echo SelectBranch($sWhere);
        break;
    case "FETCH-ROUTE-BRANCH":
        if (isset($posted["RouteID"]) && isset($posted["Column"])) {
            echo GetBranchfromRouteID($posted["RouteID"], $posted["Column"]);
        } else {
            $returnstring = $RGVP::GetStatus("701", FALSE, "No RouteID or Column Received.");
        }
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
//            $Sql_output = $RGVP->DB->Execute_Query("SELECT " . implode(",", $SelectColumns) . " FROM $sTable WHERE $sIndexColumn = " . $id, "GET", "SQLObj");
//            die(json_encode(mysqli_fetch_assoc($Sql_output)));
           header("location:../branch-add.php");
        }
        break;
    case "UPDATE-SAVE":
        // AJAX EDIT FROM JQUERY
        if (isset($_REQUEST["id"]) && 0 < intval($_REQUEST["id"])) {
            // SAVE DATA
            $id = $_REQUEST["id"];
            for ($j = 0; $j < count($ColumnAPIUpdateData); $j++)
                $UpdateColDataString .= $UpdateColumns[$j] . " = '" . $posted[$ColumnAPIUpdateData[$j]] . "',";
            $UpdateColDataString = substr($UpdateColDataString, 0, strlen($UpdateColDataString) - 1);
            $Sql_input = " UPDATE $sTable SET $UpdateColDataString WHERE $sIndexColumn = " . intval($_REQUEST["id"]);

            $Sql_output = $RGVP->DB->Execute_Query($Sql_input, "SET", "UPDATE");

//            // GET DATA
//            $Sql_input = "SELECT " . implode(",", $SelectColumns) . " FROM $sTable WHERE $sIndexColumn = " . intval($_GET["id"]);
//            $Sql_output = $RGVP->DB->Execute_Query($Sql_input, "GET", "SQLObj");
//            die(json_encode(mysqli_fetch_assoc($Sql_output)));
            header("location:../branch-view.php?txt_id=" . $id . "&Msg=Your Data is Updated Succesfully");
        }
        break;
    case "DELETE":
        // AJAX REMOVE FROM JQUERY
        if (isset($_GET["id"]) && 0 < intval($_GET["id"])) {
            //dbinit($gaSql);
            // REMOVE DATA
            $Sql_input = "update branch set Status='Inactive' WHERE $sIndexColumn = " . intval($_GET["id"]);
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
        $output = array();
        while ($aRow = mysqli_fetch_array($rResult)) {
            $row = array();
            for ($i = 0; $i < count($SelectColumns); $i++) {
                if ($SelectColumns[$i] == "version")
                    $row[] = ( $aRow[$SelectColumns[$i]] == "0" ) ? "-" : $aRow[$SelectColumns[$i]];
                else if ($SelectColumns[$i] != " ")
                    $row[] = $aRow[$SelectColumns[$i]];
            }
            $output["data"][] = array_merge(array('<a href="branch-view.php?txt_id=' . $row[0] . '" class="btn btn-warning" ><i class="fa fa-eye"></i></a>'), $row);
        }
        // RETURN IN JSON
        die(trim(json_encode($output))); // . $sQueryDisplay);
        //echo "";
        break;
    default:
        echo "Invalid Command.";
        break;
}

function GetBranchfromRouteID($RouteID, $column) {
    $RGVP = new \RGVPCore\RGVPCore();

    $Sql_input = "Select " . $column . " from route  where RouteID= '" . $RouteID . "'";
    $sql_output = $RGVP->DB->Execute_Query($Sql_input, "GET", "SQLObj");
    if ($RGVP->DB->StatusCode == "502") {
        $num = mysqli_num_rows($sql_output);
        if ($num > 0) {
            $row = mysqli_fetch_assoc($sql_output);
            $returnstring = $RGVP::GetStatus("700", TRUE, "Data Contents FromBranch", $row[$column]);
            //    echo "{Status:success,data:{FromBranch:".$s."},Msg:Data Succesfully Send}";
        } else {
            $returnstring = $RGVP::GetStatus("703", FALSE, "No Data for Specific RouteID.");
        }
    } else {
        $returnstring = $RGVP::GetStatus("503", FALSE, "Command Execution Failed. Check your SQL Query.", $Sql_input);
    }
    return $returnstring;
}

function SelectBranch($sWhere) {
    $RGVP = new \RGVPCore\RGVPCore();

    $Sql_input = "select Code,BranchName from branch  $sWhere ORDER By BranchName asc";
    $sql_output = $RGVP->DB->Execute_Query($Sql_input, "GET", "SQLObj");
    $displayOptions = "";
    $s;
    if ($RGVP->DB->StatusCode == "502") {
        $num = mysqli_num_rows($sql_output);
        if ($num > 0) {
            $displayOptions .= '<option value="" selected="" disabled="" required>Select Branch</option>';
            while ($row = mysqli_fetch_assoc($sql_output)) {
                $displayOptions .= "<option value='" . $row["Code"] . "'>" . $row["BranchName"] . "</option>";
            }
            $returnstring = $RGVP::GetStatus("702", TRUE, "Branch Data Retrived Successfully.", $displayOptions);
        } else {
            $returnstring = $RGVP::GetStatus("705", FALSE, "No Branches for Specific Search Criteria for $sWhere.");
        }
    } else {
        $returnstring = $RGVP::GetStatus("503", FALSE, "", $Sql_input);
    }
    return $returnstring;
}
