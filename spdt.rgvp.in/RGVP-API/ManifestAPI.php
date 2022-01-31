<?php

include "include.php"; // VARIABLES
$SelectColumns = array("ManifestID", "ManifestNumber", "ManifestDate", "ManifestType", "FromBranch", "ToBranch", "Dockets", "LoadedBy", "LoadingSupervisor", "UnLoadedBy", "UnloadingSupervisor", "ManifestItems", "ManifestWeight", "ManifestsAmount", "Status", "AddedBy", "AddedDate", "UpdateBy", "UpdateDate"); // array("id", "name", "email", "mobile", "start_date");
$InsertColumns = array("ManifestNumber", "ManifestDate", "ManifestType", "FromBranch", "ToBranch", "Dockets", "LoadedBy", "LoadingSupervisor", "UnLoadedBy", "UnloadingSupervisor", "ManifestItems", "ManifestWeight", "ManifestsAmount", "Status", "AddedBy", "UpdateBy");
$UpdateColumns = array("ManifestNumber", "ManifestDate", "ManifestType", "FromBranch", "ToBranch", "Dockets", "LoadedBy", "LoadingSupervisor", "UnLoadedBy", "UnloadingSupervisor", "ManifestItems", "ManifestWeight", "ManifestsAmount", "Status", "AddedBy", "UpdateBy");
$InsertColumnsData = array("txt_ManifestNumber", "date_ManifestDate", "ddl_ManifestType", "txt_FromBranch", "txt_ToBranch", "txt_Dockets", "txt_LoadedBy", "txt_LoadingSupervisor", "txt_UnLoadedBy", "txt_UnloadingSupervisor", "txt_ManifestItems", "txt_ManifestWeight", "txt_ManifestsAmount", "ddl_Status", "txt_AddedBy", "txt_UpdateBy");
$ColumnAPIUpdateData = array("txt_ManifestNumber", "date_ManifestDate", "ddl_ManifestType", "txt_FromBranch", "txt_ToBranch", "txt_Dockets", "txt_LoadedBy", "txt_LoadingSupervisor", "txt_UnLoadedBy", "txt_UnloadingSupervisor", "txt_ManifestItems", "txt_ManifestWeight", "txt_ManifestsAmount", "ddl_Status", "txt_AddedBy", "txt_UpdateBy");
$InsertColDataString = "";
$UpdateColDataString = "";
$sIndexColumn = "ManifestID";
$sTable = "manifest";
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
            $Dockets = str_replace("|", ",", $posted["txt_Dockets"]);
            $Sql_input_doc = "UPDATE docket SET Status='Active' where DocketID IN ($Dockets)";
            $Sql_output_doc = $RGVP->DB->Execute_Query($Sql_input_doc, "SET", "UPDATE");
            $ManifestNumber = "MF/" . $posted["txt_FromBranch"] . "/" . $id . "";
            $Sql_input1 = "UPDATE manifest Set ManifestNumber = '$ManifestNumber' where ManifestID = $id ";
            $Sql_output1 = $RGVP->DB->Execute_Query($Sql_input1, "SET", "UPDATE");
            $Sql_output = $RGVP->DB->Execute_Query("SELECT " . implode(",", $SelectColumns) . " FROM $sTable WHERE $sIndexColumn = " . $id, "GET", "SQLObj");
            die(json_encode(mysqli_fetch_assoc($Sql_output)));
        }


        break;
    case "UPDATE-SAVE":
// AJAX EDIT FROM JQUERY
        if (isset($_REQUEST["id"]) && 0 < intval($_REQUEST["id"])) {
            $id = $_REQUEST["id"];
// SAVE DATA
            for ($j = 0; $j < count($ColumnAPIUpdateData); $j++)
                $UpdateColDataString .= $UpdateColumns[$j] . " = '" . $posted[$ColumnAPIUpdateData[$j]] . "',";
            $UpdateColDataString = substr($UpdateColDataString, 0, strlen($UpdateColDataString) - 1);
            $Sql_input = " UPDATE $sTable SET $UpdateColDataString WHERE $sIndexColumn = " . intval($_REQUEST["id"]);
            $Sql_output = $RGVP->DB->Execute_Query($Sql_input, "SET", "UPDATE");
            header("location:../manifest-view.php?txt_id=" . $id . "&submit=submit");
// GET DATA
//            $Sql_input = "SELECT " . implode(",", $SelectColumns) . " FROM $sTable WHERE $sIndexColumn = " . intval($_GET["id"]);
//            $Sql_output = $RGVP->DB->Execute_Query($Sql_input, "GET", "SQLObj");
//            die(json_encode(mysqli_fetch_assoc($Sql_output)));
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
        $sQuery = " SELECT " . implode(",", $SelectColumns) . " FROM $sTable WHERE Status='New' ";
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
            $output["data"][] = array_merge(array('<a href="manifest-view.php?txt_id=' . $row[1] . '" class="btn btn-warning btn-docket-action" ><i class="fa fa-eye"></i></a>'), $row, $row);
        }
// RETURN IN JSON
        die(trim(json_encode($output))); // . $sQueryDisplay);
//echo "";
        break;
    case "SELECT-MANIFEST-BRANCH":
        $sWhere = "";
        $sOrder = "";
        $sLimit = "";
        if (isset($posted["Branch"])) {
            $sWhere = "Where FromBranch ='" . $posted["Branch"] . "' And Status = 'New'";
        }
// FETCH
        $sQueryDisplay = "";
        $sQuery = " SELECT " . implode(",", $SelectColumns) . " FROM $sTable $sWhere $sOrder $sLimit ";
        $sQueryDisplay .= $sQuery . "\n";
        $rResult = $RGVP->DB->Execute_Query($sQuery, "GET", "SQLObj");
        $displaytable = "";
        if ($RGVP->DB->StatusCode == "502") {
            $aRow = mysqli_num_rows($rResult);
            if ($aRow > 0) {
                while ($aRow = mysqli_fetch_assoc($rResult)) {

//            $row = array();
//            for ($i = 0; $i < count($SelectColumns); $i++) {
//                if ($SelectColumns[$i] == "version")
//                    $row[] = ( $aRow[$SelectColumns[$i]] == "0" ) ? "-" : $aRow[$SelectColumns[$i]];
//                else if ($SelectColumns[$i] != " ")
//                    $row[] = $aRow[$SelectColumns[$i]];
//            }
//            $output["data"][] = array_merge(array('<a data-id="row-' . $row[0] . '" href="javascript:editRow(' . $row[0] . ');" class="btn btn-success"><i class="fa fa-edit"></i></a>&nbsp;<a href="javascript:removeRow(' . $row[0] . ');" class="btn btn-danger" ><i class="fa fa-close"></i></a>'), $row, $row);
                    $displaytable1 .= '<tr><td><button type="button" class="btn btn-danger btn-calc-manifest" onclick="calc_manifests(' . $aRow["ManifestID"] . ')" id="btnmanifests_' . $aRow["ManifestID"] . '">Add Row</button></td>
                                    <td>' . $aRow["ManifestNumber"] . '</td><td>' . $aRow["ManifestDate"] . '</td>'
                            . '<td>' . $aRow["FromBranch"] . '</td><td>' . $aRow["ToBranch"] . '</td>'
                            . '<td>' . $aRow["ManifestItems"] . '</td><td>' . $aRow["ManifestWeight"] . '</td><td>' . $aRow["ManifestsAmount"] . '</td></tr>';
                }
            } else {
                $returnstring = $RGVP::GetStatus("607", FALSE);
            }

            $displaytable = '<table class="table table-bordered " id="myTable">
                                                        <thead>
                                                            <tr>
                                                                <th>Action</th>
                                                                <th>ManifestNumber</th>
                                                                <th>ManifestDate</th>
                                                                <th>FromBranch</th>
                                                                <th>ToBranch</th>
                                                                <th>ManifestItems</th>
                                                                <th>ManifestWeight</th>
                                                               <th>ManifestsAmount</th>
                                                                
                                                            </tr>
                                                        </thead><tbody>'
                    . $displaytable1 . '</tbody>
                                                    </table>';
// RETURN IN JSON
//        die(trim(json_encode($output))); // . $sQueryDisplay);
//echo "";
            echo $displaytable;
        } else {
            $displaytable = $RGVP::GetStatus("503", FALSE, "", $Sql_input);
        }
        break;
    case "SELECT-MANIFEST-BRANCH-THC":
        $sWhere = "";
        $sOrder = "";
        $sLimit = "";
        if (isset($posted["ToBranch"]) && isset($posted["FromBranch"])) {
            $sWhere = "Where FromBranch ='" . $posted["FromBranch"] . "' And ToBranch ='" . $posted["ToBranch"] . "' And Status = 'New'";
        }
// FETCH
        $displaytabledata = "";
        $displaytable1 = "";
        $returnstring = "";
        $sQueryDisplay = "";
        $sQuery = " SELECT " . implode(",", $SelectColumns) . " FROM $sTable $sWhere $sOrder $sLimit ";
        $sQueryDisplay .= $sQuery . "\n";
        $rResult = $RGVP->DB->Execute_Query($sQuery, "GET", "SQLObj");

        if ($RGVP->DB->StatusCode == "502") {
            $aRow = mysqli_num_rows($rResult);
            if ($aRow > 0) {
                while ($aRow = mysqli_fetch_assoc($rResult)) {
                    $displaytabledata .= '<tr><td><button type="button" class="btn btn-danger btn-calc-manifest" onclick="calc_manifests(' . $aRow["ManifestID"] . ')" id="btnmanifests_' . $aRow["ManifestID"] . '">Add Row</button></td>
                                    <td>' . $aRow["ManifestNumber"] . '</td><td>' . $aRow["ManifestDate"] . '</td>'
                            . '<td>' . $aRow["FromBranch"] . '</td><td>' . $aRow["ToBranch"] . '</td>'
                            . '<td>' . $aRow["ManifestItems"] . '</td><td>' . $aRow["ManifestWeight"] . '</td><td>' . $aRow["ManifestsAmount"] . '</td></tr>';
                }
                $returnstring = $RGVP::GetStatus("750", TRUE, "Table Data Returned.", $displaytabledata);
            } else {
                $returnstring = $RGVP::GetStatus("751", FALSE, "No Manifest Received for Route " . $posted["FromBranch"] . " To " . $posted["ToBranch"] . ". Query: " . $sQuery);
            }
        } else {
            $returnstring = $RGVP::GetStatus("503", FALSE, "", $Sql_input);
        }
        echo $returnstring;
        break;
    default:
        echo "Invalid Command.";
        break;
}