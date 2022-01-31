<?php

include "include.php"; // VARIABLES
$SelectColumns = array("VID", "VName", "VAlias", "VCode", "VGroupName", "VTDSDetails", "VRegistrationType", "VBillingAddress", "VBillingCity", "VBillingState", "VBillingPincode", "VShippingAddress", "VShippingCity", "VShippingState", "VShippingPincode", "VGSTIN", "VPAN", "VAadhar", "VCreditLimit", "VCreditDays", "VContactPersonName", "VContactPersonAddress", "VContactPersonCity", "VContactPersonState", "VContactPersonPincode", "VContactPersonCategory", "VContactPersonMobile", "VContactPersonPhoneNo", "VContactPersonEmail", "VContactPersonFax", "VContactPersonWebsite", "VStateCode", "VInterest", "VInterestAC", "VTDSAC", "VCR_DB", "VBankName", "VBranchName", "VBankAddress", "VIFSCCode", "VAccountNo", "CompanyID", "AddedBy", "Status"); // array("id", "name", "email", "mobile", "start_date");
$InsertColumns = array("VName", "VAlias", "VCode", "VGroupName", "VTDSDetails", "VRegistrationType", "VBillingAddress", "VBillingCity", "VBillingState", "VBillingPincode", "VShippingAddress", "VShippingCity", "VShippingState", "VShippingPincode", "VGSTIN", "VPAN", "VAadhar", "VCreditLimit", "VCreditDays", "VContactPersonName", "VContactPersonAddress", "VContactPersonCity", "VContactPersonState", "VContactPersonPincode", "VContactPersonCategory", "VContactPersonMobile", "VContactPersonPhoneNo", "VContactPersonEmail", "VContactPersonFax", "VContactPersonWebsite", "VStateCode", "VInterest", "VInterestAC", "VTDSAC", "VCR_DB", "VBankName", "VBranchName", "VBankAddress", "VIFSCCode", "VAccountNo", "CompanyID", "AddedBy", "Status");
$UpdateColumns = array("VName", "VAlias", "VCode", "VGroupName", "VTDSDetails", "VRegistrationType", "VBillingAddress", "VBillingCity", "VBillingState", "VBillingPincode", "VShippingAddress", "VShippingCity", "VShippingState", "VShippingPincode", "VGSTIN", "VPAN", "VAadhar", "VCreditLimit", "VCreditDays", "VContactPersonName", "VContactPersonAddress", "VContactPersonCity", "VContactPersonState", "VContactPersonPincode", "VContactPersonCategory", "VContactPersonMobile", "VContactPersonPhoneNo", "VContactPersonEmail", "VContactPersonFax", "VContactPersonWebsite", "VStateCode", "VInterest", "VInterestAC", "VTDSAC", "VCR_DB", "VBankName", "VBranchName", "VBankAddress", "VIFSCCode", "VAccountNo", "CompanyID", "AddedBy", "Status");
$InsertColumnsData = array("txt_VName", "txt_VAlias", "txt_VCode", "txt_VGroupName", "ddl_VTDSDetails", "ddl_VRegistrationType", "txt_VBillingAddress", "txt_VBillingCity", "txt_VBillingState", "txt_VBillingPincode", "txt_VShippingAddress", "txt_VShippingCity", "txt_VShippingState", "txt_VShippingPincode", "txt_VGSTIN", "txt_VPAN", "txt_VAadhar", "txt_VCreditLimit", "txt_VCreditDays", "txt_VContactPersonName", "txt_VContactPersonAddress", "txt_VContactPersonCity", "txt_VContactPersonState", "txt_VContactPersonPincode", "txt_VContactPersonCategory", "txt_VContactPersonMobile", "txt_VContactPersonPhoneNo", "txt_VContactPersonEmail", "txt_VContactPersonFax", "txt_VContactPersonWebsite", "txt_VStateCode", "txt_VInterest", "txt_VInterestAC", "txt_VTDSAC", "ddl_VCR_DB", "txt_VBankName", "txt_VBranchName", "txt_VBankAddress", "txt_VIFSCCode", "txt_VAccountNo", "txt_CompanyID", "txt_AddedBy", "ddl_Status");
$ColumnAPIUpdateData = array("txt_VName", "txt_VAlias", "txt_VCode", "txt_VGroupName", "ddl_VTDSDetails", "ddl_VRegistrationType", "txt_VBillingAddress", "txt_VBillingCity", "txt_VBillingState", "txt_VBillingPincode", "txt_VShippingAddress", "txt_VShippingCity", "txt_VShippingState", "txt_VShippingPincode", "txt_VGSTIN", "txt_VPAN", "txt_VAadhar", "txt_VCreditLimit", "txt_VCreditDays", "txt_VContactPersonName", "txt_VContactPersonAddress", "txt_VContactPersonCity", "txt_VContactPersonState", "txt_VContactPersonPincode", "txt_VContactPersonCategory", "txt_VContactPersonMobile", "txt_VContactPersonPhoneNo", "txt_VContactPersonEmail", "txt_VContactPersonFax", "txt_VContactPersonWebsite", "txt_VStateCode", "txt_VInterest", "txt_VInterestAC", "txt_VTDSAC", "ddl_VCR_DB", "txt_VBankName", "txt_VBranchName", "txt_VBankAddress", "txt_VIFSCCode", "txt_VAccountNo", "txt_CompanyID", "txt_AddedBy", "ddl_Status");
$InsertColDataString = "";
$UpdateColDataString = "";
$sIndexColumn = "VID";
$sTable = "vendor";
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
            $Sql_output = $RGVP->DB->Execute_Query("SELECT " . implode(",", $SelectColumns) . " FROM $sTable WHERE $sIndexColumn = " . $id, "GET", "SQLObj");
            die(json_encode(mysqli_fetch_assoc($Sql_output)));
        }
        break;
    case "UPDATE-SAVE":
        // AJAX EDIT FROM JQUERY
        $id = $_REQUEST["txt_VID"];
            // SAVE DATA
            for ($j = 0; $j < count($ColumnAPIUpdateData); $j++)
                $UpdateColDataString .= $UpdateColumns[$j] . " = '" . $posted[$ColumnAPIUpdateData[$j]] . "',";
            $UpdateColDataString = substr($UpdateColDataString, 0, strlen($UpdateColDataString) - 1);
            $Sql_input = " UPDATE $sTable SET $UpdateColDataString WHERE $sIndexColumn = " .  $id;
            $Sql_output = $RGVP->DB->Execute_Query($Sql_input, "SET", "UPDATE");
            header("Location:../vendor.php");
            // GET DATA
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
                    $sWhere .= $SelectColumns[$i] . " LIKE '%" . mysqli_real_escape_string($RGVP->DBCon, $_GET["sSearch"]) . "%' OR ";
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
                $sWhere .= $SelectColumns[$i] . " LIKE '%" . mysqli_real_escape_string($RGVP->DBCon, $_GET["sSearch_" . $i]) . "%' ";
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
            $output["data"][] = array_merge(array('<a data-id="row-' . $row[0] . '" href="javascript:editRow(' . $row[0] . ');" class="btn btn-success"><i class="fa fa-edit"></i></a>&nbsp;'),$row,$row);
        }
        // RETURN IN JSON
        die(trim(json_encode($output))); // . $sQueryDisplay);
        //echo "";
        break;
        
        case "SELECTACTIVE":
         $sQueryDisplay = "";
         $CompanyID = $_GET['CompanyID'];
        $sQuery = " SELECT " . implode(",", $SelectColumns) . " FROM $sTable WHERE CompanyID = $CompanyID AND Status = 'Active' ";
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
            $output["data"][] = array_merge(array('<a data-id="row-' . $row[0] . '" href="vendor-details.php?VendorID=' . $row[0] . '" class="btn btn-info"><i class="fa fa-eye"></i></a><a data-id="row-' . $row[0] . '" href="javascript:editRow(' . $row[0] . ');" class="btn btn-success"><i class="fa fa-edit"></i></a>&nbsp;<a href="javascript:removeRow(' . $row[0] . ');" class="btn btn-danger" ><i class="fa fa-close"></i></a>'), $row, $row);
        }
        // RETURN IN JSON
        die(trim(json_encode($output))); // . $sQueryDisplay);
        //echo "";
        break;
        
        
        case "SELECTINACTIVE":
         $sQueryDisplay = "";
            $CompanyID = $_GET['CompanyID'];
        $sQuery = " SELECT " . implode(",", $SelectColumns) . " FROM $sTable WHERE CompanyID = $CompanyID AND Status = 'Inactive' ";
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
            $output["data"][] = array_merge(array('<a data-id="row-' . $row[0] . '" href="vendor-details.php?VendorID=' . $row[0] . '" class="btn btn-info"><i class="fa fa-eye"></i></a><a data-id="row-' . $row[0] . '" href="javascript:editRow(' . $row[0] . ');" class="btn btn-success"><i class="fa fa-edit"></i></a>&nbsp;<a href="javascript:removeRow(' . $row[0] . ');" class="btn btn-danger" ><i class="fa fa-close"></i></a>'), $row,$row);
        }
        // RETURN IN JSON
        die(trim(json_encode($output))); // . $sQueryDisplay);
        //echo "";
        break;
        case "SELECT-WITH-ID-VENDOR":
        if (isset($_GET["id"]) && 0 < intval($_GET["id"])) {
           $Sql_input = "SELECT * FROM vendor WHERE VID = " . intval($_GET["id"]);
            $Sql_output = $RGVP->DB->Execute_Query($Sql_input, "GET", "SQLObj");
            die(json_encode(mysqli_fetch_assoc($Sql_output)));
        }
        break;
    default:
        echo "Invalid Command.";
        break;
}